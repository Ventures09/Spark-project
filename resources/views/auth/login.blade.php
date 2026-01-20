<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | S.P.A.R.K</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #0b0f14;
            color: #ffffff;
        }

        /* ===== HERO BACKGROUND ===== */
        .hero {
            height: 100vh;
            width: 100%;
            background:
                linear-gradient(
                    to bottom,
                    rgba(10, 14, 20, 0.85),
                    rgba(10, 14, 20, 0.95)
                ),
                url('{{ asset("storage/acesfront.jpg") }}');
            background-size: cover;
            background-position: center;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ===== DINO ICON ===== */
        .dino-logo {
            position: absolute;
            top: 25px;
            left: 25px;
            width: 60px;
            opacity: 0.95;
            z-index: 20;
        }

        /* ===== BACK BUTTON ===== */
        .back-btn {
            position: absolute;
            top: 30px;
            right: 30px;
            padding: 12px 34px;
            background-color: #7fa4ff;
            color: #ffffff;
            border: none;
            border-radius: 14px;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 2px;
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            z-index: 25;
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-decoration: none;
        }

        .back-btn:hover {
            background-color: #6a92ff;
        }

        .back-btn img {
            width: 16px;
            height: 16px;
        }

        /* ===== LOGIN CARD ===== */
        .login-card {
            background: #ffffff;
            color: #000;
            padding: 50px;
            width: 450px;
            border-radius: 12px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
        }

        .login-card h2 {
            margin-bottom: 28px;
            font-size: 30px;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            color: #444;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        .form-group input:focus {
            outline: none;
            border-color: #7fa4ff;
        }

        .submit-btn {
            width: 100%;
            margin-top: 14px;
            padding: 12px;
            background: linear-gradient(to bottom, #2c2f38, #0d0f14);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
        }

        .submit-btn:hover {
            opacity: 0.9;
        }

        /* ===== LOADING MODAL ===== */
        #loadingModal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #loadingModal p {
            color: #fff;
            margin-top: 16px;
            font-weight: 600;
            font-size: 18px;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            .login-card {
                width: 90%;
            }

            .dino-logo {
                width: 45px;
            }

            .back-btn {
                top: 20px;
                right: 20px;
            }
        }
    </style>
</head>
<body>

<div class="hero">

    <!-- Dino Logo -->
    <img src="{{ asset('storage/dinosaurw.png') }}" class="dino-logo" alt="Dinosaur">

    <a href="{{ url('/') }}" class="back-btn">
        <img src="{{ asset('storage/arrow-small-left.png') }}" alt="Arrow Icon">
        BACK
    </a>

    <!-- Login Form -->
    <div class="login-card">
        <h2>Sign in</h2>

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>            

            <button type="submit" class="submit-btn">
                Sign in
            </button>
        </form>
    </div>

</div>

<!-- ===== LOTTIE LOADING MODAL ===== -->
<div id="loadingModal">
    <lottie-player 
        src="{{ asset('storage/Dinodino.json') }}" 
        background="transparent" 
        speed="1" 
        loop 
        autoplay
        style="width: 200px; height: 200px;">
    </lottie-player>
    <p>Logging in...</p>
</div>

<!-- Lottie JS -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

<script>
    const loginForm = document.getElementById('loginForm');
    const loadingModal = document.getElementById('loadingModal');

    loginForm.addEventListener('submit', function(e) {
        e.preventDefault(); // prevent immediate form submission

        // Show the Lottie modal
        loadingModal.style.display = 'flex';

        // Disable the submit button
        loginForm.querySelector('button[type="submit"]').disabled = true;

        // Wait 5 seconds before submitting the form
        setTimeout(() => {
            loginForm.submit();
        }, 2000);
    });
</script>

</body>
</html>
