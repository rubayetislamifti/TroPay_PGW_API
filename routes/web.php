<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/payment/{token}', [PaymentController::class, 'showCheckoutPage'])->name('checkout.show');
Route::post('/payment/init', [PaymentController::class, 'paymentInit'])->name('payment.init');
Route::post('/payment/callbackURL', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

Route::get('/payment/search/transaction', [PaymentController::class, 'searchTransactions'])->name('payment.searchTransactions');


Route::get('test/payment',[TestController::class, 'testInit']);
Route::get('test/payment/callbackURL',[TestController::class, 'testCallback']);
Route::get('test/payment/verify',[TestController::class, 'testVerify']);
