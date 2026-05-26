<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PageStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $page): Response
    {
        $status = Cache::get("maintenance_status.$page");
        if ($status === 'maintenance') {
            return response()->view('status.maintenance');
        } elseif ($status === 'promo') {
            return response()->view('status.promo');
        }
        return $next($request);
    }
}
