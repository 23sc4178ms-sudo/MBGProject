@extends('format.layout')

@section('title')
    Edit Student
@endsection

@section('content')
<style>
    .page-header {
        margin-bottom: 3rem;
    }
    
    .page-header h1 {
        color: var(--primary);
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
    }
    
    .page-header p {
        color: var(--text-secondary);
        font-size: 1rem;
    }

    .form-container {
        background: var(--bg-white);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        max-width: 600px;
        margin: 0 auto;
    }

    /* Fieldset styling */
    fieldset {
        border: none;
        padding: 0;
        margin: 0;
    }

    fieldset + fieldset {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border);
    }

    legend {
        color: var(--primary);
        font-weight: 600;
        font-size: 1rem;
        margin-bottom: 1.25rem;
        padding: 0;
        display: block;
        width: 100%;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
    }

    .btn-cancel {
        background: var(--bg-light);
        color: var(--primary);
        border: 2px solid var(--border);
    }
    
    .btn-cancel:hover {
        background: var(--border);
    }

    @media (max-width: 480px) {
        .button-group {
            flex-direction: column;
        }
    }
</style>

<section class="page-header" aria-labelledby="page-title">
    <h1 id="page-title">Edit Student</h1>
    <p>Update student information for {{ $student->name }}</p>
</section>

<article class="form-container">
    <form action="{{ route('students.update', $student->id) }}" method="POST" aria-label="Edit student form">
        @csrf
        @method('PUT')
        
        <!-- Personal Information Section -->
        <fieldset>
            <legend>Personal Information</legend>
            
            <div class="form-group">
                <label for="name">First Name <span class="required" aria-label="required">*</span></label>
                <input type="text" name="name" id="name" placeholder="Enter first name" value="{{ old('name', $student->name) }}" required aria-required="true">
                @error('name')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="mname">Middle Name</label>
                <input type="text" name="mname" id="mname" placeholder="Enter middle name" value="{{ old('mname', $student->mname ?? '') }}">
                @error('mname')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="lname">Last Name <span class="required" aria-label="required">*</span></label>
                <input type="text" name="lname" id="lname" placeholder="Enter last name" value="{{ old('lname', $student->lname) }}" required aria-required="true">
                @error('lname')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
        </fieldset>

        <!-- Contact Information Section -->
        <fieldset>
            <legend>Contact Information</legend>
            
            <div class="form-group">
                <label for="email">Email <span class="required" aria-label="required">*</span></label>
                <input type="email" name="email" id="email" placeholder="Enter email" value="{{ old('email', $student->email) }}" required aria-required="true">
                @error('email')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="contact_number">Contact Number <span class="required" aria-label="required">*</span></label>
                <input type="tel" name="contact" id="contact_number" placeholder="Enter contact number" value="{{ old('contact', $student->contact) }}" required aria-required="true">
                @error('contact')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
        </fieldset>

        <!-- Academic Information Section -->
        <fieldset>
            <legend>Academic Information</legend>
            
            <div class="form-group">
                <label for="degree_id">Course <span class="required" aria-label="required">*</span></label>
                <select name="degree_id" id="degree_id" required aria-required="true">
                    <option value="" disabled>Select a course</option>
                    @foreach($degrees as $degree)
                        <option value="{{ $degree->id }}" {{ old('degree_id', $student->degree_id) == $degree->id ? 'selected' : '' }}>{{ $degree->Degree }}</option>
                    @endforeach
                </select>
                @error('degree_id')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
        </fieldset>
        

        <!-- Form Actions -->
        <div class="button-group" role="group" aria-label="Form actions">
            <button type="submit" class="btn btn-primary btn-submit"><i class="bi bi-check-circle"></i> Update Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-cancel" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
        </div>
    </form>
</article>

@endsection
