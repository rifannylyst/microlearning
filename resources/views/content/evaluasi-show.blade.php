@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>{{ $evaluasi->judul }}</h4>
        </div>

        {{-- Status Evaluasi --}}
        @if($hasil)
            <div class="alert alert-success m-4">
                Anda sudah mengerjakan evaluasi ini.
            </div>
        @endif

        <div class="card-body">
            @if(!$hasil)
            <form
                action="{{ route('siswa.evaluasi.submit',$evaluasi->id) }}"
                method="POST">

                @csrf
            @endif
                @foreach($evaluasi->soal as $soal)

                <div class="mb-5">

                    <h6>
                        {{ $loop->iteration }}.
                        {{ $soal->soal }}
                    </h6>

                    {{-- PILIHAN GANDA --}}
                    @if($soal->tipe == 'pilihan_ganda')

                        @php
                            $huruf = ['A','B','C','D'];
                        @endphp
                        <div class="flex flex-col gap-3">

                        @foreach($soal->opsi_jawaban as $index => $opsi)

                            @php
                                $kode = $huruf[$index];

                                $jawabanUser = $jawabanEvaluasi[$soal->id] ?? null;

                                $dipilih = $jawabanUser
                                    && $jawabanUser->jawaban == $kode;

                                $benar = $soal->kunci_jawaban == $kode;
                            @endphp

                            <label class="border rounded-lg p-3 transition hover:bg-slate-100 cursor-pointer
                                @if($hasil && $benar)
                                    border-green-500 bg-green-100
                                @elseif($hasil && $dipilih)
                                    border-red-500 bg-red-100
                                @else
                                    border-gray-300 hover:border-blue-500
                                @endif">

                                <div class="flex items-center gap-3">

                                    @if(!$hasil)
                                        <input
                                            type="radio"
                                            name="jawaban[{{ $soal->id }}]"
                                            value="{{ $kode }}"
                                            class="w-4 h-4"
                                            required>
                                    @else
                                        <input
                                            type="radio"
                                            disabled
                                            {{ $dipilih ? 'checked' : '' }}>
                                    @endif

                                    <span>{{ $kode }}. {{ $opsi }}</span>

                                    @if($hasil)

                                        @if($dipilih && !$benar)
                                            <span class="ml-auto text-red-600">
                                                ✗ Salah
                                            </span>
                                        @elseif($benar)
                                            <span class="ml-auto text-green-600">
                                                ✓ Benar
                                            </span>
                                        @endif

                                    @endif

                                </div>

                            </label>

                        @endforeach
                        </div>

                    @endif

                    {{-- ISIAN --}}
                    @if($soal->tipe == 'isian')

                        @php
                        $jawabanUser = $jawabanEvaluasi[$soal->id] ?? null;

                        $kunci = $soal->kunci_jawaban;
                        @endphp

                        @if(!$hasil)
                        <textarea
                            name="jawaban[{{ $soal->id }}]"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none"
                            placeholder="Tulis jawaban Anda..."
                            rows="4"
                            placeholder="Jawaban Anda..."></textarea>
                        @else

                        <div class="mt-3">

                            <p>
                                <strong>Jawaban Anda :</strong>
                                <textarea
                                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 outline-none"
                                    rows="4"
                                    disabled>{{ $jawabanUser->jawaban ?? '-' }}</textarea>
                                
                            </p>


                            @if($jawabanUser?->benar)
                                <span class="text-green-600">✓ Benar</span>
                            @else
                                <span class="text-red-600">✗ Salah</span>
                            @endif

                        </div>

                        @endif
                    @endif

                </div>

                @endforeach
                @if(!$hasil)
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            class="btn btn-success">
                            Kirim Jawaban
                        </button>
                    </div>
                    </form>
                @endif


        </div>

    </div>

</div>

@endsection