<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $status = \Cache::get('maintenance_status.users', 'normal');
        if ($status === 'maintenance') {
            return response()->view('status.maintenance');
        } elseif ($status === 'promo') {
            return response()->view('status.promo');
        }
        $users = User::with(['profile', 'posts'])->withCount('posts')->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,teacher',
        ]);

        User::create($validated);

        return $this->adminAjaxResponse($request, 'User created successfully!', route('users.index'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,teacher',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'string|min:8']);
            $validated['password'] = $request->password;
        }

        $user->update($validated);

        return $this->adminAjaxResponse($request, 'User updated successfully!', route('users.index'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->adminAjaxResponse(request(), 'User deleted successfully!', route('users.index'));
    }

    /**
     * Show the first login change password form (no old password required).
     */
    public function showFirstLoginChangePasswordForm($id)
    {
        $user = User::findOrFail($id);
        
        // Allow access if it's the logged-in user
        if (session('auth_user_id') && (int) $user->id === (int) session('auth_user_id')) {
            return view('userlayout.first-login-change-password', compact('user'));
        }
        
        abort(403, 'You are not allowed to access this page.');
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

        $user = User::findOrFail($id);
        
        // Allow access if it's the logged-in user
        if (session('auth_user_id') && (int) $user->id !== (int) session('auth_user_id')) {
            abort(403, 'You are not allowed to perform this action.');
        }

        if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect.']);
        }

        // Use Argon2id for hashing
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password, ['memory' => 65536, 'time' => 4, 'threads' => 2, 'type' => PASSWORD_ARGON2ID]);
        $user->password_changed_at = now();
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Password set successfully. Welcome!');
    }
}
