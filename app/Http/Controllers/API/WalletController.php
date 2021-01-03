<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use ErrorException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    public function verifyPayment(Request $request)
    {
        $reference = $request['reference'];
        $id = $request['id'];
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/{$reference}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer {$_ENV['PAYSTACK_SECRET_KEY']}",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            $res = json_decode($response);
            $status = $res->data->status;
            $amount = $res->data->amount / 100;

            if ($status == 'success') {
                $user = User::where('id', $id)->first();
                $user->deposit($amount);
            }
            return $user->balance;
        }
    }

    public function getUserTransactions(Request $request)
    {
        $transactions = DB::table('transactions')->where('payable_id', $request->user()->id)->get();
        return $transactions;
    }

    public function initiateWithdrawal(Request $request)
    {
        $amount = $request['amount'] * 100;
        $account_number = $request->user()->bank_account_number;
        $bank_code = $request->user()->bank_code;

        $res = resolveAccount($account_number, $bank_code);
        if (!$res) return;
        $status = $res->status;
        if ($status) {
            $fields = [
                'type' => "nuban",
                'name' => $res->data->account_name,
                'account_number' => $account_number,
                'bank_code' => $bank_code,
                'currency' => "NGN"
            ];
            $fields_string = http_build_query($fields);

            $res = createTransferRecipient($fields_string);
            $status = $res->status;
            if ($status) {
                $recipient_code = $res->data->recipient_code;
                $fields = [
                    'source' => "balance",
                    'amount' => $amount,
                    'recipient' => $recipient_code,
                    'reason' => "Holiday Flexing"
                ];
                $fields_string = http_build_query($fields);

                $max_try = 5;
                $attempts = 0;
                do {
                    try {
                        $res = queueTransfer($fields_string);
                    } catch (Exception $e) {
                        $attempts++;
                        sleep(1);
                        continue;
                    }
                    break;
                } while ($attempts < $max_try);
                return $res;
            }
        }
    }
}


// OTHER FUNCTIONS
function resolveAccount($account_number, $bank_code)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.paystack.co/bank/resolve?account_number={$account_number}&bank_code={$bank_code}",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer {$_ENV['PAYSTACK_SECRET_KEY']}",
            "Cache-Control: no-cache",
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if (!$err)
        return json_decode($response);
    else
        return false;
}

function createTransferRecipient($fields_string)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "https://api.paystack.co/transferrecipient");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer {$_ENV['PAYSTACK_SECRET_KEY']}",
        "Cache-Control: no-cache",
    ));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response);
}

function queueTransfer($fields_string)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.paystack.co/transfer");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Authorization: Bearer {$_ENV['PAYSTACK_SECRET_KEY']}",
        "Cache-Control: no-cache",
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    return $result;
}
