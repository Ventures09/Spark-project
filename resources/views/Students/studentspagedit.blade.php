@extends('layouts.app')

@section('title', 'DIT Masterlist')

@section('content')
<section class="dashboard-hero">
    <div class="dashboard-overlay">

        <!-- CONTENT GOES HERE -->
        <div class="masterlist-wrapper">

            <div class="masterlist-header">
                <h1>DIT Masterlist</h1>

                <div class="top-actions">
                    <a href="{{ route('students.studentspage') }}">
                        <button class="program-btn">BSIT</button>
                    </a>
                    <a href="{{ route('students.studentspagedit') }}">
                        <button class="program-btn active">DIT</button>
                    </a>
                
                    <div class="right-actions">
                        <div class="search-box">
                            <input type="text" placeholder="Search">
                            <button class="search-btn">
                                <img src="{{ asset('storage/search.png') }}">
                            </button>
                        </div>
                
                        <div class="filter-dropdown">
                            <button class="filter-btn" id="filterToggle">
                                Filter by Category
                                <img src="{{ asset('storage/arrowdown.png') }}">
                            </button>
                        
                            <ul class="filter-menu hidden" id="filterMenu">
                                <li data-value="all">All</li>
                                <li data-value="firstyear">1st Year</li>
                                <li data-value="secondyear">2nd year</li>
                                <li data-value="thirdyear">3rd Year</li>
                                <li data-value="fourthyear">4th Year</li>
                            </ul>
                        </div>
                
                        <button class="export-btn">
                            <img src="{{ asset('storage/fileexport.png') }}">
                            EXPORT
                        </button>
                    </div>
                </div>
                
            </div>

            <!-- TABLE -->
            <div class="table-card">
                <div class="table-header">
                    <span>ID NO.</span>
                    <span>FIRST NAME</span>
                    <span>LAST NAME</span>
                    <span>MIDDLE NAME</span>
                    <span>SUFFIX</span>
                    <span>YEAR LEVEL</span>
                    <span>PROGRAM</span>
                    <span>ACTION</span>
                </div>

                <div class="table-body empty">
                    <div class="empty-state">
                        <img src="{{ asset('storage/empty.png') }}" alt="No data">
                        <p>No records found</p>
                    </div>
                </div>
                
            </div>

        </div>

    </div>
</section>
@endsection


<style>

    html, body {
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }

    /* BACKGROUND */
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
            url('/storage/acesfront.jpg') center / cover no-repeat;
    }

    .dashboard-overlay {
        position: relative;
        z-index: 10;
        width: 100%;
        height: 100%;
    }
    .masterlist-wrapper {
    padding: 40px 60px;
    margin-top: 80px;

    display: flex;
    flex-direction: column;
    }
    
    .masterlist-header h1 {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 20px;
    }
    
    .top-actions {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    
    .program-btn {
        background: #0a0a3d;
        color: #fff;
        border: none;

        padding: 12px 48px;   /* ⬅ expands LEFT & RIGHT sides */
        min-width: 140px;     /* ⬅ guarantees side expansion */

        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
        transition: all 0.2s ease;
    }
    
        .program-btn:hover {
        background: #0303a0;
    }

    
    .program-btn.active {
        background: #0303a0;          /* brighter blue */
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
        transform: translateY(-1px);
    }

    
    .right-actions {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .search-box {
        display: flex;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .search-box input {
        border: none;
        padding: 10px 14px;
        outline: none;
        width: 220px;
    }
    
    .search-btn {
        background: #222;
        border: none;
        padding: 0 14px;
        cursor: pointer;
    }
    
    .search-btn img {
        width: 18px;
    }
    .filter-dropdown {
    position: relative;
    display: inline-block;
    z-index: 99999;
}
.filter-select,
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
    z-index: 99999;
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

    
    .export-btn {
        background: #0a9d00;
        color: #fff;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
    }
    
    .export-btn img {
        width: 16px;
    }
    
    /* ===== TABLE ===== */
    .table-card {
        margin-top: 30px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        overflow: hidden;
    }
    
    .table-header {
        display: grid;
        grid-template-columns:
            1fr 1.5fr 1.5fr 1.5fr 1fr 1.2fr 1.5fr 1fr;
        padding: 16px 24px;
        background: #e6e6e6;
        font-weight: 700;
        text-align: center;
    }
    
    .table-body {
        height: 600px;
    }
    
    .table-body.empty {
        background: #fff;
    }

    /* ===== TABLE BODY EMPTY CENTERED ===== */
    .table-body.empty {
        display: flex;                  /* enables flexbox */
        align-items: center;            /* vertical center */
        justify-content: center;        /* horizontal center */
        height: 600px;                  /* same as table height */
        background: #fff;
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

    </style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.getElementById('filterToggle');
    const menu = document.getElementById('filterMenu');

    if (!toggle || !menu) return;

    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        menu.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', () => {
        menu.classList.add('hidden');
    });

    // Handle item click
    menu.querySelectorAll('li').forEach(item => {
        item.addEventListener('click', () => {
            toggle.innerHTML = item.textContent + 
                ' <img src="{{ asset("storage/arrowdown.png") }}">';
            menu.classList.add('hidden');
        });
    });
});
</script>
@endpush
    