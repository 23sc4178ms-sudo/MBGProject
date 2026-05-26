<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PSU Dashboard')</title>
    <style>
        :root {
            --primary: #0d9488;
            --primary-dark: #0f766e;
            --primary-100: #ccfbf1;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #d97706;
            --bg-white: #ffffff;
            --bg-lighter: #f1f5f9;
            --text-primary: #0f172a;
            --text-light: #64748b;
            --border: #e2e8f0;
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
        }
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg-lighter);
            color: var(--text-primary);
            overflow-x: hidden;
        }
        header {
            background: var(--bg-white);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.85rem clamp(0.85rem, 2vw, 1.5rem);
            max-width: 1320px;
            margin: 0 auto;
        }
        .logo {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.4rem;
            text-decoration: none;
        }
        .menu {
            display: flex;
            gap: 0.4rem;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
            flex: 1 1 auto;
            min-width: 0;
        }
        .menu a {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 600;
            padding: 6px 8px;
            border-radius: 6px;
            white-space: nowrap;
            font-size: 0.86rem;
        }
        .menu a:hover {
            background: #e6fffb;
            color: var(--primary);
        }
        .menu a.active {
            background: var(--primary);
            color: white;
        }

        .nav-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        main {
            display: flex;
            justify-content: center;
            padding: clamp(1rem, 2.5vw, 2rem);
        }

        .container {
            width: 100%;
            max-width: 1240px;
            min-width: 0;
            margin: 0 auto;
        }
      
        
        .form-container {
            background: var(--bg-white);
            padding: clamp(1rem, 3vw, 2rem);
            border-radius: 10px;
            box-shadow: var(--shadow-md);
            border: 1px solid var(--border);
            width: min(100%, 860px);
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 0;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }
        .form-group label {
            display: block;
            color: var(--primary-dark);
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        .form-group .required {
            color: #ef4444;
            margin-left: 0.25rem;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            min-height: 44px;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 1rem;
            transition: 0.2s border-color;
            font-family: inherit;
            background: var(--bg-white);
            color: var(--primary-dark);
        }
        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: var(--text-light);
        }
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px var(--primary-100), var(--shadow-md);
            background: var(--bg-white);
        }
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        .form-error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
            font-weight: 500;
        }
        .form-success {
            color: #10b981;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }
        .form-group.error input,
        .form-group.error textarea,
        .form-group.error select {
            border-color: #ef4444;
        }
        .form-group.error input:focus,
        .form-group.error textarea:focus,
        .form-group.error select:focus {
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1), var(--shadow-md);
        }
        /* BUTTONS */
        .btn {
            min-height: 40px;
            padding: 0.6rem 1rem;
            border: 1px solid transparent;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: 0.2s box-shadow, 0.2s background;
            box-shadow: var(--shadow-md);
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
        }
        .btn:hover {
            background: var(--primary-dark);
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        }
        .btn:active {
            transform: translateY(1px);
        }
        .btn-secondary {
            background: var(--primary-100);
            color: var(--primary);
            border: 1px solid var(--primary-dark);
            box-shadow: none;
        }
        .btn-secondary:hover {
            background: var(--primary);
            color: white;
        }
        .btn-danger {
            background: #ef4444;
            color: white;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .btn-success {
            background: #10b981;
            color: white;
        }
        .btn-success:hover {
            background: #059669;
        }
        .btn-sm {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }
        
        footer {
            text-align: center;
            padding: 1.5rem;
            background: white;
            border-top: 1px solid var(--border);
            margin-top: 2rem;
        }

        body main .page-header,
        body main [class$="-header"] {
            margin-bottom: 1.25rem;
        }

        body main .page-header h1,
        body main [class$="-header"] h1 {
            color: var(--primary-dark);
            font-size: clamp(1.45rem, 1.15rem + 1.1vw, 2.15rem);
            font-weight: 800;
            letter-spacing: 0;
            margin: 0;
            overflow-wrap: anywhere;
        }

        body main .page-header p,
        body main [class$="-header"] p {
            color: var(--text-light);
            margin: 0.35rem 0 0;
        }

        body main fieldset {
            border: 0;
            padding: 0;
            margin: 0;
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
        }

        body main fieldset + fieldset {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid var(--border);
        }

        body main legend {
            grid-column: 1 / -1;
            width: 100%;
            color: var(--primary-dark);
            font-weight: 800;
            font-size: 0.95rem;
            margin-bottom: 0.2rem;
        }

        body main .form-section {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        body main .card {
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
            background: #fff;
        }

        body main .card-header {
            padding: clamp(1rem, 2.5vw, 1.5rem);
            background: #fff;
            border-bottom: 1px solid var(--border);
        }

        body main .card-title {
            margin: 0;
            color: var(--primary-dark);
            font-weight: 800;
            font-size: clamp(1.35rem, 1.1rem + 0.8vw, 1.9rem);
        }

        body main .card-subtitle {
            margin: 0.35rem 0 0;
            color: var(--text-light);
        }

        body main .card-body {
            padding: clamp(1rem, 2.5vw, 1.5rem);
        }

        body main .button-group,
        body main .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        body main .btn,
        body main a.btn,
        body main button.btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            font-weight: 700;
            line-height: 1.2;
            text-decoration: none;
            box-shadow: none;
            white-space: nowrap;
        }

        body main .btn:hover {
            background: var(--primary-dark);
            color: #fff;
            transform: none;
        }

        body main .btn-secondary,
        body main .btn-light,
        body main .btn-cancel {
            background: #fff;
            color: var(--primary-dark);
            border-color: #cbd5e1;
        }

        body main .btn-danger {
            background: var(--danger);
            color: #fff;
        }

        body main .success-alert,
        body main .alert-success {
            padding: 1rem;
            background-color: #f0fdf4;
            border-left: 4px solid var(--success);
            color: #166534;
            margin-bottom: 1rem;
            border-radius: 8px;
            font-weight: 700;
        }

        @media (max-width: 900px) {
            nav {
                align-items: flex-start;
                flex-direction: column;
            }

            .menu {
                justify-content: flex-start;
            }
        }

        @media (max-width: 640px) {
            body main fieldset,
            body main .form-section {
                grid-template-columns: 1fr;
            }

            body main .btn,
            body main .button-group > * {
                width: 100%;
                white-space: normal;
            }
        }
    </style>
</head>
<body data-auth-role="{{ session('auth_role') }}">
<header>
    <nav>
        <a href="/home" class="logo">🎓 PSU</a>

        @php
            $role = session('auth_role');
            if (! $role && session()->has('student_user_account_id')) {
                $role = 'student';
            }
        @endphp

        <div class="menu">
            @if($role === 'admin')
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="{{ route('students.index') }}" class="{{ request()->is('students*') ? 'active' : '' }}"><i class="bi bi-people"></i> Students</a>
                <a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'active' : '' }}"><i class="bi bi-person-badge"></i> Teachers</a>
                <a href="{{ route('degrees.index') }}" class="{{ request()->is('degrees*') ? 'active' : '' }}"><i class="bi bi-mortarboard"></i> Degrees</a>
                <a href="{{ route('courses.index') }}" class="{{ request()->is('courses*') ? 'active' : '' }}"><i class="bi bi-journal-bookmark"></i> Courses</a>
                <a href="{{ route('course-enrollments.index') }}" class="{{ request()->is('course-enrollments*') ? 'active' : '' }}"><i class="bi bi-diagram-3"></i> Enrollments</a>
                <a href="{{ route('profiles.index') }}" class="{{ request()->is('profiles*') ? 'active' : '' }}"><i class="bi bi-person-lines-fill"></i> Profiles</a>
                <a href="{{ route('posts.index') }}" class="{{ request()->is('posts*') ? 'active' : '' }}"><i class="bi bi-chat-square-text"></i> Posts</a>
                <a href="{{ route('about') }}"><i class="bi bi-info-circle"></i> About</a>
            @elseif($role === 'teacher')
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="{{ route('students.create') }}" class="{{ request()->routeIs('students.create') ? 'active' : '' }}"><i class="bi bi-person-plus"></i> Add Student</a>
                <a href="{{ route('about') }}"><i class="bi bi-info-circle"></i> About</a>
            @elseif($role === 'student')
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="{{ route('student.password.change.form', session('student_id')) }}" class="{{ request()->is('students/*/change-password') ? 'active' : '' }}"><i class="bi bi-key"></i> Change Password</a>
                <a href="{{ route('about') }}"><i class="bi bi-info-circle"></i> About</a>
            @endif
        </div>
    </nav>
</header>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>
<footer>
    © 2026 PSU Student Management System
</footer>
</body>
</html>
