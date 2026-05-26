@extends('format.layout')

@section('title', 'Enrollment Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Enrollment Details</h1>
        <p class="card-subtitle">Information for Enrollment #{{ $courseEnrollment->id }}</p>
    </div>
    <div class="card-body">
        <div class="details-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <div>
                <h3 style="color: var(--primary); margin-bottom: 1rem;">Student Information</h3>
                <p><strong>Name:</strong> {{ $courseEnrollment->student->name }} {{ $courseEnrollment->student->lname }}</p>
                <p><strong>Email:</strong> {{ $courseEnrollment->student->email }}</p>
            </div>
            <div>
                <h3 style="color: var(--primary); margin-bottom: 1rem;">Course Information</h3>
                <p><strong>Course:</strong> {{ $courseEnrollment->course->course_name }}</p>
                <p><strong>Enrollment Date:</strong> {{ \Carbon\Carbon::parse($courseEnrollment->enrollment_date)->format('M d, Y') }}</p>
            </div>
        </div>
        
        <div style="margin-top: 2rem; display: flex; gap: 1rem;">
            <a href="{{ route('course-enrollments.edit', $courseEnrollment->id) }}" class="btn btn-primary">Edit Enrollment</a>
            <a href="{{ route('course-enrollments.index') }}" class="btn btn-light" data-no-ajax><i class="bi bi-arrow-left"></i> Back to List</a>
        </div>
    </div>
</div>
@endsection
