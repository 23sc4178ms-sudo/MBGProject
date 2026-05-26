<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PSU')</title>
    <style>
        :root {
            --primary: #0d9488;
            --primary-dark: #0f766e;
            --bg-white: #ffffff;
            --bg-lighter: #f1f5f9;
            --text-primary: #1f2937;
            --text-secondary: #6b7280;
            --border: #e2e8f0;
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e0f2f1 0%, #ffffff 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: var(--bg-white);
            border-bottom: 1px solid var(--border);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-weight: 800;
            color: var(--primary);
            font-size: 1.4rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-actions {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            padding: 2rem 1rem;
        }

        footer {
            background: var(--bg-white);
            border-top: 1px solid var(--border);
            text-align: center;
            padding: 1.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .form-control {
            padding: 0.75rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 1rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.1);
        }
    </style>
</head>
<body>
    <header>
        <a href="/" class="logo">🎓 PSU</a>
        <div class="header-actions">
            @auth
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            @endauth
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        © 2026 PSU Student Management System
    </footer>
</body>
</html>
