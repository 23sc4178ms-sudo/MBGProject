@extends('format.layout')

@section('title', 'Students')

@section('content')

<main>
    <div class="section-header">
        <h1>Student Management</h1>
        <p>Manage and view all students in the system</p>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div style="flex: 1;"></div>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Student
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success" role="status">
        <strong>Success!</strong> {{ session('success') }}
    </div>
    @endif

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

    @forelse($students as $student)
        @if ($loop->first)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(350px, 1fr)); gap: 1.5rem;">
        @endif

            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ $student['name'] }}</div>
                    <p class="card-subtitle">
                        @if($student['age'] == 19)
                            Freshman Student
                        @elseif($student['age'] == 20)
                            Sophomore Student
                        @elseif($student['age'] == 21)
                            Junior Student
                        @elseif($student['age'] == 22)
                            Senior Student
                        @else
                            Unknown
                        @endif
                    </p>
                </div>
                
                <div class="card-body">
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div>
                            <div style="color: var(--text-secondary); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Age</div>
                            <p style="color: var(--text-primary); font-weight: 600; margin: 0.25rem 0 0 0;">{{ $student['age'] }} years</p>
                        </div>
                        <div>
                            <div style="color: var(--text-secondary); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;">Course</div>
                            <p style="color: var(--text-primary); font-weight: 600; margin: 0.25rem 0 0 0;">{{ $student['course'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="card-footer" style="flex-direction: column; align-items: stretch; gap: 0.75rem;">
                    <a href="{{ route('students.show', $student['id']) }}" class="btn btn-primary btn-sm" style="width: 100%; justify-content: center;">
                        <i class="bi bi-eye"></i> View Details
                    </a>
                    <div style="display: flex; gap: 0.75rem;">
                        <a href="{{ route('students.edit', $student['id']) }}" class="btn btn-secondary btn-sm" style="flex: 1; justify-content: center;">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('students.destroy', $student['id']) }}" method="POST" style="flex: 1;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="width: 100%; justify-content: center; background: #dc2626; color: #fff; border: none; font-weight:600;" onclick="return confirm('Are you sure you want to delete this student?');">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        @if ($loop->last)
        </div>
        @endif
    @empty
        <div class="card" style="max-width: 100%;">
            <div class="card-body" style="text-align: center; padding: 3rem;">
                <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-muted); display: block; margin-bottom: 1rem;"></i>
                <h3 style="color: var(--text-secondary); margin-bottom: 0.5rem;">No Students Found</h3>
                <p style="color: var(--text-light); margin-bottom: 1.5rem;">There are currently no students in the system. Start by adding a new student.</p>
                <a href="{{ route('students.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add First Student
                </a>
            </div>
        </div>
    @endforelse
</main>

@endsection