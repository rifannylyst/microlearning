@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100 py-8 px-4">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

        <!-- JUDUL -->
        <h1 class="text-2xl font-bold mb-6">
            {{ $quiz->judul }}
        </h1>

        <!-- FORM QUIZ -->
        <form action="{{ route('quiz.submit', [$quiz->materi->id, $quiz->id]) }}" method="POST">
            @csrf
            @foreach($quiz->pertanyaan as $index => $pertanyaan)
                <div class="mb-8 border-b pb-6">
                    <!-- SOAL -->
                    <h2 class="text-lg font-semibold mb-4">
                        {{ $index + 1 }}.
                        {{ $pertanyaan->soal }}
                    </h2>

                    {{-- =========================
                         PILIHAN GANDA
                    ========================== --}}
                    @if($pertanyaan->tipe == 'pilihan_ganda')
                        <div class="flex flex-col gap-3">
                            @forelse($pertanyaan->jawaban as $jawaban)
                                <label class="border rounded-lg p-3 cursor-pointer hover:bg-slate-100 transition">
                                    <div class="flex items-center gap-3">
                                        <input type="radio" name="jawaban[{{ $pertanyaan->id }}]" value="{{ $jawaban->id }}" class="w-4 h-4" required >
                                        <span>
                                            {{ $jawaban->jawaban }}
                                        </span>
                                    </div>
                                </label>
                            @empty
                                <div class="text-red-500 text-sm">
                                    Jawaban belum tersedia
                                </div>
                            @endforelse
                        </div>
                    @endif
                    {{-- =========================
                         ESSAY / ISIAN
                    ========================== --}}
                    @if($pertanyaan->tipe == 'isian')
                        <textarea name="isian[{{ $pertanyaan->id }}]" rows="4" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Tulis jawaban anda..." required ></textarea>
                    @endif
                </div>

            @endforeach

            <!-- BUTTON -->
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition">
                    Selesai Quiz
                </button>

            </div>

        </form>

    </div>

</div>

@endsection