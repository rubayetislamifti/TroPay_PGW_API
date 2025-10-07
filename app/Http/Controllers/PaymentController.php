<?php

namespace App\Http\Controllers;

use App\Services\bkash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    protected $token;

    public function __construct($token=null){
        $this->token = $token;
    }
    public function createCheckout(Request $request)
    {
        $amount = $request->input('amount');
        $reference = $request->input('reference');


        $urltoken = Str::uuid();
        if (env('APP_ENV') === 'production') {
            $checkoutLink = route('checkout.show'.$urltoken) . '?amount=' . $amount . '&reference=' . $reference;
        }else{
            $checkoutLink = route('sandbox') . '?amount=' . $amount . '&reference=' . $reference;
        }

        return response()->json([
            'success' => true,
            'payment_url' => $checkoutLink,
        ]);
    }
    public function showCheckoutPage(Request $request, $urltoken)
    {
        $amount = $request->input('amount');
        $reference = $request->input('reference');
        return view('checkout', ['amount' => $amount, 'reference' => $reference]);
    }

    public function sandBox(Request $request)
    {
        $amount = $request->input('amount');
        $reference = $request->input('reference');
        return view('sandbox', ['amount' => $amount, 'reference' => $reference]);
    }
    public function paymentInit(Request $request)
    {

            $amount = $request->input('amount');
            $reference = $request->input('reference');

            $bkash = new bkash($this->token);

            $token = $bkash->getToken();

            $createPayment = $bkash->createPayment($amount, $reference);

            if ($createPayment instanceof \Illuminate\Http\JsonResponse) {
                $createPayment = $createPayment->getData(true);
            }

            return redirect()->away($createPayment['payment_url']);

    }

    public function paymentSuccess(Request $request){
        $bkash = new bkash($this->token);
        $paymentID = $request->input('paymentID');

        $token = $bkash->getToken();

        $executePayment = $bkash->executePayment($paymentID);

        if ($executePayment instanceof \Illuminate\Http\JsonResponse) {
            $executePayment = $executePayment->getData(true);
        }

        return response()->json($executePayment);
    }

    public function verifyPayment(Request $request)
    {
        $bkash = new bkash($this->token);
        $agreementID = $request->input('agreementID');

        $token = $bkash->getToken();

        $queryTransaction = $bkash->queryTransaction($agreementID);

        if ($queryTransaction instanceof \Illuminate\Http\JsonResponse) {
            $queryTransaction = $queryTransaction->getData(true);
        }

        return response()->json($queryTransaction);
    }

    public function searchTransactions(Request $request){
        $bkash = new bkash($this->token);

        $token = $bkash->getToken();

        $trxID = $request->input('trxID');

        $searchTransaction = $bkash->searchTransaction($trxID);

        if ($searchTransaction instanceof \Illuminate\Http\JsonResponse) {
            $searchTransaction = $searchTransaction->getData(true);
        }

        return response()->json($searchTransaction);
    }
}
