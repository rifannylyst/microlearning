@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-slate-100 py-8 px-4">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow">

        {{-- JUDUL --}}
        <h1 class="text-2xl font-bold mb-6">
            {{ $quiz->judul }}
        </h1>

        {{-- STATUS QUIZ --}}
        @if($sudahDikerjakan)
            <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                Quiz sudah dikerjakan. Anda dapat melihat jawaban dan kunci jawaban di bawah.
            </div>
        @endif

        {{-- FORM HANYA JIKA BELUM DIKERJAKAN --}}
        @if(!$sudahDikerjakan)
        <form action="{{ route('quiz.submit', [$quiz->materi->id, $quiz->id]) }}" method="POST">
            @csrf
        @endif

        @foreach($quiz->pertanyaan as $index => $pertanyaan)

            <div class="mb-8 border-b pb-6">

                {{-- SOAL --}}
                <h2 class="text-lg font-semibold mb-4">
                    {{ $index + 1 }}.
                    {{ $pertanyaan->soal }}
                </h2>

                {{-- =========================
                     PILIHAN GANDA
                ========================== --}}
                @if($pertanyaan->tipe == 'pilihan_ganda')

                    @php
                        $jawabanUser = $jawabanSiswa[$pertanyaan->id] ?? null;
                    @endphp

                    <div class="flex flex-col gap-3">

                        @foreach($pertanyaan->jawaban as $jawaban)

                            @php
                                $dipilih = $jawabanUser && $jawabanUser->pilihan_jawaban_id == $jawaban->id;
                                $benar = $jawaban->is_benar;
                            @endphp

                            <label class="border rounded-lg p-3 transition
                                @if($sudahDikerjakan && $benar)
                                    border-green-500 bg-green-50
                                @elseif($sudahDikerjakan && $dipilih)
                                    border-red-500 bg-red-50
                                @else
                                    hover:bg-slate-100
                                @endif ">

                                <div class="flex items-center gap-3">
                                    @if(!$sudahDikerjakan)

                                        <input type="radio" name="jawaban[{{ $pertanyaan->id }}]" value="{{ $jawaban->id }}" class="w-4 h-4" required >
                                    @else
                                        <input type="radio" class="w-4 h-4" disabled {{ $dipilih ? 'checked' : '' }} >
                                    @endif
                                    <span>
                                        {{ $jawaban->jawaban }}
                                    </span>

                                    @if($sudahDikerjakan)
                                        @if($benar)
                                            <span class="ml-auto text-green-600 font-semibold">
                                                ✓ Jawaban Benar
                                            </span>
                                        @endif
                                        @if($dipilih && !$benar)
                                            <span class="ml-auto text-red-600 font-semibold">
                                                ✗ Jawaban Anda
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </label>
                        @endforeach
                    </div>
                @endif
                {{-- =========================
                     ESSAY / ISIAN
                ========================== --}}
                @if($pertanyaan->tipe == 'isian')

                    @php
                        $jawabanUser = $jawabanSiswa[$pertanyaan->id] ?? null;

                        $kunci = $pertanyaan->jawaban
                                    ->where('is_benar', true)
                                    ->first();
                    @endphp

                    @if(!$sudahDikerjakan)

                        <textarea name="isian[{{ $pertanyaan->id }}]" rows="4" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none" placeholder="Tulis jawaban anda..." required ></textarea>
                    @else

                        {{-- Jawaban Siswa --}}
                        <div class="mb-4">

                            <label class="font-semibold text-gray-700">
                                Jawaban Anda
                            </label>

                            <div class="mt-2 border rounded-lg p-3 bg-gray-50">
                                {{ $jawabanUser->isian_jawaban ?? '-' }}
                            </div>

                        </div>

                        {{-- Kunci Jawaban --}}
                        <div>

                            <label class="font-semibold text-green-700">
                                Kunci Jawaban
                            </label>

                            <div class="mt-2 border border-green-300 rounded-lg p-3 bg-green-50">
                                {{ $kunci->jawaban ?? 'Belum ada kunci jawaban' }}
                            </div>

                        </div>

                    @endif

                @endif

            </div>

        @endforeach

        {{-- TOMBOL SUBMIT --}}
        @if(!$sudahDikerjakan)

            <div class="flex justify-end">

                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition">
                    Selesai Quiz
                </button>

            </div>

            </form>

        @endif
            <a href="{{ route('materi.konten', ['id' => $quiz->materi->id]) }}" class="mt-6 inline-block text-gray-600 hover:text-gray-800">
                &larr; Kembali ke Materi
            </a>
    </div>
    

</div>

@endsection