@extends('admin.layouts.app')

@section('content')

@php
$totalMateri = $materi->count();

$materiSelesai = $user->progress
    ->pluck('materi_id')
    ->unique()
    ->count();

$progressKeseluruhan = $totalMateri > 0
    ? round(($materiSelesai / $totalMateri) * 100)
    : 0;
@endphp
<div class="max-w-7xl mx-auto p-6">

    {{-- HEADER --}}
    <div class="bg-white rounded-2xl shadow-sm border p-6 mb-6">

        <div class="flex items-center gap-4">

            <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center">
                <i class="bi bi-person text-3xl text-blue-600"></i>
            </div>

            <div>
                <h1 class="text-2xl font-bold text-gray-800">
                    {{ $user->name }}
                </h1>

                <p class="text-gray-500">
                    {{ $user->email }}
                </p>
            </div>

        </div>

    </div>

    {{-- STATISTIK --}}
    <div class="grid md:grid-cols-3 gap-4 mb-6">

        <div class="bg-white rounded-xl border p-5">
            <p class="text-gray-500 text-sm">
                Total Materi
            </p>

            <h2 class="text-3xl font-bold text-blue-600 mt-2">
                {{ $user->progress->pluck('materi_id')->unique()->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-xl border p-5">
            <p class="text-gray-500 text-sm">
                Quiz Dikerjakan
            </p>

            <h2 class="text-3xl font-bold text-green-600 mt-2">
                {{ $user->hasil_quiz->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-xl border p-5">
            <p class="text-gray-500 text-sm">
                Rata-rata Nilai
            </p>

            <h2 class="text-3xl font-bold text-purple-600 mt-2">
                {{ round($user->hasil_quiz->avg('score') ?? 0) }}
            </h2>
        </div>

    </div>

    {{-- DETAIL MATERI --}}
    <div class="bg-white rounded-2xl border shadow-sm p-6">

        <h2 class="text-xl font-bold text-gray-800 mb-5">
            Progress Pembelajaran
        </h2>

        <div class="space-y-4">

            @foreach($materi as $item)

                @php
                    $progresses = $user->progress->where('materi_id', $item->id);

                    $materiProgress = $progresses->where('tipe','materi')->first();
                    $videoProgress  = $progresses->where('tipe','video')->first();
                    $audioProgress  = $progresses->where('tipe','audio')->first();
                @endphp

                <div class="border rounded-xl p-5">

                    <h3 class="font-semibold text-lg text-gray-800 mb-4">
                        {{ $item->judul }}
                    </h3>

                    {{-- Materi --}}
                    <div class="mb-4">

                        <div class="flex justify-between mb-1">
                            <span>Materi</span>
                            @if($materiProgress)
                                <span>{{ $materiProgress->persentase }}%</span>
                            @else
                                <span>0%</span>
                            @endif
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full"
                                 style="width: {{ $materiProgress->persentase ?? 0 }}%">
                            </div>
                        </div>

                    </div>

                    {{-- Video --}}
                    <div class="mb-4">

                        <div class="flex justify-between mb-1">
                            <span>Video</span>
                            @if($videoProgress)
                                <span>{{ $videoProgress->persentase }}%</span>
                            @else
                                <span>0%</span>
                            @endif
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-red-500 h-2 rounded-full"
                                 style="width: {{ $videoProgress->persentase ?? 0 }}%">
                            </div>
                        </div>

                    </div>

                    {{-- Audio --}}
                    <div class="mb-4">

                        <div class="flex justify-between mb-1">
                            <span>Audio</span>
                            @if($audioProgress)
                                <span>{{ $audioProgress->persentase }}%</span>
                            @else
                                <span>0%</span>
                            @endif
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full"
                                 style="width: {{ $audioProgress->persentase ?? 0 }}%">
                            </div>
                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

    {{-- QUIZ --}}
    <div class="bg-white rounded-2xl border shadow-sm p-6 mt-6">

        <h2 class="text-xl font-bold text-gray-800 mb-5">
            Hasil Quiz
        </h2>

        <div class="space-y-3">

            @forelse($user->hasil_quiz as $hasil)

                <div class="border rounded-xl p-4 flex justify-between items-center">

                    <div>

                        <h3 class="font-medium text-gray-800">
                            {{ $hasil->quiz->judul }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            Nilai: {{ $hasil->score }}
                        </p>

                    </div>

                    @if($hasil->status == 'lulus')

                        <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full">
                            Lulus
                        </span>

                    @else

                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full">
                            Tidak Lulus
                        </span>

                    @endif

                </div>

            @empty

                <div class="text-center text-gray-500 py-6">
                    Belum ada quiz yang dikerjakan
                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection