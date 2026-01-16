@extends('layouts.app')

@section('title', 'Logs')

@section('content')
<section class="dashboard-hero">
    <div class="dashboard-overlay">
        <div class="logs-wrapper">

            <div class="logs-header">
                <h1>Logs</h1>

                <div class="logs-filters">
                    <label>FROM</label>
                    <input type="date">
                
                    <label>TO</label>
                    <input type="date">
                
                    <div class="filters-right">
                        <input type="text" placeholder="Search">
                
                        <button class="search-btn">
                            <img src="{{ asset('storage/search.png') }}" alt="Search">
                        </button>

                        <!-- FILTER DROPDOWN -->
                        <div class="filter-dropdown">
                            <button class="filter-btn" onclick="toggleFilterDropdown(event)">
                                Filter by Category
                                <img src="{{ asset('storage/arrowdown.png') }}" class="arrow-icon" alt="Arrow">
                            </button>
                            <div class="filter-menu" id="filterDropdown">
                                <button type="button">All</button>
                                <button type="button">Login</button>
                                <button type="button">Logout</button>
                                <button type="button">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="logs-card">
                <div class="logs-table-header">
                    <span>DATE</span>
                    <span>TIME</span>
                    <span>ACTION</span>
                    <span>MODULE</span>
                    <span>DETAILS</span>
                    <button class="clear-btn">CLEAR ALL</button>
                </div>

                <div class="logs-empty">
                    <div class="empty-state">
                        <img src="{{ asset('storage/empty.png') }}" alt="No logs">
                        <p>No logs found</p>
                    </div>
                </div>
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
    /* overflow: hidden;  ← REMOVE THIS */
}

/* ===== FULLSCREEN HERO BACKGROUND ===== */
.dashboard-hero {
    position: fixed;
    inset: 0;
    width: 100vw;
    height: 100vh;
    z-index: 0;
    background:
        linear-gradient(
            rgba(255, 255, 255, 0.95),
            rgba(255, 255, 255, 0.85)
        ),
        url('{{ asset("storage/acesfront.jpg") }}') center / cover no-repeat;
    z-index: 0;
}

/* ===== OVERLAY ===== */
.dashboard-overlay {
    position: relative;
    z-index: 5;
    width: 100%;
    height: 100%;
}

/* ===== LOGS WRAPPER ===== */
.logs-wrapper {
    position: relative;
    z-index: 10;
    padding: 40px 60px;
    margin-top: 80px;
}

/* ===== HEADER ===== */
.logs-header h1 {
    font-size: 42px;
    font-weight: 700;
    margin-bottom: 20px;
}

.logs-filters {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 60px;
}

.logs-filters input {
    height: 40px;
    padding: 0 12px;
    border-radius: 8px;
    border: none;
    outline: none;
}

.search-btn,
.filter-btn {
    height: 40px;
    padding: 0 16px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    background: #333;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

/* Right side group */
.filters-right {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 12px;position: relative;
    z-index: 50;
}

.filter-dropdown {
    z-index: 60;
}

.filter-menu {
    z-index: 9999;
}

.search-btn img {
    width: 18px;
    height: 18px;
}

.search-btn:hover,
.filter-btn:hover {
    background-color: #3d3d3d;
}

/* ===== LOGS CARD ===== */
.logs-card {
    margin-top: 30px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    overflow-x: hidden;
    overflow-y: visible;
}

.logs-table-header {
    display: grid;
    grid-template-columns: 1fr 1fr 1.5fr 1.5fr 2fr auto;
    align-items: center;
    justify-items: center;
    padding: 16px 24px;
    background: #eaeaea;
    font-weight: 600;
}

.clear-btn {
    padding: 8px 14px;
    border-radius: 8px;
    border: none;
    background: #222;
    color: #fff;
    cursor: pointer;
}

.logs-empty {
    height: 560px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #777;
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 1px;
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    text-align: center;
}

.empty-state img {
    width: 42px;
    opacity: 0.6;
    animation: float 2s ease-in-out infinite;
}

.empty-state p {
    margin: 0;
}

/* ===== FILTER DROPDOWN ===== */
.filter-dropdown {
    position: relative;
    display: inline-block;
}

.arrow-icon {
    width: 12px;
    height: 12px;
    transition: transform 0.2s ease;
}

.filter-dropdown.open .arrow-icon {
    transform: rotate(180deg);
}

.filter-menu {
    display: none;
    position: absolute;
    top: 46px;
    right: 0;
    background: #2f2f2f;
    border-radius: 10px;
    min-width: 160px;
    padding: 8px 0;
    box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    z-index: 999;
}

.filter-menu button {
    width: 100%;
    padding: 10px 14px;
    background: none;
    border: none;
    color: #fff;
    text-align: left;
    cursor: pointer;
}

.filter-menu button:hover {
    background: #3d3d3d;
}
</style>
@endpush

@push('scripts')
<script>
function toggleFilterDropdown(event) {
    event.stopPropagation(); // Prevent the window click from closing immediately

    const dropdown = document.getElementById('filterDropdown');
    const wrapper = dropdown.closest('.filter-dropdown');

    const isOpen = dropdown.style.display === 'block';

    // Close any open dropdowns first
    document.querySelectorAll('.filter-menu').forEach(menu => menu.style.display = 'none');
    document.querySelectorAll('.filter-dropdown').forEach(fd => fd.classList.remove('open'));

    // Toggle current dropdown
    dropdown.style.display = isOpen ? 'none' : 'block';
    wrapper.classList.toggle('open');
}

// Close when clicking outside
window.addEventListener('click', function (e) {
    document.querySelectorAll('.filter-menu').forEach(menu => menu.style.display = 'none');
    document.querySelectorAll('.filter-dropdown').forEach(fd => fd.classList.remove('open'));
});
</script>
@endpush
