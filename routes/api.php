<?php

use App\Http\Controllers\Api\User\HomeController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::group(['prefix' => 'account/'], function () {
    Route::post('otp-request', [UserController::class, 'otpRequest']);
    Route::get('regions', [UserController::class, 'getValidRegions']);
    Route::get('country-code', [UserController::class, 'getCountryCode']);
    Route::post('otp-verification', [UserController::class, 'otpVerify']);
    Route::post('pin-setup', [UserController::class, 'pinSetup'])->middleware('auth:sanctum');
    Route::post('login', [UserController::class, 'login']);
});
Route::group(['prefix' => 'menu/', 'middleware' => ['auth:sanctum']], function () {
    Route::get('home-content', [HomeController::class, 'homePageContent']);
});
