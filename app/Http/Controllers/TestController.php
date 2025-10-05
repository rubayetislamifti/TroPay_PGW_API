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

        if (env('APP_ENV') === 'production') {
            $response = Http::withHeaders([
                'App-Key' => $testApp,
                'App-Secret' => $testPassword,
            ])->get($baseURL . '/api/payment');
        }else{
            $response = Http::withoutVerifying()->withHeaders([
                'App-Key' => $testApp,
                'App-Secret' => $testPassword,
            ])->get($baseURL . '/api/payment',[
                'amount' => 1,
                'reference' => '01642889275',
            ]);
        }

        dd($response->json());
    }
}
