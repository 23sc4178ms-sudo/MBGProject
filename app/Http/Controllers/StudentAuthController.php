<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\UserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function showLoginForm()
    {
        if (session()->has('student_id')) {
            return redirect()->route('students.show', session('student_id'));
        }

        return view('auth.student-login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $account = UserAccount::where('username', $credentials['username'])
            ->where('role', 'student')
            ->where('is_active', 1)
            ->first();


        if (!$account || !Hash::check($credentials['password'], $account->password)) {
            return back()->withErrors([
                'username' => 'Invalid username or password.',
            ])->withInput();
        }

        // Migrate password to Argon2id if not already
        if (password_get_info($account->password)['algoName'] !== 'argon2id') {
            $account->password = Hash::make($credentials['password'], ['memory' => 65536, 'time' => 4, 'threads' => 2, 'type' => PASSWORD_ARGON2ID]);
            $account->save();
        }

        $student = $account->student;

        if (!$student) {
            return back()->withErrors([
                'username' => 'No student profile found for this account.',
            ]);
        }

        $request->session()->regenerate();
        session([
            'student_user_account_id' => $account->id,
            'student_id' => $student->id,
            'student_username' => $account->username,
        ]);

        // Check if password has never been changed - redirect to first login change password form
        if (is_null($account->password_changed_at) || $account->password_changed_at === null) {
            return redirect()->route('student.password.first-login.form', $student->id);
        }

        return redirect()->route('students.show', $student->id)->with('success', 'Login successful.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'student_user_account_id',
            'student_id',
            'student_username',
        ]);

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
