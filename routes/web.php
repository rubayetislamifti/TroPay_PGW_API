<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/payment', [PaymentController::class, 'paymentInit']);
//Route::get('/payment/callbackURL', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

Route::get('test/payment',[TestController::class, 'testInit']);
Route::get('test/payment/callbackURL',[TestController::class, 'testCallback']);
