<?php

use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::group(['prefix' => 'account/'], function () {
    Route::post('otp-request', [UserController::class, 'otpRequest']);
    Route::post('otp-verification', [UserController::class, 'otpVerify']);
    Route::post('pin-setup', [UserController::class, 'pinSetup'])->middleware('auth:sanctum');
    Route::post('login', [UserController::class, 'login']);
});
