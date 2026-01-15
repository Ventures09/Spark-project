<!-- Logging in Lottie Modal -->
<div id="loadingModal" style="display: none;">
    <div class="modal-overlay"></div>
    <div class="modal-content">
        <lottie-player 
            src="{{ asset('storage/DINOSAUR.json') }}" 
            background="transparent" 
            speed="1" 
            loop 
            autoplay
            style="width: 200px; height: 200px;">
        </lottie-player>
        <p>Logging in...</p>
    </div>
</div>

<style>
    #loadingModal {
        position: fixed;
        inset: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .modal-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.7);
    }

    .modal-content {
        position: relative;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        color: #fff;
        font-size: 18px;
        font-weight: 600;
    }
</style>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
    function showLoggingInModal() {
        const modal = document.getElementById('loadingModal');
        modal.style.display = 'flex';
    }
</script>
