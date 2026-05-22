@extends('layouts.app')

@section('content')

<div class="bg-slate-100 min-h-screen py-8 px-6">

    <!-- HEADER -->
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-blue-700 mb-2">
            {{ $materi->judul }}
        </h1>

        <p class="text-gray-600">
            {{ $materi->deskripsi }}
        </p>

    </div>

    <!-- CARD MENU -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

        <!-- CARD MATERI -->
        <a href="{{ route('materi.konten.tipe', ['id' => $materi->id, 'tipe' => 'materi']) }}" class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-blue-100 hover:border-blue-400">

            <div class="flex flex-col items-center text-center">
                <div class="bg-blue-100 text-blue-600 p-5 rounded-full mb-4">
                    <i class="bi bi-file-earmark-text text-4xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    Materi
                </h2>
                <p class="text-gray-500 text-sm">
                    Pelajari materi pembelajaran berupa PDF atau dokumen.
                </p>
                <div class="mt-4 text-blue-600 font-semibold">
                    Buka Materi →
                </div>
            </div>
        </a>

        <!-- CARD VIDEO -->
        <a href="{{ route('materi.konten.tipe', ['id' => $materi->id, 'tipe' => 'video']) }}" class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-red-100 hover:border-red-400">

            <div class="flex flex-col items-center text-center">
                <div class="bg-red-100 text-red-600 p-5 rounded-full mb-4">
                    <i class="bi bi-play-circle text-4xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    Video
                </h2>
                <p class="text-gray-500 text-sm">
                    Tonton video pembelajaran interaktif dan mudah dipahami.
                </p>
                <div class="mt-4 text-red-600 font-semibold">
                    Buka Video →
                </div>
            </div>
        </a>

        <!-- CARD AUDIO -->
        <a href="{{ route('materi.konten.tipe', ['id' => $materi->id, 'tipe' => 'audio']) }}" class="bg-white rounded-2xl shadow hover:shadow-lg transition p-6 border border-green-100 hover:border-green-400">

            <div class="flex flex-col items-center text-center">
                <div class="bg-green-100 text-green-600 p-5 rounded-full mb-4">
                    <i class="bi bi-headphones text-4xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    Audio
                </h2>
                <p class="text-gray-500 text-sm">
                    Dengarkan audio pembelajaran kapan saja dengan fleksibel.
                </p>
                <div class="mt-4 text-green-600 font-semibold">
                    Buka Audio →
                </div>
            </div>
        </a>
    </div>

    <!-- QUIZ -->
    @if($materi->quiz->count())
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">
                Daftar Quiz
            </h2>
            @foreach($materi->quiz as $quiz)
                <div class="border border-gray-200 p-4 rounded-xl mb-3 flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-gray-800">
                            {{ $quiz->judul }}
                        </h3>
                    </div>
                    @if($quizUnlocked)
                        <a href="{{ route('materi.quiz.detail', ['id' => $materi->id, 'quizId' => $quiz->id]) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                            Kerjakan
                        </a>

                    @else
                        <button disabled class="bg-gray-400 text-white px-4 py-2 rounded-lg">
                            Terkunci
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection