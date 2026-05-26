@extends('format.layout')

@section('title', 'Dashboard')
@section('content')

<style>
.hero {
    background: linear-gradient(135deg, #0d9488, #0f766e);
    color: white;
    padding: 3rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
}

.hero h1 {
    font-size: 2.3rem;
    font-weight: 800;
}

.stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin-top: 2rem;
}

.card {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    text-align: center;
    border-left: 5px solid #0d9488;
}

.num {
    font-size: 2rem;
    font-weight: bold;
    color: #0d9488;
}

.label {
    color: gray;
    font-size: 0.9rem;
}

.info {
    margin-top: 2rem;
    background: white;
    padding: 2rem;
    border-radius: 12px;
}
</style>

<!-- HERO -->
<div class="hero">
    <h1>Dashboard Overview</h1>
    <p>Welcome to PSU Student Management System</p>
</div>

<!-- STATS -->
<div class="stats">

    <div class="card">
        <div class="num">120</div>
        <div class="label">Students</div>
    </div>

    <div class="card">
        <div class="num">8</div>
        <div class="label">Degrees</div>
    </div>

    <div class="card">
        <div class="num">25</div>
        <div class="label">Courses</div>
    </div>

    <div class="card">
        <div class="num">5</div>
        <div class="label">Users</div>
    </div>

</div>

<!-- INFO -->
<div class="info">
    <h2>System Overview</h2>
    <p>
        This system manages student records, courses, enrollments, and user accounts in one centralized platform.
    </p>
</div>

@endsection