<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::middleware(\App\Http\Middleware\ProtectedApp::class)->group(function () {
    Route::get('/payment', [PaymentController::class, 'paymentInit']);
    Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
});
