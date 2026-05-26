@extends('format.layout2')

@section('title', 'Create User')

@section('content')
<style>
    .page-header {
        margin-bottom: 2.5rem;
    }
    
    .page-header h1 {
        color: var(--primary);
        font-size: 2.2rem;
        font-weight: 700;
        margin: 0 0 0.35rem 0;
    }
    
    .page-header p {
        color: var(--text-light);
        font-size: 0.95rem;
        margin: 0;
    }

    .form-container {
        background: var(--bg-white);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        max-width: 550px;
        margin: 0 auto;
    }

    .form-section {
        margin-bottom: 1.75rem;
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-group {
        margin-bottom: 1.35rem;
    }

    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--text-light);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .required {
        color: #dc2626;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 0.75rem 0.85rem;
        border: 2px solid var(--border);
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: inherit;
        background: var(--bg-white);
        transition: 0.2s;
        box-sizing: border-box;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
    }

    .form-group input::placeholder {
        color: #cbd5e1;
    }

    .form-text {
        font-size: 0.8rem;
        color: var(--text-light);
        margin-top: 0.35rem;
    }

    .form-error {
        display: block;
        color: #dc2626;
        font-size: 0.8rem;
        margin-top: 0.35rem;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-submit {
        flex: 1;
        padding: 0.85rem 1.25rem;
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.25s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.95rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(13, 148, 136, 0.25);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .btn-cancel {
        flex: 1;
        padding: 0.85rem 1.25rem;
        background: var(--bg-lighter);
        color: var(--primary);
        border: 2px solid var(--border);
        border-radius: 8px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.95rem;
    }

    .btn-cancel:hover {
        background: var(--border);
    }

    @media (max-width: 480px) {
        .page-header h1 {
            font-size: 1.8rem;
        }

        .button-group {
            flex-direction: column;
        }
    }
</style>

<section class="page-header" aria-labelledby="page-title">
    <h1 id="page-title">Create Staff Account</h1>
    <p>Add a new teacher or admin account to the system</p>
</section>

<article class="form-container">
    <form action="{{ route('users.store') }}" method="POST" aria-label="Create staff account form">
        @csrf
        
        <!-- Basic Information Section -->
        <div class="form-section">
            <div class="form-group @error('name') error @enderror">
                <label for="name">Full Name <span class="required">*</span></label>
                <input type="text" name="name" id="name" placeholder="Enter full name" value="{{ old('name') }}" required aria-required="true">
                @error('name')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('email') error @enderror">
                <label for="email">Email Address <span class="required">*</span></label>
                <input type="email" name="email" id="email" placeholder="Enter email address" value="{{ old('email') }}" required aria-required="true">
                @error('email')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group @error('username') error @enderror">
                <label for="username">Username <span class="required">*</span></label>
                <input type="text" name="username" id="username" placeholder="Enter username" value="{{ old('username') }}" required aria-required="true">
                @error('username')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Account Configuration Section -->
        <div class="form-section">
            <div class="form-group @error('role') error @enderror">
                <label for="role">Account Role <span class="required">*</span></label>
                <select name="role" id="role" required aria-required="true">
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Choose role</option>
                    <option value="teacher" {{ old('role') === 'teacher' ? 'selected' : '' }}>Teacher</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
                <p class="form-text">Staff accounts for admin and teacher roles only.</p>
            </div>

            <div class="form-group @error('password') error @enderror">
                <label for="password">Password <span class="required">*</span></label>
                <input type="password" name="password" id="password" placeholder="Minimum 8 characters" required aria-required="true">
                @error('password')
                    <span class="form-error" role="alert">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <!-- Form Actions -->
        <div class="button-group" role="group" aria-label="Form actions">
            <button type="submit" class="btn-submit">
                <i class="bi bi-person-plus"></i> Create Account
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-cancel" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
        </div>
    </form>
</article>

@endsection
