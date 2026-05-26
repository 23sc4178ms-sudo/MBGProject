<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $role = $request->session()->get('auth_role');

        if (!$role && $request->session()->has('student_user_account_id')) {
            $role = 'student';
        }

        if (!$role) {
            return redirect()->route('login');
        }

        if ($role === 'student') {
            $studentId = $request->session()->get('student_id');

            if ($studentId) {
                return redirect()->route('students.show', $studentId);
            }

            return redirect()->route('login')->withErrors([
                'username' => 'Student session is missing.',
            ]);
        }

        if ($role === 'teacher') {
            return view('dashboard.teacher', [
                'studentsCount' => Student::count(),
                'degreesCount' => Degree::count(),
            ]);
        }

        return view('dashboard.admin', [
            'studentsCount' => Student::count(),
            'degreesCount' => Degree::count(),
            'accountsCount' => User::count(),
        ]);
    }
}