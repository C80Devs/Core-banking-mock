<?php

use App\Http\Controllers\Account;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\LAController;
use Illuminate\Support\Facades\Route;


Route::post('/create-account', [AccountController::class,"createAccount"]);


Route::post('/debit', [BalanceController::class, 'debitAccount'])
    ->middleware('account-status');
