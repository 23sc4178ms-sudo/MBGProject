@extends('format.layout')

@section('title', 'Teacher Dashboard')

@section('content')
<style>
    .teacher-hero {
        background: linear-gradient(135deg, #0f766e 0%, #134e4a 100%);
        color: #fff;
        border-radius: 20px;
        padding: 2.2rem;
        box-shadow: var(--shadow-md);
        margin-bottom: 1.5rem;
    }

    .teacher-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
    }

    .teacher-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 1.25rem;
        box-shadow: var(--shadow-md);
    }

    .teacher-card .metric {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-dark);
    }
</style>

<section class="teacher-hero">
    <h1><i class="bi bi-mortarboard-fill"></i> Teacher Dashboard</h1>
    <p>Quick access to student creation and class information.</p>
</section>

<div class="teacher-grid">
    <div class="teacher-card">
        <div class="metric">{{ $studentsCount }}</div>
        <div class="label">Students</div>
    </div>
    <div class="teacher-card">
        <div class="metric">{{ $degreesCount }}</div>
        <div class="label">Degrees</div>
    </div>
    <div class="teacher-card">
        <div class="label" style="margin-bottom: 0.75rem;">Quick Action</div>
        <a class="btn" href="{{ route('students.create') }}"><i class="bi bi-person-plus-fill"></i> Add Student</a>
    </div>
</div>
@endsection