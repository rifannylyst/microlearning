@extends('admin.layouts.app')

@section('content')
<div class="space-y-8">
    {{-- Welcome Banner --}}
    <div class="bg-blue-600 rounded-2xl p-7 text-white shadow-md shadow-blue-500/5 relative overflow-hidden">
        <!-- Glow accents inside banner -->
        <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/10 rounded-full filter blur-2xl opacity-60 pointer-events-none"></div>
        <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-indigo-500/20 rounded-full filter blur-xl opacity-60 pointer-events-none"></div>
        <!-- Grid pattern overlay -->
        <div class="absolute inset-0 bg-[linear-gradient(to_right,rgba(255,255,255,0.05)_1px,transparent_1px),linear-gradient(to_bottom,rgba(255,255,255,0.05)_1px,transparent_1px)] bg-[size:1.25rem_1.25rem] opacity-40 pointer-events-none"></div>
        
        <div class="relative z-10 max-w-3xl">
            <span class="text-[9px] font-bold px-2.5 py-0.5 bg-white/15 backdrop-blur-md text-white rounded-full uppercase tracking-wider mb-3.5 inline-block">
                Pusat Kendali Admin
            </span>
            <h2 class="text-2xl font-extrabold tracking-tight text-white m-0 leading-tight">
                Selamat Datang di Portal Admin MicroLearn, {{ auth()->user()->name }}!
            </h2>
            <p class="text-xs text-blue-100 mt-2.5 leading-relaxed font-medium opacity-90 max-w-2xl">
                Kelola kurikulum microlearning secara interaktif, pantau grafik pertumbuhan akademik siswa, serta konfigurasikan bank soal evaluasi dalam satu lingkungan dashboard terpadu.
            </p>
        </div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @php
            $stats = [
                [
                    'label' => 'Total Materi',
                    'value' => \App\Models\Materi::count(),
                    'icon' => 'bi-book',
                    'color' => 'from-blue-500 to-blue-600',
                    'bg_light' => 'bg-blue-50 text-blue-600',
                    'route' => route('admin.materi')
                ],
                [
                    'label' => 'Total Konten',
                    'value' => \App\Models\KontenMateri::count(),
                    'icon' => 'bi-file-earmark-play',
                    'color' => 'from-cyan-500 to-cyan-600',
                    'bg_light' => 'bg-cyan-50 text-cyan-600',
                    'route' => route('admin.materi')
                ],
                [
                    'label' => 'Total Siswa',
                    'value' => \App\Models\User::where('role', 'user')->count(),
                    'icon' => 'bi-people',
                    'color' => 'from-violet-500 to-violet-600',
                    'bg_light' => 'bg-violet-50 text-violet-600',
                    'route' => route('admin.progress')
                ],
                [
                    'label' => 'Kuis Aktif',
                    'value' => \App\Models\Quiz::count(),
                    'icon' => 'bi-question-circle',
                    'color' => 'from-amber-500 to-amber-600',
                    'bg_light' => 'bg-amber-50 text-amber-600',
                    'route' => route('admin.evaluasi')
                ]
            ];
        @endphp

        @foreach($stats as $stat)
        <a href="{{ $stat['route'] }}" class="group bg-white rounded-2xl p-5 border border-slate-200/60 hover:border-blue-500/20 shadow-sm hover:shadow-md transition-all duration-300 flex items-center justify-between no-underline">
            <div>
                <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider block">{{ $stat['label'] }}</span>
                <span class="text-2xl font-extrabold text-slate-800 block mt-1.5">{{ $stat['value'] }}</span>
            </div>
            <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-300 {{ $stat['bg_light'] }} group-hover:scale-110">
                <i class="bi {{ $stat['icon'] }} text-xl"></i>
            </div>
        </a>
        @endforeach
    </div>

    {{-- Shortcuts / Quick Actions --}}
    <div class="bg-white rounded-2xl border border-slate-200/60 p-6 shadow-sm">
        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-5">Akses Cepat Pengelolaan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.materi') }}" class="flex items-center gap-3.5 p-4 rounded-xl border border-slate-200/60 hover:border-blue-500/20 hover:bg-slate-50/50 transition-all duration-200 no-underline">
                <div class="w-10 h-10 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center"><i class="bi bi-journal-plus text-lg"></i></div>
                <div>
                    <h4 class="text-sm font-semibold text-slate-700">Materi</h4>
                    <p class="text-xs text-slate-400 mt-1">Kelola & tambah pelajaran</p>
                </div>
            </a>
            <a href="{{ route('admin.progress') }}" class="flex items-center gap-3.5 p-4 rounded-xl border border-slate-200/60 hover:border-blue-500/20 hover:bg-slate-50/50 transition-all duration-200 no-underline">
                <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center"><i class="bi bi-graph-up text-lg"></i></div>
                <div>
                    <h4 class="text-sm font-semibold text-slate-700">Progress Siswa</h4>
                    <p class="text-xs text-slate-400 mt-1">Pantau data belajar siswa</p>
                </div>
            </a>
            <a href="{{ route('admin.evaluasi') }}" class="flex items-center gap-3.5 p-4 rounded-xl border border-slate-200/60 hover:border-blue-500/20 hover:bg-slate-50/50 transition-all duration-200 no-underline">
                <div class="w-10 h-10 rounded-lg bg-violet-50 text-violet-600 flex items-center justify-center"><i class="bi bi-clipboard-check text-lg"></i></div>
                <div>
                    <h4 class="text-sm font-semibold text-slate-700">Evaluasi</h4>
                    <p class="text-xs text-slate-400 mt-1">Buat soal & penilaian kuis</p>
                </div>
            </a>
            <a href="{{ route('admin.pengguna') }}" class="flex items-center gap-3.5 p-4 rounded-xl border border-slate-200/60 hover:border-blue-500/20 hover:bg-slate-50/50 transition-all duration-200 no-underline">
                <div class="w-10 h-10 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center"><i class="bi bi-people text-lg"></i></div>
                <div>
                    <h4 class="text-sm font-semibold text-slate-700">Pengguna</h4>
                    <p class="text-xs text-slate-400 mt-1">Lihat daftar user & admin</p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection