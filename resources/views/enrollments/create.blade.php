@extends('format.layout2')

@section('title', 'Enroll Student')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Enroll Student</h1>
        <p class="card-subtitle">Assign a student to a course</p>
    </div>
    <div class="card-body">
        <form action="{{ route('course-enrollments.store') }}" method="POST" class="form-container">
            @csrf
            
            <div class="form-group @error('student_id') error @enderror">
                <label for="student_id">Student <span class="required">*</span></label>
                <select name="student_id" id="student_id" required>
                    <option value="">Select Student</option>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                            {{ $student->name }} {{ $student->lname }}
                        </option>
                    @endforeach
                </select>
                @error('student_id')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('course_id') error @enderror">
                <label for="course_id">Course <span class="required">*</span></label>
                <select name="course_id" id="course_id" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->course_name }}
                        </option>
                    @endforeach
                </select>
                @error('course_id')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('enrollment_date') error @enderror">
                <label for="enrollment_date">Enrollment Date <span class="required">*</span></label>
                <input type="date" name="enrollment_date" id="enrollment_date" value="{{ old('enrollment_date', date('Y-m-d')) }}" required>
                @error('enrollment_date')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn"><i class="bi bi-check-circle"></i> Enroll Now</button>
                <a href="{{ route('course-enrollments.index') }}" class="btn btn-secondary" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
