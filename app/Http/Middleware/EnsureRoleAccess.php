<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureRoleAccess
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $role = $request->session()->get('auth_role');

        if (!$role && $request->session()->has('student_user_account_id')) {
            $role = 'student';
        }

        if (!$role) {
            return redirect()->route('login')->withErrors([
                'username' => 'Please login first.',
            ]);
        }

        if (!empty($roles) && !in_array($role, $roles, true)) {
            abort(403, 'You are not authorized to access this page.');
        }

        return $next($request);
    }
}