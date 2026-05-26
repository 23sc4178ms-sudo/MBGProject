<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Models\Degree;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = \Cache::get('maintenance_status.degrees', 'normal');
        if ($status === 'maintenance') {
            return response()->view('status.maintenance');
        } elseif ($status === 'promo') {
            return response()->view('status.promo');
        }
        $degrees = Degree::all();
        return view('degreereslayout.index', ['degrees' => $degrees]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('degreereslayout.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $validated = $request->validate([
            'Degree' => 'required|string|max:255|unique:degrees,Degree',
        ]);

        Degree::create($validated);
        
        return $this->adminAjaxResponse($request, 'Degree added successfully.', route('degrees.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $degree = Degree::find($id);
        return view('degreereslayout.show', ['degree' => $degree]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $degree = Degree::find($id);
        return view('degreereslayout.edit', ['degree' => $degree]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Degree' => 'required|string|max:255|unique:degrees,Degree,' . $id,
        ]);

        $degree = Degree::find($id);
        $degree->update([
            'Degree' => $request->input('Degree'),
        ]);

        return $this->adminAjaxResponse($request, 'Degree updated successfully.', route('degrees.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Degree::destroy($id);
        return $this->adminAjaxResponse(request(), 'Degree deleted successfully.', route('degrees.index'));
    }
}
