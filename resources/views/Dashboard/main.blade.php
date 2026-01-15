@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- DASHBOARD HERO FULLSCREEN -->
<section class="dashboard-hero">
    <div class="dashboard-overlay">

        <!-- LOGO -->
        <img src="{{ asset('storage/iictlogo.png') }}" class="hero-logo" alt="IICT Logo">

        <!-- TITLE -->
        <h1 class="hero-title">
            STUDENT PARTICIPATION ATTENDANCE RECORDING KIT
        </h1>

        <!-- SUBTITLE -->
        <p class="hero-subtitle">
            INSTITUTE OF INFORMATION AND COMMUNICATIONS TECHNOLOGY
        </p>

        <!-- STATS -->
        <div class="stats-row">
            <div class="stat-card">
                <p class="stat-title">Total | <strong>BSIT</strong></p>
                <h2>0</h2>
                <span>Students</span>
            </div>

            <div class="stat-card">
                <p class="stat-title">Total | <strong>DIT</strong></p>
                <h2>0</h2>
                <span>Students</span>
            </div>

            <div class="stat-card">
                <p class="stat-title">Total | <strong>ALL</strong></p>
                <h2>0</h2>
                <span>Students</span>
            </div>

            <div class="stat-card">
                <p class="stat-title">Total | <strong>EVENTS</strong></p>
                <h2>0</h2>
                <span>Events</span>
            </div>
        </div>

    </div>
</section>
@endsection

@push('styles')
<style>
/* ===== RESET ===== */
html, body {
    margin: 0;
    padding: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

/* ===== FULLSCREEN HERO BACKGROUND ===== */
.dashboard-hero {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;

    background:
        linear-gradient(
            rgba(255, 255, 255, 0.95),
            rgba(255, 255, 255, 0.85)
        ),
        url('{{ asset("storage/acesfront.jpg") }}') center / cover no-repeat;

    z-index: 0;
}

/* ===== OVERLAY CONTENT ===== */
.dashboard-overlay {
    position: relative;
    z-index: 5;
    width: 100%;
    height: 100%;
    padding-top: 220px;

    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    font-family: 'Poppins', sans-serif;
}

/* ===== LOGO ===== */
.hero-logo {
    width: 250px;
    margin-bottom: 20px;
}

/* ===== TEXT ===== */
.hero-title {
    font-size: 26px;
    font-weight: 700;
    letter-spacing: 3px;
    color: #000;
    margin-bottom: 8px;
}

.hero-subtitle {
    font-size: 14px;
    letter-spacing: 2px;
    color: #222;
    margin-bottom: 40px;
}

/* ===== STATS ===== */
.stats-row {
    display: flex;
    gap: 24px;
}

.stat-card {
    background: #ffffff;
    width: 220px;
    padding: 22px;
    border-radius: 14px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.stat-title {
    font-size: 13px;
    color: #5c6bc0;
    margin-bottom: 12px;
}

.stat-card h2 {
    font-size: 34px;
    margin: 0;
}

.stat-card span {
    font-size: 14px;
    color: #333;
}
</style>
@endpush
