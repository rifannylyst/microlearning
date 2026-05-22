@extends('layouts.app')

@section('content')

<div class="bg-slate-100 min-h-screen py-8 px-6">
    <!-- HEADER -->
    <div class="mb-8">
        <a href="{{ route('materi.konten', $materi->id) }}"
           class="inline-flex items-center text-blue-600 hover:text-blue-700 mb-4">
            <i class="bi bi-arrow-left mr-2"></i>
            Kembali
        </a>
        <h1 class="text-3xl font-bold text-blue-700 capitalize">
            {{ $tipe }}
        </h1>
        <p class="text-gray-600 mt-2">
            {{ $materi->judul }}
        </p>
    </div>
    <!-- LIST KONTEN -->
    @if($kontens->count())
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($kontens as $konten)
                <div class="bg-white rounded-2xl shadow p-5 border border-gray-200 hover:shadow-lg transition">
                    <!-- HEADER -->
                    <div class="flex justify-between items-center mb-4">
                        <span class="bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full capitalize">
                            {{ $konten->tipe }}
                        </span>
                        <span class="text-sm text-gray-500">
                            Urutan {{ $konten->urutan }}
                        </span>
                    </div>
                    <!-- CONTENT PREVIEW -->
                    <div class="mb-4">
                        {{-- VIDEO --}}
                        @if($konten->tipe == 'video')
                            @if($konten->link)
                                @php
                                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $konten->link, $matches);
                                    $youtubeId = $matches[1] ?? null;
                                @endphp
                                @if($youtubeId)
                                    <iframe class="w-full h-52 rounded-xl" src="https://www.youtube.com/embed/{{ $youtubeId }}" allowfullscreen>
                                    </iframe>
                                @else
                                    <a href="{{ $konten->link }}" target="_blank" class="text-blue-500 underline"> Buka Video
                                    </a>
                                @endif
                            @elseif($konten->isi)
                                <video controls class="w-full rounded-xl">
                                    <source src="{{ asset('storage/'.$konten->isi) }}">
                                </video>
                            @endif
                        {{-- AUDIO --}}
                        @elseif($konten->tipe == 'audio')
                            @if($konten->isi)
                                <div class="bg-green-50 p-4 rounded-xl">
                                    <audio controls class="w-full">
                                        <source src="{{ asset('storage/'.$konten->isi) }}">
                                    </audio>
                                </div>
                            @elseif($konten->link)
                                <a href="{{ $konten->link }}" target="_blank" class="text-blue-500 underline"> Buka Audio
                                </a>
                            @endif
                        {{-- MATERI --}}
                        @elseif($konten->tipe == 'materi')
                            @if($konten->isi)
                                <iframe src="{{ asset('storage/'.$konten->isi) }}" class="w-full h-64 rounded-xl border">
                                </iframe>
                            @elseif($konten->link)
                                <a href="{{ $konten->link }}" target="_blank" class="text-blue-500 underline">Buka Materi
                                </a>
                            @endif
                        @endif
                    </div>
                    <!-- DESKRIPSI -->
                    @if($konten->deskripsi)
                        <p class="text-gray-600 text-sm mb-4">
                            {{ $konten->deskripsi }}
                        </p>
                    @endif

                    <!-- DURASI -->
                    @if($konten->durasi)
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <i class="bi bi-clock mr-2"></i>
                            {{ $konten->durasi }} menit
                        </div>
                    @endif
                    <!-- BUTTON -->
                    <a href="{{ route('materi.konten.detail', [$materi->id, $konten->tipe, $konten->id]) }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                        Buka Konten
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <!-- EMPTY STATE -->
        <div class="bg-white rounded-2xl shadow p-10 text-center">
            <div class="text-gray-400 text-6xl mb-4">
                <i class="bi bi-folder-x"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-700 mb-2">
                Konten Tidak Tersedia
            </h2>
            <p class="text-gray-500">
                Belum ada konten {{ strtolower($tipe) }} untuk materi ini.
            </p>
        </div>
    @endif
</div>
@endsection