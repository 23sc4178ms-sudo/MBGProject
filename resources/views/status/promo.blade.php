@extends('format.layout')
@section('title', 'Special Promo!')

@section('content')

<style>
    .promo-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 3rem 1rem;
    }

    .promo-card {
        max-width: 520px;
        width: 100%;
        border-radius: 1.2rem;
        overflow: hidden;
        background: linear-gradient(145deg, #ffffff, #f8fafc);
        box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        border: 1px solid var(--border);
        animation: fadeIn 0.6s ease;
        position: relative;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    /* HEADER */
    .promo-header {
        text-align: center;
        padding: 2rem 1.5rem;
        background: linear-gradient(135deg, #22c55e, #14b8a6, #0d9488);
        color: white;
        position: relative;
    }

    .promo-header::after {
        content: "";
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top left, rgba(255,255,255,0.3), transparent 70%);
    }

    .promo-icon {
        font-size: 3rem;
        background: rgba(255,255,255,0.9);
        color: #0d9488;
        padding: 0.8rem 1rem;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        margin-bottom: 1rem;
    }

    .promo-title {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
    }

    .promo-badge {
        margin-top: 0.5rem;
        display: inline-block;
        padding: 0.3rem 1rem;
        border-radius: 999px;
        background: rgba(255,255,255,0.9);
        color: #065f46;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* BODY */
    .promo-body {
        padding: 2rem;
        text-align: center;
    }

    .promo-alert {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-left: 4px solid #22c55e;
        padding: 1.2rem;
        border-radius: 10px;
        color: #065f46;
        margin-bottom: 1.8rem;
        font-size: 1rem;
        position: relative;
    }

    .promo-discount {
        font-size: 2.2rem;
        font-weight: 900;
        color: #059669;
        margin-bottom: 0.5rem;
        text-shadow: 0 2px 10px rgba(34,197,94,0.3);
    }

    .promo-alert span {
        display: block;
        margin-top: 0.3rem;
    }

    /* BUTTON */
    .promo-btn {
        width: 100%;
        padding: 0.9rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 10px;
        background: linear-gradient(135deg, #22c55e, #14b8a6);
        color: white;
        border: none;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(34,197,94,0.25);
    }

    .promo-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(34,197,94,0.35);
    }

    /* FOOTER */
    .promo-footer {
        margin-top: 1rem;
        font-size: 0.85rem;
        color: var(--text-light);
    }

    /* EXTRA EFFECT (shine animation) */
    .promo-card::before {
        content: "";
        position: absolute;
        top: -100%;
        left: -50%;
        width: 200%;
        height: 300%;
        background: linear-gradient(
            120deg,
            transparent,
            rgba(255,255,255,0.3),
            transparent
        );
        transform: rotate(25deg);
        animation: shine 6s infinite;
    }

    @keyframes shine {
        0% { top: -100%; }
        100% { top: 100%; }
    }

</style>

<div class="promo-wrapper">

    <div class="promo-card">

        <!-- HEADER -->
        <div class="promo-header">
            <div class="promo-icon">
                <i class="bi bi-stars"></i>
            </div>

            <h1 class="promo-title">Special Promo!</h1>

            <div class="promo-badge">
                Promo Ongoing
            </div>
        </div>

        <!-- BODY -->
        <div class="promo-body">

            <div class="promo-alert">
                <div class="promo-discount">50% OFF</div>
                on all items!
                <span>Don’t miss out on this amazing event.</span>
                <span><strong>Hurry, limited time only!</strong></span>
            </div>

            <a href="/home" class="promo-btn">
                ← Back to Home
            </a>

            <div class="promo-footer">
                <div>Thank you for your support.</div>
                <div>Contact support for more details.</div>
            </div>

        </div>

    </div>

</div>

@endsection