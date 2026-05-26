@extends('format.layout')

@section('title', 'Edit Course')

@section('content')

<style>
    .page-header {
        margin-bottom: 2rem;
    }
    
    .page-header h1 {
        color: var(--primary);
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
    }
    
    .page-header p {
        color: var(--text-light);
        font-size: 1rem;
    }

    .form-container {
        background: var(--bg-white);
        padding: 2.5rem;
        border-radius: 12px;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        max-width: 700px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .form-group input, 
    .form-group textarea {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition-fast);
        background: var(--bg-light);
    }

    .form-group input:focus, 
    .form-group textarea:focus {
        outline: none;
        border-color: var(--primary);
        background: #fff;
        box-shadow: 0 0 0 4px var(--primary-100);
    }

    .required {
        color: var(--error);
    }

    .form-error {
        color: var(--error);
        font-size: 0.85rem;
        margin-top: 0.4rem;
        display: block;
    }

    .button-group {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        transition: var(--transition-fast);
        font-size: 0.95rem;
        border: none;
    }

    .btn-primary {
        background: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-1px);
    }

    .btn-cancel {
        background: var(--bg-light);
        color: var(--text-light);
        border: 1px solid var(--border);
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

<section class="page-header">
    <h1>Edit Course</h1>
    <p>Modify course: <strong>{{ $course->course_name }}</strong></p>
</section>

<div class="form-container">
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="course_name">Course Name <span class="required">*</span></label>
            <input type="text" name="course_name" id="course_name" value="{{ old('course_name', $course->course_name) }}" required>
            @error('course_name')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description <span class="required">*</span></label>
            <textarea name="description" id="description" rows="5" required>{{ old('description', $course->description) }}</textarea>
            @error('description')
                <span class="form-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="button-group">
            <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Update Course</button>
            <a href="{{ route('courses.index') }}" class="btn btn-cancel" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
        </div>
    </form>
</div>
@endsection

