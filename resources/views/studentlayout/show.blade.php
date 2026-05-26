@extends('format.layout')

@section('title')
    Student Details
@endsection

@section('content')
<style>
    /* Page Header */
    .page-header {
        margin-bottom: 2.5rem;
    }

    .page-header h1 {
        color: var(--primary);
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0;
    }

    .page-header p {
        color: var(--text-secondary);
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    /* Success Alert */
    .alert-success {
        padding: 1rem;
        background-color: #f0fdf4;
        border-left: 4px solid var(--success);
        border-radius: 4px;
        margin-bottom: 1.5rem;
        color: #166534;
    }

    /* Student Cards Grid */
    .students-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    /* Student Card */
    .student-card {
        background: var(--bg-white);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-light);
        animation: fadeIn 0.5s ease-out;
    }

    /* Student Header */
    .student-header {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 3rem 2rem;
        color: white;
        position: relative;
    }

    .student-header-content {
        display: flex;
        justify-content: center;
        text-align: center;
    }

    .student-info h2 {
        margin: 0;
        font-size: 2rem;
        font-weight: 700;
    }

    .badges {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
        justify-content: center;
    }

    .badge {
        background: rgba(255,255,255,0.2);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    /* Details */
    .student-details {
        padding: 2rem;
    }

    .details-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .detail-card {
        padding: 1.5rem;
        border-radius: 12px;
        transition: 0.3s;
    }

    .detail-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
    }

    .detail-card.email { border-left: 4px solid var(--primary); }
    .detail-card.contact { border-left: 4px solid #a855f7; }
    .detail-card.course { border-left: 4px solid #c084fc; }
    .detail-card.status { border-left: 4px solid var(--primary); }

    .detail-label {
        display: flex;
        gap: 0.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .detail-value {
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        border-top: 1px solid var(--border-light);
        padding-top: 2rem;
        flex-wrap: wrap;
    }

    .action-buttons .btn,
    .action-buttons .btn-password,
    .action-buttons .btn-edit,
    .action-buttons .btn-delete {
        min-width: 150px;
        justify-content: center;
    }

    .btn-edit {
        flex: 1;
        padding: 1rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
    }

    /* NEW: Change Password */
    .btn-password {
        flex: 1;
        padding: 1rem;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-password:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }

    .btn-delete {
        flex: 1;
        padding: 1rem;
        background: #dc2626;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
    }

    /* Back */
    .btn-back {
        margin-top: 2rem;
        display: inline-block;
        padding: 0.7rem 1.2rem;
        background: var(--bg-light);
        border-radius: 8px;
        text-decoration: none;
    }
</style>

<section class="page-header">
    <h1>Student Details</h1>
    <p>View and manage student information</p>
</section>

@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

<section class="students-grid">
@foreach($students as $student)
<article class="student-card">

    <header class="student-header">
        <div class="student-header-content">
            <div class="student-info">
                <h2>{{ $student->name }}</h2>
                <p>{{ $student->mname }} {{ $student->lname }}</p>
                <div class="badges">
                    <span class="badge">ID: {{ $student->id }}</span>
                    <span class="badge">Active</span>
                </div>
            </div>
        </div>
    </header>

    <section class="student-details">
        <div class="details-grid">
            <div class="detail-card email">
                <div class="detail-label">Email</div>
                <p class="detail-value">{{ $student->email }}</p>
            </div>

            <div class="detail-card contact">
                <div class="detail-label">Contact</div>
                <p class="detail-value">{{ $student->contact }}</p>
            </div>

            <div class="detail-card course">
                <div class="detail-label">Course</div>
                <p class="detail-value">{{ $student->degree?->Degree ?? 'N/A' }}</p>
            </div>

            <div class="detail-card status">
                <div class="detail-label">Status</div>
                <p class="detail-value">Enrolled</p>
            </div>
        </div>

        <!-- Buttons -->
        <div class="action-buttons">
            @if(session('auth_role') !== 'student')
                <a href="/students/{{ $student->id }}/edit" class="btn-edit btn btn-primary">
                    <i class="bi bi-pencil-square"></i> Edit
                </a>
                <form action="/students/{{ $student->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete btn btn-danger" onclick="return confirm('Delete this student?')">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </form>
            @endif

            <a href="{{ route('student.password.change.form', $student->id) }}" class="btn-password btn btn-warning">
                <i class="bi bi-key"></i> Change Password
            </a>
        </div>
    </section>

</article>
@endforeach
</section>



@endsection
