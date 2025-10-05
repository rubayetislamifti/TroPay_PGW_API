<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProtectedApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $appKey = $request->header('App-Key');
        $apppassword = $request->header('App-Secret');

        $testApp = 'Rubayet_Islam';
        $testPassword = 'Rubayet_Islam2025';

        if (!$appKey || !$apppassword){
            return response()->json([
                'status' => false,
                'message' => 'App Key or App-Secret are required'
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($appKey != $testApp || $apppassword != $testPassword) {
            return response()->json([
                'status' => false,
                'message' => 'App key or App secret are not matched'
            ], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
