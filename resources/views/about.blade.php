@extends('format.layout')

@section('title', 'About - Student Management System')

@section('content')

<style>
    .about-hero {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
        padding: 3rem 2rem;
        border-radius: var(--radius-xl);
        margin-bottom: 3rem;
    }
    
    .about-hero h1 {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 0.75rem 0;
        letter-spacing: -0.5px;
    }
    
    .about-hero p {
        font-size: 1.1rem;
        opacity: 0.95;
        margin: 0;
    }

    .content-section {
        background: var(--bg-white);
        padding: 2.5rem;
        border-radius: var(--radius-xl);
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        margin-bottom: 2rem;
    }
    
    .content-section h2 {
        color: var(--primary);
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0 0 1rem 0;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--primary-100);
    }

    .content-section p {
        font-size: 1rem;
        line-height: 1.8;
        margin-bottom: 1.5rem;
        color: var(--text-light);
    }

    .content-section strong {
        color: var(--primary);
        font-weight: 600;
    }

    .content-section p:last-child {
        margin-bottom: 0;
    }
    
    .features-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid var(--border);
    }
    
    .feature-item {
        padding: 1.5rem;
        background: var(--bg-light);
        border-radius: var(--radius-lg);
        border-left: 4px solid var(--primary);
    }
    
    .feature-item h3 {
        color: var(--primary);
        font-size: 1.125rem;
        font-weight: 600;
        margin: 0 0 0.75rem 0;
    }
    
    .feature-item p {
        margin: 0;
        font-size: 0.95rem;
        color: var(--text-light);
    }
    
    .tech-stack {
        background: linear-gradient(135deg, var(--primary-50) 0%, var(--primary-100) 100%);
        padding: 2rem;
        border-radius: var(--radius-lg);
        border: 1px solid var(--primary-200);
    }
    
    .tech-stack h3 {
        color: var(--primary);
        margin: 0 0 1rem 0;
        font-weight: 700;
    }
    
    .tech-list {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }
    
    .tech-item {
        background: var(--bg-white);
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius-md);
        border: 1px solid var(--primary-200);
        color: var(--primary);
        font-weight: 600;
        font-size: 0.9rem;
    }
</style>

<main>
    <section class="about-hero" aria-labelledby="about-title">
        <h1 id="about-title">About This Project</h1>
        <p>A modern Student Management System built with Laravel and contemporary web technologies</p>
    </section>

    <article class="content-section" role="main">
        <h2>Project Overview</h2>
        <p>
            This project is a <strong>Student Management Dashboard</strong> developed using 
            <strong>Laravel Blade Templates</strong>. It demonstrates how <strong>Laravel</strong> can be used 
            to build dynamic and reusable web interfaces with modern design patterns.
        </p>

        <p>
            The system uses <strong>Blade layout inheritance</strong> to maintain a consistent 
            design across pages. It also implements <strong>loops</strong> and 
            <strong>conditional statements</strong> to dynamically display student information with a clean, modern UI.
        </p>

        <p>
            This project showcases the use of Laravel's templating features to create 
            a responsive, accessible, and maintainable web application with an elegant teal-themed design system 
            and optimized layouts for all device sizes.
        </p>
    </article>

    <article class="content-section">
        <h2>Key Features</h2>
        <div class="features-list">
            <div class="feature-item">
                <h3><i class="bi bi-people"></i> Student Management</h3>
                <p>View, add, edit, and delete student records with an intuitive interface</p>
            </div>
            <div class="feature-item">
                <h3><i class="bi bi-layout-wtf"></i> Modern Dashboard</h3>
                <p>Clean, minimalist design with responsive grid layouts and modern card components</p>
            </div>
            <div class="feature-item">
                <h3><i class="bi bi-check-circle"></i> Form Validation</h3>
                <p>Client and server-side validation to ensure data integrity</p>
            </div>
            <div class="feature-item">
                <h3><i class="bi bi-shield-check"></i> Semantic HTML</h3>
                <p>Accessible markup with proper ARIA labels and semantic elements</p>
            </div>
            <div class="feature-item">
                <h3><i class="bi bi-phone"></i> Responsive Design</h3>
                <p>Fully responsive layout that works beautifully on mobile, tablet, and desktop</p>
            </div>
            <div class="feature-item">
                <h3><i class="bi bi-palette"></i> Beautiful UI</h3>
                <p>Modern teal color scheme with smooth animations and micro-interactions</p>
            </div>
        </div>
    </article>

    <article class="content-section">
        <h2>Technology Stack</h2>
        <div class="tech-stack">
            <h3>Built With</h3>
            <div class="tech-list">
                <span class="tech-item">Laravel 11</span>
                <span class="tech-item">Blade Templates</span>
                <span class="tech-item">PHP</span>
                <span class="tech-item">CSS3</span>
                <span class="tech-item">HTML5</span>
                <span class="tech-item">Bootstrap Icons</span>
            </div>
        </div>
    </article>

    <article class="content-section">
        <h2>Design Philosophy</h2>
        <p>
            This project follows modern design principles with a focus on <strong>simplicity</strong>, 
            <strong>accessibility</strong>, and <strong>user experience</strong>. The teal color scheme provides 
            a professional and calming aesthetic while maintaining excellent contrast ratios for readability. 
            All components are built with semantic HTML5 and include ARIA attributes for accessibility.
        </p>
        <p>
            The responsive design ensures that the application works seamlessly across all devices, 
            from large desktop displays to small mobile screens. Smooth transitions and animations 
            provide visual feedback without being distracting or slowing down the application.
        </p>
    </article>
</main>

@endsection