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
                        <div class="filter-dropdown">
                            <button class="filter-btn" onclick="toggleFilterDropdown(event)">
                                Filter by Action
                                <img src="{{ asset('storage/arrowdown.png') }}" class="arrow-icon" alt="Arrow">
                            </button>
                            <div class="filter-menu" id="filterDropdown">
                                <button type="button" data-action="all">All</button>
                                <button type="button" data-action="login">Login</button>
                                <button type="button" data-action="logout">Logout</button>
                                <button type="button" data-action="create">Create</button>
                                <button type="button" data-action="update">Update</button>
                                <button type="button" data-action="delete">Delete</button>
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
                </div>
            
                @if($logs->count() > 0)
                    <div class="logs-table-body">
                        @foreach($logs as $log)
                            <div class="logs-row" style="display: grid; grid-template-columns: 1fr 1fr 1.5fr 1.5fr 2fr; 
                                                         align-items: center; justify-items: center; 
                                                         padding: 12px 24px; border-bottom: 1px solid #eee;">
                                <span>{{ $log->created_at?->timezone('Asia/Manila')->format('Y-m-d') ?? 'N/A' }}</span>
                                <span>{{ $log->created_at?->timezone('Asia/Manila')->format('h:i:s A') ?? 'N/A' }}</span>
                                <span>{{ ucfirst($log->action) }}</span>
                                <span>{{ $log->module }}</span>
                                <span>{{ $log->details }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="logs-empty">
                        <div class="empty-state">
                            <img src="{{ asset('storage/empty.png') }}" alt="No logs">
                            <p>No logs found</p>
                        </div>
                    </div>
                @endif
            </div>
            
            


                @if ($logs->hasPages())
                <div class="logs-pagination">
                    <button class="page-btn {{ $logs->onFirstPage() ? 'disabled' : '' }}"
                        @if(!$logs->onFirstPage()) onclick="window.location='{{ $logs->previousPageUrl() }}'" @endif>
                        Prev
                    </button>

                    @foreach ($logs->getUrlRange(1, $logs->lastPage()) as $page => $url)
                        <button class="page-btn {{ $logs->currentPage() == $page ? 'active' : '' }}"
                            onclick="window.location='{{ $url }}'">
                            {{ $page }}
                        </button>
                    @endforeach

                    <button class="page-btn {{ $logs->hasMorePages() ? '' : 'disabled' }}"
                        @if($logs->hasMorePages()) onclick="window.location='{{ $logs->nextPageUrl() }}'" @endif>
                        Next
                    </button>
                </div>
                @endif

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

.logs-table-body .logs-row {
    display: grid;
    grid-template-columns: 1fr 1fr 1.5fr 1.5fr 2fr;
    align-items: center;
    justify-items: center;
    padding: 12px 24px;
    border-bottom: 1px solid #eee;
}

/* Zebra striping */
.logs-table-body .logs-row:nth-child(odd) {
    background-color: #ffffff; /* white */
}

.logs-table-body .logs-row:nth-child(even) {
    background-color: #E3E3E3; /* light gray */
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
    margin-top: 12px;
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

/* ===== PAGINATION ===== */
.logs-pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 8px;
    padding: 18px 0 22px;
    border-top: 1px solid #eee;
}

.page-btn {
    min-width: 36px;
    height: 36px;
    padding: 0 12px;
    border-radius: 8px;
    border: none;
    background: #f2f2f2;
    color: #333;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease;
}

.page-btn:hover {
    background: #ddd;
}

.page-btn.active {
    background: #222;
    color: #fff;
}

.page-btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

</style>
@endpush

@push('scripts')
<script>
function toggleFilterDropdown(event) {
    event.stopPropagation();
    const dropdown = document.getElementById('filterDropdown');
    const wrapper = dropdown.closest('.filter-dropdown');
    const isOpen = dropdown.style.display === 'block';
    document.querySelectorAll('.filter-menu').forEach(menu => menu.style.display = 'none');
    document.querySelectorAll('.filter-dropdown').forEach(fd => fd.classList.remove('open'));
    dropdown.style.display = isOpen ? 'none' : 'block';
    wrapper.classList.toggle('open');
}
window.addEventListener('click', function () {
    document.querySelectorAll('.filter-menu').forEach(menu => menu.style.display = 'none');
    document.querySelectorAll('.filter-dropdown').forEach(fd => fd.classList.remove('open'));
});
</script>
@endpush
