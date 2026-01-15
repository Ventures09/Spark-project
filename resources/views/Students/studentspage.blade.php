@extends('layouts.app')

@section('title', 'Logs')

@section('content')
<!-- LOGS PAGE HERO -->
<section class="dashboard-hero">
    <div class="dashboard-overlay">
        <!-- Blank content; only background shows -->
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

/* ===== OVERLAY (BLANK) ===== */
.dashboard-overlay {
    position: relative;
    z-index: 5;
    width: 100%;
    height: 100%;
}
</style>
@endpush
