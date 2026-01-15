<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>S.P.A.R.K | Attendance System</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

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
    
        /* ===== HERO SECTION ===== */
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
            background-repeat: no-repeat;
            position: relative;
        }
    
        /* ===== DINOSAUR LOGO ===== */
        .dino-logo {
            position: absolute;
            top: 25px;
            left: 25px;
            width: 60px;
            opacity: 0.95;
            z-index: 20;
        }
    
        /* ===== ATCI BRAND (NOT NAVBAR) ===== */
        .brand-header {
            position: absolute;
            top: 30px;
            left: 40px;
            display: flex;
            align-items: center;
            z-index: 10;
        }
    
        .brand-header img {
            width: 80px;
            margin-right: 12px;
        }
    
        .brand-header span {
            font-size: 50px;
            font-weight: bold;
            color: #0073ff;
            letter-spacing: 2px;
        }
    
        /* ===== CENTER CONTENT ===== */
        .content {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
    
        .seal {
            width: 320px;
            margin-bottom: 30px;
            opacity: 0.95;
        }
    
        .title {
            font-size: 74px;
            letter-spacing: 14px;
            font-weight: 600;
            color: #7fa4ff;
            margin-bottom: 14px;
        }
    
        .subtitle {
            font-size: 28px;
            letter-spacing: 4px;
            font-weight: 550;
            margin-bottom: 10px;
        }
    
        .school {
            font-size: 17px;
            letter-spacing: 3px;
            opacity: 0.85;
        }
    
        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
    
            .dino-logo {
                width: 45px;
                top: 15px;
                left: 15px;
            }
    
            .brand-header {
                top: 20px;
                left: 20px;
            }
    
            .brand-header span {
                font-size: 36px;
            }
    
            .brand-header img {
                width: 60px;
            }
    
            .title {
                font-size: 42px;
                letter-spacing: 8px;
            }
    
            .subtitle {
                font-size: 15px;
                letter-spacing: 2px;
            }
    
            .seal {
                width: 140px;
            }

            .login-icon {
                width: 18px;
                height: 18px;
            }
        }

        /* ===== LOGIN BUTTON (TOP RIGHT) ===== */
        .login-btn {
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
        }

        .login-btn:hover {
            background-color: #6a92ff;
            transform: translateY(-1px);
        }

        .login-icon {
            width: 20px;
            height: 20px;
            object-fit: contain;
        }

        /* ===== MOBILE ===== */
        @media (max-width: 768px) {
            .login-btn {
            top: 20px;
            right: 20px;
            padding: 10px 26px;
            font-size: 13px;
        }

        .login-icon {
            width: 18px;
            height: 18px;
        }
    
    }

    </style>    
</head>
<body>

<div class="hero">

    <img src="{{ asset('storage/dinosaurw.png') }}" alt="Dinosaur Logo" class="dino-logo">

    <!-- LOGIN BUTTON -->
    <button class="login-btn" onclick="window.location.href='/login'">
        <img src="{{ asset('storage/entrance.png') }}" alt="Login Icon" class="login-icon">
        LOGIN
    </button>

    <!-- MAIN CONTENT -->
    <div class="content">
        <img src="{{ asset('storage/iictlogo.png') }}" alt="SPARK Logo" class="seal">

        <div class="title">S.P.A.R.K</div>

        <div class="subtitle">
            STUDENT PARTICIPATION ATTENDANCE RECORDING KIT
        </div>

        <div class="school">
            INSTITUTE OF INFORMATION AND COMMUNICATIONS TECHNOLOGY
        </div>
    </div>

</div>

</body>
</html>
