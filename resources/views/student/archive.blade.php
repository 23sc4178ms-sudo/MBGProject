@extends('format.layout')

@section('title', 'Archived Students')

@section('content')

<style>
    .archive-header {
        margin-bottom: 2.5rem;
    }

    .archive-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--primary);
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .archive-header p {
        color: #64748b;
        font-size: 1.1rem;
    }

    .action-bar {
        background: white;
        padding: 1.25rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        margin-bottom: 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid var(--border-color);
    }

    .archive-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    .archive-card {
        background: white;
        border-radius: var(--radius-xl);
        border: 1px solid var(--border-color);
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .archive-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
        border-color: var(--primary-light);
    }

    .card-header {
        padding: 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--border-color);
        position: relative;
    }

    .card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.25rem;
    }

    .card-subtitle {
        font-size: 0.875rem;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-body {
        padding: 1.5rem;
        flex-grow: 1;
    }

    .info-item {
        margin-bottom: 1rem;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: #334155;
    }

    .card-footer {
        padding: 1.25rem 1.5rem;
        background: #f8fafc;
        border-top: 1px solid var(--border-color);
    }

    .btn-view {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem;
        background: var(--primary);
        color: white;
        border-radius: var(--radius-md);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-view:hover {
        background: var(--primary-dark);
        color: white;
        transform: translateY(-1px);
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: var(--radius-xl);
        border: 2px dashed #e2e8f0;
    }

    .empty-icon {
        font-size: 3.5rem;
        color: #cbd5e1;
        margin-bottom: 1.5rem;
    }
</style>

<div class="archive-header">
    <h1>Archived Students</h1>
    <p>Viewing historical records of previously enrolled students</p>
</div>

<div class="action-bar">
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
        <i class="bi bi-arrow-left"></i>
        <span>Back to Active Students</span>
    </a>
    <span class="badge bg-teal-soft text-teal px-3 py-2 rounded-pill">
        Total Archived: {{ count($archivedStudents) }}
    </span>
</div>

@if (count($archivedStudents) > 0)
    <div class="archive-grid">
        @foreach($archivedStudents as $student)
            <div class="archive-card">
                <div class="card-header">
                    <div class="card-title">{{ $student->name }}</div>
                    <div class="card-subtitle">
                        <i class="bi bi-archive-fill text-muted"></i>
                        <span>Archived Record</span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="info-item">
                        <div class="info-label">Email Address</div>
                        <div class="info-value">{{ $student->email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Contact Number</div>
                        <div class="info-value">{{ $student->contact_number }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Program / Course</div>
                        <div class="info-value">{{ $student->course }}</div>
                    </div>
                    <div class="info-item mb-0">
                        <div class="info-label">Age</div>
                        <div class="info-value">{{ $student->age }} Years Old</div>
                    </div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('students.show', $student->id) }}" class="btn-view">
                        <i class="bi bi-file-earmark-person"></i>
                        <span>View Archive Details</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-icon">
            <i class="bi bi-archive"></i>
        </div>
        <h3 class="fw-bold text-slate-700">No records found</h3>
        <p class="text-slate-500 mb-4">The archive is currently empty.</p>
        <a href="{{ route('students.index') }}" class="btn btn-primary px-4 py-2">
            Return to Directory
        </a>
    </div>
@endif

@endsection