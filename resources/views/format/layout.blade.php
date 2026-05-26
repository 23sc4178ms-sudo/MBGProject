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
            --primary-soft: #ccfbf1;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #d97706;
            --bg-white: #ffffff;
            --bg-lighter: #f1f5f9;
            --text-primary: #0f172a;
            --text-light: #64748b;
            --border: #e2e8f0;
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 16px 40px rgba(15,23,42,0.12);
        }

        * {
            box-sizing: border-box;
        }

        html {
            min-width: 320px;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg-lighter);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* ================= NAVBAR ================= */
        header {
            background: var(--bg-white);
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav {
            max-width: 1320px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.75rem;
            padding: 0.85rem clamp(0.85rem, 2vw, 1.5rem);
        }

        .logo {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.3rem;
            text-decoration: none;
        }

        .menu {
            display: flex;
            gap: 0.4rem;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
            min-width: 0;
            flex: 1 1 auto;
        }

        .menu a {
            text-decoration: none;
            color: var(--text-light);
            font-weight: 600;
            padding: 6px 8px;
            border-radius: 6px;
            font-size: 0.86rem;
            transition: 0.2s;
            white-space: nowrap;
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
            margin-left: 0;
            flex-wrap: wrap;
            justify-content: flex-end;
            flex: 0 0 auto;
        }

        .role-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.4rem 0.75rem;
            border-radius: 999px;
            background: #ecfeff;
            color: var(--primary-dark);
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: capitalize;
        }

        /* ================= LOGOUT BUTTON (UPDATED) ================= */
        .btn-logout {
            background: linear-gradient(135deg, #f6ecec 0%, #eacfcf 100%);
            color: #000000;
            border: none;
            padding: 0.55rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: var(--shadow-md);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-logout:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }

        .btn-logout:active {
            transform: translateY(0);
        }

        /* ================= MAIN ================= */
        main {
            display: flex;
            justify-content: center;
            padding: clamp(1rem, 2.5vw, 2rem);
        }

        .container {
            width: 100%;
            max-width: 1240px;
            min-width: 0;
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

        body main .dashboard-hero,
        body main .teacher-hero {
            border-radius: 12px;
            padding: clamp(1.25rem, 3vw, 2rem);
        }

        body main .quick-card,
        body main .teacher-card,
        body main .student-card,
        body main .card,
        body main .form-container,
        body main .empty-state {
            border: 1px solid var(--border);
            border-radius: 10px;
            box-shadow: var(--shadow-md);
            background: #fff;
        }

        body main .form-container {
            width: min(100%, 860px);
            padding: clamp(1rem, 3vw, 2rem);
            margin-inline: auto;
        }

        body main .card {
            overflow: hidden;
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

        body main .form-group {
            min-width: 0;
            margin-bottom: 0;
        }

        body main .form-section {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        body main .form-group label {
            display: block;
            color: var(--text-primary);
            font-weight: 700;
            margin-bottom: 0.45rem;
        }

        body main input,
        body main select,
        body main textarea {
            width: 100%;
            min-height: 44px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.7rem 0.8rem;
            color: var(--text-primary);
            background: #fff;
        }

        body main input:focus,
        body main select:focus,
        body main textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(13,148,136,0.14);
        }

        body main .form-error,
        body main .ajax-field-error {
            color: var(--danger);
            font-size: 0.85rem;
            font-weight: 700;
            margin-top: 0.35rem;
        }

        body main .button-group,
        body main .action-buttons,
        body main .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        body main .btn,
        body main a.btn,
        body main button.btn,
        body main .create-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.45rem;
            min-height: 40px;
            border-radius: 8px;
            padding: 0.6rem 1rem;
            border: 1px solid transparent;
            background: var(--primary);
            color: #fff;
            font-weight: 700;
            line-height: 1.2;
            text-decoration: none;
            box-shadow: none;
            white-space: nowrap;
        }

        body main .btn:hover,
        body main .create-btn:hover {
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

        body main .btn-danger,
        body main .btn-delete {
            background: var(--danger);
            color: #fff;
        }

        body main .btn-warning,
        body main .btn-password {
            background: var(--warning);
            color: #fff;
        }

        body main .table-container,
        body main .table-responsive {
            width: 100%;
            overflow-x: auto;
            border-radius: 10px;
            border: 1px solid var(--border);
            background: #fff;
            box-shadow: var(--shadow-md);
        }

        body main table {
            width: 100%;
            min-width: 760px;
            border-collapse: collapse;
            background: #fff;
            box-shadow: none;
            border-radius: 0;
        }

        body main thead {
            background: var(--primary-dark);
            color: #fff;
        }

        body main th,
        body main td {
            padding: 0.85rem 1rem;
            vertical-align: middle;
        }

        body main th {
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 0;
            white-space: nowrap;
        }

        body main td {
            color: var(--text-primary);
        }

        body main tbody tr {
            border-bottom: 1px solid var(--border);
        }

        body main tbody tr:hover {
            background: #f8fafc;
        }

        body main .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
            align-items: center;
        }

        body main .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            min-height: 34px;
            border-radius: 8px;
            padding: 0.45rem 0.7rem;
            font-size: 0.82rem;
            font-weight: 800;
            border: 1px solid transparent;
            cursor: pointer;
            text-decoration: none;
            white-space: nowrap;
            line-height: 1.1;
        }

        body main .action-btn.view {
            color: #075985;
            background: #e0f2fe;
            border-color: #bae6fd;
        }

        body main .action-btn.edit {
            color: #92400e;
            background: #fef3c7;
            border-color: #fde68a;
        }

        body main .action-btn.delete {
            color: #991b1b;
            background: #fee2e2;
            border-color: #fecaca;
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

        body main .empty-state {
            text-align: center;
            padding: clamp(1.5rem, 4vw, 3rem);
            border-style: dashed;
        }

        @media (max-width: 900px) {
            nav {
                align-items: flex-start;
                flex-direction: column;
            }

            .menu {
                justify-content: flex-start;
            }

            .nav-meta {
                margin-left: 0;
                justify-content: flex-start;
            }
        }

        @media (max-width: 640px) {
            body main fieldset,
            body main .form-section {
                grid-template-columns: 1fr;
            }

            body main .btn,
            body main .create-btn,
            body main .button-group > * {
                width: 100%;
                white-space: normal;
            }

            body main .actions {
                flex-direction: column;
                align-items: stretch;
            }

            body main .actions .action-btn,
            body main .actions form,
            body main .actions button {
                width: 100%;
            }
        }

        /* ================= FOOTER ================= */
        footer {
            text-align: center;
            padding: 1rem;
            background: white;
            border-top: 1px solid var(--border);
            margin-top: 2rem;
            font-size: 0.85rem;
            color: var(--text-light);
        }
    </style>
</head>

<body data-auth-role="{{ session('auth_role') }}">

<header>
    <nav>
        <a href="/home" class="logo"> PSU</a>

        @php
            $role = session('auth_role');
            if (! $role && session()->has('student_user_account_id')) {
                $role = 'student';
            }
        @endphp

        @if(!request()->routeIs('login'))
        <div class="menu">
            @if($role === 'admin')
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="{{ route('students.index') }}" class="{{ request()->is('students*') ? 'active' : '' }}"><i class="bi bi-people"></i> Students</a>
                <a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'active' : '' }}"><i class="bi bi-person-badge"></i> Users</a>
                <a href="{{ route('degrees.index') }}" class="{{ request()->is('degrees*') ? 'active' : '' }}"><i class="bi bi-mortarboard"></i> Degrees</a>
                <a href="{{ route('courses.index') }}" class="{{ request()->is('courses*') ? 'active' : '' }}"><i class="bi bi-journal-bookmark"></i> Courses</a>
                <a href="{{ route('course-enrollments.index') }}" class="{{ request()->is('course-enrollments*') ? 'active' : '' }}"><i class="bi bi-diagram-3"></i> Enrollments</a>
                <a href="{{ route('profiles.index') }}" class="{{ request()->is('profiles*') ? 'active' : '' }}"><i class="bi bi-person-lines-fill"></i> Profiles</a>
                <a href="{{ route('posts.index') }}" class="{{ request()->is('posts*') ? 'active' : '' }}"><i class="bi bi-chat-square-text"></i> Posts</a>
                <a href="{{ route('maintenance.get') }}" class="{{ request()->is('maintenance*') ? 'active' : '' }}"><i class="bi bi-sliders"></i> Maintenance</a>
                <a href="{{ route('about') }}"><i class="bi bi-info-circle"></i> About</a>
                <a href="{{ route('admin.pdf.index') }}" class="{{ request()->is('pdf*') ? 'active' : '' }}"><i class="bi bi-file-earmark-pdf"></i> PDF</a>
                @if (Route::has('admin.upload.index'))
                    <a href="{{ route('admin.upload.index') }}" class="{{ request()->is('upload*') ? 'active' : '' }}"><i class="bi bi-image"></i> Upload</a>
                @endif
                <a href="{{ route('admin.excel.index') }}" class="{{ request()->is('excel*') ? 'active' : '' }}"><i class="bi bi-file-earmark-spreadsheet"></i> Excel</a>
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

        @if($role)
        <div class="nav-meta">
            <span class="role-pill"><i class="bi bi-person-circle"></i> {{ $role }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline; margin: 0;">
                @csrf
                <button type="submit" class="btn-logout">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
        @endif
        @endif
    </nav>
</header>

<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<footer>
    Â© 2026 PSU Student Management System
</footer>

</body>
</html>

