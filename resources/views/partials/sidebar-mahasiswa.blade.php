<a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('mahasiswa.profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.profile.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
    Profil Saya
</a>
<a href="{{ route('mahasiswa.vacancies.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.vacancies.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
    Lowongan Magang
</a>
<a href="{{ route('mahasiswa.applications.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.applications.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    Lamaran Saya
</a>
<a href="{{ route('mahasiswa.logbooks.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.logbooks.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
    Logbook Harian
</a>
<a href="{{ route('mahasiswa.final-report.create') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.final-report.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
    Laporan Akhir
</a>
<a href="{{ route('mahasiswa.notifications.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('mahasiswa.notifications.*') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm' : 'text-slate-600 hover:text-indigo-600 hover:bg-indigo-50/50' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
    Notifikasi
</a>
