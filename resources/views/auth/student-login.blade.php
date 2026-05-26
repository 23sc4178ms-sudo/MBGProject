@extends('format.layout')

@section('title', 'Login')

@section('content')

<style>
/* ================ LOGIN CONTAINER ================ */
.login-container {
    display: flex;
    min-height: calc(100vh - 200px);
    align-items: center;
    padding: 2rem 1rem;
    background: linear-gradient(135deg, #e0f2f1 0%, #ffffff 100%);
}

.login-wrapper {
    max-width: 1000px;
    width: 100%;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2.5rem;
    align-items: center;
}

/* ================ LEFT SIDE: BRANDING ================ */
.login-branding {
    padding: 2rem;
}

.brand-logo {
    font-size: 3.5rem;
    margin-bottom: 1.5rem;
    line-height: 1;
}

.brand-name {
    font-size: 2.8rem;
    font-weight: 800;
    color: var(--primary);
    margin: 0 0 1rem 0;
}

.brand-tagline {
    font-size: 1.3rem;
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 2rem;
    max-width: 90%;
}

.brand-features {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.feature-item {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
}

.feature-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #ccfbf1;
    color: var(--primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.feature-text {
    font-size: 0.95rem;
    color: var(--text-light);
    line-height: 1.5;
}

/* ================ RIGHT SIDE: FORM ================ */
.auth-wrapper {
    background: var(--bg-white);
    border-radius: 12px;
    box-shadow: var(--shadow-md);
    padding: 2.5rem;
    border: 1px solid var(--border);
    width: 100%;
    max-width: 420px;
    justify-self: start;
}

.auth-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.4rem 0.85rem;
    border-radius: 999px;
    background: #ccfbf1;
    color: var(--primary-dark);
    font-size: 0.8rem;
    font-weight: 700;
    margin-bottom: 1.25rem;
}

.auth-wrapper h1 {
    margin-bottom: 0.5rem;
    margin-top: 0;
    color: var(--primary);
    font-size: 1.85rem;
    font-weight: 700;
}

.auth-wrapper > p {
    margin-bottom: 1.75rem;
    margin-top: 0;
    color: var(--text-light);
    font-size: 0.9rem;
    line-height: 1.4;
}

.auth-error,
.auth-success {
    margin-bottom: 1.25rem;
    border-radius: 10px;
    padding: 0.95rem 1.1rem;
    font-size: 0.9rem;
    line-height: 1.4;
}

.auth-error {
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #991b1b;
}

.auth-success {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #166534;
}

.input-group {
    margin-bottom: 1.3rem;
    width: 100%;
}

.input-group label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 600;
    color: var(--text-light);
    font-size: 0.9rem;
}

.input-wrapper {
    position: relative;
    width: 100%;
}

.input-wrapper input {
    width: 100%;
    height: 44px;
    padding: 0 44px 0 12px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 0.95rem;
    outline: none;
    box-sizing: border-box;
    transition: 0.2s ease;
    background: var(--bg-white);
}

.input-wrapper input::placeholder {
    color: #9ca3af;
}

.input-wrapper input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.08);
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    color: var(--text-light);
    font-size: 1rem;
    transition: 0.2s;
}

.toggle-password:hover {
    color: var(--primary);
}

.auth-actions {
    display: flex;
    gap: 0.75rem;
    margin-top: 1.75rem;
    width: 100%;
}

.btn-login {
    flex: 1;
    padding: 0.85rem;
    border-radius: 8px;
    border: none;
    font-weight: 700;
    cursor: pointer;
    font-size: 0.95rem;
    transition: 0.25s ease;
    background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
    color: white;
}

.btn-login:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(13, 148, 136, 0.3);
}

.btn-login:active {
    transform: translateY(0);
}

.helper-note {
    margin-top: 1rem;
    font-size: 0.8rem;
    color: var(--text-light);
    line-height: 1.5;
}

/* ================ MOBILE RESPONSIVE ================ */
@media (max-width: 768px) {
    .login-container {
        min-height: auto;
        padding: 1.5rem 1rem;
    }

    .login-wrapper {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .login-branding {
        text-align: center;
        padding: 1rem;
    }

    .brand-logo {
        font-size: 2.5rem;
        margin-bottom: 1rem;
    }

    .brand-name {
        font-size: 2rem;
    }

    .brand-tagline {
        font-size: 1.1rem;
        max-width: 100%;
    }

    .auth-wrapper {
        padding: 2rem;
        max-width: 100%;
        justify-self: stretch;
    }

    .auth-wrapper h1 {
        font-size: 1.6rem;
    }
}
</style>

<section class="login-container">
    <div class="login-wrapper">
        <!-- Left Side: Branding -->
        <aside class="login-branding">
            <div class="brand-logo">🎓</div>
            <h2 class="brand-name">PSU</h2>
            <p class="brand-tagline">Pangasinan State University Student Management System</p>
            
            <div class="brand-features">
                <div class="feature-item">
                    <div class="feature-icon"><i class="bi bi-person-check"></i></div>
                    <div class="feature-text">Easy access for admin, teachers, and students</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="bi bi-shield-check"></i></div>
                    <div class="feature-text">Secure and role-based authentication</div>
                </div>
                <div class="feature-item">
                    <div class="feature-icon"><i class="bi bi-lightning-charge"></i></div>
                    <div class="feature-text">Fast and responsive management system</div>
                </div>
            </div>
        </aside>

        <!-- Right Side: Login Form -->
        <article class="auth-wrapper">

    <h1>Welcome back</h1>
   

    @if (session('success'))
        <div class="auth-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="auth-error">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST" style="width: 100%;">
        @csrf

        <!-- USERNAME -->
        <div class="input-group">
            <label>Username or Email</label>
            <div class="input-wrapper">
                <input type="text" name="username" value="{{ old('username') }}" required>
            </div>
        </div>

        <!-- PASSWORD -->
        <div class="input-group">
            <label>Password</label>
            <div class="input-wrapper">
                <input type="password" id="password" name="password" required>

                <i class="bi bi-eye-slash toggle-password" id="togglePassword"></i>
            </div>
        </div>

        <div class="auth-actions">
            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right"></i> Login
            </button>
        </div>

  
    </form>

        </article>
    </div>
</section>

<script>
const toggle = document.getElementById('togglePassword');
const password = document.getElementById('password');

if (toggle && password) {
    toggle.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
}
</script>

@endsection