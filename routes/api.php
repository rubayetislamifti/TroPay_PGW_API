<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\ProtectedApp;
use App\Http\Controllers\TestController;

Route::middleware(ProtectedApp::class)->group(function () {

    Route::post('/payment', [PaymentController::class, 'createCheckout']);

//    Route::post('/payment/callbackURL', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    Route::post('payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
});
//Route::get('test/payment/verify',[TestController::class, 'testVerify']);
