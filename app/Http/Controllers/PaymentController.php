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
//        $amount = $request->input('amount');
//        $reference = $request->input('reference');
        $amount = 1;
        $reference = '01642889275';
        $bkash = new bkash($this->token);

        $token = $bkash->getToken();

        $createPayment = $bkash->createPayment($amount, $reference);

        if ($createPayment instanceof \Illuminate\Http\JsonResponse) {
            $createPayment = $createPayment->getData(true);
        }

        return response()->json($createPayment);
    }

    public function paymentSuccess(Request $request){
        $bkash = new bkash($this->token);

        $token = $bkash->getToken();

        $executePayment = $bkash->executePayment();

        if ($executePayment instanceof \Illuminate\Http\JsonResponse) {
            $executePayment = $executePayment->getData(true);
        }

        return response()->json($executePayment);
    }
}
