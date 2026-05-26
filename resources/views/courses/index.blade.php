@extends('format.layout')

@section('title', 'Courses')

@section('content')

<style>
    .courses-header {
        margin-bottom: 2rem;
    }

    .courses-header h1 {
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

    .edit { 
        background: #fef3c7; 
        color: #b45309; 
    }
    
    .edit:hover {
        background: #fde68a;
    }

    .delete { 
        background: #fee2e2; 
        color: #991b1b; 
    }

    .delete:hover {
        background: #fecaca;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #fff;
        border: 2px dashed var(--border);
        border-radius: 12px;
        margin-top: 1rem;
    }

    .empty-state h3 {
        color: var(--text-primary);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--text-light);
        margin-bottom: 1.5rem;
    }
</style>

<section class="courses-header">
    <h1>Courses List</h1>
</section>

@if(session('success'))
    <div class="success-alert">
        {{ session('success') }}
    </div>
@endif

<div class="action-buttons">
    <a href="{{ route('courses.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Course
    </a>
</div>

@if($courses->count() > 0)
<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
                <tr>
                    <td>#{{ $course->id }}</td>
                    <td><strong>{{ $course->course_name }}</strong></td>
                    <td>{{ Str::limit($course->description, 60) }}</td>
                    <td>{{ $course->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('courses.edit', $course->id) }}" class="action-btn edit" title="Edit course">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete" onclick="return confirm('Delete {{ addslashes($course->course_name) }}?')">
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
    <h3>No Courses Yet</h3>
    <p>There are no courses in the system. Create one to get started.</p>
    <a href="{{ route('courses.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create First Course</a>
</div>
@endif

@endsection

