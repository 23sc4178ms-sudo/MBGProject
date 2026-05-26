<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Models\Profile;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = \Cache::get('maintenance_status.profiles', 'normal');
        if ($status === 'maintenance') {
            return response()->view('status.maintenance');
        } elseif ($status === 'promo') {
            return response()->view('status.promo');
        }
        $profiles = Profile::with('user')->get();
        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::doesntHave('profile')->get();
        return view('profiles.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id|unique:profiles,user_id',
            'bio' => 'required|string',
        ]);

        Profile::create($validated);

        return $this->adminAjaxResponse($request, 'Profile created successfully!', route('profiles.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $validated = $request->validate([
            'bio' => 'required|string',
        ]);

        $profile->update($validated);

        return $this->adminAjaxResponse($request, 'Profile updated successfully!', route('profiles.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        $profile->delete();
        return $this->adminAjaxResponse(request(), 'Profile deleted successfully!', route('profiles.index'));
    }
}
