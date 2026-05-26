@extends('format.layout2')

@section('title')
    Add Student
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

    /* Select field styling */
    #degree_id {
        background-color: white !important;
        color: black !important;
        border: 2px solid black !important;
    }

    #degree_id option {
        background: white !important;
        color: black !important;
        padding: 0.5rem !important;
        margin: 0 !important;
    }

    #degree_id option:checked {
        background: var(--primary-100) !important;
        color: black !important;
    }

    #degree_id option:disabled {
        background: white !important;
        color: #999 !important;
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
    <h1 id="page-title">Add New Student</h1>
    <p>Enter student details to create a new record</p>
</section>

<article class="form-container">
    <form action="{{ route('students.store') }}" method="POST" aria-label="Create new student form">
        @csrf
        
        <!-- Personal Information Section -->
        <fieldset>
            <legend>Personal Information</legend>
            
            <div class="form-group">
                <label for="name">First Name <span class="required" aria-label="required">*</span></label>
                <input type="text" name="name" id="name" placeholder="Enter first name" required aria-required="true" value="{{ old('name') }}">
                @error('name')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="mname">Middle Name</label>
                <input type="text" name="mname" id="mname" placeholder="Enter middle name" value="{{ old('mname') }}">
                @error('mname')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="lname">Last Name <span class="required" aria-label="required">*</span></label>
                <input type="text" name="lname" id="lname" placeholder="Enter last name" required aria-required="true" value="{{ old('lname') }}">
                @error('lname')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>



        </fieldset>

        <!-- Contact Information Section -->
        <fieldset>
            <legend>Contact Information</legend>
            
            <div class="form-group">
                <label for="email">Email <span class="required" aria-label="required">*</span></label>
                <input type="email" name="email" id="email" placeholder="Enter email" required aria-required="true" value="{{ old('email') }}">
                @error('email')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="contact">Contact Number <span class="required" aria-label="required">*</span></label>
                <input type="tel" name="contact" id="contact" placeholder="Enter contact number" required aria-required="true" value="{{ old('contact') }}">
                @error('contact')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
        </fieldset>

        <!-- Academic Information Section -->
        <fieldset>
            <legend>Academic Information</legend>
            
            <div class="form-group">
                <label for="degree_id">Course <span class="required" aria-label="required">*</span></label>
                <select name="degree_id" id="degree_id" required aria-required="true" style="background-color: white !important; color: black !important; border: 2px solid black !important;">
                    <option value="" disabled {{ old('degree_id') ? '' : 'selected' }} style="background: white; color: black;">Select a course</option>
                    @foreach($degrees as $degree)
                        <option value="{{ $degree->id }}" {{ old('degree_id') == $degree->id ? 'selected' : '' }} style="background: white; color: black;">{{ $degree->Degree }}</option>
                    @endforeach
                </select>
                @error('degree_id')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
        </fieldset>

        <fieldset>
            <legend>Student Login Account</legend>

            <div class="form-group">
                <label for="username">Username <span class="required" aria-label="required">*</span></label>
                <input type="text" name="username" id="username" placeholder="Create a unique username" required aria-required="true" value="{{ old('username') }}">
                @error('username')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="password">Password <span class="required" aria-label="required">*</span></label>
                <input type="password" name="password" id="password" placeholder="Minimum 8 characters" required aria-required="true">
                @error('password')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
        </fieldset>

        <!-- Form Actions -->
        <div class="button-group" role="group" aria-label="Form actions">
            <button type="submit" class="btn"><i class="bi bi-check-circle"></i> Create Student</button>
            <a href="{{ session('auth_role') === 'admin' ? route('students.index') : route('dashboard') }}" class="btn btn-secondary" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
        </div>
    </form>
</article>

@endsection
