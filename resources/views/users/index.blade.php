@extends('format.layout')

@section('title', 'Users')

@section('content')

<style>
    .users-header {
        margin-bottom: 2rem;
    }

    .users-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
    }

    /* ===== CREATE BUTTON DESIGN ===== */
    .create-btn {
        background: linear-gradient(135deg, #0d9488, #0f766e);
        color: white;
        padding: 10px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 6px 15px rgba(13,148,136,0.25);
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .create-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(13,148,136,0.35);
        background: linear-gradient(135deg, #0f766e, #0d9488);
    }

    .create-btn:active {
        transform: scale(0.97);
    }

    .create-btn i {
        font-size: 1rem;
    }

    .action-buttons {
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: flex-start;
    }

    /* ===== ROLE BADGE ===== */
    .role-badge {
        background: #f1f5f9;
        color: #475569;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        border: 1px solid #e2e8f0;
    }

    .role-admin {
        background: #fef3c7;
        color: #92400e;
        border-color: #fde68a;
    }

    /* ===== TABLE ===== */
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
        background: linear-gradient(135deg, #0d9488, #0f766e);
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
        transition: 0.2s;
    }

    tbody tr:hover {
        background: #f9fafb;
    }

    /* ===== BADGES ===== */
    .badge {
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .badge-success { background: #d1fae5; color: #065f46; }
    .badge-secondary { background: #f1f5f9; color: #475569; }

    /* ===== ACTION BUTTONS ===== */
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
        transition: 0.2s;
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
</style>

<section class="users-header">
    <h1>Teacher and Admin Accounts</h1>
</section>

@if(session('success'))
    <div style="padding: 1rem; background-color: #f0fdf4; border-left: 4px solid #10b981; color: #166534; margin-bottom: 1rem; border-radius: 4px;">
        {{ session('success') }}
    </div>
@endif

<!-- ✅ FIXED BUTTON -->
<div class="action-buttons">
    <a href="{{ route('users.create') }}" class="create-btn">
        <i class="bi bi-plus-circle"></i> Create Account
    </a>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Profile Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>#{{ $user->id }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td>
                            <span class="role-badge {{ strtolower($user->role) == 'admin' ? 'role-admin' : '' }}">
                            {{ $user->role ?: 'User' }}
                        </span>
                    </td>
                    <td>
                        @if($user->profile)
                            <span class="badge badge-success">Active Profile</span>
                        @else
                            <span class="badge badge-secondary">No Profile</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('users.edit', $user->id) }}" class="action-btn edit" title="Edit account"><i class="bi bi-pencil-square"></i> Edit</a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete"
                                    onclick="return confirm('Delete this user account?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; padding: 2rem;">
                        No accounts found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
