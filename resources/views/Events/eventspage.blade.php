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
    </div>
</section>

<!-- ===== ADD EVENT MODAL ===== -->
<section id="addEventModal" class="add-event-backdrop hidden">
    <div class="add-event-modal">
        <button id="closeAddEventBtn" class="modal-close">&times;</button>

        <form>
            <div class="form-row two-cols">
                <div class="form-group">
                    <label>DATE</label>
                    <input type="date" required>
                </div>

                <div class="form-group">
                    <label>DAY</label>
                    <select required>
                        <option disabled selected></option>
                        <option>Monday</option>
                        <option>Tuesday</option>
                        <option>Wednesday</option>
                        <option>Thursday</option>
                        <option>Friday</option>
                        <option>Saturday</option>
                        <option>Sunday</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>EVENT NAME</label>
                <input type="text" placeholder="Event name" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">ADD EVENT</button>
                <button type="button" id="cancelBtn" class="btn-outline">CANCEL</button>
            </div>
        </form>
    </div>
</section>

@endsection


@push('styles')
<style>
html, body {
    margin: 0;
    padding: 0;
    height: 100%;
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
</style>




@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('openAddEventBtn');
    const modal = document.getElementById('addEventModal');
    const closeBtn = document.getElementById('closeAddEventBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    openBtn.addEventListener('click', () => modal.classList.remove('hidden'));
    closeBtn.addEventListener('click', () => modal.classList.add('hidden'));
    cancelBtn.addEventListener('click', () => modal.classList.add('hidden'));

    modal.addEventListener('click', e => {
        if (e.target === modal) modal.classList.add('hidden');
    });
});
</script>
@endpush


