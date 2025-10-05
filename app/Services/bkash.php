<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class bkash{
    protected $token;

    public function __construct($token){
        $this->token = $token;
    }

    public function allKey()
    {
        $username='01777614837';
        $password='$Jiq{H:1m+3';
        $appKey='IhoSMLt5FuagMTCxtVWRJ5sftc';
        $appSecret='vCtNEcEe4GpwAwNMpb6oIPW5omVaPx0njOcoiAUtL29O0HemOmai';
        $baseURL='https://tokenized.pay.bka.sh/v1.2.0-beta';

        $sandBoxURL = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta';
        $sandBoxUsername = 'sandboxTokenizedUser02';
        $sandBoxPassword = 'sandboxTokenizedUser02@12345';
        $sandBoxAppKey = '4f6o0cjiki2rfm34kfdadl1eqq';
        $sandBoxAppPassword = '2is7hdktrekvrbljjh44ll3d9l1dtjo4pasmjvs5vl5qr3fug4b';

        return[
            'username' => $username,
            'password' => $password,
            'appKey' => $appKey,
            'appSecret' => $appSecret,
            'baseURL' => $baseURL,

            'sandBoxURL' => $sandBoxURL,
            'sandBoxAppKey' => $sandBoxAppKey,
            'sandBoxAppPassword' => $sandBoxAppPassword,
            'sandBoxUsername' => $sandBoxUsername,
            'sandBoxPassword' => $sandBoxPassword
        ];
    }
    public function getToken()
    {
        $key = $this->allKey();

        if (env('APP_ENV') === 'production') {
            $response = Http::withHeaders([
                'username' => $key['username'],
                'password' => $key['password'],
            ])->post($key['baseURL'].'/tokenized/checkout/token/grant', [
                'app_key' => $key['appKey'],
                'app_secret' => $key['appSecret'],
            ]);
        }else{
            $response = Http::withoutVerifying()->withHeaders([
                'username' => $key['sandBoxUsername'],
                'password' => $key['sandBoxPassword'],
            ])->post($key['sandBoxURL'].'/tokenized/checkout/token/grant', [
                'app_key' => $key['sandBoxAppKey'],
                'app_secret' => $key['sandBoxAppPassword'],
            ]);
        }

        if ($response->successful()){
            $this->token = $response->json()['id_token'];
        }
        else{
            return response()->json([
                'success' => false,
                'message' => $response->json()
            ]);
        }
    }

    public function createPayment($amount, $reference){
        if (!$this->token){
            return response()->json([
                'success' => false,
                'message' => 'Token invalid'
            ]);
        }
        $key = $this->allKey();
        if (env('APP_ENV') === 'production') {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
                'X-App-Key' => $key['appKey'],
            ])->post($key['baseURL'].'/tokenized/checkout/create', [
                'mode' => '0000',
                'payerReference' => $reference,
                'callbackURL' => route('payment.success'),
                'amount' => $amount,
                'currency' => 'BDT',
                'intent' => 'sale',
                'merchantInvoiceNumber' => Str::random(16)
            ]);
        }
        else{
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => $this->token,
                'X-App-Key' => $key['sandBoxAppKey'],
            ])->post($key['sandBoxURL'].'/tokenized/checkout/create', [
                'mode' => '0000',
                'payerReference' => $reference,
                'callbackURL' => route('payment.success'),
                'amount' => $amount,
                'currency' => 'BDT',
                'intent' => 'sale',
                'merchantInvoiceNumber' => Str::random(16)
            ]);
        }

        if ($response->successful()){
//            dd($response->json());
            return response()->json([
                'success' => true,
                'payment_url' => $response->json('bkashURL'),
            ],200);

        }
        elseif(!$response->successful()){
            return response()->json([
                'success' => false,
                'message' => $response->json()
            ],200);
        }
        return response()->json([
            'success' => false,
            'message' => $response->json('errorMessage')
        ],$response->json('errorCode'));
    }

    public function executePayment($paymentID)
    {
//        dd($paymentID);
        $paymentID = request('paymentID');
        if (!$this->token){
            return response()->json([
                'success' => false,
                'message' => 'Token invalid'
            ]);
        }

        $key = $this->allKey();

        if (env('APP_ENV') === 'production') {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
                'X-App-Key' => $key['appKey'],
            ])->post($key['baseURL'].'/tokenized/checkout/execute', [
                'paymentID' => $paymentID,
            ]);
        }
        else{
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => $this->token,
                'X-App-Key' => $key['sandBoxAppKey'],
            ])->post($key['sandBoxURL'].'/tokenized/checkout/execute', [
                'paymentID' => $paymentID,
            ]);
        }

        if ($response->successful()){
            return response()->json([
                'success' => true,
                'message' => 'Payment Successful',
                'data' => $response->json()
            ]);
        }
        elseif (!$response->successful()){
            return response()->json([
                'success' => false,
                'message' => $response->json()
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => $response->json('errorMessage')
            ],$response->json('errorCode'));
        }
    }

    public function queryTransaction($agreementID)
    {
        if (!$this->token){
            return response()->json([
                'success' => false,
                'message' => 'Token invalid'
            ]);
        }

        $key = $this->allKey();

        if (env('APP_ENV') === 'production') {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
                'X-App-Key' => $key['appKey'],
            ])->post($key['baseURL'].'/tokenized/checkout/agreement/status', [
                'agreementID' => $agreementID,
            ]);
        }else{
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => $this->token,
                'X-App-Key' => $key['sandBoxAppKey'],
            ])->post($key['sandBoxURL'].'/tokenized/checkout/agreement/status', [
                'agreementID' => $agreementID,
            ]);
        }

        if ($response->successful()){
            return response()->json([
                'success' => false,
                'message' => $response->json()
            ]);
        }
    }

    public function searchTransaction($trxID)
    {
        if (!$this->token){
            return response()->json([
                'success' => false,
                'message' => 'Token invalid'
            ]);
        }

        $key = $this->allKey();

        if (env('APP_ENV') === 'production') {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
                'X-App-Key' => $key['appKey'],
            ])->post($key['baseURL'].'/tokenized/checkout/general/searchTran', [
                'trxID' => $trxID,
            ]);
        }
        else{
            $response = Http::withoutVerifying()->withHeaders([
                'Authorization' => $this->token,
                'X-App-Key' => $key['sandBoxAppKey'],
            ])->post($key['sandBoxURL'].'/tokenized/checkout/general/searchTran', [
                'trxID' => $trxID,
            ]);
        }

        if ($response->successful()){
            return response()->json();
        }else{
            return response()->json([
                'success' => false,
                'message' => $response->json()
            ]);
        }
    }
}
