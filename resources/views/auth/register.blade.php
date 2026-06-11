@extends('layouts.guest')
@section('title', 'Register')

@section('content')
    <h2 class="text-2xl font-bold text-white mb-1">Daftar Akun</h2>
    <p class="text-slate-400 text-sm mb-6">Buat akun mahasiswa untuk mulai magang</p>

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-slate-300 mb-1.5">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                       placeholder="Nama lengkap">
            </div>
            <div>
                <label for="nim" class="block text-sm font-medium text-slate-300 mb-1.5">NIM</label>
                <input type="text" id="nim" name="nim" value="{{ old('nim') }}" required
                       class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                       placeholder="202310001">
            </div>
        </div>

        <div>
            <label for="nama_lengkap" class="block text-sm font-medium text-slate-300 mb-1.5">Nama Lengkap</label>
            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                   class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                   placeholder="Nama lengkap sesuai KTP">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                   class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                   placeholder="nama@email.com">
        </div>

        <div>
            <label for="jurusan" class="block text-sm font-medium text-slate-300 mb-1.5">Jurusan</label>
            <select id="jurusan" name="jurusan" required
                    class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200">
                <option value="" class="bg-slate-800">Pilih Jurusan</option>
                <option value="Teknik Informatika" {{ old('jurusan') == 'Teknik Informatika' ? 'selected' : '' }} class="bg-slate-800">Teknik Informatika</option>
                <option value="Sistem Informasi" {{ old('jurusan') == 'Sistem Informasi' ? 'selected' : '' }} class="bg-slate-800">Sistem Informasi</option>
                <option value="Bisnis Digital" {{ old('jurusan') == 'Bisnis Digital' ? 'selected' : '' }} class="bg-slate-800">Bisnis Digital</option>
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                       placeholder="Min. 8 karakter">
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-300 mb-1.5">Konfirmasi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       class="w-full px-4 py-2.5 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-all duration-200"
                       placeholder="Ulangi password">
            </div>
        </div>

        <button type="submit"
                class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:scale-[1.02]">
            Daftar Sekarang
        </button>
    </form>

    <p class="text-center text-slate-400 text-sm mt-6">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition">Masuk</a>
    </p>
@endsection
