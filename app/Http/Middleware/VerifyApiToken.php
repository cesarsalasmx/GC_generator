<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->header('X-API-Token');
        if($token !== env('API_TOKEN')){
            return response()->json([
                'status' => 401,
                'code' => 'error',
                'message' => 'No autorizado'
            ],401);
        }
        return $next($request);
    }
}
