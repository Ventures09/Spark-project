@extends('layouts.app')

@section('title', 'Events')

@section('content')

<!-- ===== BACKGROUND PAGE ===== -->
<section class="dashboard-hero">
    <div class="dashboard-overlay">

        <div class="events-center">
            <h1>EVENTS</h1>
            <button class="add-event-btn" id="openAddEventBtn">ADD EVENT</button>
        </div>

        <!-- ===== EVENTS DISPLAY ===== -->
        <div class="events-floating">
            @forelse($events as $event)
    <a href="{{ route('events.show', $event->id) }}" class="event-pill">
        {{ strtoupper($event->name) }}
    </a>
@empty
    <div class="no-events-center">
        <img src="{{ asset('storage/empty.png') }}" alt="No events" class="empty-icon">
        <p class="no-events">No events yet</p>
    </div>
@endforelse


        </div>

    </div>
</section>

<!-- ===== ADD EVENT MODAL ===== -->
<section id="addEventModal" class="add-event-backdrop hidden">
    <div class="add-event-modal">
        <button id="closeAddEventBtn" class="modal-close">&times;</button>

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="form-row two-cols">
                <div class="form-group">
                    <label>DATE</label>
                    <input type="date" name="date" required>
                </div>

                <div class="form-group">
                    <label>DAY</label>
                    <input type="text" name="day" id="dayInput" readonly required>
                </div>
                
            </div>

            <div class="form-group">
                <label>EVENT NAME</label>
                <input type="text" name="name" placeholder="Event name" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">ADD EVENT</button>
                <button type="button" id="cancelBtn" class="btn-outline">CANCEL</button>
            </div>
        </form>
    </div>
</section>

<!-- ===== DATE WARNING MODAL ===== -->
<section id="dateWarningModal" class="add-event-backdrop hidden">
    <div class="add-event-modal" style="max-width: 420px; text-align: center;">
        <h3 style="margin-bottom: 12px;">⚠ Invalid Date</h3>
        <p style="margin-bottom: 20px;">
            You selected a past date. Please choose today or a future date.
        </p>
        <button id="closeWarningBtn" class="btn-primary">OK</button>
    </div>
</section>


<!-- ===== PROCESSING MODAL (MUST BE SEPARATE) ===== -->
<div id="processingModal" class="processing-backdrop hidden">
    <div class="processing-box">
        <div id="dinoAnimation" style="width:200px;height:200px;"></div>
        <p class="processing-text">Adding event...</p>
    </div>
</div>

@endsection


@push('styles')
<style>
html, body {
    margin: 0;
    padding: 0;
    height: 100%;
}

/* ===== EVENTS FLOATING LIST ===== */
.events-floating {
    position: absolute;
    top: 350px;
    width: 100%;
    max-width: 1200px;
    left: 50%;
    transform: translateX(-50%);

    display: grid;
    grid-template-columns: repeat(2, 1fr); /* LEFT & RIGHT */
    gap: 24px 40px; /* row gap | column gap */

    z-index: 2;
}

.event-pill {
    width: 100%;
    padding: 18px 30px;
    background: #1f1f1f;
    color: white;
    text-align: center;
    font-size: 18px;
    font-weight: 600;
    letter-spacing: 4px;
    border-radius: 16px;
    text-decoration: none;
    transition: all .3s ease;
}

.event-pill:hover {
    background: #000;
    transform: scale(1.03);
}

.no-events {
    margin-top: 20px;
    font-size: 16px;
    color: #444;
}


/* ===== PAGE BACKGROUND ===== */
.dashboard-hero {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background:
        linear-gradient(rgba(255,255,255,.92), rgba(255,255,255,.85)),
        url('{{ asset("storage/acesfront.jpg") }}') center / cover no-repeat;
    z-index: 0;
}

.dashboard-overlay {
    position: relative;
    width: 100%;
    height: 100%;
}

.events-center {
    position: absolute;
    top: 130px;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
}

.events-center h1 {
    font-size: 46px;
    font-weight: 800;
    letter-spacing: 4px;
}

.add-event-btn {
    margin-top: 20px;
    padding: 14px 36px;
    background: #000;
    color: #fff;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

/* ===== MODAL BACKDROP ===== */
.add-event-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.4);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

.add-event-backdrop.hidden {
    display: none;
}

/* ===== MODAL BOX ===== */
.add-event-modal {
    background: #fff;
    width: 760px;
    border-radius: 28px;
    padding: 40px 50px;
    position: relative;
}

.modal-close {
    position: absolute;
    top: 12px;
    right: 18px;
    font-size: 26px;
    border: none;
    background: none;
    cursor: pointer;
}

/* ===== FORM ===== */
.form-group {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 24px;
}


.form-group label {
    font-size: 13px;
    letter-spacing: 3px;
    font-weight: 600;
}

input, select {
    height: 56px;
    border-radius: 14px;
    border: none;
    background: #eaeaea;
    padding: 0 18px;
}

.two-cols {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.form-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
}

.btn-primary {
    background: #000;
    color: #fff;
    border: none;
    border-radius: 16px;
    height: 60px;
}

.btn-outline {
    background: transparent;
    border: 3px solid #000;
    border-radius: 16px;
    height: 60px;
}

/* ===== NO EVENTS CENTER SLIGHTLY LOWER ===== */
.no-events-center {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start; /* starts from top offset */
    gap: 8px; /* smaller space between icon and text */
    
    position: absolute;
    top: 180px; /* adjust this value to move the block lower or higher */
    left: 50%;
    transform: translateX(-50%); /* horizontal center only */
}

.no-events-center .empty-icon {
    width: 60px;
    opacity: 0.5;
}

.no-events {
    font-size: 22px;
    font-weight: 600;
    color: #555;
    letter-spacing: 2px;
    text-align: center;
    margin: 0; /* remove default margin */
}

/* ===== PROCESSING MODAL ===== */
.processing-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10000;
}

.processing-backdrop.hidden {
    display: none;
}

.processing-box {
    background: #fff;
    padding: 40px 50px;
    border-radius: 24px;
    text-align: center;
    box-shadow: 0 20px 40px rgba(0,0,0,.25);
}

.processing-text {
    margin-top: 14px;
    font-weight: 600;
    letter-spacing: 2px;
    color: #333;
}

/* ===== INVALID DATE MODAL OK BUTTON ===== */
#dateWarningModal .btn-primary,
#dateWarningModal #closeWarningBtn {
    width: 120px;          /* adjust as you like */
    padding: 10px 0;
    text-align: center;
    margin: 0 auto;        /* center horizontally */
    display: block;
    border-radius: 8px;
    font-weight: 600;
}


</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.12.2/lottie.min.js"></script>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const openBtn = document.getElementById('openAddEventBtn');
        const modal = document.getElementById('addEventModal');
        const closeBtn = document.getElementById('closeAddEventBtn');
        const cancelBtn = document.getElementById('cancelBtn');
    
        const processingModal = document.getElementById('processingModal');
        const warningModal = document.getElementById('dateWarningModal');
        const closeWarningBtn = document.getElementById('closeWarningBtn');
    
        const form = modal.querySelector('form');
        const dateInput = form.querySelector('input[name="date"]');
        const dayInput = form.querySelector('input[name="day"]'); // readonly day input
        const nameInput = form.querySelector('input[name="name"]');
    
        // ===== OPEN MODAL =====
        openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    
        // ===== CLOSE MODAL =====
        const closeModal = () => {
            modal.classList.add('hidden');
            // Clear inputs when modal closes
            dateInput.value = '';
            dayInput.value = '';
            nameInput.value = '';
        };
    
        closeBtn.addEventListener('click', closeModal);
        cancelBtn.addEventListener('click', closeModal);
    
        modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });
    
        // ===== CLOSE WARNING MODAL =====
        closeWarningBtn.addEventListener('click', () => {
            warningModal.classList.add('hidden');
        });
    
        // ===== AUTO-FILL DAY BASED ON DATE =====
        dateInput.addEventListener('change', () => {
            const selectedDate = new Date(dateInput.value);
            if (!isNaN(selectedDate)) {
                const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                dayInput.value = days[selectedDate.getDay()];
            } else {
                dayInput.value = '';
            }
        });
    
        // ===== FORM SUBMIT WITH DATE VALIDATION =====
        form.addEventListener('submit', (e) => {
            e.preventDefault(); // STOP default submit
    
            const selectedDate = new Date(dateInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0); // normalize
    
            //  PAST DATE → SHOW WARNING
            if (selectedDate < today) {
                warningModal.classList.remove('hidden');
                return;
            }
    
            // ✅ VALID DATE → SHOW PROCESSING
            modal.classList.add('hidden');
            processingModal.classList.remove('hidden');
    
            setTimeout(() => {
                form.submit();
            }, 3000);
        });
    
        // ===== LOTTIE DINO =====
        lottie.loadAnimation({
            container: document.getElementById('dinoAnimation'),
            renderer: 'svg',
            loop: true,
            autoplay: true,
            path: "{{ asset('storage/runrex.json') }}"
        });
    });
    </script>
    
@endpush



