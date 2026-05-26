<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = \Cache::get('maintenance_status.courses', 'normal');
        if ($status === 'maintenance') {
            return response()->view('status.maintenance');
        } elseif ($status === 'promo') {
            return response()->view('status.promo');
        }
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Course::create($validated);

        return $this->adminAjaxResponse($request, 'Course created successfully!', route('courses.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'course_name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $course->update($validated);

        return $this->adminAjaxResponse($request, 'Course updated successfully!', route('courses.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return $this->adminAjaxResponse(request(), 'Course deleted successfully!', route('courses.index'));
    }
}
