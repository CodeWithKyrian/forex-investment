<?php

namespace App\Http\Resources;

use App\Models\Bank;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    public static $wrap = 'user';
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'xid' => $this->xid,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'bank_account_number' => $this->bank_account_number,
            'bank_code' => $this->bank_code,
            'bank_name' => Bank::where('bank_code', $this->bank_code)->first()->name,
            'bank_account_verified' => $this->bank_account_verified,
            'wallet_id' => $this->wallet->id,
            'wallet_balance' => $this->wallet->balance,
            'aaa' => Auth::user()->hasWallet("default")
        ];
    }
}