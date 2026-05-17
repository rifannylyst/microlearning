@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto py-8">

    <div class="bg-white p-6 rounded-xl shadow">

        <h1 class="text-2xl font-bold mb-4">
            Konten {{ $konten->urutan }}
        </h1>

        {{-- Gambar --}}
        @if($konten->tipe == 'gambar')

            <img src="{{ asset('storage/' . $konten->isi) }}"
                 class="rounded-lg w-full">

        {{-- Video --}}
        @elseif($konten->tipe == 'video')

            <video controls class="w-full rounded-lg">
                <source src="{{ asset('storage/' . $konten->isi) }}">
            </video>

        {{-- Audio --}}
        @elseif($konten->tipe == 'audio')

            <audio controls class="w-full">
                <source src="{{ asset('storage/' . $konten->isi) }}">
            </audio>

        @endif

        {{-- Tombol selesai --}}
        <form action="{{ route('materi.konten.progress', [$konten->materi_id, $konten->id]) }}"
              method="POST"
              class="mt-6">

            @csrf

            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">

                Selesaikan Konten

            </button>
        </form>

    </div>

</div>

@endsection