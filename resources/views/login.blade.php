@extends('layouts.app')

@section('title', 'Login - Maison Boutique POS')

@section('content')
<!-- Container Main Screen -->
<div class="login-wrapper d-flex align-items-center justify-content-center position-fixed top-0 start-0 w-100 h-100 overflow-hidden" 
     style="background: #FAF5F0; z-index: 9999;">

    <!-- Canvas Background Hidup & Gradasi Dinamis -->
    <canvas id="animated-gradient-canvas" class="position-absolute top-0 start-0 w-100 h-100" style="z-index: 1; opacity: 0.95;"></canvas>

    <!-- Wadah Manik-Manik Melayang di Belakang Card -->
    <div id="beads-container" class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden pointer-events-none" style="z-index: 5;"></div>

    <!-- Login Card Frosted Glass Terang & Elegan -->
    <div class="luxury-card-light p-4 p-sm-5 position-relative" style="z-index: 10;">
        <div class="text-center">
            
            <!-- Header Brand: Ikon Mesin Kasir / EDC Hidup -->
            <div class="mb-4">
                <div class="alive-brand-container d-inline-flex align-items-center justify-content-center mb-3">
                    <div class="pos-register-wrapper">
                        <!-- Indikator Lampu Server/Transaksi Berkedip -->
                        <span class="status-dot"></span>
                        <!-- Main Body Mesin Kasir -->
                        <i class="bi bi-calculator pos-body-icon"></i>
                        <!-- Struk Belanja Keluar Hidup (Animated Receipt) -->
                        <div class="animated-receipt">
                            <span class="receipt-line"></span>
                            <span class="receipt-line short"></span>
                        </div>
                    </div>
                </div>
                <h4 class="fw-semibold text-espresso mb-1" style="letter-spacing: -0.3px; font-family: 'Inter', sans-serif;">Maison POS</h4>
                <p class="mb-0" style="font-size: 0.83rem; color: #8a7e72;">Exclusive item inspection System</p>
            </div>

            @if(session('success'))
                <div class="alert alert-dismissible fade show text-start mb-3 border-0" role="alert" style="font-size: 0.83rem; background: rgba(212, 165, 116, 0.18); color: #8c5e34; border-radius: 12px;">
                    <i class="bi bi-check-circle-fill me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="loginForm" action="{{ route('auth') }}" method="POST">
                @csrf

                <!-- Input Email / User ID -->
                <div class="mb-3 text-start">
                    <label class="form-label small" style="color: #5c5247; font-size: 0.78rem; font-weight: 600;">Email / ID Akses</label>
                    <div class="input-group">
                        <span class="input-group-text luxury-input-icon"><i class="bi bi-envelope text-bronze"></i></span>
                        <input type="email" name="email" class="form-control luxury-input" value="{{ old('email') }}" required placeholder="boutique@maison.com" autocomplete="username">
                    </div>
                    @error('email')
                        <div class="text-danger mt-1" style="font-size: 0.73rem; color: #dc2626 !important;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="mb-3 text-start">
                    <label class="form-label small" style="color: #5c5247; font-size: 0.78rem; font-weight: 600;">Kata Sandi</label>
                    <div class="input-group position-relative">
                        <span class="input-group-text luxury-input-icon"><i class="bi bi-key text-bronze"></i></span>
                        <input type="password" id="passwordInput" name="password" class="form-control luxury-input pe-5" required placeholder="••••••••" autocomplete="current-password">
                        <i class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3 toggle-password" style="cursor: pointer; color: #a39585; z-index: 5;"></i>
                    </div>
                    @error('password')
                        <div class="text-danger mt-1" style="font-size: 0.73rem; color: #dc2626 !important;">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="d-flex align-items-center mb-4" style="font-size: 0.81rem;">
                    <div class="form-check d-flex align-items-center gap-1">
                        <input class="form-check-input custom-checkbox" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label ms-1" for="remember" style="color: #73675a; cursor: pointer;">
                            Simpan Sesi Masuk
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="btnSubmit" class="btn w-100 py-2.5 fw-semibold text-white border-0 d-flex align-items-center justify-content-center gap-2">
                    <span id="btnText">Masuk ke Sistem</span>
                    <i class="bi bi-arrow-right fs-6" id="btnIcon"></i>
                </button>
            </form>
            
            <!-- System Status Indicator -->
            <div class="mt-4 pt-3 border-top border-secondary border-opacity-10 d-flex justify-content-between align-items-center" style="font-size: 0.72rem; color: #a39585 !important;">
                <span><i class="bi bi-shield-check text-rose-gold me-1"></i> Secure Enclave Active</span>
                <span>v2.4-lux</span>
            </div>
        </div>
    </div>
</div>

<!-- Typography & Icons -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    /* Reset Base */
    html, body {
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        height: 100% !important;
        overflow: hidden !important;
        background-color: #FAF5F0;
        font-family: 'Inter', sans-serif;
    }

    .pointer-events-none {
        pointer-events: none;
    }

    /* Light Luxury Card Style (Glassmorphism Mutiara) */
    .luxury-card-light {
        width: 25rem;
        max-width: 90%;
        background: rgba(255, 255, 255, 0.76);
        backdrop-filter: blur(30px);
        -webkit-backdrop-filter: blur(30px);
        border: 1px solid rgba(255, 255, 255, 0.95);
        border-radius: 22px;
        box-shadow: 0 25px 45px -12px rgba(184, 140, 110, 0.22),
                    0 10px 20px -5px rgba(0, 0, 0, 0.03);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
    }

    /* Color Palette Styles */
    .text-espresso { color: #3b322a !important; }
    .text-rose-gold { color: #c48b71 !important; }
    .text-bronze { color: #a88265 !important; }

    /* --- CONTAINER IKON BRAND --- */
    .alive-brand-container {
        width: 62px;
        height: 62px;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(245, 220, 205, 0.75));
        border: 1px solid rgba(212, 165, 116, 0.4);
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(196, 139, 113, 0.15);
        position: relative;
    }

    .pos-register-wrapper {
        position: relative;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pos-body-icon {
        font-size: 1.8rem;
        color: #b3785b;
        z-index: 2;
    }

    .status-dot {
        position: absolute;
        top: -1px;
        right: -1px;
        width: 7px;
        height: 7px;
        background-color: #10b981;
        border-radius: 50%;
        box-shadow: 0 0 8px #10b981;
        z-index: 4;
        animation: statusBlink 1.8s infinite alternate;
    }

    .animated-receipt {
        position: absolute;
        bottom: 2px;
        width: 14px;
        height: 12px;
        background: #ffffff;
        border: 1px solid #d49575;
        border-radius: 2px 2px 0 0;
        z-index: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
        padding: 2px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.08);
        animation: printReceipt 3s ease-in-out infinite;
    }

    .receipt-line {
        height: 1.5px;
        background-color: #c48b71;
        width: 100%;
        border-radius: 1px;
    }

    .receipt-line.short { width: 60%; }

    @keyframes printReceipt {
        0% { transform: translateY(0px) scaleY(0.3); opacity: 0; }
        30% { transform: translateY(-8px) scaleY(1); opacity: 1; }
        70% { transform: translateY(-8px) scaleY(1); opacity: 1; }
        100% { transform: translateY(-12px) scaleY(0.8); opacity: 0; }
    }

    @keyframes statusBlink {
        0% { opacity: 0.3; transform: scale(0.8); }
        100% { opacity: 1; transform: scale(1.1); }
    }

    /* --- ANIMASI MANIK-MANIK (BEADS) --- */
    .bead {
        position: absolute;
        border-radius: 50%;
        opacity: 1;
        animation: floatBurst 1.8s cubic-bezier(0.12, 0.8, 0.32, 1) forwards;
    }

    @keyframes floatBurst {
        0% {
            opacity: 1;
            transform: translate(0, 0) scale(0.4);
        }
        70% {
            opacity: 0.9;
        }
        100% {
            opacity: 0;
            transform: translate(var(--tx), var(--ty)) scale(1.2);
        }
    }

    /* Input Fields */
    .luxury-input-icon {
        background: rgba(255, 255, 255, 0.85) !important;
        border: 1px solid rgba(212, 185, 160, 0.45) !important;
        border-right: none !important;
        border-radius: 12px 0 0 12px !important;
        padding-left: 1rem !important;
    }

    .luxury-input {
        background: rgba(255, 255, 255, 0.85) !important;
        border: 1px solid rgba(212, 185, 160, 0.45) !important;
        border-left: none !important;
        border-radius: 0 12px 12px 0 !important;
        color: #3b322a !important;
        padding: 0.7rem 0.9rem !important;
        font-size: 0.86rem !important;
        transition: all 0.25s ease !important;
    }

    .luxury-input:focus {
        background: #ffffff !important;
        border-color: #c48b71 !important;
        box-shadow: 0 0 0 3.5px rgba(196, 139, 113, 0.18) !important;
        color: #26201a !important;
    }

    .luxury-input::placeholder { color: #b5a899; }

    /* Checkbox */
    .custom-checkbox {
        background-color: rgba(255, 255, 255, 0.9) !important;
        border-color: rgba(196, 139, 113, 0.45) !important;
        border-radius: 5px !important;
        cursor: pointer;
    }
    .custom-checkbox:checked {
        background-color: #c48b71 !important;
        border-color: #c48b71 !important;
    }

    /* Submit Button (Rose-Bronze Luxury Gradient) */
    #btnSubmit {
        background: linear-gradient(135deg, #d49575 0%, #b3785b 100%);
        border-radius: 12px;
        font-size: 0.88rem;
        transition: opacity 0.2s ease, transform 0.1s ease, box-shadow 0.2s ease;
        box-shadow: 0 6px 18px rgba(196, 139, 113, 0.32);
    }

    #btnSubmit:hover {
        opacity: 0.94;
        box-shadow: 0 8px 22px rgba(196, 139, 113, 0.42);
    }

    #btnSubmit:active { transform: scale(0.99); }
    .toggle-password:hover { color: #5c5247 !important; }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Toggle Password Input Visibility
        const togglePassword = document.querySelector('.toggle-password');
        const passwordInput = document.getElementById('passwordInput');
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('bi-eye');
                this.classList.toggle('bi-eye-slash');
            });
        }

        // --- ANIMASI SBURAN MANIK-MANIK DI BELAKANG CARD ---
        const loginForm = document.getElementById('loginForm');
        const beadsContainer = document.getElementById('beads-container');
        const luxuryCard = document.querySelector('.luxury-card-light');

        const beadColors = [
            '#d49575', '#c48b71', '#a88265', '#f3d9c8', 
            '#e6beae', '#ffffff', '#ffd700'
        ];

        function createBeadsBurst() {
            const beadCount = 65; // Jumlah manik-manik
            const centerX = window.innerWidth / 2;
            const centerY = window.innerHeight / 2;

            for (let i = 0; i < beadCount; i++) {
                const bead = document.createElement('div');
                bead.classList.add('bead');

                // Ukuran manik-manik acak
                const size = Math.random() * 12 + 6; // 6px - 18px
                bead.style.width = `${size}px`;
                bead.style.height = `${size}px`;

                // Warna & Efek Mengkilap Mutiara
                const randomColor = beadColors[Math.floor(Math.random() * beadColors.length)];
                bead.style.background = `radial-gradient(circle at 30% 30%, #ffffff, ${randomColor})`;
                bead.style.boxShadow = `0 4px 10px rgba(0,0,0,0.15), 0 0 12px ${randomColor}`;

                // Posisi awal di tengah belakang card
                bead.style.left = `${centerX}px`;
                bead.style.top = `${centerY}px`;

                // Arah lemparan acak ke segala arah
                const angle = Math.random() * Math.PI * 2;
                const distance = Math.random() * 320 + 150; // Jarak melayang ke luar
                const tx = Math.cos(angle) * distance;
                const ty = Math.sin(angle) * distance;

                bead.style.setProperty('--tx', `${tx}px`);
                bead.style.setProperty('--ty', `${ty}px`);

                beadsContainer.appendChild(bead);

                // Hapus elemen setelah animasi selesai
                setTimeout(() => bead.remove(), 1800);
            }
        }

        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                // Efek membal halus pada card saat tombol masuk dipencet
                luxuryCard.style.transform = 'scale(1.02)';
                setTimeout(() => luxuryCard.style.transform = 'scale(1)', 200);

                // Picu Letupan Manik-Manik!
                createBeadsBurst();
            });
        }

        // --- ANIMATED DYNAMIC GRADIENT MESH CANVAS ---
        const canvas = document.getElementById('animated-gradient-canvas');
        const ctx = canvas.getContext('2d');

        let width, height;
        let points = [];

        function resize() {
            width = canvas.width = window.innerWidth;
            height = canvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resize);
        resize();

        class GradientPoint {
            constructor(x, y, radius, color, speedX, speedY) {
                this.x = x;
                this.y = y;
                this.radius = radius;
                this.color = color;
                this.vx = speedX;
                this.vy = speedY;
            }

            update() {
                this.x += this.vx;
                this.y += this.vy;

                if (this.x < -100 || this.x > width + 100) this.vx *= -1;
                if (this.y < -100 || this.y > height + 100) this.vy *= -1;
            }

            draw() {
                const grad = ctx.createRadialGradient(
                    this.x, this.y, 0,
                    this.x, this.y, this.radius
                );
                grad.addColorStop(0, this.color);
                grad.addColorStop(1, 'rgba(250, 245, 240, 0)');

                ctx.fillStyle = grad;
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initPoints() {
            points = [
                new GradientPoint(width * 0.2, height * 0.3, 450, 'rgba(242, 198, 180, 0.75)', 0.6, 0.4),
                new GradientPoint(width * 0.8, height * 0.2, 500, 'rgba(238, 218, 190, 0.80)', -0.5, 0.5),
                new GradientPoint(width * 0.3, height * 0.8, 550, 'rgba(248, 222, 212, 0.70)', 0.4, -0.6),
                new GradientPoint(width * 0.7, height * 0.7, 480, 'rgba(230, 202, 182, 0.65)', -0.6, -0.4)
            ];
        }

        initPoints();

        function render() {
            ctx.clearRect(0, 0, width, height);

            ctx.fillStyle = '#FAF5F0';
            ctx.fillRect(0, 0, width, height);

            points.forEach(point => {
                point.update();
                point.draw();
            });

            requestAnimationFrame(render);
        }

        render();
    });
</script>
@endsection