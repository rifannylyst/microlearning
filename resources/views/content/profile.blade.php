@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-10">

    <div class="max-w-3xl mx-auto">

        <!-- Header Card -->
        <div class="bg-gradient-to-tr from-blue-50 to-indigo-50/50 rounded-2xl border border-slate-200/60 p-8 text-slate-800 relative overflow-hidden shadow-sm">
            <!-- Grid pattern -->
            <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:1rem_1rem] opacity-35"></div>
            <!-- Glow abstract -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br from-blue-200/50 to-indigo-200/50 rounded-full filter blur-xl opacity-70"></div>
            
            <div class="flex items-center gap-5 relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-blue-600/10 border border-blue-500/20 text-blue-600 flex items-center justify-center text-2xl font-extrabold shadow-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <span class="text-[9px] font-bold px-2 py-0.5 bg-blue-100 text-blue-700 rounded uppercase tracking-wider mb-1.5 inline-block">
                        Profil Siswa
                    </span>
                    <h1 class="text-2xl font-extrabold tracking-tight text-slate-850 mb-0">
                        {{ auth()->user()->name }}
                    </h1>
                    <p class="text-xs text-slate-500 mt-1 font-semibold mb-0">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Detail Profil -->
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm mt-6 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                <h2 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-0">
                    Informasi Akun
                </h2>
            </div>
            @if(session('success'))
                <div class="mx-6 mt-4 bg-green-50 text-green-700 border border-green-200/50 px-4 py-3 rounded-xl text-xs font-semibold">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="p-6 space-y-5">

                    <!-- Nama -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">
                            Nama Lengkap
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', auth()->user()->name) }}"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">
                            Email
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', auth()->user()->email) }}"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>

                    <!-- Password Baru -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">
                            Password Baru
                        </label>
                        <input
                            type="password"
                            name="password"
                            placeholder="Kosongkan jika tidak ingin mengubah"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder-slate-400">
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label class="block text-xs font-bold text-slate-600 mb-1.5 uppercase tracking-wider">
                            Konfirmasi Password
                        </label>
                        <input
                            type="password"
                            name="password_confirmation"
                            class="w-full border border-slate-200 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                    </div>

                    <div class="pt-3 flex justify-center">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-xs font-semibold shadow-sm hover:shadow transition-all">
                            Simpan Perubahan
                        </button>
                    </div>

                </div>
            </form>

        </div>

    </div>

</div>
@endsection