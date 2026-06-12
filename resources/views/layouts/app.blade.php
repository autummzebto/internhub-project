<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="InternHub - Sistem Informasi Manajemen Magang Mahasiswa">
    <title>@yield('title', 'InternHub') - Sistem Manajemen Magang</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 min-h-screen dashboard-layout">
    <div class="flex min-h-screen" x-data="{ sidebarOpen: false }">
        {{-- Sidebar Overlay (Mobile) --}}
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-black/60 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- Sidebar --}}
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               class="fixed inset-y-0 left-0 z-50 w-72 transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-auto lg:z-auto">
            <div class="flex flex-col h-full bg-white border-r border-slate-200">
                {{-- Logo --}}
                <div class="flex items-center gap-3 px-6 py-6 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/25">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-extrabold tracking-tight">
                            <span class="text-indigo-600">Intern</span><span class="text-slate-800">Hub</span>
                        </h1>
                        <p class="text-xs text-slate-400">Manajemen Magang</p>
                    </div>
                    <button @click="sidebarOpen = false" class="lg:hidden ml-auto text-slate-400 hover:text-slate-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- User Info --}}
                <div class="px-6 py-4 border-b border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-violet-500 flex items-center justify-center text-white text-sm font-bold shadow-md shadow-indigo-500/20">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-slate-700 truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-slate-400">{{ auth()->user()->role_label }}</p>
                        </div>
                    </div>
                </div>

                {{-- Navigation --}}
                <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                    @yield('sidebar-nav')
                </nav>

                {{-- Logout --}}
                <div class="px-4 py-4 border-t border-slate-100">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm text-slate-500 hover:text-red-600 hover:bg-red-50 rounded-xl transition-all duration-200 font-semibold">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">
            {{-- Top Bar --}}
            <header class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-slate-200/80 shadow-sm">
                <div class="flex items-center justify-between px-4 sm:px-6 py-4">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = true" class="lg:hidden text-slate-500 hover:text-indigo-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <h2 class="text-lg sm:text-xl font-extrabold text-slate-800">@yield('page-title', 'Dashboard')</h2>
                    </div>

                    <div class="flex items-center gap-3">
                        {{-- Notification Bell --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="relative p-2 text-slate-500 hover:text-indigo-600 hover:bg-slate-50 rounded-xl transition-all duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                                @php $unreadCount = auth()->user()->appNotifications()->where('is_read', false)->count(); @endphp
                                @if($unreadCount > 0)
                                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs font-bold rounded-full flex items-center justify-center badge-bounce">{{ $unreadCount > 9 ? '9+' : $unreadCount }}</span>
                                @endif
                            </button>

                            {{-- Dropdown --}}
                            <div x-show="open" @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-80 sm:w-96 rounded-2xl border border-slate-200 bg-white shadow-2xl shadow-slate-200/50 overflow-hidden z-50">
                                <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
                                    <h3 class="font-bold text-sm text-slate-700">Notifikasi</h3>
                                    @if($unreadCount > 0)
                                        <span class="text-xs font-semibold text-indigo-600">{{ $unreadCount }} belum dibaca</span>
                                    @endif
                                </div>
                                <div class="max-h-80 overflow-y-auto">
                                    @php $latestNotifs = auth()->user()->appNotifications()->take(5)->get(); @endphp
                                    @forelse($latestNotifs as $notif)
                                        <div class="px-4 py-3 border-b border-slate-50 hover:bg-slate-50/50 transition {{ !$notif->is_read ? 'bg-indigo-50/30' : '' }}">
                                            <p class="text-sm font-bold {{ !$notif->is_read ? 'text-indigo-600' : 'text-slate-700' }}">{{ $notif->title }}</p>
                                            <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $notif->message }}</p>
                                            <p class="text-xs text-slate-400 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                                        </div>
                                    @empty
                                        <div class="px-4 py-8 text-center text-slate-400">
                                            <svg class="w-8 h-8 mx-auto mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                            <p class="text-sm">Tidak ada notifikasi</p>
                                        </div>
                                    @endforelse
                                </div>
                                @if($latestNotifs->isNotEmpty())
                                    <a href="{{ route(auth()->user()->role === 'mahasiswa' ? 'mahasiswa.notifications.index' : (auth()->user()->role === 'dosen' ? 'dosen.notifications.index' : 'admin.activity-log.index')) }}"
                                       class="block px-4 py-3 text-center text-sm font-bold text-indigo-600 hover:bg-slate-50 border-t border-slate-100 transition">
                                        Lihat Semua →
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            {{-- Flash Messages --}}
            @if(session('success'))
                <div class="mx-4 sm:mx-6 mt-4 animate-slide-up">
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-4 sm:mx-6 mt-4 animate-slide-up">
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mx-4 sm:mx-6 mt-4 animate-slide-up">
                    <div class="px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400">
                        <ul class="list-disc list-inside text-sm space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Page Content --}}
            <main class="flex-1 p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- Alpine.js CDN --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @stack('scripts')
</body>
</html>
