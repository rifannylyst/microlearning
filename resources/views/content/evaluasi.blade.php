@extends('layouts.app')

@section('content')
<div class="container py-8 max-w-5xl mx-auto px-6">

    <!-- Header -->
    <div class="mb-10">
        <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Evaluasi Akhir</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">Ujian Evaluasi</h2>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">Uji seluruh kompetensi pemahaman materi pemrograman Anda melalui ujian evaluasi akhir terstandarisasi.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        @forelse($evaluasis as $evaluasi)

        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 hover:border-blue-500/20 transition-all duration-300 overflow-hidden flex flex-col h-full">
            {{-- Header card --}}
            <div class="bg-gradient-to-tr from-blue-50 to-indigo-50/50 relative overflow-hidden h-32 flex flex-col justify-between p-4 border-b border-slate-100">
                <!-- Grid pattern -->
                <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:1rem_1rem] opacity-35"></div>
                <!-- Glow abstract -->
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-blue-200/50 to-indigo-200/50 rounded-full filter blur-xl opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>

                <div class="flex justify-between items-start w-full relative z-20">
                    <span class="text-[9px] font-bold px-2 py-0.5 bg-blue-100 text-blue-700 rounded uppercase tracking-wider">
                        {{ $evaluasi->soal_count }} Soal
                    </span>
                </div>
                <div class="relative z-20">
                    <div class="w-8 h-8 rounded-lg bg-blue-600/10 flex items-center justify-center text-blue-600 border border-blue-200/30 group-hover:scale-105 transition-transform duration-300">
                        <i class="bi bi-clipboard-check text-sm"></i>
                    </div>
                </div>
            </div>

            {{-- Card Body --}}
            <div class="p-5 flex flex-col flex-1">
                <h3 class="font-bold text-slate-800 text-base group-hover:text-blue-600 transition-colors line-clamp-1 mb-1.5">
                    {{ $evaluasi->judul }}
                </h3>
                <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed flex-1 mb-5">
                    {{ $evaluasi->deskripsi }}
                </p>
                @if($evaluasi->hasil->isNotEmpty())
                <span class="inline-flex justify-center items-center w-30 h-10 bg-emerald-50 text-emerald-600 border border-emerald-100 px-3 py-1.5 rounded-full text-xs font-semibold">
                    Nilai: {{ $evaluasi->hasil->last()->nilai }}
                </span>
                @else
                <span class="inline-flex justify-center items-center w-40 h-10 bg-red-50 text-red-600 border border-red-100/50 px-3 py-1.5 rounded-full text-xs font-semibold">
                    Belum Mengerjakan
                </span>
                @endif

                @php
                    $sudahMengerjakan = $evaluasi->hasil->isNotEmpty();
                @endphp
                <br>
    
                <a href="{{ $sudahMengerjakan ? route('siswa.evaluasi.hasil', $evaluasi->id) : route('siswa.evaluasi.show', $evaluasi->id) }}"
                   class="mt-auto block text-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 px-4 rounded-xl text-xs font-bold shadow-sm shadow-blue-500/10 hover:shadow transition-all no-underline">
                    {{ $sudahMengerjakan ? 'Lihat Hasil' : 'Mulai Evaluasi' }}
                </a>
            </div>
        </div>

        @empty

        <div class="col-span-full bg-slate-50 border border-slate-100 text-slate-400 p-6 rounded-2xl text-center font-medium">
            Belum ada evaluasi tersedia.
        </div>

        @endforelse

    </div>

</div>
@endsection