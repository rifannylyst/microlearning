@extends('layouts.app')

@section('content')

<div class="bg-slate-100 min-h-screen py-8 px-6">

    <div class="bg-white p-6 rounded-4xl shadow">

        {{-- HEADER --}}
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-blue-700 mb-2">
                Konten {{ $konten->urutan }}
            </h1>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 rounded-full text-sm font-medium
                    @if($konten->tipe == 'materi')
                        bg-blue-100 text-blue-600
                    @elseif($konten->tipe == 'video')
                        bg-red-100 text-red-600
                    @else
                        bg-green-100 text-green-600
                    @endif
                ">
                    {{ ucfirst($konten->tipe) }}
                </span>
                @if($konten->durasi)
                    <span class="text-gray-500 text-sm">
                        {{ $konten->durasi }} menit
                    </span>
                @endif
            </div>
        </div>
        {{-- DESKRIPSI --}}
        @if($konten->deskripsi)
            <div class="mb-6 bg-slate-50 border rounded-xl p-4">
                <p class="text-gray-700 leading-relaxed">
                    {{ $konten->deskripsi }}
                </p>
            </div>
        @endif

        {{-- =========================
             KONTEN DARI LINK
        ========================== --}}
        @if($konten->link)
            {{-- VIDEO --}}
            @if($konten->tipe == 'video')
                @php
                    preg_match(
                        '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
                        $konten->link,
                        $matches
                    );
                    $youtubeId = $matches[1] ?? null;
                @endphp
                @if($youtubeId)
                    <iframe class="w-full h-[600px] rounded-xl" src="https://www.youtube.com/embed/{{ $youtubeId }}" allowfullscreen>
                    </iframe>
                @else
                    <video controls class="w-full rounded-xl">
                        <source src="{{ $konten->link }}">
                    </video>
                @endif
            {{-- AUDIO --}}
            @elseif($konten->tipe == 'audio')
                <audio controls class="w-full">
                    <source src="{{ $konten->link }}">
                </audio>
            {{-- MATERI --}}
            @elseif($konten->tipe == 'materi')
                <iframe src="{{ $konten->link }}" class="w-full h-screen rounded-xl">
                </iframe>
            @endif
        {{-- =========================
             KONTEN DARI FILE
        ========================== --}}
        @elseif($konten->isi)
            {{-- MATERI --}}
            @if($konten->tipe == 'materi')
                <iframe src="{{ asset('storage/'.$konten->isi) }}" class="w-full h-screen rounded-xl" allowfullscreen>
                </iframe>
            {{-- VIDEO --}}
            @elseif($konten->tipe == 'video')
                <video controls class="w-full rounded-xl">
                    <source src="{{ asset('storage/'.$konten->isi) }}">
                </video>
            {{-- AUDIO --}}
            @elseif($konten->tipe == 'audio')
                <audio controls class="w-full">
                    <source src="{{ asset('storage/'.$konten->isi) }}">
                </audio>
            @endif
        @else
            {{-- JIKA KONTEN KOSONG --}}
            <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center">
                <i class="bi bi-exclamation-triangle text-5xl text-red-500"></i>
                <p class="text-red-600 mt-4 font-medium">
                    Konten tidak tersedia
                </p>
            </div>
        @endif
        {{-- BUTTON --}}
        <div class="mt-8 flex gap-3">
            {{-- KEMBALI --}}
            <a href="{{ route('materi.konten', $konten->materi_id) }}" class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-3 rounded-xl transition">
                Kembali
            </a>
            {{-- SELESAI --}}
            <form action="{{ route('materi.konten.progress', [$konten->materi_id, $konten->id]) }}" method="POST">
                @csrf
                <button type="submit"class="bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl transition">
                    Selesaikan Konten
                </button>
            </form>
        </div>
    </div>
</div>
@endsection