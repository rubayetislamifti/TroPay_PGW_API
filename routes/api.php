<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Middleware\ProtectedApp;

Route::middleware(ProtectedApp::class)->group(function () {

    Route::post('/payment', [PaymentController::class, 'paymentInit']);

    Route::post('/payment/callbackURL', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
});
