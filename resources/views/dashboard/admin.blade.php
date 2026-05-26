@extends('format.layout')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .dashboard-shell {
        display: grid;
        gap: 1.5rem;
    }

    .dashboard-hero {
        background: linear-gradient(135deg, #0d9488 0%, #115e59 100%);
        color: #fff;
        border-radius: 20px;
        padding: 2.2rem;
        box-shadow: var(--shadow-md);
    }

    .dashboard-hero h1 {
        margin: 0 0 0.5rem 0;
        font-size: 2rem;
    }

    .dashboard-hero p {
        margin: 0;
        opacity: 0.95;
    }

    .quick-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1rem;
    }

    .quick-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        padding: 1.25rem;
        box-shadow: var(--shadow-md);
        display: grid;
        gap: 0.75rem;
    }

    .quick-card .metric {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-dark);
    }

    .quick-card .label {
        color: var(--text-light);
        font-weight: 600;
    }

    .quick-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }
</style>

<section class="dashboard-shell">
    <div class="dashboard-hero">
        <h1><i class="bi bi-shield-lock-fill"></i> Admin Dashboard</h1>
        <p>Manage students, teachers, and system content from one place.</p>
    </div>

    <div class="quick-grid">
        <div class="quick-card">
            <div class="metric">{{ $studentsCount }}</div>
            <div class="label">Students</div>
        </div>
        <div class="quick-card">
            <div class="metric">{{ $degreesCount }}</div>
            <div class="label">Degrees</div>
        </div>
        <div class="quick-card">
            <div class="metric">{{ $accountsCount }}</div>
            <div class="label">Teacher/Admin Accounts</div>
        </div>
    </div>

    <div class="quick-card">
        <div class="label">Quick Actions</div>
        <div class="quick-actions">
            <a class="btn" href="{{ route('students.create') }}"><i class="bi bi-person-plus-fill"></i> Add Student</a>
            <a class="btn btn-secondary" href="{{ route('users.create') }}"><i class="bi bi-person-badge-fill"></i> Add Teacher</a>
            <a class="btn btn-secondary" href="{{ route('users.index') }}"><i class="bi bi-people-fill"></i> Manage Accounts</a>
        </div>
    </div>
</section>
@endsection