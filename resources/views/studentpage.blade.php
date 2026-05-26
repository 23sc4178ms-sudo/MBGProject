@extends('format.layout')

@section('title','Students')

@section('content')

<style>
    .students-header {
        margin-bottom: 2rem;
    }

    .students-header h1 {
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

    .view { background: #dbeafe; color: #0369a1; }
    .view:hover { background: #bfdbfe; }
    
    .edit { background: #fef3c7; color: #b45309; }
    .edit:hover { background: #fde68a; }

    .delete { background: #fee2e2; color: #991b1b; }
    .delete:hover { background: #fecaca; }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #fff;
        border: 2px dashed var(--border);
        border-radius: 12px;
        margin-top: 1rem;
    }

    .student-modal-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1rem;
    }

    .student-modal-heading {
        border-bottom: 1px solid var(--border);
        margin-bottom: 1rem;
        padding-bottom: 1rem;
    }

    .student-modal-heading h3 {
        color: var(--primary);
        font-size: 1.35rem;
        margin: 0 0 0.35rem;
    }

    .student-modal-heading span,
    .student-modal-field span {
        color: var(--text-light);
        display: block;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .student-modal-field {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 1rem;
    }

    .student-modal-field strong {
        color: var(--text-primary);
        display: block;
        margin-top: 0.35rem;
        overflow-wrap: anywhere;
    }

    @media (max-width: 640px) {
        .student-modal-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="students-header">
    <h1>Student List</h1>
</section>

@if(session('success'))
    <div class="success-alert">
        {{ session('success') }}
    </div>
@endif

<div class="action-buttons">
    <a href="{{ route('students.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Student
    </a>
</div>

@if($students->count() > 0)
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Degree</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>#{{ $student->id }}</td>
                    <td><strong>{{ $student->lname }}, {{ $student->name }} {{ $student->mname }}</strong></td>
                    <td>{{ $student->degree->Degree ?? 'N/A' }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->contact }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('students.show', $student->id) }}" class="action-btn view js-student-view" title="View student">
                                <i class="bi bi-eye"></i> View
                            </a>
                            <a href="{{ route('students.edit', $student->id) }}" class="action-btn edit js-student-edit" title="Edit student">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" onclick="return confirm('Delete Student?')">
                                    <i class="bi bi-trash"></i> Delete
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
    <h3>No Students Yet</h3>
    <p>There are no students in the system. Add one to get started.</p>
    <a href="{{ route('students.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add First Student</a>
</div>
@endif

<div class="modal fade" id="studentAjaxModal" tabindex="-1" aria-labelledby="studentAjaxModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fs-5" id="studentAjaxModalTitle">Student</h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-student-modal-body>
                <div class="text-center py-4">Loading...</div>
            </div>
        </div>
    </div>
</div>

@endsection
