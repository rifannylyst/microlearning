@extends('layouts.app')

@section('content')

<div class="container py-8 max-w-5xl mx-auto px-6">

    <!-- HEADER -->
    <div class="mb-10">
        <span class="text-blue-600 font-bold text-xs uppercase tracking-wider bg-blue-50 px-3 py-1.5 rounded-full">Menu Belajar</span>
        <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-4">{{ $materi->judul }}</h2>
        <p class="text-slate-500 text-xs sm:text-sm mt-1">{{ $materi->deskripsi }}</p>
    </div>

    <!-- CARD MENU -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <!-- CARD MATERI -->
        <a href="{{ route('materi.konten.tipe', ['id' => $materi->id, 'tipe' => 'materi']) }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 hover:border-blue-500/20 transition-all duration-300 p-6 flex flex-col h-full transform hover:-translate-y-1 no-underline">
            <div class="flex flex-col items-center text-center h-full">
                <div class="w-16 h-16 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center mb-4 border border-blue-100/50 group-hover:scale-105 transition-transform duration-300">
                    <i class="bi bi-file-earmark-text text-2xl"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm mb-1.5">
                    Materi
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed flex-1">
                    Pelajari materi komprehensif berbasis dokumen teks untuk memahami teori dasar secara terstruktur.
                </p>
                @if($notifMateri)
                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                    Sudah Diselesaikan
                    </span>
                @else
                    <span class="bg-red-50 text-red-600 border border-red-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                    Belum Diselesaikan
                    </span>
                @endif
                <div class="mt-5 inline-flex items-center justify-center gap-1.5 bg-blue-600 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm group-hover:bg-blue-700 transition-colors w-full">
                    Buka Materi <i class="bi bi-arrow-right text-[10px]"></i>
                </div>
            </div>
        </a>

        <!-- CARD VIDEO -->
        <a href="{{ route('materi.konten.tipe', ['id' => $materi->id, 'tipe' => 'video']) }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 hover:border-red-500/20 transition-all duration-300 p-6 flex flex-col h-full transform hover:-translate-y-1 no-underline">
            <div class="flex flex-col items-center text-center h-full">
                <div class="w-16 h-16 rounded-full bg-red-50 text-red-600 flex items-center justify-center mb-4 border border-red-100/50 group-hover:scale-105 transition-transform duration-300">
                    <i class="bi bi-play-circle text-2xl"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm mb-1.5">
                    Video
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed flex-1">
                    Tonton demonstrasi visual dan panduan video interaktif untuk pengalaman belajar langsung yang praktis.
                </p>
                @if($notifVideo)
                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                    Sudah Diselesaikan
                    </span>
                @else
                    <span class="bg-red-50 text-red-600 border border-red-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                    Belum Diselesaikan
                    </span>
                @endif
                <div class="mt-5 inline-flex items-center justify-center gap-1.5 bg-red-600 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm group-hover:bg-red-700 transition-colors w-full">
                    Buka Video <i class="bi bi-play-btn text-[10px]"></i>
                </div>
            </div>
        </a>

        <!-- CARD AUDIO -->
        <a href="{{ route('materi.konten.tipe', ['id' => $materi->id, 'tipe' => 'audio']) }}" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl border border-slate-100 hover:border-emerald-500/20 transition-all duration-300 p-6 flex flex-col h-full transform hover:-translate-y-1 no-underline">
            <div class="flex flex-col items-center text-center h-full">
                <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center mb-4 border border-emerald-100/50 group-hover:scale-105 transition-transform duration-300">
                    <i class="bi bi-headphones text-2xl"></i>
                </div>
                <h3 class="font-bold text-slate-800 text-sm mb-1.5">
                    Audio
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2 leading-relaxed flex-1">
                    Dengarkan pembahasan audio ringkas dan penjelasan konsep penting secara fleksibel di mana pun Anda berada.
                </p>
                @if($notifAudio)
                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                    Sudah Diselesaikan
                    </span>
                 @else
                    <span class="bg-red-50 text-red-600 border border-red-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                    Belum Diselesaikan
                    </span>
                @endif
                <div class="mt-5 inline-flex items-center justify-center gap-1.5 bg-emerald-600 text-white text-xs font-semibold px-4 py-2 rounded-xl shadow-sm group-hover:bg-emerald-700 transition-colors w-full">
                    Buka Audio <i class="bi bi-headphones text-[10px]"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- QUIZ -->
    @if($materi->quiz->count())
        <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm mb-10">
            <h3 class="font-bold text-slate-800 text-sm uppercase tracking-wider mb-4">
                Daftar Quiz
            </h3>
            @foreach($materi->quiz as $quiz)
                <div class="bg-slate-50/50 border border-slate-100 p-4 rounded-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3.5 mb-3">
                    <div>
                        <h4 class="font-bold text-slate-800 text-xs">
                            {{ $quiz->judul }}
                        </h4>
                        <p class="text-[10px] text-slate-400 mt-0.5">
                            Evaluasi materi kuis dasar pemrograman.
                        </p>
                    </div>

                    <div class="bg-slate-50/50 p-4 rounded-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3.5 mb-3">
                    @if($quizUnlocked)
                        @if(isset($hasilQuiz[$quiz->id]))
                            <a href="{{ route('materi.quiz.detail', [ 'id' => $materi->id, 'quizId' => $quiz->id]) }}" 
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-sm hover:shadow transition-all">
                                    Lihat hasil
                            </a>
                            @if($hasilQuiz[$quiz->id]->status == 'lulus')
                                <div class="flex items-center gap-3">
                                    <span class="bg-emerald-50 text-emerald-600 border border-emerald-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                        Lulus
                                    </span>
                                    <span class="text-xs font-semibold text-slate-500">
                                        Nilai: <strong class="text-blue-600">{{ $hasilQuiz[$quiz->id]->score }}</strong>
                                    </span>
                                </div>
                            @else
                                <div class="flex items-center gap-3">
                                    <span class="bg-red-50 text-red-600 border border-red-100/50 px-2.5 py-0.5 rounded-md text-[9px] font-bold uppercase tracking-wider">
                                        Tidak Lulus
                                    </span>
                                    <span class="text-xs font-semibold text-slate-500">
                                        Nilai: <strong class="text-blue-600">{{ $hasilQuiz[$quiz->id]->score }}</strong>
                                    </span>
                                </div>
                            @endif
                        @else
                            <a href="{{ route('materi.quiz.detail', [ 'id' => $materi->id, 'quizId' => $quiz->id]) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-xs font-semibold shadow-sm hover:shadow transition-all">
                                Kerjakan <i class="bi bi-pencil-square text-[10px]"></i>
                            </a>
                        @endif
                    @else
                        <button disabled class="inline-flex items-center gap-1.5 px-4 py-2 bg-slate-300 text-slate-500 border border-slate-400/20 rounded-xl text-xs font-semibold cursor-not-allowed">
                            Terkunci <i class="bi bi-lock-fill text-[10px]"></i>
                        </button>
                    @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection