@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-[#eef6ff] flex flex-col">

    <!-- HEADER -->
    <section class="border-b border-blue-200 bg-white">
        <div class="max-w-7xl mx-auto px-6 py-8">
            <h1 class="text-3xl font-bold text-blue-700">
                Pembelajaran Saya
            </h1>
            <p class="text-gray-600 mt-2">
                Lacak kemajuan Anda dan lanjutkan dari tempat terakhir
            </p>
        </div>
    </section>
    <!-- CONTENT -->
    <section class="flex-1 py-10">
        <div class="max-w-7xl mx-auto px-6">
            {{-- JIKA BELUM ADA PROGRESS --}}
            @if(!$punyaProgress)
                <div class="bg-white rounded-3xl shadow-sm border border-blue-200 p-16 text-center">
                    <div class="flex justify-center mb-6">
                        <i class="bi bi-book text-6xl text-blue-600"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-blue-700 mb-3">
                        Mulai Perjalanan Belajar Anda
                    </h2>
                    <p class="text-gray-500 mb-8">
                        Daftar di kursus untuk melacak kemajuan dan mendapatkan sertifikat
                    </p>
                    <a href="{{ route('materi.index') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-3 rounded-full transition">
                        Jelajahi Kursus
                    </a>
                </div>
            @else
                {{-- LIST PROGRESS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($materis as $materi)
                        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden">
                            {{-- THUMBNAIL --}}
                            <div class="h-44 bg-blue-100 flex items-center justify-center">
                                @if($materi->thumbnail)
                                    <img src="{{ asset('storage/' . $materi->thumbnail) }}" class="w-full h-full object-cover">
                                @else
                                    <i class="bi bi-journal-richtext text-6xl text-blue-600"></i>
                                @endif
                            </div>
                            {{-- BODY --}}
                            <div class="p-5">
                                {{-- JUDUL --}}
                                <h2 class="text-xl font-bold text-gray-800 mb-2">
                                    {{ $materi->judul }}
                                </h2>
                                {{-- DESKRIPSI --}}
                                <p class="text-sm text-gray-500 line-clamp-3 mb-5">
                                    {{ $materi->deskripsi }}
                                </p>
                                {{-- DETAIL PROGRESS BERDASARKAN TIPE --}}
                                <div class="space-y-4 mb-6">
                                @php
                                    $progressMateri = $progress[$materi->id]['materi'][0] ?? null;
                                    $progressVideo  = $progress[$materi->id]['video'][0] ?? null;
                                    $progressAudio  = $progress[$materi->id]['audio'][0] ?? null;
                                @endphp

                                @foreach([
                                    [
                                        'title' => 'Materi',
                                        'icon' => 'file-earmark-text',
                                        'bg' => 'bg-blue-100',
                                        'text' => 'text-blue-600',
                                        'bar' => 'bg-blue-500',
                                        'data' => $progressMateri
                                    ],
                                    [
                                        'title' => 'Video',
                                        'icon' => 'play-circle',
                                        'bg' => 'bg-red-100',
                                        'text' => 'text-red-600',
                                        'bar' => 'bg-red-500',
                                        'data' => $progressVideo
                                    ],
                                    [
                                        'title' => 'Audio',
                                        'icon' => 'headphones',
                                        'bg' => 'bg-green-100',
                                        'text' => 'text-green-600',
                                        'bar' => 'bg-green-500',
                                        'data' => $progressAudio
                                    ]
                                ] as $item)

                                    <div class="border rounded-xl p-4">

                                        <div class="flex items-center justify-between mb-3">

                                            <div class="flex items-center gap-3">

                                                <div class="w-10 h-10 rounded-full {{ $item['bg'] }} flex items-center justify-center">
                                                    <i class="bi bi-{{ $item['icon'] }} {{ $item['text'] }}"></i>
                                                </div>

                                                <div>
                                                    <h3 class="font-semibold text-gray-800">
                                                        {{ $item['title'] }}
                                                    </h3>

                                                    <p class="text-sm text-gray-400">
                                                        Progress {{ strtolower($item['title']) }}
                                                    </p>
                                                </div>

                                            </div>

                                            <span class="font-bold {{ $item['text'] }}">
                                                {{ $item['data']->persentase ?? 0 }}%
                                            </span>

                                        </div>

                                        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden mb-2">

                                            <div
                                                class="{{ $item['bar'] }} h-3 rounded-full transition-all duration-500"
                                                style="width: {{ $item['data']->persentase ?? 0 }}%">
                                            </div>

                                        </div>

                                        <p class="text-sm text-gray-500 capitalize">
                                            {{ str_replace('_', ' ', $item['data']->status ?? 'belum_dimulai') }}
                                        </p>

                                    </div>

                                @endforeach

                            </div>
                                {{-- HASIL QUIZ --}}
                                @if($materi->quiz->count())

                                <div class="mb-6">

                                    <h3 class="font-bold text-gray-700 mb-3">
                                        Hasil Quiz
                                    </h3>

                                    <div class="space-y-3">

                                        @foreach($materi->quiz as $quiz)

                                            @php
                                                $hasil = $quiz->hasilQuiz->first();
                                            @endphp

                                            <div class="border rounded-xl p-3 flex items-center justify-between">

                                                <div>
                                                    <h4 class="font-medium text-gray-800">
                                                        {{ $quiz->judul }}
                                                    </h4>

                                                    @if($hasil)
                                                        <p class="text-sm text-gray-500">
                                                            Nilai: {{ $hasil->score }}
                                                        </p>
                                                    @else
                                                        <p class="text-sm text-gray-400">
                                                            Belum mengerjakan quiz
                                                        </p>
                                                    @endif
                                                </div>

                                                @if(!$hasil)

                                                    <span class="bg-gray-100 text-gray-500 px-3 py-1 rounded-full text-sm">
                                                        Belum Dikerjakan
                                                    </span>

                                                @elseif($hasil->status == 'lulus')

                                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-sm">
                                                        Lulus
                                                    </span>

                                                @else

                                                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-sm">
                                                        Belum Lulus
                                                    </span>

                                                @endif

                                            </div>

                                        @endforeach

                                    </div>

                                </div>

                                @endif
                                {{-- BUTTON --}}
                                <a href="{{ route('materi.konten', $materi->id) }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition">
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