<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;
use Illuminate\Support\Facades\Route;


Route::post('/create-account', [AccountController::class,"createAccount"]);


Route::post('/debit', [BalanceController::class, 'debitAccount'])
    ->middleware('account-status');

Route::post('/credit', [BalanceController::class, 'creditAccount'])
    ->middleware('account-status');
