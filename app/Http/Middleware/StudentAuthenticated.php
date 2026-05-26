<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StudentAuthenticated
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('student_user_account_id') && $request->session()->get('auth_role') !== 'student') {
            return redirect()->route('login')->withErrors([
                'username' => 'Please login first.',
            ]);
        }

        return $next($request);
    }
}
