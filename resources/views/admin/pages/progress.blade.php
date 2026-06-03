@extends('admin.layouts.app')

@section('content')

<div class="p-6">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        Progress Siswa
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    @foreach($users as $user)

        @php
            $progress = round($user->progress->avg('persentase') ?? 0);
            $quiz = round($user->hasil_quiz->avg('score') ?? 0);
        @endphp

        <div class="bg-white border rounded-xl p-4 hover:shadow-md transition">

            <div class="flex justify-between items-start mb-3">

                <div>
                    <h3 class="font-semibold text-gray-800">
                        {{ $user->name }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        {{ $user->email }}
                    </p>
                </div>

                @if($progress >= 75)
                    <span class="text-xs px-2 py-1 bg-green-100 text-green-600 rounded-full">
                        Aktif
                    </span>
                @else
                    <span class="text-xs px-2 py-1 bg-gray-100 text-gray-500 rounded-full">
                        Belajar
                    </span>
                @endif

            </div>

            {{-- Progress --}}
            <div class="mb-3">

                <div class="flex justify-between text-sm mb-1">
                    <span>Progress Pembelajaran</span>
                    <span>{{ $progress }}%</span>
                </div>

                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div
                        class="bg-blue-500 h-2 rounded-full"
                        style="width: {{ $progress }}%">
                    </div>
                </div>

            </div>

            {{-- Quiz --}}
            <div class="flex justify-between items-center text-sm">

                <span class="text-gray-500">
                   Rata Rata Nilai Quiz
                </span>

                <span class="font-semibold
                    {{ $quiz >= 75 ? 'text-green-600' : 'text-red-500' }}">
                    {{ $quiz }}
                </span>

            </div>

            <a href="{{ route('admin.progress.detail', $user->id) }}"
            class="mt-4 block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg">
                Lihat Detail
            </a>
        </div>

    @endforeach

</div>

</div>

@endsection