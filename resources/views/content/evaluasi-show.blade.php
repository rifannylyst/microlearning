@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>{{ $evaluasi->judul }}</h4>
        </div>

        <div class="card-body">

            <form
                action="{{ route('siswa.evaluasi.submit',$evaluasi->id) }}"
                method="POST">

                @csrf

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

                        @foreach($soal->opsi_jawaban as $index => $opsi)

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="radio"
                                name="jawaban[{{ $soal->id }}]"
                                value="{{ $huruf[$index] }}"
                                required>

                            <label class="form-check-label">
                                {{ $huruf[$index] }}.
                                {{ $opsi }}
                            </label>

                        </div>

                        @endforeach

                    @endif

                    {{-- ISIAN --}}
                    @if($soal->tipe == 'isian')

                        <textarea
                            class="form-control mt-2"
                            rows="4"
                            name="jawaban[{{ $soal->id }}]"
                            placeholder="Tulis jawaban Anda..."></textarea>

                    @endif

                </div>

                @endforeach

                <button
                    type="submit"
                    class="btn btn-success">

                    Kirim Jawaban

                </button>

            </form>

        </div>

    </div>

</div>

@endsection