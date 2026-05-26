@extends('format.layout')

@section('title', 'Change Password')

@section('content')
<style>
    /* Wrapper */
    .auth-wrapper {
        max-width: 480px;
        margin: 3rem auto;
        background: var(--bg-white);
        border-radius: 16px;
        box-shadow: var(--shadow-lg);
        padding: 2.5rem 2rem;
        animation: fadeIn 0.4s ease-in-out;
        border: 1px solid var(--border-light);
    }

    /* Header */
    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .auth-header h1 {
        margin: 0;
        color: var(--primary);
        font-size: 2rem;
        font-weight: 700;
    }

    .auth-header p {
        margin-top: 0.5rem;
        color: var(--text-secondary);
        font-size: 0.95rem;
    }

    /* Alerts */
    .auth-error, .auth-success {
        margin-bottom: 1rem;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }

    .auth-error {
        background: #fef2f2;
        border-left: 4px solid #ef4444;
        color: #991b1b;
    }

    .auth-success {
        background: #f0fdf4;
        border-left: 4px solid #22c55e;
        color: #166534;
    }

    /* Form */
    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: var(--text-primary);
    }

    .form-control {
        width: 100%;
        padding: 0.7rem 0.8rem;
        padding-right: 2.7rem;
        border-radius: 8px;
        border: 1px solid var(--border);
        transition: 0.2s;
        font-size: 0.95rem;
    }

    .form-control:focus {
        border-color: var(--primary);
        outline: none;
        box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.15);
    }

    .input-wrapper {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 0.9rem;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: var(--text-secondary);
        font-size: 1rem;
    }

    .toggle-password:hover {
        color: var(--primary);
    }

    /* Actions */
    .auth-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.8rem;
    }

    /* Change Password Button */
    .btn-submit {
        flex: 1;
        padding: 0.75rem;
        background: linear-gradient(135deg, #22c55e, #16a34a);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: var(--shadow-md);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-hover);
    }

    /* Cancel Button */
    .btn-cancel {
        flex: 1;
        padding: 0.75rem;
        background: #e2e8f0;
        color: #334155;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-cancel:hover {
        background: #cbd5f5;
        transform: translateY(-1px);
    }

    /* Icon Circle (optional aesthetic) */
    .icon-circle {
        width: 60px;
        height: 60px;
        margin: 0 auto 1rem auto;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: var(--shadow-md);
    }
</style>

<section class="auth-wrapper">

    <div class="auth-header">
        <div class="icon-circle">🔑</div>
        <h1>Change Password</h1>
        <p>Enter your old password and set a new secure password</p>
    </div>

    @if (session('success'))
        <div class="auth-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="auth-error">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('student.password.change', $student->id) }}" autocomplete="off">
        @csrf

        <div class="form-group">
            <label for="old_password">Old Password</label>
            <div class="input-wrapper">
                <input type="password" id="old_password" name="old_password" class="form-control" required>
                <i class="bi bi-eye-slash toggle-password" data-target="old_password" aria-hidden="true"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="password">New Password</label>
            <div class="input-wrapper">
                <input type="password" id="password" name="password" class="form-control" required>
                <i class="bi bi-eye-slash toggle-password" data-target="password" aria-hidden="true"></i>
            </div>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <div class="input-wrapper">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                <i class="bi bi-eye-slash toggle-password" data-target="password_confirmation" aria-hidden="true"></i>
            </div>
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn-submit">
                🔒 Update Password
            </button>

            <a href="{{ route('students.show', $student->id) }}" class="btn-cancel">
                Cancel
            </a>
        </div>
    </form>

</section>
<script>
document.querySelectorAll('.toggle-password').forEach(function (icon) {
    icon.addEventListener('click', function () {
        const targetId = this.getAttribute('data-target');
        const input = document.getElementById(targetId);

        if (!input) {
            return;
        }

        const nextType = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', nextType);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
});
</script>
@endsection