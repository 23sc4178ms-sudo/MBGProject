@extends('format.layout')

@section('title', 'Student Details - Student Management Dashboard')

@section('content')

<main>
    <div class="section-header">
        <h1>Student Details</h1>
        <p>View and manage student information</p>
    </div>

    <div class="card" style="max-width: 700px; margin: 0 auto;">
        <div class="card-header">
            <div class="card-title">{{ $student->name }}</div>
            <p class="card-subtitle">Student ID: {{ $student->id }}</p>
        </div>

        <div class="card-body">
            <div style="display: grid; gap: 1.5rem;">
                <div>
                    <div style="color: var(--text-secondary); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Email Address</div>
                    <p style="color: var(--text-primary); font-size: 1rem; margin: 0;">{{ $student->email }}</p>
                </div>

                <div>
                    <div style="color: var(--text-secondary); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Contact Number</div>
                    <p style="color: var(--text-primary); font-size: 1rem; margin: 0;">{{ $student->contact_number }}</p>
                </div>

                <div>
                    <div style="color: var(--text-secondary); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Age</div>
                    <p style="color: var(--text-primary); font-size: 1rem; margin: 0;">{{ $student->age }} years old</p>
                </div>

                <div>
                    <div style="color: var(--text-secondary); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Course</div>
                    <p style="color: var(--text-primary); font-size: 1rem; margin: 0;">{{ $student->course }}</p>
                </div>

                <div style="border-top: 1px solid var(--border); padding-top: 1.5rem;">
                    <div style="color: var(--text-secondary); font-size: 0.875rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.5rem;">Address</div>
                    <p style="color: var(--text-primary); font-size: 1rem; margin: 0; line-height: 1.6;">{{ $student->address }}</p>
                </div>
            </div>
        </div>

        <div class="card-footer" style="margin-left: -1.5rem; margin-right: -1.5rem; margin-bottom: -1.5rem;">
            <a href="{{ route('students.index') }}" class="btn btn-secondary">
                <i class="bi bi-chevron-left"></i> Back
            </a>
            <div style="display: flex; gap: 0.75rem;">
                <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this student? This action cannot be undone.');">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</main>

@endsection
