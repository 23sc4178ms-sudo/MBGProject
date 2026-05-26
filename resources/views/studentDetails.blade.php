@extends('format.layout')

@section('title')
    Student Details
@endsection

@section('content')

<style>
    .container {
        max-width: 700px;
        margin: auto;
    }

    .card {
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #ec4899, #db2777);
        color: #fff;
        padding: 1.5rem;
        font-size: 1.5rem;
        font-weight: 600;
    }

    .card-body {
        padding: 1.5rem;
    }

    .info {
        margin-bottom: 1rem;
        display: flex;
        justify-content: space-between;
        border-bottom: 1px solid #f3f4f6;
        padding-bottom: 8px;
    }

    .label {
        font-weight: 600;
        color: #ec4899;
    }

    .value {
        color: #333;
    }

    .actions {
        margin-top: 1.5rem;
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 6px 10px;
        border-radius: 5px;
        color: #fff;
        text-decoration: none;
        font-size: 0.85rem;
    }

    .edit { background: #f59e0b; }
    .delete { background: #ef4444; border: none; cursor: pointer; }
    .back { background: #6b7280; }
</style>

<div class="container">

    <div class="card">
        <div class="card-header">
            {{ $student->name }} {{ $student->lname }}
        </div>

        <div class="card-body">
            <div class="info">
                <span class="label">Full Name</span>
                <span class="value">
                    {{ $student->name }} {{ $student->mname }} {{ $student->lname }}
                </span>
            </div>

            <div class="info">
                <span class="label">Email</span>
                <span class="value">{{ $student->email }}</span>
            </div>

            <div class="info">
                <span class="label">Contact</span>
                <span class="value">{{ $student->contact }}</span>
            </div>

            <div class="info">
                <span class="label">Course</span>
                <span class="value">{{ $student->degree->Degree ?? 'Not Assigned' }}</span>
            </div>

            <div class="actions">
                <a href="{{ route('students.edit', $student->id) }}" class="btn edit">Edit</a>

                <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn delete"
                    onclick="return confirm('Delete {{ addslashes($student->name) }}?')">
                        Delete
                    </button>
                </form>

                <a href="{{ route('students.index') }}" class="btn back">Back</a>
                <!-- Change Password Button -->
                <button class="btn edit" style="background: #6366f1;" onclick="document.getElementById('changePasswordModal').style.display='block'">Change Password</button>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div id="changePasswordModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.4); z-index:1000;">
        <div style="background:#fff; max-width:400px; margin:5% auto; padding:2rem; border-radius:10px; position:relative;">
            <h2 style="margin-bottom:1rem;">Change Password</h2>
            <form method="POST" action="{{ route('student.password.change', $student->id) }}">
                @csrf
                <div class="form-group">
                    <label for="old_password">Old Password</label>
                    <input type="password" name="old_password" id="old_password" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required class="form-control">
                </div>
                <div style="margin-top:1rem; display:flex; gap:10px;">
                    <button type="submit" class="btn edit" style="background:#10b981;">Update Password</button>
                    <button type="button" class="btn back" onclick="document.getElementById('changePasswordModal').style.display='none'">Cancel</button>
                </div>
            </form>
            <button onclick="document.getElementById('changePasswordModal').style.display='none'" style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:1.5rem; color:#888; cursor:pointer;">&times;</button>
        </div>
    </div>

</div>

@endsection