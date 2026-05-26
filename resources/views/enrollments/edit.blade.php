@extends('format.layout')

@section('title', 'Edit Enrollment')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Edit Enrollment</h1>
        <p class="card-subtitle">Update enrollment details</p>
    </div>
    <div class="card-body">
        <form action="{{ route('course-enrollments.update', $courseEnrollment->id) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')
            
            <div class="form-group @error('student_id') error @enderror">
                <label for="student_id">Student <span class="required">*</span></label>
                <select name="student_id" id="student_id" required>
                    @foreach($students as $student)
                        <option value="{{ $student->id }}" {{ old('student_id', $courseEnrollment->student_id) == $student->id ? 'selected' : '' }}>
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
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ old('course_id', $courseEnrollment->course_id) == $course->id ? 'selected' : '' }}>
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
                <input type="date" name="enrollment_date" id="enrollment_date" value="{{ old('enrollment_date', \Carbon\Carbon::parse($courseEnrollment->enrollment_date)->format('Y-m-d')) }}" required>
                @error('enrollment_date')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions" style="margin-top: 2rem; display: flex; gap: 1rem;">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Update Enrollment</button>
                <a href="{{ route('course-enrollments.index') }}" class="btn btn-light" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
