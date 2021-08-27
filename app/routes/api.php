<?php

use App\Http\Controllers\Api\AuthenticateController;
use App\Http\Controllers\Api\OtherController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
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
    Route::get('dashboard', [UserController::class, 'dashboard']);

    Route::get('swappable', [TransactionController::class, 'swappable']);
    Route::post('swapcoin', [TransactionController::class, 'swapcoin']);

    Route::get('vaultplans', [OtherController::class, 'vaultplans']);
    Route::post('buyplan', [OtherController::class, 'buyplan']);

    Route::get('kyc', [UserController::class, 'kyc']);
    Route::post('kyc', [UserController::class, 'postkyc']);

    Route::get('uploadkyc', [UserController::class, 'postkyc']);

    Route::get('deposit_cryto', [OtherController::class, 'depositcrypto']);
});

