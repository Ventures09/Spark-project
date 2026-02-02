@extends('layouts.app')

@section('title', 'Event Details')

@section('content')

<section class="event-page">
    <div class="event-content">
    <!-- ===== HEADER ===== -->
    <div class="event-header">
        <div class="header-left">
            <a href="{{ route('events.index') }}" class="btn-back">
                ← BACK
            </a>            
        
            <form id="deleteEventForm" action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">
                    <img src="{{ asset('storage/trash.png') }}" alt="Delete" class="trash-icon">
                    DELETE
                </button>
            </form>            
        </div>
        

        <button class="btn-export">
            <img src="{{ asset('storage/fileexport.png') }}" alt="Export" class="export-icon">
            EXPORT
        </button>
    </div>

    <!-- ===== EVENT INFO ===== -->
    <div class="event-info">
        <h1>{{ strtoupper($event->name) }}</h1>
        <p>
            {{ \Carbon\Carbon::parse($event->date)->format('m/d/Y') }}
            – {{ strtoupper($event->day) }}
        </p>
    </div>

    <!-- ===== CONTROLS ===== -->
    <div class="table-controls">
        <div class="search-box">
            <input type="text" placeholder="Search">
            <button class="search-btn">
                <img src="{{ asset('storage/search.png') }}">
            </button>
        </div>

        <div class="filter-dropdown">
            <button class="filter-btn" id="filterToggle">
                Filter by Year
                <img src="{{ asset('storage/arrowdown.png') }}" alt="Arrow">
            </button>
        
            <ul class="filter-menu hidden" id="filterMenu">
                <li data-value="all">All</li>
                <li data-value="firstyear">1st Year</li>
                <li data-value="secondyear">2nd Year</li>
                <li data-value="thirdyear">3rd Year</li>
                <li data-value="fourthyear">4th Year</li>
            </ul>
        </div>
        
        
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID NO.</th>
                    <th>FIRST NAME</th>
                    <th>LAST NAME</th>
                    <th>MIDDLE NAME</th>
                    <th>SUFFIX</th>
                    <th>YEAR LEVEL</th>
                    <th>PROGRAM</th>
                    <th>TIME IN</th>
                    <th>TIME OUT</th>
                </tr>
            </thead>
            <tbody class="empty">
                <tr>
                    <td colspan="9">
                        <div class="empty-state">
                            <img src="{{ asset('storage/empty.png') }}" alt="No data">
                            <p>No attendance records found</p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- DELETE CONFIRMATION MODAL -->
<div id="deleteConfirmModal" class="delete-modal-backdrop hidden">
    <div class="delete-modal">
        <p>Are you sure you want to delete this event? This action cannot be undone.</p>
        <div class="modal-actions">
            <button id="confirmDelete" class="btn-yes">Yes</button>
            <button id="cancelDelete" class="btn-no">No</button>
        </div>
    </div>
</div>

    
    
</section>


@endsection


@push('styles')
<style>
/* ===== PAGE WRAPPER ===== */
.event-page {
    position: fixed;
    inset: 0;
    background:
        linear-gradient(rgba(255,255,255,.92), rgba(255,255,255,.92)),
        url('{{ asset("storage/acesfront.jpg") }}') center center / cover no-repeat;
}

.event-overlay {
    position: relative;
    width: 100%;
    min-height: 100vh;
}

.event-page {
    padding: 40px 60px;
}

.event-content {
    margin-top: 70px;   /* THIS pushes everything down */
}

/* ===== HEADER ===== */
.event-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}



.header-left {
    display: flex;
    gap: 14px;
}

/* ===== EXPORT ICON ===== */
.export-icon {
    width: 16px;   /* adjust size if needed */
    height: 16px;
    margin-right: 8px;
}


/* ===== DELETE ICON ===== */
.trash-icon {
    width: 16px;      /* change this value to resize */
    height: 16px;
    margin-right: 8px;
}


.btn-back,
.btn-delete {
    padding: 12px 22px;      /* same vertical & horizontal */
    height: 48px;            /* optional, enforce exact height */
    display: inline-flex;    /* align text vertically */
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    box-sizing: border-box;  /* include padding in height */
}

.btn-back {
    background: #222;
    color: #fff;
}

.btn-delete {
    background: #d40000;
    color: #fff;
    border: none;
}


.btn-export {
    background: #0a9b3f;
    color: #fff;
    padding: 12px 22px;
    border-radius: 10px;
    border: none;
    font-weight: 600;
    cursor: pointer;
}

/* ===== EVENT INFO ===== */
.event-info {
    margin-top: 30px;
}

.event-info h1 {
    font-size: 42px;
    font-weight: 800;
    letter-spacing: 3px;
    margin-bottom: 6px;
}

.event-info p {
    font-size: 14px;
    letter-spacing: 3px;
    font-weight: 600;
    color: #444;
}

/* ===== CONTROLS ===== */
.table-controls {
    margin-top: -70px;
    display: flex;
    justify-content: flex-end;
    gap: 16px;
}

.search-box {
    display: flex;
    background: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0,0,0,.1);
}

.search-box input {
    border: none;
    padding: 12px 16px;
    width: 220px;
    outline: none;
}

.search-box button {
    border: none;
    background: #222;
    color: #fff;
    padding: 0 16px;
    cursor: pointer;
}

.filter-box button {
    background: #6e6e6e;
    color: #fff;
    padding: 12px 18px;
    border-radius: 12px;
    border: none;
    cursor: pointer;
}

.search-btn img {
    width: 14px;
    height: 14px;
}


/* ===== TABLE ===== */
.table-wrapper {
    margin-top: 34px;
    background: #fff;
    border-radius: 14px;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

.table-wrapper {
    margin-top: 24px;
    background: #fff;
    border-radius: 14px;
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
}

/* ===== TABLE BODY EMPTY CENTERED ===== */
.table-wrapper tbody.empty td {
    height: 600px;                /* same height as table */
    background: #fff;
    text-align: center;           /* horizontal center */
    vertical-align: middle;       /* vertical center */
}

.empty-state {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    text-align: center;
    color: #777;
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 1px;
}

.empty-state img {
    width: 42px;
    opacity: 0.6;
}

thead {
    background: #e6e6e6;
}

th {
    padding: 14px 16px;
    font-size: 13px;
    letter-spacing: 2px;
    text-align: left;
}

td {
    padding: 14px 16px;
    border-bottom: 1px solid #eee;
}

.filter-dropdown {
    position: relative;
    display: inline-block;
    z-index: 9999;
}

.filter-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 18px;
    border-radius: 8px;
    background: #000;
    color: #fff;
    border: none;
    cursor: pointer;
    position: relative;
}

.filter-btn img {
    width: 14px;
}

.filter-menu {
    position: absolute;
    top: 110%;
    left: 0;
    width: 100%;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    list-style: none;
    padding: 8px 0;
    z-index: 50;
}

.filter-menu.hidden {
    display: none;
}

.filter-menu li {
    padding: 10px 16px;
    cursor: pointer;
    font-size: 14px;
}

.filter-menu li:hover {
    background: #f2f2f2;
}

/* ===== DELETE MODAL ===== */
.delete-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 99999;
}

.delete-modal-backdrop.hidden {
    display: none;
}

.delete-modal {
    background: #fff;
    padding: 30px 40px;
    border-radius: 16px;
    max-width: 400px;
    text-align: center;
}

.delete-modal p {
    font-size: 16px;
    margin-bottom: 24px;
    font-weight: 600;
    color: #333;
}

.modal-actions {
    display: flex;
    justify-content: center;
    gap: 20px;
}

.btn-yes {
    background: #d40000;
    color: #fff;
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
}

.btn-no {
    background: #ccc;
    color: #222;
    padding: 12px 24px;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
}


</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // ===== FILTER DROPDOWN =====
    const toggle = document.getElementById('filterToggle'); // dropdown button
    const menu = document.getElementById('filterMenu');     // dropdown menu
    const arrowImg = '{{ asset("storage/arrowdown.png") }}'; // arrow icon

    if (toggle && menu) {
        // Restore saved filter selection on page refresh
        const savedFilter = localStorage.getItem('yearFilter');
        if (savedFilter) {
            toggle.innerHTML = savedFilter + ` <img src="${arrowImg}">`;
        }

        // Toggle dropdown visibility
        toggle.addEventListener('click', (e) => {
            e.stopPropagation();
            menu.classList.toggle('hidden');
        });

        // Close dropdown if clicking outside
        document.addEventListener('click', () => {
            menu.classList.add('hidden');
        });

        // Handle selection
        menu.querySelectorAll('li').forEach(item => {
            item.addEventListener('click', () => {
                const selectedText = item.textContent;
                toggle.innerHTML = selectedText + ` <img src="${arrowImg}">`;
                localStorage.setItem('yearFilter', selectedText);
                menu.classList.add('hidden');
            });
        });
    }

    // ===== DELETE CONFIRMATION MODAL =====
const deleteForm = document.getElementById('deleteEventForm');
const deleteModal = document.getElementById('deleteConfirmModal');
const confirmBtn = document.getElementById('confirmDelete');
const cancelBtn = document.getElementById('cancelDelete');

if (deleteForm && deleteModal) {
    deleteForm.addEventListener('submit', function(e) {
        e.preventDefault();           // stop default submit
        deleteModal.classList.remove('hidden'); // show modal
    });

    confirmBtn.addEventListener('click', () => {
        deleteForm.submit();          // submit form if Yes
    });

    cancelBtn.addEventListener('click', () => {
        deleteModal.classList.add('hidden'); // hide modal if No
    });

    // Click outside modal to close
    deleteModal.addEventListener('click', (e) => {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });
}

});
</script>
@endpush


