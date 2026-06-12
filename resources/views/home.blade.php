<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="InternHub - Platform Manajemen Magang Mahasiswa Terpercaya. Temukan lowongan magang terbaik dari berbagai perusahaan ternama.">
    <title>@yield('title', 'InternHub') - Platform Magang Mahasiswa</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800,900&family=plus-jakarta-sans:400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Plus Jakarta Sans', 'Inter', sans-serif; }

        /* ─── Floating shapes ─── */
        .float-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
            animation: floatAround 20s ease-in-out infinite;
        }
        .float-shape:nth-child(2) { animation-delay: -7s; animation-duration: 25s; }
        .float-shape:nth-child(3) { animation-delay: -14s; animation-duration: 30s; }

        @keyframes floatAround {
            0%, 100% { transform: translate(0, 0) scale(1); }
            25%  { transform: translate(30px, -40px) scale(1.1); }
            50%  { transform: translate(-20px, 20px) scale(0.95); }
            75%  { transform: translate(15px, 35px) scale(1.05); }
        }

        /* ─── Stats floating cards ─── */
        .stat-float {
            animation: statFloat 6s ease-in-out infinite;
        }
        .stat-float:nth-child(2) { animation-delay: -2s; }
        .stat-float:nth-child(3) { animation-delay: -4s; }

        @keyframes statFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* ─── Navbar scroll ─── */
        .navbar-scrolled {
            background: rgba(255,255,255,0.95) !important;
            backdrop-filter: blur(20px) !important;
            box-shadow: 0 4px 30px rgba(0,0,0,0.08) !important;
        }

        /* ─── Hero gradient text ─── */
        .hero-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #2563eb 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ─── Vacancy card ─── */
        .vacancy-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .vacancy-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.12);
        }

        /* ─── Tag pill ─── */
        .tag-pill {
            font-size: 0.75rem;
            padding: 4px 12px;
            border-radius: 9999px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        /* ─── Counter animation ─── */
        .count-up {
            display: inline-block;
        }

        /* ─── Smooth section reveal ─── */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ─── Search bar focus ─── */
        .search-input:focus-within {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
            border-color: #6366f1;
        }

        /* ─── User dropdown ─── */
        .user-dropdown {
            opacity: 0;
            visibility: hidden;
            transform: translateY(-8px);
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .user-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        /* ─── Toast notification ─── */
        .toast {
            animation: toastIn 0.4s ease-out, toastOut 0.4s ease-in 3.6s forwards;
        }
        @keyframes toastIn {
            from { opacity: 0; transform: translateY(-20px) scale(0.95); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }
        @keyframes toastOut {
            from { opacity: 1; transform: translateY(0) scale(1); }
            to   { opacity: 0; transform: translateY(-20px) scale(0.95); }
        }
    </style>
</head>
<body class="bg-white text-slate-800 antialiased">
    {{-- ═══════════════════════ FLASH MESSAGE TOAST ═══════════════════════ --}}
    @if(session('success'))
        <div id="toast" class="toast fixed top-24 left-1/2 -translate-x-1/2 z-[100] bg-white border border-emerald-200 rounded-2xl px-6 py-4 shadow-2xl shadow-emerald-500/10 flex items-center gap-3">
            <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <p class="text-sm font-semibold text-slate-700">{{ session('success') }}</p>
        </div>
        <script>setTimeout(() => document.getElementById('toast')?.remove(), 4000);</script>
    @endif
    {{-- ═══════════════════════ NAVBAR ═══════════════════════ --}}
    <nav id="mainNav" class="fixed top-0 inset-x-0 z-50 transition-all duration-300 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/25 group-hover:shadow-indigo-500/40 transition-all duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight">
                        <span class="text-indigo-600">Intern</span><span class="text-slate-800">Hub</span>
                    </span>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden md:flex items-center gap-1">
                    <a href="#lowongan" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all duration-200">Cari Lowongan</a>
                    <a href="#perusahaan" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all duration-200">Perusahaan Mitra</a>
                    <a href="#tentang" class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition-all duration-200">Tentang InternHub</a>
                </div>

                {{-- Auth Buttons --}}
                <div class="flex items-center gap-3">
                    @auth
                        @php
                            $dashRoute = match(auth()->user()->role) {
                                'admin'     => route('admin.dashboard'),
                                'dosen'     => route('dosen.dashboard'),
                                'mahasiswa' => route('mahasiswa.dashboard'),
                                default     => route('login'),
                            };
                            $roleLabel = match(auth()->user()->role) {
                                'admin'     => 'Administrator',
                                'dosen'     => 'Dosen Pembimbing',
                                'mahasiswa' => 'Mahasiswa',
                                default     => 'User',
                            };
                        @endphp
                        {{-- Dashboard button --}}
                        <a href="{{ $dashRoute }}" class="hidden sm:inline-flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-xl transition-all duration-200">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                            Dashboard
                        </a>

                        {{-- User dropdown --}}
                        <div class="relative">
                            <button id="userDropdownBtn" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-50 transition-all duration-200">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-white text-sm font-bold shadow-md shadow-indigo-500/20">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <div class="hidden sm:block text-left">
                                    <p class="text-sm font-semibold text-slate-700 leading-tight">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $roleLabel }}</p>
                                </div>
                                <svg class="w-4 h-4 text-slate-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>

                            <div id="userDropdown" class="user-dropdown absolute right-0 mt-2 w-56 bg-white rounded-2xl border border-slate-200 shadow-2xl shadow-slate-200/50 py-2 z-50">
                                <div class="px-4 py-3 border-b border-slate-100">
                                    <p class="text-sm font-bold text-slate-700">{{ auth()->user()->name }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ $dashRoute }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 hover:text-indigo-600 hover:bg-indigo-50 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                    Dashboard
                                </a>
                                <div class="border-t border-slate-100 mt-1 pt-1">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-2.5 text-sm text-red-500 hover:text-red-600 hover:bg-red-50 transition rounded-b-2xl">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('register') }}" class="hidden sm:inline-flex px-4 py-2.5 text-sm font-semibold text-indigo-600 hover:text-indigo-700 hover:bg-indigo-50 rounded-xl transition-all duration-200">Daftar</a>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-sm font-semibold rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:from-indigo-500 hover:to-violet-500 transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Masuk
                        </a>
                    @endauth

                    {{-- Mobile menu toggle --}}
                    <button id="mobileMenuBtn" class="md:hidden p-2 text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Nav --}}
            <div id="mobileMenu" class="hidden md:hidden pb-4 border-t border-slate-100 mt-1 pt-3 space-y-1">
                <a href="#lowongan" class="block px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition">Cari Lowongan</a>
                <a href="#perusahaan" class="block px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition">Perusahaan Mitra</a>
                <a href="#tentang" class="block px-4 py-2.5 text-sm font-medium text-slate-600 hover:text-indigo-600 rounded-lg hover:bg-indigo-50 transition">Tentang InternHub</a>
                @auth
                    <a href="{{ $dashRoute }}" class="block px-4 py-2.5 text-sm font-medium text-indigo-600 hover:bg-indigo-50 rounded-lg transition">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="block">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2.5 text-sm font-medium text-red-500 hover:bg-red-50 rounded-lg transition">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('register') }}" class="block px-4 py-2.5 text-sm font-medium text-indigo-600 hover:bg-indigo-50 rounded-lg transition">Daftar Akun</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- ═══════════════════════ HERO SECTION ═══════════════════════ --}}
    <section class="relative min-h-[90vh] flex items-center pt-20 lg:pt-0 overflow-hidden">
        {{-- Background decorative shapes --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="float-shape w-96 h-96 bg-indigo-500" style="top: 10%; right: -5%;"></div>
            <div class="float-shape w-72 h-72 bg-violet-500" style="bottom: 15%; left: -3%;"></div>
            <div class="float-shape w-64 h-64 bg-blue-400" style="top: 50%; left: 30%;"></div>
        </div>

        {{-- Subtle grid pattern --}}
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #6366f1 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                {{-- Left: Text --}}
                <div class="reveal">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 text-sm font-semibold rounded-full mb-6">
                        <span class="w-2 h-2 bg-indigo-500 rounded-full animate-pulse"></span>
                        Platform Magang #1 untuk Mahasiswa
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight tracking-tight">
                        Temukan kesempatan
                        <span class="hero-gradient">magang terbaik</span>
                        di perusahaan ternama
                    </h1>

                    <p class="mt-6 text-lg text-slate-500 leading-relaxed max-w-lg">
                        Bergabung dengan InternHub dan mulai perjalanan karir Anda. Akses ratusan lowongan magang dari berbagai perusahaan terbaik di Indonesia.
                    </p>

                    <div class="flex flex-wrap gap-4 mt-8">
                        <a href="#lowongan" class="inline-flex items-center gap-2 px-7 py-3.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white font-bold rounded-2xl shadow-xl shadow-indigo-500/25 hover:shadow-indigo-500/40 hover:from-indigo-500 hover:to-violet-500 transition-all duration-300 transform hover:scale-[1.02]">
                            Jelajahi Lowongan
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                        @auth
                            @php
                                $heroDashRoute = match(auth()->user()->role) {
                                    'admin'     => route('admin.dashboard'),
                                    'dosen'     => route('dosen.dashboard'),
                                    'mahasiswa' => route('mahasiswa.dashboard'),
                                    default     => route('home'),
                                };
                            @endphp
                            <a href="{{ $heroDashRoute }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-slate-700 font-bold rounded-2xl border-2 border-slate-200 hover:border-indigo-300 hover:text-indigo-600 transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                Ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-7 py-3.5 bg-white text-slate-700 font-bold rounded-2xl border-2 border-slate-200 hover:border-indigo-300 hover:text-indigo-600 transition-all duration-300">
                                Daftar Gratis
                            </a>
                        @endauth
                    </div>
                </div>

                {{-- Right: Visual with floating stat cards --}}
                <div class="relative reveal hidden lg:block">
                    {{-- Main illustration card --}}
                    <div class="relative bg-gradient-to-br from-indigo-50 via-violet-50 to-blue-50 rounded-3xl p-8 lg:p-10">
                        {{-- Decorative circles --}}
                        <div class="absolute top-4 right-4 w-20 h-20 bg-indigo-200/30 rounded-full"></div>
                        <div class="absolute bottom-6 left-6 w-14 h-14 bg-violet-200/30 rounded-full"></div>

                        {{-- Illustration content --}}
                        <div class="relative z-10 text-center">
                            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-indigo-500 to-violet-500 rounded-3xl flex items-center justify-center shadow-2xl shadow-indigo-500/30 rotate-3">
                                <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-slate-500 text-sm">Mulai Perjalanan Karir Anda</p>
                        </div>

                        {{-- Team avatars --}}
                        <div class="flex justify-center mt-6 -space-x-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 ring-3 ring-white flex items-center justify-center text-white text-xs font-bold">RP</div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 ring-3 ring-white flex items-center justify-center text-white text-xs font-bold">DP</div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 ring-3 ring-white flex items-center justify-center text-white text-xs font-bold">AL</div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 ring-3 ring-white flex items-center justify-center text-white text-xs font-bold">BS</div>
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-400 to-purple-500 ring-3 ring-white flex items-center justify-center text-white text-xs font-bold">CD</div>
                        </div>
                    </div>

                    {{-- Floating stat cards --}}
                    <div class="absolute -top-6 -left-6 stat-float">
                        <div class="bg-white rounded-2xl px-5 py-4 shadow-xl shadow-indigo-500/10 border border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium">Lowongan Tersedia</p>
                                    <p class="text-lg font-extrabold text-slate-800">{{ $stats['vacancies'] }}+</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-4 -left-4 stat-float" style="animation-delay: -2s;">
                        <div class="bg-white rounded-2xl px-5 py-4 shadow-xl shadow-emerald-500/10 border border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium">Mahasiswa Terdaftar</p>
                                    <p class="text-lg font-extrabold text-slate-800">{{ $stats['students'] }}+</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="absolute -bottom-2 -right-4 stat-float" style="animation-delay: -4s;">
                        <div class="bg-white rounded-2xl px-5 py-4 shadow-xl shadow-violet-500/10 border border-slate-100">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-violet-100 rounded-xl flex items-center justify-center">
                                    <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 font-medium">Perusahaan Mitra</p>
                                    <p class="text-lg font-extrabold text-slate-800">{{ $stats['companies'] }}+</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════ STATS BAR (Mobile friendly) ═══════════════════════ --}}
    <section class="py-8 lg:hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-3 gap-4">
                <div class="text-center p-4 bg-indigo-50 rounded-2xl">
                    <p class="text-2xl font-extrabold text-indigo-600">{{ $stats['vacancies'] }}+</p>
                    <p class="text-xs text-slate-500 mt-1">Lowongan</p>
                </div>
                <div class="text-center p-4 bg-emerald-50 rounded-2xl">
                    <p class="text-2xl font-extrabold text-emerald-600">{{ $stats['students'] }}+</p>
                    <p class="text-xs text-slate-500 mt-1">Mahasiswa</p>
                </div>
                <div class="text-center p-4 bg-violet-50 rounded-2xl">
                    <p class="text-2xl font-extrabold text-violet-600">{{ $stats['companies'] }}+</p>
                    <p class="text-xs text-slate-500 mt-1">Perusahaan</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════ SEARCH & FILTER BAR ═══════════════════════ --}}
    <section id="lowongan" class="py-12 lg:py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Section header --}}
            <div class="text-center mb-10 reveal">
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    Cari <span class="hero-gradient">Lowongan Magang</span>
                </h2>
                <p class="mt-3 text-slate-500 max-w-xl mx-auto">Temukan posisi magang yang sesuai dengan minat dan jurusan Anda</p>
            </div>

            {{-- Search / Filter Card --}}
            <div class="bg-white rounded-3xl border border-slate-200 shadow-xl shadow-slate-200/50 p-6 mb-10 reveal">
                <form action="{{ url('/') }}" method="GET" id="filterForm">
                    {{-- Search Bar --}}
                    <div class="search-input flex items-center gap-3 bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 mb-4 transition-all duration-300">
                        <svg class="w-5 h-5 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari posisi magang... (contoh: Backend Developer, Data Analyst)"
                               class="flex-1 bg-transparent border-none outline-none text-sm text-slate-700 placeholder-slate-400">
                        <button type="submit" class="shrink-0 px-5 py-2 bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-sm font-semibold rounded-xl hover:from-indigo-500 hover:to-violet-500 transition-all duration-200 shadow-md shadow-indigo-500/25">
                            <svg class="w-4 h-4 sm:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <span class="hidden sm:inline">Cari</span>
                        </button>
                    </div>

                    {{-- Filter Row --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                        <div class="relative">
                            <select name="company" onchange="document.getElementById('filterForm').submit()" class="w-full appearance-none bg-slate-50 border border-slate-200 text-sm text-slate-600 rounded-xl px-4 py-3 pr-10 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
                                <option value="">Semua Perusahaan</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}" {{ request('company') == $company->id ? 'selected' : '' }}>{{ $company->company_name }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>

                        <div class="relative">
                            <select name="industri" onchange="document.getElementById('filterForm').submit()" class="w-full appearance-none bg-slate-50 border border-slate-200 text-sm text-slate-600 rounded-xl px-4 py-3 pr-10 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
                                <option value="">Semua Industri</option>
                                @foreach($industries as $industri)
                                    <option value="{{ $industri }}" {{ request('industri') == $industri ? 'selected' : '' }}>{{ $industri }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>

                        <div class="relative">
                            <select name="lokasi" onchange="document.getElementById('filterForm').submit()" class="w-full appearance-none bg-slate-50 border border-slate-200 text-sm text-slate-600 rounded-xl px-4 py-3 pr-10 focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none transition">
                                <option value="">Semua Lokasi</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc }}" {{ request('lokasi') == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>

                    @if(request()->hasAny(['search', 'company', 'industri', 'lokasi']))
                        <div class="mt-3 flex items-center gap-2">
                            <a href="{{ url('/') }}" class="inline-flex items-center gap-1 text-xs text-red-500 hover:text-red-600 font-medium transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                Hapus semua filter
                            </a>
                        </div>
                    @endif
                </form>
            </div>

            {{-- ═══════════ VACANCY CARDS GRID ═══════════ --}}
            @if($vacancies->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($vacancies as $vacancy)
                        <div class="vacancy-card bg-white border border-slate-200 rounded-3xl overflow-hidden reveal">
                            {{-- Card Header --}}
                            <div class="p-6 pb-4">
                                {{-- Company Logo/Avatar + Name --}}
                                <div class="flex items-start gap-3 mb-4">
                                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-100 to-slate-50 border border-slate-200 flex items-center justify-center shrink-0">
                                        <span class="text-sm font-bold text-indigo-600">{{ strtoupper(substr($vacancy->company->company_name, 0, 2)) }}</span>
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs text-slate-400 font-medium truncate">{{ $vacancy->company->company_name }}</p>
                                        <h3 class="text-base font-bold text-slate-800 mt-0.5 line-clamp-2 leading-snug">{{ $vacancy->posisi }}</h3>
                                    </div>
                                </div>

                                {{-- Location --}}
                                <div class="flex items-center gap-1.5 text-xs text-slate-400 mb-3">
                                    <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="truncate">{{ $vacancy->company->lokasi }}</span>
                                </div>

                                {{-- Applicants & Quota --}}
                                <div class="flex items-center gap-4 text-xs text-slate-400 mb-4">
                                    <span class="flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                        {{ $vacancy->kuota }} Posisi
                                    </span>
                                    <span>•</span>
                                    <span>{{ $vacancy->applications->count() }} Pelamar</span>
                                </div>

                                {{-- Tags --}}
                                <div class="flex flex-wrap gap-2">
                                    <span class="tag-pill bg-indigo-50 text-indigo-700 border border-indigo-100">Magang</span>
                                    <span class="tag-pill bg-amber-50 text-amber-700 border border-amber-100">{{ $vacancy->durasi_bulan }} bulan</span>
                                    <span class="tag-pill bg-emerald-50 text-emerald-700 border border-emerald-100">Onsite</span>
                                </div>
                            </div>

                            {{-- Card Footer --}}
                            <div class="px-6 py-4 bg-slate-50/70 border-t border-slate-100">
                                <div class="flex items-center justify-between">
                                    <p class="text-xs text-slate-400">
                                        <svg class="w-3.5 h-3.5 inline-block mr-0.5 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        Diterbitkan {{ $vacancy->created_at->diffForHumans() }}
                                    </p>
                                </div>

                                @auth
                                    <a href="{{ route('mahasiswa.vacancies.show', $vacancy) }}" class="mt-3 w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-sm font-semibold rounded-xl hover:from-indigo-500 hover:to-violet-500 shadow-md shadow-indigo-500/20 transition-all duration-300">
                                        Lihat Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="mt-3 w-full inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 text-white text-sm font-semibold rounded-xl hover:from-indigo-500 hover:to-violet-500 shadow-md shadow-indigo-500/20 transition-all duration-300">
                                        Lihat Detail
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-10 flex justify-center">
                    {{ $vacancies->withQueryString()->links() }}
                </div>
            @else
                {{-- Empty State --}}
                <div class="text-center py-20">
                    <div class="w-20 h-20 mx-auto bg-slate-100 rounded-2xl flex items-center justify-center mb-4">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-600">Tidak ada lowongan ditemukan</h3>
                    <p class="text-sm text-slate-400 mt-1 max-w-sm mx-auto">Coba ubah kata kunci atau filter pencarian Anda.</p>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-2 mt-4 px-5 py-2.5 bg-indigo-50 text-indigo-600 text-sm font-semibold rounded-xl hover:bg-indigo-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        Reset Filter
                    </a>
                </div>
            @endif
        </div>
    </section>

    {{-- ═══════════════════════ PARTNER COMPANIES ═══════════════════════ --}}
    <section id="perusahaan" class="py-16 bg-gradient-to-b from-slate-50/50 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    Perusahaan <span class="hero-gradient">Mitra Kami</span>
                </h2>
                <p class="mt-3 text-slate-500">Bermitra dengan perusahaan terkemuka di Indonesia</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 reveal">
                @foreach($companies as $company)
                    <div class="group bg-white rounded-2xl p-6 border border-slate-200 hover:border-indigo-200 hover:shadow-xl hover:shadow-indigo-500/5 transition-all duration-300 text-center">
                        <div class="w-16 h-16 mx-auto bg-gradient-to-br from-indigo-50 to-violet-50 rounded-2xl flex items-center justify-center mb-4 group-hover:from-indigo-100 group-hover:to-violet-100 transition-all duration-300">
                            <span class="text-xl font-extrabold text-indigo-600">{{ strtoupper(substr($company->company_name, 0, 2)) }}</span>
                        </div>
                        <h3 class="font-bold text-sm text-slate-700 group-hover:text-indigo-600 transition-colors">{{ $company->company_name }}</h3>
                        <p class="text-xs text-slate-400 mt-1">{{ $company->bidang_industri }}</p>
                        <p class="text-xs text-indigo-500 font-semibold mt-2">{{ $company->activeVacancies()->count() }} Lowongan Aktif</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════ ABOUT / HOW IT WORKS ═══════════════════════ --}}
    <section id="tentang" class="py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 reveal">
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">
                    Cara Kerja <span class="hero-gradient">InternHub</span>
                </h2>
                <p class="mt-3 text-slate-500 max-w-xl mx-auto">Proses magang yang terkelola dengan baik dari awal hingga akhir</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 reveal">
                {{-- Step 1 --}}
                <div class="relative text-center group">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-indigo-500 to-violet-500 rounded-2xl flex items-center justify-center shadow-xl shadow-indigo-500/25 mb-6 group-hover:shadow-indigo-500/40 transition-all duration-300">
                        <span class="text-2xl font-extrabold text-white">1</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Daftar & Lengkapi Profil</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Buat akun mahasiswa, lengkapi biodata, dan unggah CV serta portofolio Anda.</p>
                </div>

                {{-- Step 2 --}}
                <div class="relative text-center group">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-violet-500 to-purple-500 rounded-2xl flex items-center justify-center shadow-xl shadow-violet-500/25 mb-6 group-hover:shadow-violet-500/40 transition-all duration-300">
                        <span class="text-2xl font-extrabold text-white">2</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Lamar Lowongan Magang</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Jelajahi lowongan magang dari berbagai perusahaan dan kirimkan lamaran Anda.</p>
                </div>

                {{-- Step 3 --}}
                <div class="relative text-center group">
                    <div class="w-16 h-16 mx-auto bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-xl shadow-emerald-500/25 mb-6 group-hover:shadow-emerald-500/40 transition-all duration-300">
                        <span class="text-2xl font-extrabold text-white">3</span>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Kelola Logbook & Laporan</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">Isi logbook harian, monitor progres, dan unggah laporan akhir magang Anda.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════ CTA SECTION ═══════════════════════ --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative bg-gradient-to-r from-indigo-600 via-violet-600 to-purple-600 rounded-3xl overflow-hidden reveal">
                {{-- Decorative --}}
                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 20px 20px;"></div>
                <div class="absolute top-0 right-0 w-72 h-72 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>

                <div class="relative px-8 py-16 lg:px-16 lg:py-20 text-center">
                    @auth
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Selamat Datang Kembali, {{ auth()->user()->name }}!</h2>
                        <p class="text-indigo-100 text-lg max-w-xl mx-auto mb-8">Kelola magang Anda dari dashboard. Pantau progres, isi logbook, dan kelola laporan dengan mudah.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            @php
                                $ctaDashRoute = match(auth()->user()->role) {
                                    'admin'     => route('admin.dashboard'),
                                    'dosen'     => route('dosen.dashboard'),
                                    'mahasiswa' => route('mahasiswa.dashboard'),
                                    default     => route('home'),
                                };
                            @endphp
                            <a href="{{ $ctaDashRoute }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-indigo-700 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:bg-indigo-50 transition-all duration-300 transform hover:scale-[1.02]">
                                Ke Dashboard
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                        </div>
                    @else
                        <h2 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">Siap Memulai Perjalanan Magang Anda?</h2>
                        <p class="text-indigo-100 text-lg max-w-xl mx-auto mb-8">Daftar sekarang dan temukan peluang magang terbaik yang sesuai dengan passion Anda.</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-indigo-700 font-bold rounded-2xl shadow-xl hover:shadow-2xl hover:bg-indigo-50 transition-all duration-300 transform hover:scale-[1.02]">
                                Daftar Sekarang
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white/10 text-white font-bold rounded-2xl border-2 border-white/20 hover:bg-white/20 transition-all duration-300">
                                Sudah Punya Akun? Masuk
                            </a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════ FOOTER ═══════════════════════ --}}
    <footer class="bg-slate-900 text-white pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 pb-12 border-b border-slate-700/50">
                {{-- Brand --}}
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-xl font-extrabold">
                            <span class="text-indigo-400">Intern</span><span class="text-white">Hub</span>
                        </span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed max-w-md">Sistem Informasi Manajemen Magang Mahasiswa — platform terintegrasi untuk mengelola proses magang dari pendaftaran hingga penilaian.</p>
                </div>

                {{-- Links --}}
                <div>
                    <h4 class="font-bold text-sm mb-4 text-slate-300 uppercase tracking-wide">Platform</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        <li><a href="#lowongan" class="hover:text-indigo-400 transition">Cari Lowongan</a></li>
                        <li><a href="#perusahaan" class="hover:text-indigo-400 transition">Perusahaan</a></li>
                        <li><a href="#tentang" class="hover:text-indigo-400 transition">Cara Kerja</a></li>
                    </ul>
                </div>

                {{-- Akun --}}
                <div>
                    <h4 class="font-bold text-sm mb-4 text-slate-300 uppercase tracking-wide">Akun</h4>
                    <ul class="space-y-2.5 text-sm text-slate-400">
                        @auth
                            @php
                                $footerDashRoute = match(auth()->user()->role) {
                                    'admin'     => route('admin.dashboard'),
                                    'dosen'     => route('dosen.dashboard'),
                                    'mahasiswa' => route('mahasiswa.dashboard'),
                                    default     => route('home'),
                                };
                            @endphp
                            <li><a href="{{ $footerDashRoute }}" class="hover:text-indigo-400 transition">Dashboard</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="hover:text-indigo-400 transition">Keluar</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="hover:text-indigo-400 transition">Login</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-indigo-400 transition">Daftar Mahasiswa</a></li>
                        @endauth
                    </ul>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-500">© {{ date('Y') }} InternHub. All rights reserved.</p>
                <p class="text-sm text-slate-500">Built with ❤️ for Indonesian Students</p>
            </div>
        </div>
    </footer>

    {{-- ═══════════════════════ SCRIPTS ═══════════════════════ --}}
    <script>
        // ─── Navbar scroll effect ───
        const nav = document.getElementById('mainNav');
        window.addEventListener('scroll', () => {
            nav.classList.toggle('navbar-scrolled', window.scrollY > 50);
        });

        // ─── Mobile menu toggle ───
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // ─── User dropdown toggle ───
        const userDropdownBtn = document.getElementById('userDropdownBtn');
        const userDropdown = document.getElementById('userDropdown');
        if (userDropdownBtn && userDropdown) {
            userDropdownBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('active');
            });
            document.addEventListener('click', (e) => {
                if (!userDropdown.contains(e.target) && !userDropdownBtn.contains(e.target)) {
                    userDropdown.classList.remove('active');
                }
            });
        }

        // ─── Scroll reveal animation ───
        const revealElements = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        revealElements.forEach(el => observer.observe(el));

        // ─── Close mobile menu on anchor click ───
        document.querySelectorAll('#mobileMenu a').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.add('hidden'));
        });
    </script>
</body>
</html>
