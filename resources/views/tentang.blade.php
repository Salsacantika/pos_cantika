@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 px-xl-5 developer-wrapper position-relative overflow-hidden">
    {{-- Dynamic Background Shapes & Ambient Glows --}}
    <div class="luxury-shape shape-one"></div>
    <div class="luxury-shape shape-two"></div>
    <div class="luxury-grid-overlay"></div>

    <div class="container position-relative z-2">
        <div class="row justify-content-center">
            <div class="col-xxl-11">

                {{-- Modern Header Section with Glassmorphism --}}
                <div class="glass-header-card p-4 p-md-5 rounded-4 mb-5 d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-4 position-relative overflow-hidden">
                    <div class="header-glow-accent"></div>
                    <div class="position-relative z-1">
                        <div class="d-flex align-items-center gap-2.5 mb-3">
                            <span class="badge badge-system-modern px-3 py-1.5 rounded-pill font-monospace text-xs uppercase tracking-wider d-flex align-items-center gap-2">
                                <span class="pulse-dot-mini"></span> Secure Architecture Core
                            </span>
                            <span class="text-muted opacity-25">•</span>
                            <span class="text-muted small fw-bold font-monospace tracking-widest text-uppercase">MaisonPOS // v12.x</span>
                        </div>
                        <h1 class="fw-black display-5 mb-1 text-gradient-main tracking-tight">Sistem & Pengembang</h1>
                        <p class="text-secondary mb-0 fw-medium small">Dokumentasi arsitektur sistem tingkat lanjut dan profil pengembang utama.</p>
                    </div>
                    <div class="position-relative z-1">
                        <div class="live-security-badge px-4 py-3 rounded-4 d-flex align-items-center gap-3 shadow-sm bg-white/80 backdrop-blur border">
                            <div class="icon-shield-box rounded-3 d-flex align-items-center justify-content-center text-accent">
                                <i class="bi bi-shield-lock-fill fs-5"></i>
                            </div>
                            <div>
                                <span class="d-block text-muted font-monospace text-uppercase" style="font-size: 10px;">Security Protocol</span>
                                <span class="fw-extrabold text-dark font-monospace text-xs">AES-256 ENCRYPTED</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Main Content Bento Grid Layout --}}
                <div class="row g-4 align-items-stretch mb-5">
                    
                    {{-- Kolom Kiri: Profil Developer (Bento Profile Card) --}}
                    <div class="col-lg-4">
                        <div class="bento-profile-card h-100 p-4 p-xl-5 text-center d-flex flex-column align-items-center justify-content-between position-relative overflow-hidden">
                            <div class="card-bg-glow"></div>
                            
                            <div class="w-100 position-relative z-1">
                                <div class="position-relative d-inline-block mb-4 profile-wrapper mt-3">
                                    <div class="avatar-glow-ring"></div>
                                    <div class="avatar-orbit-ring"></div>
                                    <img src="{{ asset('images/Gua.jpeg') }}"
                                         alt="Salsa Cantika Indriyani"
                                         class="rounded-circle shadow-lg profile-avatar position-relative"
                                         onerror="this.src='https://ui-avatars.com/api/?name=Salsa+Cantika+Indriyani&background=b37456&color=fff&size=200'">
                                    <div class="position-absolute bottom-0 end-0 text-white rounded-circle shadow-md d-flex align-items-center justify-content-center border-3 border-white verified-badge animate-bounce-short" title="Verified Lead Security Architect">
                                        <i class="bi bi-shield-check fw-bold fs-6"></i>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <span class="badge-role-pill px-3.5 py-1.5 rounded-pill text-xs fw-extrabold uppercase tracking-widest mb-2.5 d-inline-block font-monospace">
                                        <i class="bi bi-code-square me-1"></i> Lead Laravel Architect
                                    </span>
                                    <h2 class="fw-black text-dark mb-1 fs-3 text-gradient-main">Salsa Cantika Indriyani</h2>
                                    <p class="text-muted small fw-bold mb-0 tracking-wide font-monospace">Pengembang Utama MaisonPOS</p>
                                </div>
                            </div>

                            <div class="w-100 pt-4 border-top border-amber-subtle position-relative z-1 text-start">
                                <div class="d-flex flex-column gap-2">
                                    <div class="d-flex align-items-center text-secondary small info-pill-item p-2.5 rounded-3 transition">
                                        <div class="icon-clean-sm rounded-2 d-flex align-items-center justify-content-center text-accent me-3">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                        <span class="fw-bold text-slate-700">Tasikmalaya, Jawa Barat</span>
                                    </div>
                                    <div class="d-flex align-items-center text-secondary small info-pill-item p-2.5 rounded-3 transition">
                                        <div class="icon-clean-sm rounded-2 d-flex align-items-center justify-content-center text-accent me-3">
                                            <i class="bi bi-mortarboard-fill"></i>
                                        </div>
                                        <span class="fw-bold text-slate-700">Kelas XII PPLG 1</span>
                                    </div>
                                    <div class="d-flex align-items-center text-secondary small info-pill-item p-2.5 rounded-3 transition">
                                        <div class="icon-clean-sm rounded-2 d-flex align-items-center justify-content-center text-accent me-3">
                                            <i class="bi bi-laptop"></i>
                                        </div>
                                        <span class="fw-bold text-slate-700">Software Engineering</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Detail Sistem & Spesifikasi Teknis --}}
                    <div class="col-lg-8">
                        <div class="h-100 d-flex flex-column justify-content-between gap-4">
                            
                            {{-- Main Info Box --}}
                            <div class="bento-main-card p-4 p-xl-5 position-relative overflow-hidden rounded-4">
                                <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="p-3 rounded-4 bg-accent-soft text-accent shadow-xs animate-float">
                                            <i class="bi bi-cpu-fill fs-4"></i>
                                        </div>
                                        <div>
                                            <h3 class="fw-black text-dark mb-0 fs-4">MaisonPOS Enterprise Core</h3>
                                            <span class="text-muted small fw-semibold font-monospace">Laravel 12 Framework & Cryptography</span>
                                        </div>
                                    </div>
                                    <span class="badge bg-dark text-white px-3.5 py-2 rounded-pill font-monospace text-xs fw-bold shadow-sm d-flex align-items-center gap-2">
                                        <span class="dot-amber"></span> v12.0 Stable
                                    </span>
                                </div>

                                <p class="text-secondary lh-lg mb-0 fs-6 fw-medium" style="text-align: justify;">
                                    <strong class="text-dark">MaisonPOS</strong> dibangun di atas fondasi kerangka kerja <em class="text-accent fw-bold">Laravel 12</em> mutakhir. Mengintegrasikan lapisan proteksi data perusahaan (<span class="fw-bold text-dark">Enterprise Security Layer</span>), mitigasi serangan injeksi SQL, manajemen token CSRF ganda, serta sistem otorisasi peran ketat demi menjamin keamanan transaksi secara menyeluruh.
                                </p>
                            </div>

                            {{-- Grid Spesifikasi (2 Kolom Kecil) --}}
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="bento-spec-card p-4 rounded-4 h-100 position-relative overflow-hidden">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="tech-icon-box rounded-3 d-flex align-items-center justify-content-center text-accent shadow-xs">
                                                <i class="bi bi-filetype-php fs-4"></i>
                                            </div>
                                            <span class="badge-sub-modern font-monospace text-xs px-2.5 py-1 rounded-pill">MVC CORE</span>
                                        </div>
                                        <span class="d-block text-muted text-uppercase fw-bold font-monospace tracking-wider mb-1" style="font-size: 0.65rem;">Framework Architecture</span>
                                        <h4 class="fw-black text-dark fs-5 font-monospace mb-2">Laravel 12 Engine</h4>
                                        <p class="text-secondary small mb-0 fw-semibold">Service container teroptimasi penuh untuk kecepatan pemrosesan kasir kilat.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="bento-spec-card p-4 rounded-4 h-100 position-relative overflow-hidden">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <div class="tech-icon-box rounded-3 d-flex align-items-center justify-content-center text-accent shadow-xs">
                                                <i class="bi bi-shield-fill-check fs-4"></i>
                                            </div>
                                            <span class="badge-sub-modern font-monospace text-xs px-2.5 py-1 rounded-pill">SECURITY</span>
                                        </div>
                                        <span class="d-block text-muted text-uppercase fw-bold font-monospace tracking-wider mb-1" style="font-size: 0.65rem;">Data Protection</span>
                                        <h4 class="fw-black text-dark fs-5 font-monospace mb-2">AES-256 Encryption</h4>
                                        <p class="text-secondary small mb-0 fw-semibold">Hashing bcrypt berlapis serta enkripsi data sensitif tingkat tinggi.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- Live Footer Bar --}}
                <div class="glass-footer-card p-4 rounded-4 d-flex flex-column flex-md-row align-items-center justify-content-between text-muted small font-monospace shadow-xs">
                    <div class="d-flex align-items-center gap-2 mb-2 mb-md-0">
                        <i class="bi bi-shield-shaded text-accent"></i>
                        <span class="fw-bold text-dark">MaisonPOS Enterprise Ecosystem</span>
                        <span>— Secured Core</span>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <span class="badge bg-white text-accent px-3 py-1.5 rounded-pill border shadow-xs" id="live-clock">
                            <i class="bi bi-clock-fill me-1"></i> 00:00:00 WIB
                        </span>
                        <span class="fw-bold text-secondary d-none d-lg-inline">Engineered with Passion</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Eksklusif Mewah & Modern Bento Glassmorphism */
    :root {
        --color-accent: #b37456;
        --color-accent-dark: #8c583f;
        --color-accent-soft: #fbf5f1;
        --border-color-custom: rgba(179, 116, 86, 0.18);
    }

    .developer-wrapper {
        background: linear-gradient(135deg, #fbfaf8 0%, #f3ede8 100%);
        min-height: calc(100vh - 70px);
        position: relative;
    }

    /* Ambient Background Shapes */
    .luxury-shape {
        position: absolute;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        filter: blur(90px);
        z-index: 1;
        pointer-events: none;
    }
    .shape-one {
        top: -15%;
        left: -10%;
        background: rgba(179, 116, 86, 0.1);
        animation: floatShape 12s ease-in-out infinite alternate;
    }
    .shape-two {
        bottom: -15%;
        right: -10%;
        background: rgba(212, 160, 134, 0.12);
        animation: floatShape 15s ease-in-out infinite alternate-reverse;
    }

    @keyframes floatShape {
        0% { transform: translateY(0) scale(1); }
        100% { transform: translateY(40px) scale(1.15); }
    }

    /* Glass Cards & Bento Containers */
    .glass-header-card, .bento-profile-card, .bento-main-card, .bento-spec-card, .glass-footer-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        border: 1px solid var(--border-color-custom);
        box-shadow: 0 20px 40px -15px rgba(44, 36, 32, 0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .glass-header-card:hover, .bento-main-card:hover, .bento-spec-card:hover, .bento-profile-card:hover {
        border-color: rgba(179, 116, 86, 0.4);
        box-shadow: 0 25px 50px -12px rgba(179, 116, 86, 0.12);
        transform: translateY(-3px);
    }

    /* Profile Avatar Effects */
    .profile-avatar {
        width: 160px;
        height: 160px;
        object-fit: cover;
        border: 4px solid #ffffff;
        box-shadow: 0 20px 40px rgba(179, 116, 86, 0.2);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .profile-avatar:hover {
        transform: scale(1.06) rotate(2deg);
        box-shadow: 0 30px 60px rgba(179, 116, 86, 0.3);
    }

    .avatar-glow-ring {
        position: absolute;
        inset: -12px;
        background: linear-gradient(135deg, rgba(179,116,86,0.35), rgba(179,116,86,0));
        border-radius: 50%;
        filter: blur(18px);
        z-index: 0;
        animation: pulseGlow 3s ease-in-out infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 0.9; transform: scale(1.08); }
    }

    .avatar-orbit-ring {
        position: absolute;
        inset: -6px;
        border: 2px dashed rgba(179, 116, 86, 0.35);
        border-radius: 50%;
        animation: spinOrbit 25s linear infinite;
        z-index: 0;
    }

    @keyframes spinOrbit {
        100% { transform: rotate(360deg); }
    }

    .verified-badge {
        width: 38px;
        height: 38px;
        background-color: var(--color-accent) !important;
    }

    .animate-bounce-short {
        animation: bounceShort 2s ease-in-out infinite;
    }

    @keyframes bounceShort {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-4px); }
    }

    /* Badges & Icons Styling */
    .badge-role-pill {
        background-color: var(--color-accent-soft);
        color: var(--color-accent);
        border: 1px solid rgba(179, 116, 86, 0.2);
    }

    .badge-system-modern {
        background-color: var(--color-accent-soft);
        color: var(--color-accent);
        border: 1px solid rgba(179, 116, 86, 0.2);
    }

    .badge-sub-modern {
        background-color: var(--color-accent-soft);
        color: var(--color-accent);
        border: 1px solid rgba(179, 116, 86, 0.2);
        font-weight: 700;
    }

    .icon-clean-sm {
        width: 36px;
        height: 36px;
        background-color: var(--color-accent-soft);
        border: 1px solid rgba(179, 116, 86, 0.15);
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .info-pill-item:hover {
        background-color: var(--color-accent-soft);
        transform: translateX(4px);
    }

    .info-pill-item:hover .icon-clean-sm {
        background-color: var(--color-accent);
        color: #ffffff !important;
    }

    .tech-icon-box {
        width: 44px;
        height: 44px;
        background-color: var(--color-accent-soft);
        border: 1px solid rgba(179, 116, 86, 0.2);
    }

    .icon-shield-box {
        width: 40px;
        height: 40px;
        background-color: var(--color-accent-soft);
        border: 1px solid rgba(179, 116, 86, 0.2);
    }

    .text-accent {
        color: var(--color-accent) !important;
    }

    .bg-accent-soft {
        background-color: var(--color-accent-soft);
    }

    .text-gradient-main {
        background: linear-gradient(135deg, #2b211c 0%, #b37456 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .pulse-dot-mini {
        width: 7px;
        height: 7px;
        background-color: var(--color-accent);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 6px var(--color-accent);
        animation: pulseDotAnim 1.5s infinite;
    }

    @keyframes pulseDotAnim {
        0% { transform: scale(0.95); opacity: 1; }
        50% { transform: scale(1.5); opacity: 0.4; }
        100% { transform: scale(0.95); opacity: 1; }
    }

    .dot-amber {
        width: 6px;
        height: 6px;
        background-color: var(--color-accent);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 5px var(--color-accent);
    }

    .animate-float {
        animation: floatIcon 3s ease-in-out infinite alternate;
    }

    @keyframes floatIcon {
        0% { transform: translateY(0); }
        100% { transform: translateY(-3px); }
    }
</style>

{{-- Script Live Clock Real-Time --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        function updateLiveClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const clockElement = document.getElementById('live-clock');
            if (clockElement) {
                clockElement.innerHTML = `<i class="bi bi-clock-fill me-1 text-accent"></i> ${hours}:${minutes}:${seconds} WIB`;
            }
        }
        setInterval(updateLiveClock, 1000);
        updateLiveClock();
    });
</script>
@endsection