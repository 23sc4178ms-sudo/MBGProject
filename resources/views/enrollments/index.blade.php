@extends('format.layout')

@section('title', 'Manage Enrollments')

@section('content')

<style>
    .enrollments-header {
        margin-bottom: 2rem;
    }

    .enrollments-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
    }

    .action-buttons {
        margin-bottom: 1.5rem;
    }

    .btn {
        padding: 0.6rem 1.2rem;
        border-radius: 6px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary {
        background: var(--primary);
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background: var(--primary-dark);
    }

    .success-alert {
        padding: 1rem;
        background-color: #f0fdf4;
        border-left: 4px solid var(--success);
        color: #166534;
        margin-bottom: 1rem;
        border-radius: 4px;
    }

    /* TABLE STYLE */
    .table-container {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    thead {
        background: var(--primary);
        color: #fff;
    }

    th, td {
        padding: 12px 15px;
        text-align: left;
    }

    th {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    tbody tr {
        border-bottom: 1px solid #eee;
        transition: var(--transition-fast);
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .actions {
        display: flex;
        gap: 8px;
    }

    .action-btn {
        padding: 6px 12px;
        border-radius: 5px;
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition-fast);
    }

    .edit { background: #fef3c7; color: #b45309; }
    .edit:hover { background: #fde68a; }

    .delete { background: #fee2e2; color: #991b1b; }
    .delete:hover { background: #fecaca; }

    .course-label {
        color: var(--primary-dark);
        font-weight: 700;
        font-size: 0.9rem;
    }

    .student-label {
        color: var(--text-primary);
        font-weight: 600;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #fff;
        border: 2px dashed var(--border);
        border-radius: 12px;
        margin-top: 1rem;
    }
</style>

<section class="enrollments-header">
    <h1>Course Enrollments</h1>
</section>

@if(session('success'))
    <div class="success-alert">
        {{ session('success') }}
    </div>
@endif

<div class="action-buttons">
    <a href="{{ route('course-enrollments.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Enroll Student
    </a>
</div>

@if($enrollments->count() > 0)
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Enrolled Course</th>
                <th>Student Name</th>
                <th>Date of Enrollment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
                <tr>
                    <td>#{{ $enrollment->id }}</td>
                    <td><span class="course-label">{{ $enrollment->course->course_name }}</span></td>
                    <td><span class="student-label">{{ $enrollment->student->name }} {{ $enrollment->student->lname }}</span></td>
                    <td>{{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('M d, Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('course-enrollments.edit', $enrollment->id) }}" class="action-btn edit" title="Edit enrollment">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('course-enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" onclick="return confirm('Unenroll student from this course?')">
                                    <i class="bi bi-trash"></i> Unenroll
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="empty-state">
    <h3>No Enrollments Recorded</h3>
    <p>Sign up students for available courses here.</p>
    <a href="{{ route('course-enrollments.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Make First Enrollment</a>
</div>
@endif

@endsection

