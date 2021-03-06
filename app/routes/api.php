<?php

use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\OtherController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TradeController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\WithdrawalController;
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



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/webhook', 'CallbackController@webhook')->name('webhook');
Route::post('/coinremittersuccesscallback', 'CallbackController@coinremittersuccesscallback');


Route::middleware("guest")->group(function () {
    Route::post('login', [AuthenticateController::class, 'login']);
    Route::post('signup', [AuthenticateController::class, 'signup']);
});

Route::middleware("auth:api")->group(function () {
    Route::post('biometriclogin', [AuthenticateController::class, 'loginonetime']);

    Route::get('dashboard', [UserController::class, 'dashboard']);

    Route::get('swappable', [TransactionController::class, 'swappable']);
    Route::post('swapcoin', [TransactionController::class, 'swapcoin']);

    Route::get('vaultplans', [OtherController::class, 'vaultplans']);
    Route::post('buyplan', [OtherController::class, 'buyplan']);

    Route::get('kyc', [UserController::class, 'kyc']);
    Route::post('kyc', [UserController::class, 'postkyc']);

    Route::post('updateaccount', [UserController::class, 'submitProfile']);

    Route::post('changepassword', [AuthenticateController::class, 'changepassword']);

    Route::get('deposit_crypto', [OtherController::class, 'depositcrypto']);

    Route::get('createoffer', [TradeController::class, 'create']);
    Route::post('createoffer', [TradeController::class, 'postoffer']);
    Route::get('myoffers', [TradeController::class, 'myoffers']);
    Route::get('offersparams', [TradeController::class, 'offersparams']);
    Route::post('fetchmarket', [TradeController::class, 'fetchmarket']);
    Route::get('activateoffer/{code}', [TradeController::class, 'activateoffer']);
    Route::get('disableoffer/{code}', [TradeController::class, 'disableoffer']);
    Route::get('deleteoffer/{code}', [TradeController::class, 'deleteoffer']);
    Route::get('takeoffer', [TradeController::class, 'contactseller']);
    Route::get('manageoffer/{code}', [TradeController::class, 'manageofferbuy']);


    Route::get('createwallet', [WalletController::class, 'createwalletget']);
    Route::post('createwallet', [WalletController::class, 'createwallet']);
    Route::get('wallets', [WalletController::class, 'wallets']);
    Route::get('wallets/{id}', [WalletController::class, 'wallet']);
    Route::get('wallet/{id}', [WalletController::class, 'viewaddress']);
    Route::post('sendcoin', [WalletController::class, 'sendfromwallet']);

    Route::post('ngndeposit', [PaymentController::class, 'depositInsert']);
    Route::post('paystackcallback', [PaymentController::class, 'paystackipn']);

    Route::get('cryptodeposit', [PaymentController::class, 'depositcrypto']);
    Route::post('cryptodeposit', [PaymentController::class, 'depositcryptopost']);
    Route::post('verifycryptodeposit', [PaymentController::class, 'verifycryptodeposit']);


    Route::get('withdraw', [WithdrawalController::class, 'withdraw']);
    Route::post('withdraw', [WithdrawalController::class, 'withdrawMoney']);

    Route::get('referrallogs', [UserController::class, 'referrallogs']);
});

