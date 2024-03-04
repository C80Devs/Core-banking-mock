<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;
use Illuminate\Support\Facades\Route;


Route::post('/create-account', [AccountController::class,"createAccount"]);


Route::prefix('account')->group(function () {
    Route::post('/debit', [BalanceController::class, 'debitAccount'])
        ->middleware('account-status');

    Route::post('/credit', [BalanceController::class, 'creditAccount'])
        ->middleware('account-status');

    Route::post('/restrict-credit', [AccountController::class, 'restrictCredit']);
    Route::post('/restrict-debit', [AccountController::class, 'restrictDebit']);
    Route::post('/restrict', [AccountController::class, 'restrictAccount']);
    Route::post('/unrestrict', [AccountController::class, 'unRestrictAccount']);
});

