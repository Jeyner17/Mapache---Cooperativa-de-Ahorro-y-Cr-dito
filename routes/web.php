<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SavingsAccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SavingsQuotaController;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('savings_accounts', SavingsAccountController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('savings_quotas', SavingsQuotaController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
