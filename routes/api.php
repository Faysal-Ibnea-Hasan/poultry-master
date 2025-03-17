<?php

use App\Http\Controllers\Api\Management\BatchManagementController;
use App\Http\Controllers\Api\Management\ExpenseController;
use App\Http\Controllers\Api\User\HomeController;
use App\Http\Controllers\Api\User\MenuController;
use App\Http\Controllers\Api\User\SubscriptionController;
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
    Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => 'menu/'], function () {
        Route::get('home-content', [HomeController::class, 'homePageContent']);
        Route::post('get-result', [MenuController::class, 'getMenuResults']);
    });
    Route::group(['prefix' => 'seed/'], function () {
        Route::get('get-companies', [HomeController::class, 'companies']);
        Route::get('get-chick-types', [BatchManagementController::class, 'chickTypes']);
        Route::get('get-batch-dropdown', [BatchManagementController::class, 'batchDropdown']);
        Route::get('get-expense-types', [ExpenseController::class, 'expenseTypes']);
        Route::get('get-food-types', [ExpenseController::class, 'foodTypes']);
    });
    Route::group(['prefix' => 'profile/'], function () {
        Route::match(['get', 'post'], 'update', [UserController::class, 'updateProfile']);
    });
    Route::group(['prefix' => 'manager/'], function () {
        Route::post('batches', [BatchManagementController::class, 'batches']);
        Route::post('manage-batch', [BatchManagementController::class, 'createOrUpdateBatch']);
        Route::post('add-to-old-batch', [BatchManagementController::class, 'addBatchToOLd']);
        Route::post('delete-batch', [BatchManagementController::class, 'deleteBatch']);

        Route::post('expenses', [ExpenseController::class, 'expenses']);
        Route::post('manage-expense', [ExpenseController::class, 'createOrUpdateExpense']);
        Route::post('delete-expense', [ExpenseController::class, 'deleteExpense']);

    });
    Route::group(['prefix' => 'subscription/'], function () {
        Route::post('subscribe', [SubscriptionController::class, 'subscribe']);
    });
});
Route::match(['get', 'post'], 'subscription/payment-success', [SubscriptionController::class, 'paymentSuccess']);




