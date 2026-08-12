@extends('layouts.app')

@section('content')
<div class="container-fluid py-5 px-xl-5 dashboard-wrapper position-relative overflow-hidden">
    {{-- Ambient Lighting Effects --}}
    <div class="ambient-glow glow-one"></div>
    <div class="ambient-glow glow-two"></div>

    <div class="container position-relative z-2">
        <div class="row justify-content-center">
            <div class="col-xxl-11">

                {{-- Modern Header Section --}}
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-5 pb-4 border-bottom border-amber-subtle">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-2 animate-fade-in">
                            <span class="badge badge-system-glow px-3.5 py-1.5 rounded-pill font-monospace text-xs uppercase tracking-widest shadow-xs">
                                <i class="bi bi-shield-lock-fill me-1.5 text-accent animate-spin-slow"></i> Secure Architecture Core
                            </span>
                            <span class="text-muted opacity-50">•</span>
                            <span class="text-muted small fw-semibold font-monospace tracking-wider">MAISON-POS // SECURE ENGINE V12</span>
                        </div>
                        <h1 class="fw-black text-dark display-5 mb-0 tracking-tight text-gradient-title">Sistem & Pengembang</h1>
                    </div>
                    <div class="mt-4 mt-md-0 d-flex align-items-center gap-3">
                        <div class="live-status-pill px-4 py-2.5 rounded-pill d-flex align-items-center gap-2.5 shadow-sm bg-white border border-amber-light">
                            <span class="status-pulse-dot">
                                <span class="pulse-ring"></span>
                            </span>
                            <span class="fw-extrabold text-slate-800 text-xs font-monospace tracking-wide">SECURE: ENCRYPTED (256-BIT)</span>
                        </div>
                    </div>
                </div>

                {{-- Main Content Grid --}}
                <div class="row g-5 align-items-center mb-5">
                    
                    {{-- Kolom Kiri: Profil Developer --}}
                    <div class="col-lg-4 text-center text-lg-start">
                        <div class="position-relative d-inline-block mb-4 profile-wrapper">
                            <div class="avatar-glow-ring"></div>
                            <div class="avatar-orbit-ring"></div>
                            <img src="{{ asset('images/Gua.jpeg') }}"
                                 alt="Salsa Cantika Indriyani"
                                 class="rounded-circle shadow-2xl profile-avatar position-relative"
                                 onerror="this.src='https://ui-avatars.com/api/?name=Salsa+Cantika+Indriyani&background=b37456&color=fff&size=200'">
                            <div class="position-absolute bottom-0 end-0 text-white rounded-circle shadow-lg d-flex align-items-center justify-content-center border-4 border-white verified-badge animate-bounce-short" title="Verified Lead Security Architect">
                                <i class="bi bi-shield-check fw-bold fs-5"></i>
                            </div>
                        </div>

                        <div class="mb-4">
                            <span class="badge-role-elite px-4 py-1.5 rounded-pill text-xs fw-extrabold uppercase tracking-widest mb-3 d-inline-block font-monospace shadow-xs">
                                <i class="bi bi-file-earmark-code-fill me-1 text-accent"></i> Lead Laravel Architect
                            </span>
                            <h2 class="fw-black text-dark mb-1 fs-2 text-gradient-name">Salsa Cantika Indriyani</h2>
                            <p class="text-muted small fw-bold mb-0 tracking-wider">Pengembang Utama MaisonPOS</p>
                        </div>

                        <div class="d-flex flex-column gap-2.5 pt-4 border-top border-amber-subtle">
                            <div class="d-flex align-items-center text-secondary small info-hover-item p-2.5 rounded-3 transition cursor-pointer">
                                <div class="icon-clean rounded-3 d-flex align-items-center justify-content-center text-accent me-3 shadow-xs">
                                    <i class="bi bi-geo-alt-fill fs-5"></i>
                                </div>
                                <span class="fw-bold text-slate-700">Kota Tasikmalaya, Jawa Barat</span>
                            </div>
                            <div class="d-flex align-items-center text-secondary small info-hover-item p-2.5 rounded-3 transition cursor-pointer">
                                <div class="icon-clean rounded-3 d-flex align-items-center justify-content-center text-accent me-3 shadow-xs">
                                    <i class="bi bi-mortarboard-fill fs-5"></i>
                                </div>
                                <span class="fw-bold text-slate-700">Kelas XII PPLG 1</span>
                            </div>
                            <div class="d-flex align-items-center text-secondary small info-hover-item p-2.5 rounded-3 transition cursor-pointer">
                                <div class="icon-clean rounded-3 d-flex align-items-center justify-content-center text-accent me-3 shadow-xs">
                                    <i class="bi bi-code-slash fs-5"></i>
                                </div>
                                <span class="fw-bold text-slate-700">PPLG - Software Engineering</span>
                            </div>
                        </div>
                    </div>

                    {{-- Kolom Kanan: Detail Desain Laravel & Keamanan Tinggi --}}
                    <div class="col-lg-8">
                        <div class="ps-lg-4">
                            
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="p-3 rounded-4 bg-accent-soft text-accent shadow-sm animate-float">
                                        <i class="bi bi-shield-shaded fs-4"></i>
                                    </div>
                                    <div>
                                        <h3 class="fw-black text-dark mb-0 fs-3">MaisonPOS Secure Framework</h3>
                                        <span class="text-muted small fw-semibold font-monospace">Enterprise Laravel 12 & Advanced Cryptography</span>
                                    </div>
                                </div>
                                <span class="badge bg-dark text-white px-4 py-2.5 rounded-pill font-monospace text-xs fw-bold shadow-md d-flex align-items-center gap-2">
                                    <span class="dot-amber"></span> Laravel v12.x Secured
                                </span>
                            </div>

                            <p class="text-secondary lh-lg mb-4 fs-6 fw-medium" style="text-align: justify;">
                                <strong class="text-dark">MaisonPOS</strong> dikembangkan menggunakan arsitektur modern <em class="text-accent fw-bold">Laravel 12</em> dengan penerapan sistem keamanan tingkat tinggi (<span class="fw-bold text-dark">Enterprise Security Layer</span>). Dilengkapi proteksi enkripsi data tingkat lanjut, pencegahan <em>SQL Injection</em>, proteksi <em>CSRF Token</em> berlapis, serta manajemen otorisasi akses berbasis peran yang memastikan integritas transaksi kasir selalu terlindungi secara maksimal.
                            </p>

                            {{-- Desain Kartu Spesifikasi --}}
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 spec-card-new h-100 position-relative overflow-hidden">
                                        <div class="d-flex align-items-start justify-content-between mb-3">
                                            <div class="tech-icon-circle rounded-3 d-flex align-items-center justify-content-center text-accent shadow-xs">
                                                <i class="bi bi-filetype-php fs-4"></i>
                                            </div>
                                            <span class="badge-sub-clean font-monospace text-xs px-2.5 py-1 rounded-pill">ENGINE</span>
                                        </div>
                                        <span class="d-block text-muted text-uppercase fw-bold font-monospace tracking-wider mb-1" style="font-size: 0.7rem;">Laravel Architecture</span>
                                        <h4 class="fw-black text-dark fs-5 font-monospace mb-2">Laravel 12 Engine</h4>
                                        <p class="text-secondary small mb-0 fw-semibold">MVC & Service Container teroptimasi tinggi untuk performa kasir secepat kilat.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="p-4 rounded-4 spec-card-new h-100 position-relative overflow-hidden">
                                        <div class="d-flex align-items-start justify-content-between mb-3">
                                            <div class="tech-icon-circle rounded-3 d-flex align-items-center justify-content-center text-accent shadow-xs">
                                                <i class="bi bi-shield-lock-fill fs-4"></i>
                                            </div>
                                            <span class="badge-sub-clean font-monospace text-xs px-2.5 py-1 rounded-pill">PROTECTION</span>
                                        </div>
                                        <span class="d-block text-muted text-uppercase fw-bold font-monospace tracking-wider mb-1" style="font-size: 0.7rem;">Advanced Security</span>
                                        <h4 class="fw-black text-dark fs-5 font-monospace mb-2">AES-256 Encryption</h4>
                                        <p class="text-secondary small mb-0 fw-semibold">Bcrypt hashing guard serta token enkripsi ganda untuk proteksi data mutlak.</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Highlight Callout Banner Keamanan --}}
                            <div class="p-4 rounded-4 callout-modern-banner d-flex align-items-center justify-content-between flex-wrap gap-3 shadow-sm position-relative overflow-hidden">
                                <div class="position-absolute end-0 bottom-0 opacity-05 pointer-events-none me-3 mb-n3">
                                    <i class="bi bi-shield-fill-check" style="font-size: 6rem;"></i>
                                </div>
                                <div class="d-flex align-items-center gap-3.5 position-relative z-1">
                                    <div class="p-3.5 rounded-4 bg-accent text-white shadow-md animate-pulse-slow">
                                        <i class="bi bi-shield-fill-check fs-4"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-extrabold text-dark mb-1 fs-6">Sistem Keamanan Terpadu</h5>
                                        <p class="text-secondary small fw-semibold mb-0">Proteksi firewall aplikasi ketat untuk mencegah akses ilegal & manipulasi data.</p>
                                    </div>
                                </div>
                                <span class="badge bg-white text-accent px-4 py-2.5 rounded-pill border fw-black text-xs shadow-sm font-monospace position-relative z-1">
                                    <i class="bi bi-patch-check-fill me-1"></i> ENCRYPTED CORE
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

                {{-- Live Footer --}}
                <div class="pt-4 border-top border-amber-subtle d-flex flex-column flex-md-row align-items-center justify-content-between text-muted small font-monospace">
                    <span class="fw-semibold">MaisonPOS Enterprise Ecosystem — Protected by Laravel Security Core.</span>
                    <div class="d-flex align-items-center gap-3 mt-2 mt-md-0">
                        <span class="text-accent fw-bold" id="live-clock"><i class="bi bi-clock-fill me-1"></i> 00:00:00 WIB</span>
                        <span class="text-muted opacity-50">|</span>
                        <span class="fw-bold text-dark">Engineered with Precision & Passion</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Eksklusif Mewah Bernuansa Warm Gold & Bronze */
    :root {
        --color-accent: #b37456;
        --color-accent-dark: #8c583f;
        --color-accent-soft: #f7f0ec;
    }

    .dashboard-wrapper {
        background: linear-gradient(135deg, #fcfbf9 0%, #f4ede9 100%);
        min-height: calc(100vh - 70px);
        position: relative;
    }

    .ambient-glow {
        position: absolute;
        width: 450px;
        height: 450px;
        border-radius: 50%;
        filter: blur(80px);
        z-index: 1;
        pointer-events: none;
    }
    .glow-one {
        top: -10%;
        left: -10%;
        background: rgba(179, 116, 86, 0.12);
        animation: floatGlow 10s ease-in-out infinite alternate;
    }
    .glow-two {
        bottom: -10%;
        right: -10%;
        background: rgba(212, 160, 134, 0.15);
        animation: floatGlow 12s ease-in-out infinite alternate-reverse;
    }

    @keyframes floatGlow {
        0% { transform: translateY(0) scale(1); }
        100% { transform: translateY(30px) scale(1.1); }
    }

    .border-amber-subtle {
        border-color: rgba(179, 116, 86, 0.15) !important;
    }

    .border-amber-light {
        border-color: rgba(179, 116, 86, 0.3) !important;
    }

    .profile-wrapper {
        perspective: 1000px;
    }

    .profile-avatar {
        width: 175px;
        height: 175px;
        object-fit: cover;
        border: 5px solid #ffffff;
        box-shadow: 0 25px 50px rgba(179, 116, 86, 0.25);
        transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .profile-avatar:hover {
        transform: scale(1.05) rotate(2deg);
        box-shadow: 0 35px 70px rgba(179, 116, 86, 0.35);
    }

    .avatar-glow-ring {
        position: absolute;
        inset: -14px;
        background: linear-gradient(135deg, rgba(179,116,86,0.4), rgba(179,116,86,0));
        border-radius: 50%;
        filter: blur(20px);
        z-index: 0;
        animation: pulseGlow 3s ease-in-out infinite;
    }

    @keyframes pulseGlow {
        0%, 100% { opacity: 0.6; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.08); }
    }

    .avatar-orbit-ring {
        position: absolute;
        inset: -8px;
        border: 2px dashed rgba(179, 116, 86, 0.4);
        border-radius: 50%;
        animation: spinOrbit 20s linear infinite;
        z-index: 0;
    }

    @keyframes spinOrbit {
        100% { transform: rotate(360deg); }
    }

    .verified-badge {
        width: 40px;
        height: 40px;
        background-color: var(--color-accent) !important;
    }

    .animate-bounce-short {
        animation: bounceShort 2s ease-in-out infinite;
    }

    @keyframes bounceShort {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }

    .badge-role-elite {
        background-color: rgba(179, 116, 86, 0.12);
        color: var(--color-accent);
        border: 1px solid rgba(179, 116, 86, 0.25);
    }

    .badge-system-glow {
        background-color: #f7f2ef;
        color: var(--color-accent);
        border: 1px solid rgba(179, 116, 86, 0.2);
    }

    .icon-clean {
        width: 46px;
        height: 46px;
        background-color: #f7f2ef;
        border: 1px solid rgba(179, 116, 86, 0.2);
        flex-shrink: 0;
        transition: all 0.3s ease;
    }

    .info-hover-item:hover {
        background-color: #f7f2ef;
        transform: translateX(6px);
        border-color: rgba(179, 116, 86, 0.3);
    }

    .info-hover-item:hover .icon-clean {
        background-color: var(--color-accent);
        color: #ffffff !important;
        transform: scale(1.1);
    }

    .text-accent {
        color: var(--color-accent) !important;
    }

    .bg-accent {
        background-color: var(--color-accent) !important;
    }

    .bg-accent-soft {
        background-color: var(--color-accent-soft);
    }

    .text-gradient-title {
        background: linear-gradient(135deg, #2b211c 0%, #b37456 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .text-gradient-name {
        background: linear-gradient(135deg, #2b211c 0%, #b37456 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .spec-card-new {
        background-color: #ffffff;
        border: 1px solid rgba(179, 116, 86, 0.2);
        box-shadow: 0 10px 30px rgba(44, 36, 32, 0.04);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }

    .spec-card-new:hover {
        transform: translateY(-6px);
        border-color: var(--color-accent);
        box-shadow: 0 20px 40px rgba(179, 116, 86, 0.12);
    }

    .tech-icon-circle {
        width: 48px;
        height: 48px;
        background-color: var(--color-accent-soft);
        border: 1px solid rgba(179, 116, 86, 0.2);
        transition: transform 0.3s ease;
    }

    .spec-card-new:hover .tech-icon-circle {
        transform: scale(1.1) rotate(-5deg);
        background-color: var(--color-accent);
        color: #ffffff !important;
    }

    .badge-sub-clean {
        background-color: var(--color-accent-soft);
        color: var(--color-accent);
        border: 1px solid rgba(179, 116, 86, 0.15);
        font-weight: 700;
    }

    .callout-modern-banner {
        background: linear-gradient(135deg, #fcf5f1 0%, #f1e6e0 100%);
        border: 1px solid rgba(179, 116, 86, 0.3);
        transition: all 0.3s ease;
    }

    .callout-modern-banner:hover {
        box-shadow: 0 15px 35px rgba(179, 116, 86, 0.12);
        transform: translateY(-2px);
    }

    .live-status-pill {
        border-color: rgba(179, 116, 86, 0.25) !important;
    }

    .status-pulse-dot {
        position: relative;
        width: 10px;
        height: 10px;
        background-color: var(--color-accent);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 10px var(--color-accent);
    }

    .pulse-ring {
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        border: 2px solid var(--color-accent);
        border-radius: 50%;
        animation: pulseRingAnim 1.8s cubic-bezier(0.215, 0.61, 0.355, 1) infinite;
    }

    @keyframes pulseRingAnim {
        0% { transform: scale(0.95); opacity: 1; }
        50% { transform: scale(2.2); opacity: 0; }
        100% { transform: scale(0.95); opacity: 0; }
    }

    .dot-amber {
        width: 7px;
        height: 7px;
        background-color: var(--color-accent);
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 6px var(--color-accent);
    }

    .animate-spin-slow {
        animation: spinSlow 8s linear infinite;
    }

    @keyframes spinSlow {
        100% { transform: rotate(360deg); }
    }

    .animate-float {
        animation: floatIcon 3s ease-in-out infinite alternate;
    }

    @keyframes floatIcon {
        0% { transform: translateY(0); }
        100% { transform: translateY(-4px); }
    }

    .animate-pulse-slow {
        animation: pulseSlow 3s ease-in-out infinite;
    }

    @keyframes pulseSlow {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
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
                clockElement.innerHTML = `<i class="bi bi-clock-fill me-1"></i> ${hours}:${minutes}:${seconds} WIB`;
            }
        }
        setInterval(updateLiveClock, 1000);
        updateLiveClock();
    });
</script>
@endsection