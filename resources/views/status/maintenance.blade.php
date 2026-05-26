@extends('format.layout')
@section('title', 'Down for Maintenance')

@section('content')

<style>
    .maintenance-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 3rem 1rem;
    }

    .maintenance-card {
        max-width: 520px;
        width: 100%;
        border-radius: 1.2rem;
        overflow: hidden;
        background: linear-gradient(145deg, #ffffff, #f8fafc);
        box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        border: 1px solid var(--border);
        animation: fadeIn 0.6s ease;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .maintenance-header {
        text-align: center;
        padding: 2rem 1.5rem;
        background: linear-gradient(135deg, #0d9488, #14b8a6, #22c55e);
        color: white;
        position: relative;
    }

    .maintenance-header::after {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(255,255,255,0.3), transparent 70%);
    }

    .maintenance-icon {
        font-size: 3rem;
        background: rgba(255,255,255,0.9);
        color: #0d9488;
        padding: 0.8rem 1rem;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        margin-bottom: 1rem;
    }

    .maintenance-title {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
    }

    .maintenance-badge {
        margin-top: 0.5rem;
        display: inline-block;
        padding: 0.3rem 1rem;
        border-radius: 999px;
        background: rgba(255,255,255,0.9);
        color: #0f766e;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .maintenance-body {
        padding: 2rem;
        text-align: center;
    }

    .maintenance-alert {
        background: linear-gradient(135deg, #ecfeff, #f0fdf4);
        border-left: 4px solid var(--primary);
        padding: 1rem;
        border-radius: 8px;
        color: var(--primary-dark);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .maintenance-stats {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1.8rem;
    }

    .stat-box {
        flex: 1;
        padding: 1rem;
        border-radius: 10px;
        background: #f9fafb;
        box-shadow: inset 0 0 0 1px var(--border);
    }

    .stat-title {
        font-size: 0.85rem;
        color: var(--text-light);
        margin-bottom: 0.3rem;
    }

    .stat-value {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-dark);
    }

    .status-active {
        color: #16a34a;
    }

    .maintenance-btn {
        width: 100%;
        padding: 0.9rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 10px;
        background: linear-gradient(135deg, #0d9488, #14b8a6);
        color: white;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(13,148,136,0.25);
    }

    .maintenance-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(13,148,136,0.35);
    }

    .maintenance-footer {
        margin-top: 1rem;
        font-size: 0.85rem;
        color: var(--text-light);
    }
</style>

<div class="maintenance-wrapper">

    <div class="maintenance-card">

        <!-- HEADER -->
        <div class="maintenance-header">
            <div class="maintenance-icon">
                <i class="bi bi-tools"></i>
            </div>

            <h1 class="maintenance-title">Down for Maintenance</h1>

            <div class="maintenance-badge">
                Scheduled Maintenance in Progress
            </div>
        </div>

        <!-- BODY -->
        <div class="maintenance-body">

            <div class="maintenance-alert">
                We're currently performing important maintenance and upgrades.<br>
                We appreciate your patience while we improve your experience.
            </div>

            <div class="maintenance-stats">
                <div class="stat-box">
                    <div class="stat-title">Expected Back</div>
                    <div class="stat-value">01:10 PM</div>
                </div>

                <div class="stat-box">
                    <div class="stat-title">Status</div>
                    <div class="stat-value status-active">In Progress</div>
                </div>
            </div>

            <a href="/home" class="maintenance-btn">
                ← Back to Home
            </a>

            <div class="maintenance-footer">
                <div>Thank you for your patience.</div>
                <div>Contact support if needed.</div>
            </div>

        </div>

    </div>

</div>

@endsection