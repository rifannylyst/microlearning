@extends('layouts.app')

@section('content')
<div class="bg-slate-100 min-h-screen py-8 px-6">

    <!-- Judul Materi -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-blue-700">
            {{ $materi->judul }}
        </h1>
        <p class="text-gray-600">
            {{ $materi->deskripsi }}
        </p>
    </div>

    <!-- List Konten -->
    <div class="space-y-6">

        @forelse($materi->konten_materi as $item)
            @if ($item->unlocked)
                
        <div class="bg-white rounded-xl shadow p-5 border border-blue-100">

            <!-- Header -->
            <div class="flex justify-between items-center mb-3">
                <span class="text-sm font-semibold text-blue-600 capitalize">
                    {{ $item->tipe }}
                </span>

                <span class="text-xs text-gray-500">
                    Urutan: {{ $item->urutan }}
                </span>
            </div>

            <!-- Konten -->
            <div class="mt-3">

                {{-- GAMBAR --}}
                @if($item->tipe == 'gambar')
                    <img src="{{ asset('storage/' . $item->isi) }}" 
                         class="rounded-lg w-full max-h-96 object-cover">

                {{-- VIDEO --}}
                @elseif($item->tipe == 'video')
                    <video controls class="w-full rounded-lg">
                        <source src="{{ asset('storage/' . $item->isi) }}">
                        Browser tidak mendukung video
                    </video>

                {{-- AUDIO --}}
                @elseif($item->tipe == 'audio')
                    <audio controls class="w-full">
                        <source src="{{ asset('storage/' . $item->isi) }}">
                        Browser tidak mendukung audio
                    </audio>
                @endif

            </div>

            <!-- Durasi -->
            @if($item->durasi)
            <div class="mt-3 text-sm text-gray-500 flex items-center gap-2">
                <i class="bi bi-clock"></i>
                <span>{{ $item->durasi }} menit</span>
            </div>
            @endif

            <div class="mt-4">
            <a href="{{ route('materi.konten.detail', [$materi->id, $item->id]) }}"
               class="bg-blue-500 text-white px-3 py-2 rounded">
               Buka Konten
            </a>
            </div>
        @else
        <div class="border p-4 rounded mb-3 opacity-50">
            <h3>Konten {{ $item->urutan }}</h3>

            <button disabled
                class="bg-gray-400 text-white px-3 py-2 rounded">
                Terkunci
            </button>
        </div>
        @endif
        </div>
        @empty
            <p class="text-gray-500">Tidak ada konten tersedia.</p>
        @endforelse

    </div>

</div>
@endsection