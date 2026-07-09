@extends('admin.layouts.app')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($users as $user)
    @php
        $jumlahSelesai = $user->progress
            ->where('status', 'selesai')
            ->pluck('materi_id')
            ->unique()
            ->count();

        $progress = $totalMateri > 0
            ? round(($jumlahSelesai / $totalMateri) * 100)
            : 0;

        $quiz = round($user->hasil_quiz->avg('score') ?? 0);
    @endphp

        <div class="bg-white shadow-sm border border-slate-200/60 rounded-2xl p-5 hover:shadow-md transition-all duration-300 flex flex-col justify-between h-full hover:-translate-y-0.5">

            <div>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h3 class="font-extrabold text-slate-800 text-sm">
                            {{ $user->name }}
                        </h3>
                        <p class="text-[11px] text-slate-400 font-medium">
                            {{ $user->email }}
                        </p>
                    </div>

                    @if($progress >= 75)
                        <span class="text-[10px] font-bold px-2.5 py-0.5 bg-emerald-50 text-emerald-600 border border-emerald-100/50 rounded-full">
                            Aktif
                        </span>
                    @else
                        <span class="text-[10px] font-bold px-2.5 py-0.5 bg-slate-100 text-slate-500 border border-slate-200 rounded-full">
                            Belajar
                        </span>
                    @endif
                </div>

                {{-- Progress --}}
                <div class="mb-4">
                    <div class="flex justify-between text-xs font-semibold text-slate-600 mb-1.5">
                        <span>Progress Pembelajaran</span>
                        <span class="text-blue-600">{{ $progress }}%</span>
                    </div>

                    <div class="w-full bg-slate-100 rounded-full h-1.5 overflow-hidden">
                        <div
                            class="bg-blue-600 h-1.5 rounded-full"
                            style="width: {{ $progress }}%">
                        </div>
                    </div>
                </div>

                {{-- Quiz --}}
                <div class="flex justify-between items-center text-xs font-semibold text-slate-600 border-t border-slate-50 pt-3">
                    <span class="text-slate-400">
                       Rata-Rata Nilai Kuis
                    </span>
                    <span class="{{ $quiz >= 75 ? 'text-emerald-600' : 'text-red-500' }}">
                        {{ $quiz }}
                    </span>
                </div>
            </div>

            <a href="{{ route('admin.progress.detail', $user->id) }}"
            class="mt-6 block text-center bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl text-xs font-bold shadow-sm shadow-blue-500/10 hover:shadow transition-all no-underline">
                Lihat Detail
            </a>
        </div>

    @endforeach

    </div>

@endsection