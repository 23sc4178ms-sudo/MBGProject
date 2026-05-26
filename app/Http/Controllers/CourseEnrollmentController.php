<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

use App\Models\CourseEnrollment;
use App\Models\Course;
use App\Models\Student;


class CourseEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $status = \Cache::get('maintenance_status.enrollments', 'normal');
        if ($status === 'maintenance') {
            return response()->view('status.maintenance');
        } elseif ($status === 'promo') {
            return response()->view('status.promo');
        }
        $enrollments = CourseEnrollment::with(['course', 'student'])->get();
        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::all();
        $students = Student::all();
        return view('enrollments.create', compact('courses', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
            'enrollment_date' => 'required|date',
        ]);

        CourseEnrollment::create($validated);

        return $this->adminAjaxResponse($request, 'Student enrolled successfully!', route('course-enrollments.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseEnrollment $courseEnrollment)
    {
        return view('enrollments.show', compact('courseEnrollment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseEnrollment $courseEnrollment)
    {
        $courses = Course::all();
        $students = Student::all();
        return view('enrollments.edit', compact('courseEnrollment', 'courses', 'students'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CourseEnrollment $courseEnrollment)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'student_id' => 'required|exists:students,id',
            'enrollment_date' => 'required|date',
        ]);

        $courseEnrollment->update($validated);

        return $this->adminAjaxResponse($request, 'Enrollment updated successfully!', route('course-enrollments.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseEnrollment $courseEnrollment)
    {
        $courseEnrollment->delete();
        return $this->adminAjaxResponse(request(), 'Enrollment deleted successfully!', route('course-enrollments.index'));
    }
}
