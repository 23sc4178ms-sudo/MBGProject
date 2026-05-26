<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Degree;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\UserAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Show the form for changing a student's password.
     */
    public function showChangePasswordForm($id)
    {
        $student = Student::findOrFail($id);
        $this->authorizeStudentAccess($student);
        return view('studentlayout.change-password', compact('student'));
    }
    private function authorizeStudentAccess(Student $student): void
    {
        if (session()->has('student_user_account_id') && (int) $student->user_account_id !== (int) session('student_user_account_id')) {
            abort(403, 'You are not allowed to access this student profile.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = \Cache::get('maintenance_status.students', 'normal');
        if ($status === 'maintenance') {
            return response()->view('status.maintenance');
        } elseif ($status === 'promo') {
            return response()->view('status.promo');
        }
        $students = Student::with('degree')->get();
        $degrees = Degree::all();
        return view('studentpage')->with('students', $students)->with('degrees', $degrees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return "Showing form to create student";
        $degrees = Degree::all();
        return view('studentlayout.addstudent', ['degrees' => $degrees]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:students,email',
            'contact' => 'required|string|max:20',
            'degree_id' => 'required|exists:degrees,id',
            'username' => 'required|string|min:4|max:255|unique:user_accounts,username',
            'password' => 'required|string|min:8|max:255',
        ]);
    
//         $user = UserAccount:: create(
// [
//     'username'=>$request->input('username'),
//     'email'=>$request->input('email'),
//     'password'=>bcrypt ($request->input('passwprd')),
//     'role'=>'student'
// ]
// );

// student::create([
//     'fname' => $validated ['fname'],
//     'mname' => $validated ['mname']?? null,
//     'lname' => $validated ['lname'],
//     'contact' => $validated ['contact'],
//     'email' => $validated ['fname'],
//     'fname' => $validated ['fname'],
// ])

        DB::transaction(function () use ($validated) {
            $account = UserAccount::create([
                'username' => $validated['username'],
                'email' => $validated['email'],
                // Use Argon2id for hashing
                'password' => Hash::make($validated['password'], ['memory' => 65536, 'time' => 4, 'threads' => 2, 'type' => PASSWORD_ARGON2ID]),
                'role' => 'student',
                'is_active' => 1,
                'password_changed_at' => null, // Force first login password change
            ]);

            Student::create([
                'name' => $validated['name'],
                'mname' => $validated['mname'] ?? null,
                'lname' => $validated['lname'],
                'email' => $validated['email'],
                'contact' => $validated['contact'],
                'degree_id' => $validated['degree_id'],
                'user_account_id' => $account->id,
            ]);
        });
        
        $msg = "Student is Added!";
        Log::info($msg);
        Log::notice($msg);
        Log::alert($msg);
        Log::emergency($msg);
        Log::alert($msg);
        Log::critical($msg);
        Log::error($msg);
        Log::warning($msg);
        Log::alert($msg);

        Log::info('A new student has been added: ' . $validated['name'] . ' ' . $validated['lname']);
        
        $redirect = session('auth_role') === 'admin' ? route('students.index') : route('dashboard');

        return $this->adminAjaxResponse($request, $msg, $redirect);
    }

        // Student::create($request->only(['name', 'mname', 'lname', 'email', 'contact']));

        // return redirect()->route('studentPage.index')->with('success', 'Student added successfully.');
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return "Displaying student with ID: $id";
        $student = Student::with('degree')->findOrFail($id);

        $this->authorizeStudentAccess($student);

        if (request()->ajax() && request()->header('X-Modal-Request') === 'student-view') {
            return view('studentlayout.partials.show-modal', compact('student'));
        }

        return view('studentlayout.show')->with("students", [$student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // return "Showing form to edit student with ID: $id";
        $student = Student::findOrFail($id);
        $this->authorizeStudentAccess($student);
        $degrees = Degree::all();

        if (request()->ajax() && request()->header('X-Modal-Request') === 'student-edit') {
            return view('studentlayout.partials.edit-modal', compact('student', 'degrees'));
        }

        return view('studentlayout.edit')->with('student', $student)->with('degrees', $degrees);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'mname' => 'nullable|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'contact' => 'required|string|max:20',
            'degree_id' => 'required|exists:degrees,id',
        ]);

        $student = Student::findOrFail($id);
        $this->authorizeStudentAccess($student);
        $student->update($validated);

        if ($student->user_account_id) {
            UserAccount::where('id', $student->user_account_id)->update([
                'email' => $student->email,
            ]);
        }

        // Handle password change if fields are filled
        if ($request->filled('old_password') || $request->filled('new_password') || $request->filled('new_password_confirmation')) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
            ]);
            $account = UserAccount::find($student->user_account_id);
            if (!$account || !\Illuminate\Support\Facades\Hash::check($request->old_password, $account->password)) {
                if ($request->expectsJson() || $request->ajax()) {
                    return response()->json([
                        'message' => 'Old password is incorrect.',
                        'errors' => ['old_password' => ['Old password is incorrect.']],
                    ], 422);
                }

                return back()->withErrors(['old_password' => 'Old password is incorrect.'])->withInput();
            }
            // Use Argon2id for hashing
            $account->password = \Illuminate\Support\Facades\Hash::make($request->new_password, ['memory' => 65536, 'time' => 4, 'threads' => 2, 'type' => PASSWORD_ARGON2ID]);
            $account->save();
        }

        return $this->adminAjaxResponse($request, 'Student updated successfully.', route('students.index'));
    }
    
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Check if user is still authenticated
        if (!session()->has('auth_role') && !session()->has('student_user_account_id')) {
            if (request()->expectsJson() || request()->ajax()) {
                return response()->json([
                    'message' => 'Session expired. Please login again.',
                    'redirect' => route('login'),
                ], 401);
            }

            return redirect()->route('login')->withErrors([
                'username' => 'Session expired. Please login again.',
            ]);
        }

        // return "Deleting student";
        $student = Student::find($id);

        if (!$student) {
            return $this->adminAjaxError(request(), 'Student not found.', route('students.index'), 404);
        }

        $this->authorizeStudentAccess($student);

        $userAccountId = $student->user_account_id;
        $student->delete();

        if ($userAccountId) {
            UserAccount::where('id', $userAccountId)->delete();
        }

        return $this->adminAjaxResponse(request(), 'Student deleted successfully.', route('students.index'));
    }
        /**
         * Change the password for a student account.
         */
        public function changePassword(Request $request, $id)
        {

            $request->validate([
                'old_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $student = Student::findOrFail($id);
            $this->authorizeStudentAccess($student);

            if (!$student->user_account_id) {
                return back()->withErrors(['old_password' => 'No user account associated.']);
            }

            $account = \App\Models\UserAccount::find($student->user_account_id);
            if (!$account) {
                return back()->withErrors(['password' => 'User account not found.']);
            }

            if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $account->password)) {
                return back()->withErrors(['old_password' => 'Old password is incorrect.']);
            }

            // Use Argon2id for hashing
            $account->password = \Illuminate\Support\Facades\Hash::make($request->password, ['memory' => 65536, 'time' => 4, 'threads' => 2, 'type' => PASSWORD_ARGON2ID]);
            $account->password_changed_at = now();
            $account->save();

            return back()->with('success', 'Password changed successfully.');
        }

        /**
         * Submit first login password change (with old password validation).
         */
        public function submitFirstLoginChangePassword(Request $request, $id)
        {
            $request->validate([
                'old_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $student = Student::findOrFail($id);
            
            // Allow access if it's the logged-in student
            if (session('student_id') && (int) $student->id !== (int) session('student_id')) {
                abort(403, 'You are not allowed to perform this action.');
            }

            if (!$student->user_account_id) {
                return back()->withErrors(['password' => 'No user account associated.']);
            }

            $account = \App\Models\UserAccount::find($student->user_account_id);
            if (!$account) {
                return back()->withErrors(['password' => 'User account not found.']);
            }

            if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $account->password)) {
                return back()->withErrors(['old_password' => 'Old password is incorrect.']);
            }

            // Use Argon2id for hashing
            $account->password = \Illuminate\Support\Facades\Hash::make($request->password, ['memory' => 65536, 'time' => 4, 'threads' => 2, 'type' => PASSWORD_ARGON2ID]);
            $account->password_changed_at = now();
            $account->save();

            return redirect()->route('students.show', $student->id)->with('success', 'Password set successfully. Welcome!');
        }

        /**
         * Show the first login change password form (requires old password).
         */
        public function showFirstLoginChangePasswordForm($id)
        {
            $student = Student::findOrFail($id);
            
            // Allow access if it's the logged-in student
            if (session('student_id') && (int) $student->id === (int) session('student_id')) {
                return view('studentlayout.first-login-change-password', compact('student'));
            }
            
            abort(403, 'You are not allowed to access this page.');
        }
    
        
}
