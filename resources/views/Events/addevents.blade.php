<section id="addEventModal" class="add-event-backdrop hidden">
    <div class="add-event-modal">
        <button id="closeAddEventBtn" class="modal-close">&times;</button>

        <form>
            <!-- ROW 1 -->
            <div class="form-row two-cols">
                <div class="form-group">
                    <label>MM/DD/YY</label>
                    <input type="date" required>
                </div>

                <div class="form-group">
                    <label>DAY</label>
                    <select required>
                        <option value="" selected disabled></option>
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

            <!-- ROW 2 -->
            <div class="form-group">
                <label>EVENT NAME</label>
                <input type="text" placeholder="Event name" required>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">ADD EVENT</button>
                <a href="#" id="cancelBtn" class="btn-outline">CANCEL</a>
            </div>
        </form>
    </div>
</section>

@push('styles')
<style>
.add-event-backdrop {
    position: fixed;
    inset: 0;
    z-index: 9999; /* increase to be safe */
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(0,0,0,0.35);
}



.add-event-backdrop.hidden {
    display: none;
}

.add-event-modal {
    width: 760px;
    background: #fff;
    border-radius: 28px;
    padding: 40px 50px;
    position: relative;
}

.modal-close {
    position: absolute;
    top: 10px;
    right: 14px;
    background: none;
    border: none;
    font-size: 22px;
    cursor: pointer;
}

/* FORM STYLES */
.form-group { 
    display: flex; 
    flex-direction: column; 
    gap: 10px; 
    margin-bottom: 26px; 
}

.form-group label { 
    font-size: 14px; 
    letter-spacing: 3px; 
    font-weight: 600; 
}

/* Base input & select styles */
input, 
select { 
    height: 56px; 
    border-radius: 14px; 
    border: none; 
    background: #eaeaea; 
    padding: 0 18px; 
    font-size: 15px; 
    outline: none; 
}

/* ✅ Custom SELECT arrow */
.form-group select {
    padding-right: 48px; /* space for arrow */

    /* Remove default arrow */
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;

    /* Custom arrow */
    background-image: url('/storage/arrowdown.jpg');
    background-repeat: no-repeat;
    background-position: right 18px center;
    background-size: 14px;
}

/* Layout helpers */
.two-cols { 
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    gap: 30px; 
}

.form-actions { 
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    gap: 30px; 
    margin-top: 30px; 
}

.btn-primary { 
    height: 60px; 
    border-radius: 16px; 
    border: none; 
    background: #000; 
    color: #fff; 
    font-size: 14px; 
    letter-spacing: 3px; 
    cursor: pointer; 
}

.btn-outline { 
    height: 60px; 
    border-radius: 16px; 
    border: 3px solid #000; 
    background: transparent; 
    color: #000; 
    font-size: 14px; 
    letter-spacing: 3px; 
    display: flex; 
    align-items: center; 
    justify-content: center; 
    text-decoration: none; 
}

</style>
@endpush
