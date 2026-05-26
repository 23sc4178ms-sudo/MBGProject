<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (session()->has('auth_role') || session()->has('student_user_account_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = trim($credentials['username']);

        $user = User::where('username', $identifier)
            ->orWhere('email', $identifier)
            ->first();

        if ($user && in_array($user->role, ['admin', 'teacher'], true) && Hash::check($credentials['password'], $user->password)) {
            $request->session()->regenerate();

            session([
                'auth_user_id' => $user->id,
                'auth_role' => $user->role ?: 'user',
                'auth_name' => $user->name,
                'auth_username' => $user->username,
                'auth_email' => $user->email,
                'auth_provider' => 'users',
            ]);

            // Check if teacher needs to change password on first login
            if ($user->role === 'teacher' && (is_null($user->password_changed_at) || $user->password_changed_at === null)) {
                return redirect()->route('user.password.first-login.form', $user->id);
            }

            return redirect()->route('dashboard')->with('success', 'Login successful.');
        }

        $account = UserAccount::where(function ($query) use ($identifier) {
                $query->where('username', $identifier)
                    ->orWhere('email', $identifier);
            })
            ->where('role', 'student')
            ->where('is_active', 1)
            ->first();

        if (!$account || !Hash::check($credentials['password'], $account->password)) {
            return back()->withErrors([
                'username' => 'Invalid username or password.',
            ])->withInput();
        }

        $student = $account->student;

        if (!$student) {
            return back()->withErrors([
                'username' => 'No student profile found for this account.',
            ])->withInput();
        }

        $request->session()->regenerate();

        session([
            'auth_user_id' => $account->id,
            'auth_role' => 'student',
            'auth_name' => trim(($student->name ?? '') . ' ' . ($student->lname ?? '')) ?: $account->username,
            'auth_username' => $account->username,
            'auth_email' => $account->email,
            'auth_provider' => 'user_accounts',
            'student_user_account_id' => $account->id,
            'student_id' => $student->id,
            'student_username' => $account->username,
        ]);

        // Check if student needs to change password on first login
        if (is_null($account->password_changed_at)) {
            return redirect()->route('student.password.first-login.form', $student->id);
        }

        return redirect()->route('students.show', $student->id)->with('success', 'Login successful.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'auth_user_id',
            'auth_role',
            'auth_name',
            'auth_username',
            'auth_email',
            'auth_provider',
            'student_user_account_id',
            'student_id',
            'student_username',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}