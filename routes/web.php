<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment', [PaymentController::class, 'paymentInit']);
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
