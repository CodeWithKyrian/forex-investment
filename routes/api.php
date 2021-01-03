<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::apiResource('/products', 'App\Http\Controllers\ProductController');
Route::group(['prefix' => 'products'], function () {
    Route::apiResource('/{product}/reviews', 'App\Http\Controllers\ReviewController');
});

Route::post('/register', 'App\Http\Controllers\API\AccessController@register');
Route::post('/login', 'App\Http\Controllers\API\AccessController@login');
Route::apiResource('/articles', 'App\Http\Controllers\API\ArticleController');

Route::get('/webhook', 'App\Http\Controllers\API\WebhookController@index');

Route::middleware('auth:api')->group(function () {
    Route::post('logout', 'App\Http\Controllers\API\AccessController@logout');

    // USER
    Route::apiResource('/users', 'App\Http\Controllers\API\UserController');
    Route::get('/get_user', 'App\Http\Controllers\API\UserController@getUser');
    Route::post('/confirm_user_password', 'App\Http\Controllers\API\UserController@confirmPassword');

    // WALLET
    Route::post('/wallet/verify_payment', 'App\Http\Controllers\API\WalletController@verifyPayment');
    Route::post('/wallet/initiate_withdrawal', 'App\Http\Controllers\API\WalletController@initiateWithdrawal');
    Route::get('/wallet/get_user_transactions', 'App\Http\Controllers\API\WalletController@getUserTransactions');

    // BANKS
    Route::apiResource('/banks', 'App\Http\Controllers\API\BankController');
    Route::post('/banks/verify', 'App\Http\Controllers\API\BankController@verifyBankAccount');

    // ROLES ND PERMISSIONS
    Route::get('roles', 'App\Http\Controllers\API\PermissionController@role_list');
    Route::post('roles', 'App\Http\Controllers\API\PermissionController@role_store');
    Route::get('permissions', 'App\Http\Controllers\API\PermissionController@permission_list');
    Route::post('permissions', 'App\Http\Controllers\API\PermissionController@permission_store');
    Route::post('assign_permission/{role}', 'App\Http\Controllers\API\PermissionController@role_has_permissions');
    Route::post('assign_user_to_role/{role}', 'App\Http\Controllers\API\PermissionController@assign_user_to_role');
});

Route::fallback(function () {
    return response()->json(['message' => 'Not Found.'], 404);
})->name('api.fallback.404');

// ->middleware('api.admin')
// ->middleware('api.superAdmin')