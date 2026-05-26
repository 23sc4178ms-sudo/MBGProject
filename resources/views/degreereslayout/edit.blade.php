@extends('format.layout')

@section('title')
    Edit Degree
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
    <h1 id="page-title">Edit Degree</h1>
    <p>Update degree information for <strong>{{ $degree->Degree }}</strong></p>
</section>

<article class="form-container">
    <form action="{{ route('degrees.update', $degree->id) }}" method="POST" aria-label="Edit degree form">
        @csrf
        @method('PUT')
        
        <!-- Degree Information Section -->
        <fieldset>
            <legend>Degree Information</legend>
            
            <div class="form-group">
                <label for="Degree">Degree Name <span class="required" aria-label="required">*</span></label>
                <input type="text" name="Degree" id="Degree" placeholder="e.g., BS Information Technology" required aria-required="true" value="{{ old('Degree', $degree->Degree) }}">
                @error('Degree')<span class="form-error" role="alert">{{ $message }}</span>@enderror
            </div>
        </fieldset>

        <!-- Form Actions -->
        <div class="button-group" role="group" aria-label="Form actions">
            <button type="submit" class="btn btn-primary btn-submit"><i class="bi bi-check-circle"></i> Update Degree</button>
            <a href="{{ route('degrees.index') }}" class="btn btn-cancel" data-no-ajax><i class="bi bi-x-circle"></i> Cancel</a>
        </div>
    </form>
</article>

@endsection
