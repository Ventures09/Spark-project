<!-- CUSTOM DASHBOARD NAVBAR -->
<nav class="dashboard-navbar">
    <!-- LEFT SIDE -->
    <div class="nav-left">
        <div class="logo">
            <img src="{{ asset('storage/dinosaurw.png') }}" alt="Logo">
        </div>

        <ul class="nav-links">
            <li>
                <a href="{{ route('dashboard.main') }}" 
                   class="nav-item {{ Route::is('dashboard.main') ? 'active' : '' }}">
                   Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('logs.logspage') }}" 
                   class="nav-item {{ Route::is('logs.*') ? 'active' : '' }}">
                   Logs
                </a>
            </li>
            <li>
                <a href="{{ route('students.studentspage') }}" 
                    class="nav-item {{ Route::is('students.studentspage') || Route::is('students.studentspagedit') ? 'active' : '' }}">
                    Students
                </a>
            </li>
            <li>
                <a href="{{ route('events.eventspage') }}" 
                   class="nav-item {{ Route::is('events.eventspage') ? 'active' : '' }}">
                   Events
                </a>
            </li>
        </ul>
    </div>

    <!-- RIGHT SIDE -->
    <div class="nav-right">
        <div class="profile-dropdown">
            <div class="profile-icon" onclick="toggleDropdown()">
                <i class="fas fa-user"></i>
            </div>

            <!-- Dropdown menu -->
            <div class="dropdown-menu" id="profileDropdown">
                <!-- ADD ID HERE -->
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <img src="{{ asset('storage/logout.png') }}" alt="Logout Icon" class="logout-icon">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<!-- ===== LOGGING OUT LOTTIE MODAL ===== -->
<div id="loadingModalLogout" style="display: none;">
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
        <p>Logging out...</p>
    </div>
</div>

<style>
    /* ===== NAVBAR ===== */
    .dashboard-navbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        height: 72px;
        padding: 0 32px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #2f2f2f;
        font-family: 'Poppins', sans-serif;
    }
    
    .nav-left { display: flex; align-items: center; gap: 45px; }
    .logo img { height: 38px; width: auto; }
    .nav-links { list-style: none; display: flex; gap: 16px; margin:0; padding:0; }
    .nav-item { text-decoration: none; color:#fff; font-size:14px; letter-spacing:2px; padding:10px 20px; border-radius:10px; transition:background 0.25s ease; }
    .nav-item.active { background-color:#000; }
    .nav-item:hover { background-color:#3d3d3d; }
    
    .nav-right { display:flex; align-items:center; }
    .profile-icon {
        width:42px; height:42px; border-radius:50%; background:#fff; display:flex; align-items:center; justify-content:center;
        color:#000; font-size:18px; cursor:pointer; transition: transform 0.2s ease;
    }
    .profile-icon:hover { transform: scale(1.05); }
    
    .profile-dropdown { position:relative; }
    .dropdown-menu {
        display:none; position:absolute; right:0; top:50px; background:#2f2f2f; border-radius:10px; padding:10px 0;
        min-width:120px; box-shadow:0 5px 15px rgba(0,0,0,0.3); z-index:1001;
    }
    
    .logout-btn {
        width:100%; padding:10px 15px; border:none; background:none; color:#fff; font-size:14px; text-align:left; cursor:pointer;
        display:flex; align-items:center; gap:10px; transition:background 0.2s ease;
    }
    .logout-btn:hover { background-color:#3d3d3d; }
    .logout-icon { width:18px; height:18px; }
    
    /* ===== LOTTIE MODAL ===== */
    #loadingModalLogout {
        position: fixed; inset:0; display:flex; justify-content:center; align-items:center; z-index:9999; flex-direction:column;
    }
    .modal-overlay { position:absolute; inset:0; background:rgba(0,0,0,0.7); }
    .modal-content { position:relative; z-index:10000; display:flex; flex-direction:column; align-items:center; gap:16px; color:#fff; font-size:18px; font-weight:600; }
    </style>

<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>


<script>
    // Dropdown toggle
    function toggleDropdown() {
        const dropdown = document.getElementById('profileDropdown');
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }
    
    // Close dropdown if clicked outside
    window.addEventListener('click', function(e) {
        const dropdown = document.getElementById('profileDropdown');
        const icon = document.querySelector('.profile-icon');
        if (!icon.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.style.display = 'none';
        }
    });
    
    // ===== LOGOUT LOTTIE =====
    const logoutForm = document.getElementById('logoutForm');
    const loadingModalLogout = document.getElementById('loadingModalLogout');
    
    logoutForm.addEventListener('submit', function(e) {
        e.preventDefault(); // prevent immediate logout
    
        // Show modal
        loadingModalLogout.style.display = 'flex';
    
        // Disable button
        logoutForm.querySelector('button[type="submit"]').disabled = true;
    
        // Submit after 5 seconds
        setTimeout(() => {
            logoutForm.submit();
        }, 2000);
    });
    </script>
