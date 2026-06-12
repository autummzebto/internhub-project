<a href="{{ route('dosen.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.dashboard') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('dosen.grading.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.grading.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
    Penilaian
</a>
<a href="{{ route('dosen.notifications.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('dosen.notifications.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
    Notifikasi
</a>
