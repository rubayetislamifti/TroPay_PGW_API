<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function testInit()
    {
        $testApp = 'Rubayet_Islam';
        $testPassword = 'Rubayet_Islam2025';
        $baseURL = 'https://tropay.zobayerdev.top';
        $amount = 1;
        $reference = '01642889275';
        try {
            if (env('APP_ENV') === 'production') {
                $response = Http::withHeaders([
                    'App-Key' => $testApp,
                    'App-Secret' => $testPassword,
                ])->post($baseURL . '/api/payment',[
                    'amount' => $amount,
                    'reference' => $reference,
                ]);
            }else{
                $response = Http::withoutVerifying()->withHeaders([
                    'App-Key' => $testApp,
                    'App-Secret' => $testPassword,
                ])->post($baseURL . '/api/payment',[
                    'amount' => $amount,
                    'reference' => $reference,
                ]);
            }
            if ($response->successful()){
//                dd($response->json());
                return redirect()->away($response->json()['payment_url']);
            }
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }
    public function testVerify(Request $request)
    {
//        dd($request->getHost());
        $testApp = 'Rubayet_Islam';
        $testPassword = 'Rubayet_Islam2025';
        $baseURL = 'https://tropay.zobayerdev.top';
        $agreementID = $request->query('agreementID');
        try {
            if (env('APP_ENV') === 'production') {
                $response = Http::withHeaders([
                    'App-Key' => $testApp,
                    'App-Secret' => $testPassword,
                ])->post($baseURL . '/api/payment/verify',[
                    'agreementID' => $agreementID,
                ]);
            }else{
                $response = Http::withoutVerifying()->withHeaders([
                    'App-Key' => $testApp,
                    'App-Secret' => $testPassword,
                ])->post($baseURL . '/api/payment/verify',[
                    'agreementID'=> $agreementID,
                ]);
            }
            if ($response->successful()){
                dd($response->json());
//                return redirect()->away($response->json()['payment_url']);
            }
        }catch (\Exception $e){
            dd($e->getMessage());
        }
    }
}
