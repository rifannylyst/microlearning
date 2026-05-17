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
            @if($progress->count() == 0)

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

                    <a href="{{ route('materi.index') }}"
                       class="bg-blue-700 hover:bg-blue-800 text-white px-8 py-3 rounded-full transition">

                        Jelajahi Kursus

                    </a>

                </div>

            @else

                {{-- LIST PROGRESS --}}
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

                    @foreach($progress as $item)

                        <div class="bg-white rounded-2xl shadow-sm border border-blue-100 overflow-hidden">

                            {{-- THUMBNAIL --}}
                            <div class="h-44 bg-blue-100 flex items-center justify-center">

                                @if($item->materi->thumbnail)
                                    <img src="{{ asset('storage/' . $item->materi->thumbnail) }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <i class="bi bi-journal-richtext text-6xl text-blue-600"></i>
                                @endif

                            </div>

                            {{-- BODY --}}
                            <div class="p-5">

                                {{-- STATUS --}}
                                <div class="flex items-center justify-between mb-3">

                                    <span class="text-sm font-medium text-blue-600">
                                        {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                    </span>

                                    <span class="text-sm text-gray-500">
                                        {{ $item->persentase }}%
                                    </span>

                                </div>

                                {{-- JUDUL --}}
                                <h2 class="text-xl font-bold text-gray-800 mb-2">
                                    {{ $item->materi->judul }}
                                </h2>

                                {{-- DESKRIPSI --}}
                                <p class="text-sm text-gray-500 line-clamp-3 mb-5">
                                    {{ $item->materi->deskripsi }}
                                </p>

                                {{-- PROGRESS BAR --}}
                                <div class="w-full bg-gray-200 rounded-full h-3 mb-5 overflow-hidden">

                                    <div
                                        class="bg-blue-600 h-full rounded-full transition-all duration-500"
                                        style="width: {{ $item->persentase }}%">
                                    </div>

                                </div>

                                {{-- DETAIL PROGRESS --}}
                                <div class="space-y-2 mb-6">

                                    @foreach($item->materi->konten_materi as $konten)

                                        @php
                                            $selesai = $konten->progressUser
                                                ->where('user_id', auth()->id())
                                                ->where('is_completed', true)
                                                ->count();
                                        @endphp

                                        <div class="flex items-center justify-between border rounded-lg px-3 py-2">

                                            <div class="flex items-center gap-3">

                                                @if($selesai)

                                                    <div class="w-7 h-7 rounded-full bg-green-100 flex items-center justify-center">
                                                        <i class="bi bi-check-lg text-green-600"></i>
                                                    </div>

                                                @else

                                                    <div class="w-7 h-7 rounded-full bg-gray-100 flex items-center justify-center">
                                                        <i class="bi bi-lock text-gray-500"></i>
                                                    </div>

                                                @endif

                                                <div>

                                                    <p class="font-medium text-gray-700">
                                                        Konten {{ $konten->urutan }}
                                                    </p>

                                                    <p class="text-xs text-gray-400 capitalize">
                                                        {{ $konten->tipe }}
                                                    </p>

                                                </div>

                                            </div>

                                            @if($selesai)

                                                <span class="text-green-600 text-sm font-medium">
                                                    Selesai
                                                </span>

                                            @else

                                                <span class="text-gray-400 text-sm">
                                                    Belum
                                                </span>

                                            @endif

                                        </div>

                                    @endforeach

                                </div>

                                {{-- BUTTON --}}
                                <a href="{{ route('materi.konten', $item->materi->id) }}"
                                   class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl transition">

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