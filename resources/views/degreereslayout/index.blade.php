@extends('format.layout')

@section('title','Degrees')

@section('content')

<style>
    .degrees-header {
        margin-bottom: 2rem;
    }

    .degrees-header h1 {
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
    }

    .btn-primary {
        background: var(--primary);
        color: #fff;
    }

    .success-alert {
        padding: 1rem;
        background-color: #f0fdf4;
        border-left: 4px solid green;
        margin-bottom: 1rem;
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
    }

    tbody tr {
        border-bottom: 1px solid #eee;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    .actions {
        display: flex;
        gap: 5px;
    }

    .action-btn {
        padding: 5px 8px;
        border-radius: 5px;
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .edit { background: #fef3c7; color: #b45309; }
    .delete { background: #fee2e2; color: #991b1b; }
</style>

<section class="degrees-header">
    <h1>Degrees List</h1>
</section>

@if(session('success'))
    <div class="success-alert">{{ session('success') }}</div>
@endif

<div class="action-buttons">
    <a href="{{ route('degrees.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Degree
    </a>
</div>

@if($degrees->count() > 0)
<div class="table-container">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Degree</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
    @foreach($degrees as $degree)
        <tr>
            <td>#{{ $degree->id }}</td>
            <td>{{ $degree->Degree }}</td>

            <td>
                <div class="actions">
                    <a href="{{ route('degrees.edit',$degree->id) }}" class="action-btn edit" title="Edit degree">
                        <i class="bi bi-pencil-square"></i> Edit
                    </a>

                    <form action="{{ route('degrees.destroy',$degree->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="action-btn delete"
                        onclick="return confirm('Delete {{ addslashes($degree->Degree) }}?')">
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
<div class="empty-state" style="text-align:center; padding:2rem; border:1px dashed #ddd; border-radius:10px; margin-top:1rem;">
    <h3>No Degrees Yet</h3>
    <p>There are no degrees in the system. Create one to get started.</p>
    <a href="{{ route('degrees.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Create First Degree</a>
</div>
@endif

@endsection
