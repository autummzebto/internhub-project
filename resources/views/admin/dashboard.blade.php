@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Administrator')
@section('sidebar-nav') @include('partials.sidebar-admin') @endsection

@section('content')
<div class="space-y-6 animate-fade-in">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @php $statItems = [
            ['label' => 'Mahasiswa', 'value' => $stats['total_students'], 'color' => 'blue', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
            ['label' => 'Dosen', 'value' => $stats['total_lecturers'], 'color' => 'purple', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
            ['label' => 'Perusahaan', 'value' => $stats['total_companies'], 'color' => 'emerald', 'icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4'],
            ['label' => 'Lowongan Aktif', 'value' => $stats['total_vacancies'], 'color' => 'amber', 'icon' => 'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z'],
        ]; @endphp
        @foreach($statItems as $item)
            <div class="rounded-2xl bg-slate-800/50 border border-white/5 p-5 card-hover">
                <div class="w-10 h-10 rounded-xl bg-{{ $item['color'] }}-500/20 flex items-center justify-center mb-3">
                    <svg class="w-5 h-5 text-{{ $item['color'] }}-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
                </div>
                <p class="text-2xl font-bold">{{ $item['value'] }}</p>
                <p class="text-xs text-slate-400 mt-1">{{ $item['label'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="rounded-2xl bg-gradient-to-r from-yellow-600/10 to-yellow-500/5 border border-yellow-500/20 p-5 card-hover">
            <p class="text-3xl font-bold text-yellow-400">{{ $stats['pending_applications'] }}</p>
            <p class="text-sm text-slate-400 mt-1">Lamaran Pending</p>
            <a href="{{ route('admin.applications.index', ['status' => 'pending']) }}" class="text-xs text-yellow-400 mt-2 inline-block">Proses Sekarang →</a>
        </div>
        <div class="rounded-2xl bg-gradient-to-r from-indigo-600/10 to-indigo-500/5 border border-indigo-500/20 p-5 card-hover">
            <p class="text-3xl font-bold text-indigo-400">{{ $stats['total_logbooks'] }}</p>
            <p class="text-sm text-slate-400 mt-1">Total Logbook</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-white/10"><h3 class="font-semibold">Lamaran Terbaru</h3></div>
            <div class="divide-y divide-white/5">
                @forelse($recentApplications as $app)
                    <div class="px-6 py-3 flex items-center justify-between">
                        <div><p class="text-sm font-medium">{{ $app->student->nama_lengkap }}</p><p class="text-xs text-slate-400">{{ $app->vacancy->posisi }} · {{ $app->vacancy->company->company_name }}</p></div>
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $app->status_lamaran === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : ($app->status_lamaran === 'verified_by_admin' ? 'bg-blue-500/20 text-blue-400' : ($app->status_lamaran === 'accepted_by_company' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-red-500/20 text-red-400')) }}">{{ $app->status_label }}</span>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500 text-sm">Belum ada lamaran</div>
                @endforelse
            </div>
        </div>
        <div class="rounded-2xl bg-slate-800/50 border border-white/5 overflow-hidden">
            <div class="px-6 py-4 border-b border-white/10"><h3 class="font-semibold">Logbook Terbaru</h3></div>
            <div class="divide-y divide-white/5">
                @forelse($recentLogbooks as $log)
                    <div class="px-6 py-3 flex items-center justify-between">
                        <div><p class="text-sm font-medium">{{ $log->student->nama_lengkap }}</p><p class="text-xs text-slate-400">{{ $log->tanggal->format('d M Y') }}</p></div>
                        <span class="text-xs {{ $log->validasi_dosen ? 'text-emerald-400' : 'text-yellow-400' }}">{{ $log->validasi_dosen ? '✓ Valid' : 'Pending' }}</span>
                    </div>
                @empty
                    <div class="px-6 py-8 text-center text-slate-500 text-sm">Belum ada logbook</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
