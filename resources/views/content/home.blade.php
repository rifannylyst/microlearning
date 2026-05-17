@extends('layouts.app')

@section('content')

{{-- HERO --}}
<section class="bg-gradient-to-r from-blue-400 to-blue-600 text-white text-center py-16">
    <h1 class="text-3xl md:text-4xl font-bold">
        Kuasai Pemrograman dengan Pembelajaran Multi-Format
    </h1>
    <p class="mt-4 text-sm md:text-base">
        Belajar dengan kecepatan Anda sendiri melalui pelajaran teks, audio, dan video.
    </p>

    <a href="{{ route('materi.index') }}" class="mt-6 bg-white text-blue-600 px-6 py-2 rounded-full font-semibold hover:bg-gray-200">
        Lihat Selengkapnya
    </a>
</section>

{{-- FITUR --}}
<section class="py-12 bg-white text-center">
    <h2 class="text-xl font-semibold mb-8">Belajar dengan Cara Anda</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-10">
        <div>
            <div class="text-4xl mb-2"><i class="bi bi-pencil-fill text-3xl"></i></div>
            <h3 class="font-semibold">Pelajaran Teks</h3>
            <p class="text-sm text-gray-500">Belajar dengan membaca materi.</p>
        </div>

        <div>
            <div class="text-4xl mb-2"><i class="bi bi-volume-up text-3xl"></i></div>
            <h3 class="font-semibold">Format Audio</h3>
            <p class="text-sm text-gray-500">Belajar sambil mendengarkan.</p>
        </div>

        <div>
            <div class="text-4xl mb-2"><i class="bi bi-camera-video text-3xl"></i></div>
            <h3 class="font-semibold">Tutorial Video</h3>
            <p class="text-sm text-gray-500">Tonton video pembelajaran.</p>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-3 gap-6 mt-10 text-blue-600 font-bold">
        <div>
            <p class="text-2xl">6+</p>
            <p class="text-sm text-gray-500">Kursus Pemrograman</p>
        </div>
        <div>
            <p class="text-2xl">20+</p>
            <p class="text-sm text-gray-500">Jam Konten</p>
        </div>
        <div>
            <p class="text-2xl">3</p>
            <p class="text-sm text-gray-500">Format Pembelajaran</p>
        </div>
    </div>
</section>

{{-- KURSUS --}}
<section class="py-12 px-10">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-blue-700">Kursus Unggulan</h2>
        <a href="{{ route('materi.index') }}" class="text-blue-500 text-sm">Lihat Semua →</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Card --}}
        @foreach($materi as $course)
        <div class="bg-white rounded-lg shadow hover:shadow-lg transition">
            <div class="bg-blue-400 h-32 rounded-t-lg flex items-center justify-center text-white text-3xl">
                📘
            </div>

            <div class="p-4">
                <span class="text-xs text-gray-400">{{ $course->urutan }}</span>
                <h3 class="font-semibold mt-2">{{ $course->judul }}</h3>
                <p class="text-sm text-gray-500 mt-1">
                    {{ $course->deskripsi }}
                </p>

                <div class="flex justify-between mt-4 text-sm text-gray-500">
                    <span>👨‍🎓 {{ $course->user->name }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection