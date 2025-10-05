<?php

namespace App\Http\Controllers;

use App\Services\bkash;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $token;

    public function __construct($token=null){
        $this->token = $token;
    }
    public function paymentInit(Request $request)
    {
        $amount = $request->input('amount');
        $reference = $request->input('reference');
        $bkash = new bkash($this->token);

        $token = $bkash->getToken();

        $createPayment = $bkash->createPayment($amount, $reference);

        return response()->json($createPayment);
    }

    public function paymentSuccess(Request $request){
        $bkash = new bkash($this->token);

        $token = $bkash->getToken();

        $executePayment = $bkash->executePayment();

        return $executePayment;
    }
}
