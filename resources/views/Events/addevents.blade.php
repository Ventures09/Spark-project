<section id="addEventModal" class="add-event-backdrop hidden">
    <div class="add-event-modal">
        <button id="closeAddEventBtn" class="modal-close">&times;</button>

        <form>
            <!-- ROW 1 -->
            <div class="form-row two-cols">
                <div class="form-group">
                    <label>MM/DD/YY</label>
                    <input type="date">
                </div>

                <div class="form-group">
                    <label>DAY</label>
                    <select>
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
                <input type="text">
            </div>

            <!-- ACTION BUTTONS -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">ADD EVENT</button>
                <button id="cancelBtn" class="btn-outline">CANCEL</button>
            </div>
        </form>
    </div>
</section>
