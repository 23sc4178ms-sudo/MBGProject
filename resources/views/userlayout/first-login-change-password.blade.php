@extends('format.layout')

@section('title', 'Set Your Password')

@section('content')
<style>
    .auth-wrapper {
        max-width: 460px;
        margin: 2rem auto;
        background: var(--bg-white);
        border: 1px solid var(--border);
        border-radius: 14px;
        box-shadow: var(--shadow-md);
        padding: 2rem;
    }
    .auth-wrapper h1 {
        margin: 0 0 0.5rem 0;
        color: var(--primary);
        font-size: 2rem;
    }
    .auth-wrapper p {
        margin: 0 0 1.5rem 0;
        color: var(--text-secondary);
    }
    .auth-error {
        margin-bottom: 1rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        border-radius: 8px;
        padding: 0.75rem 1rem;
    }
    .auth-success {
        margin-bottom: 1rem;
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
        border-radius: 8px;
        padding: 0.75rem 1rem;
    }
    .form-group {
        margin-bottom: 1rem;
    }
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-primary);
        font-weight: 600;
    }
    .form-group input {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid var(--border);
        border-radius: 8px;
        font-size: 1rem;
    }
    .form-group input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1);
    }
    .auth-actions {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.5rem;
    }
    .auth-actions .btn {
        flex: 1;
        justify-content: center;
    }
</style>

<section class="auth-wrapper" aria-labelledby="first-login-title">
    <h1 id="first-login-title">Set Your Password</h1>
    <p>Welcome! Please set your new password to continue.</p>

    @if (session('success'))
        <div class="auth-success" role="status">{{ session('success') }}</div>
    @endif
    @if ($errors->any())
        <div class="auth-error" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST" action="{{ route('user.password.first-login.submit', $user->id) }}" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="old_password">Old Password</label>
            <input type="password" id="old_password" name="old_password" class="form-control" required autocomplete="current-password">
        </div>
        <div class="form-group">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" class="form-control" required autocomplete="new-password" minlength="8">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password" minlength="8">
        </div>
        <div class="auth-actions">
            <button type="submit" class="btn btn-primary" style="background: #22c55e; border: none; color: #fff; font-weight:600;">Set Password</button>
        </div>
    </form>
</section>
@endsection
