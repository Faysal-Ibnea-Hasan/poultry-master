<?php

use App\Http\Controllers\Api\User\HomeController;
use App\Http\Controllers\Api\User\MenuController;
use App\Http\Controllers\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::post('migrate-refresh', [\App\Http\Controllers\MigrationController::class, 'migrateRefresh']);
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
Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'menu/'], function () {
        Route::get('home-content', [HomeController::class, 'homePageContent']);
        Route::post('get-result', [MenuController::class, 'getMenuResults']);
    });
    Route::group(['prefix' => 'seed/'], function () {
        Route::get('get-companies', [HomeController::class, 'companies']);
    });
    Route::group(['prefix' => 'profile/'], function () {
        Route::match(['get', 'post'], 'update', [UserController::class, 'updateProfile']);
    });
});



