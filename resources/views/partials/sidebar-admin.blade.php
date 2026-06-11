<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<p class="px-4 pt-4 pb-1 text-xs font-semibold text-slate-500 uppercase tracking-wider">Master Data</p>
<a href="{{ route('admin.students.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.students.*') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
    Mahasiswa
</a>
<a href="{{ route('admin.lecturers.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.lecturers.*') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
    Dosen
</a>
<a href="{{ route('admin.companies.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.companies.*') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
    Perusahaan
</a>
<a href="{{ route('admin.vacancies.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.vacancies.*') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
    Lowongan
</a>
<p class="px-4 pt-4 pb-1 text-xs font-semibold text-slate-500 uppercase tracking-wider">Manajemen</p>
<a href="{{ route('admin.applications.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.applications.*') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    Verifikasi Lamaran
</a>
<a href="{{ route('admin.plottings.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.plottings.*') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
    Plotting Dosen
</a>
<a href="{{ route('admin.broadcast.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.broadcast.*') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
    Broadcast
</a>
<a href="{{ route('admin.activity-log.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm rounded-xl transition-all duration-200 {{ request()->routeIs('admin.activity-log.*') ? 'bg-indigo-500/20 text-indigo-300 font-medium' : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
    Activity Log
</a>
