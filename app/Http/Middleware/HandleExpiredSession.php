<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HandleExpiredSession
{
   
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $response = $next($request);
            
            
            if ($response->getStatusCode() === 419) {
                return redirect()->route('login')->withErrors([
                    'username' => 'Session expired. Please login again.',
                ]);
            }
            
            return $response;
        } catch (\Exception $e) {
           
            if (strpos($e->getMessage(), 'CSRF') !== false || strpos($e->getMessage(), 'token') !== false) {
                return redirect()->route('login')->withErrors([
                    'username' => 'Session expired. Please login again.',
                ]);
            }
            
            throw $e;
        }
    }
}
