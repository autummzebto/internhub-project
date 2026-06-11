@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    <h2 class="text-2xl font-bold text-white mb-1">Selamat Datang</h2>
    <p class="text-slate-400 text-sm mb-6">Masuk ke akun InternHub Anda</p>

    <form action="{{ route('login') }}" method="POST" class="space-y-5">
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                   class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                   placeholder="nama@email.com">
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Password</label>
            <input type="password" id="password" name="password" required
                   class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all duration-200"
                   placeholder="••••••••">
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="remember" class="w-4 h-4 rounded border-white/20 bg-white/5 text-indigo-500 focus:ring-indigo-500 focus:ring-offset-0">
                <span class="text-sm text-slate-400">Ingat saya</span>
            </label>
        </div>

        <button type="submit"
                class="w-full py-3 px-4 rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-500 hover:to-indigo-400 text-white font-semibold shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:scale-[1.02]">
            Masuk
        </button>
    </form>

    <p class="text-center text-slate-400 text-sm mt-6">
        Belum punya akun?
        <a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-medium transition">Daftar sekarang</a>
    </p>
@endsection
