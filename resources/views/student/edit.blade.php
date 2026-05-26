@extends('format.layout')

@section('title', 'Edit Student - Student Management Dashboard')

@section('content')

<main>
    <div class="section-header">
        <h1>Edit Student Information</h1>
        <p>Update the student's details below</p>
    </div>

    @if ($errors->any())
    <div class="alert alert-error" role="alert">
        <strong>Please correct the following errors:</strong>
        <ul style="margin: 0.5rem 0 0 1.5rem;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header">
            <div class="card-title">Student Details</div>
            <p class="card-subtitle">{{ $student->name }} - ID: {{ $student->id }}</p>
        </div>

        <form action="{{ route('students.update', $student->id) }}" method="POST" class="card-body">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="required">Full Name</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="@error('name') error @enderror"
                    value="{{ old('name', $student->name) }}"
                    required
                    placeholder="Enter student's full name"
                >
                @error('name')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="age" class="required">Age</label>
                <input 
                    type="number" 
                    id="age" 
                    name="age"
                    class="@error('age') error @enderror"
                    value="{{ old('age', $student->age) }}"
                    required
                    min="1"
                    max="120"
                    placeholder="Enter student's age"
                >
                @error('age')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="email" class="required">Email Address</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email"
                    class="@error('email') error @enderror"
                    value="{{ old('email', $student->email) }}"
                    required
                    placeholder="Enter student's email"
                >
                @error('email')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="contact_no" class="required">Contact Number</label>
                <input 
                    type="tel" 
                    id="contact_no" 
                    name="contact_no"
                    class="@error('contact_no') error @enderror"
                    value="{{ old('contact_no', $student->contact_number) }}"
                    required
                    placeholder="Enter student's contact number"
                >
                @error('contact_no')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="course" class="required">Course</label>
                <input 
                    type="text" 
                    id="course" 
                    name="course"
                    class="@error('course') error @enderror"
                    value="{{ old('course', $student->course) }}"
                    required
                    placeholder="Enter course name"
                >
                @error('course')<span class="form-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea 
                    id="address" 
                    name="address"
                    class="@error('address') error @enderror"
                    placeholder="Enter student's address (optional)"
                >{{ old('address', $student->address) }}</textarea>
                @error('address')<span class="form-error">{{ $message }}</span>@enderror
            </div>


            <div class="card-footer" style="margin-left: -1.5rem; margin-right: -1.5rem; margin-bottom: -1.5rem;">
                <a href="{{ route('students.index') }}" class="btn btn-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Update Student
                </button>
            </div>
        </form>
    </div>
</main>

@endsection
