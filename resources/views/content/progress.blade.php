@extends('layouts.app')

@section('content')

<div class="container py-8 max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="mb-10 px-6">
        <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Progres Belajar</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">Pembelajaran Saya</h2>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">Pantau statistik kemajuan belajar Anda, capai target kompetensi, dan lanjutkan modul materi terakhir yang dipelajari.</p>
    </div>

    <!-- CONTENT -->
    <section class="flex-1 py-4">
        <div class="max-w-7xl mx-auto px-6">
            {{-- JIKA BELUM ADA PROGRESS --}}
            @if(!$punyaProgress)
                <div class="bg-white rounded-2xl border border-slate-100 p-16 text-center shadow-sm max-w-xl mx-auto">
                    <div class="w-20 h-20 mx-auto bg-slate-50 rounded-2xl flex items-center justify-center border border-slate-100 mb-6">
                        <i class="bi bi-book text-3xl text-slate-300"></i>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800 mb-2">
                        Mulai Perjalanan Belajar Anda
                    </h2>
                    <p class="text-slate-500 text-xs mb-8 max-w-xs mx-auto leading-relaxed">
                        Silakan pilih dan daftar pada materi pembelajaran kami untuk memantau progres belajar Anda secara terarah.
                    </p>
                    <a href="{{ route('materi.index') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-6 py-2.5 rounded-xl text-xs font-semibold shadow-sm shadow-blue-500/10 transition-all duration-200">
                        Jelajahi Katalog Materi
                    </a>
                </div>
            @else
                {{-- LIST PROGRESS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($materis as $materi)
                        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 hover:border-blue-500/20 transition-all duration-300 overflow-hidden flex flex-col h-full">
                            {{-- THUMBNAIL / CARD HEADER --}}
                            <div class="bg-gradient-to-tr from-blue-50 to-indigo-50/50 relative overflow-hidden h-36 flex flex-col justify-between p-4 border-b border-slate-100">
                                <!-- Glow bubble backdrop -->
                                <div class="absolute -top-10 -right-10 w-24 h-24 bg-gradient-to-br from-blue-200/50 to-indigo-200/50 rounded-full filter blur-xl opacity-70 group-hover:opacity-90 transition-opacity duration-300"></div>
                                <!-- Grid pattern -->
                                <div class="absolute inset-0 bg-[linear-gradient(to_right,#e2e8f0_1px,transparent_1px),linear-gradient(to_bottom,#e2e8f0_1px,transparent_1px)] bg-[size:1rem_1rem] opacity-35"></div>
                                
                                <span class="text-[9px] font-bold self-start px-2 py-0.5 bg-blue-100 text-blue-700 rounded uppercase tracking-wider relative z-20">
                                    Progres Belajar
                                </span>
                                <div class="relative z-20">
                                    <div class="w-8 h-8 rounded-lg bg-blue-600/10 flex items-center justify-center text-blue-600 border border-blue-200/30 group-hover:scale-105 transition-transform duration-300">
                                        <i class="bi bi-journal-richtext text-sm"></i>
                                    </div>
                                </div>
                            </div>
                            {{-- BODY --}}
                            <div class="p-5 flex-1 flex flex-col">
                                {{-- JUDUL --}}
                                <h3 class="font-bold text-slate-800 text-base mb-1.5">
                                    {{ $materi->judul }}
                                </h3>
                                {{-- DESKRIPSI --}}
                                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed mb-5">
                                    {{ $materi->deskripsi }}
                                </p>
                                {{-- DETAIL PROGRESS BERDASARKAN TIPE --}}
                                <div class="space-y-3.5 mb-6">
                                @php
                                    $progressMateri = $progress[$materi->id]['materi'][0] ?? null;
                                    $progressVideo  = $progress[$materi->id]['video'][0] ?? null;
                                    $progressAudio  = $progress[$materi->id]['audio'][0] ?? null;
                                @endphp

                                @foreach([
                                    [
                                        'title' => 'Materi',
                                        'icon' => 'file-earmark-text',
                                        'bg' => 'bg-blue-50 text-blue-600 border-blue-100/50',
                                        'bar' => 'bg-blue-500',
                                        'data' => $progressMateri
                                    ],
                                    [
                                        'title' => 'Video',
                                        'icon' => 'play-circle',
                                        'bg' => 'bg-red-50 text-red-600 border-red-100/50',
                                        'bar' => 'bg-red-500',
                                        'data' => $progressVideo
                                    ],
                                    [
                                        'title' => 'Audio',
                                        'icon' => 'headphones',
                                        'bg' => 'bg-emerald-50 text-emerald-600 border-emerald-100/50',
                                        'bar' => 'bg-emerald-500',
                                        'data' => $progressAudio
                                    ]
                                ] as $item)

                                    @php
                                        $persen = $item['data']->persentase ?? 0;
                                        $statusRaw = $item['data']->status ?? 'belum_dimulai';
                                        $status = str_replace('_', ' ', $statusRaw);
                                        
                                        // Status dot color
                                        $dotColor = 'bg-slate-300';
                                        if ($statusRaw === 'selesai') {
                                            $dotColor = 'bg-emerald-500 animate-pulse';
                                        } elseif ($statusRaw === 'sedang_dipelajari') {
                                            $dotColor = 'bg-blue-500 animate-pulse';
                                        }
                                    @endphp

                                    <div class="bg-slate-50/50 border border-slate-100 p-3 rounded-xl transition-colors">
                                        <div class="flex items-center justify-between mb-2">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-8.5 h-8.5 rounded-lg {{ $item['bg'] }} flex items-center justify-center border shrink-0">
                                                    <i class="bi bi-{{ $item['icon'] }} text-sm"></i>
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-slate-800 text-[13px]">
                                                        {{ $item['title'] }}
                                                    </h4>
                                                    <p class="text-[10px] text-slate-400 mt-0.5">
                                                        Progress {{ strtolower($item['title']) }}
                                                    </p>
                                                </div>
                                            </div>
                                            <span class="text-xs font-bold text-slate-800">
                                                {{ $persen }}%
                                            </span>
                                        </div>

                                        <div class="w-full bg-slate-200/50 rounded-full h-1.5 overflow-hidden">
                                            <div
                                                class="{{ $item['bar'] }} h-1.5 rounded-full transition-all duration-500"
                                                style="width: {{ $persen }}%">
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2 mt-2.5">
                                            <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }} shrink-0"></span>
                                            <span class="text-[10px] text-slate-500 font-semibold uppercase tracking-wider capitalize leading-none">
                                                {{ $status }}
                                            </span>
                                        </div>
                                    </div>

                                @endforeach

                            </div>
                                {{-- HASIL QUIZ --}}
                                @if($materi->quiz->count())

                                <div class="mb-6">
                                    <h3 class="font-bold text-slate-800 text-[11px] uppercase tracking-wider mb-2.5">
                                        Hasil Quiz
                                    </h3>

                                    <div class="space-y-2.5">
                                        @foreach($materi->quiz as $quiz)
                                            @php
                                                $hasil = $quiz->hasilQuiz->first();
                                            @endphp

                                            <div class="bg-slate-50/30 border border-slate-100 p-3 rounded-xl flex items-center justify-between hover:bg-slate-50 transition-colors">
                                                <div>
                                                    <h4 class="font-bold text-slate-800 text-xs">
                                                        {{ $quiz->judul }}
                                                    </h4>
                                                    @if($hasil)
                                                        <p class="text-[11px] text-slate-500 mt-0.5 font-medium">
                                                            Nilai: <span class="text-blue-600 font-bold">{{ $hasil->score }}</span>
                                                        </p>
                                                    @else
                                                        <p class="text-[11px] text-slate-400 mt-0.5">
                                                            Belum mengerjakan quiz
                                                        </p>
                                                    @endif
                                                </div>

                                                @if(!$hasil)
                                                    <span class="bg-slate-100 text-slate-500 border border-slate-200/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                                        Belum Lulus
                                                    </span>
                                                @elseif($hasil->status == 'lulus')
                                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                                        Lulus
                                                    </span>
                                                @else
                                                    <span class="bg-red-50 text-red-600 border border-red-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                                        Tidak Lulus
                                                    </span>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                {{-- BUTTON --}}
                                <a href="{{ route('materi.konten', $materi->id) }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-xl text-xs font-semibold shadow-sm hover:shadow transition-all mt-auto">
                                    Lanjutkan Belajar
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
</div>
@endsection