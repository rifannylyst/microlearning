@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm">

        <div class="card-header">
            <h4>{{ $evaluasi->judul }}</h4>
        </div>

        <div class="card-body">

            @foreach($jawabans as $jawaban)

                <div class="mb-4">

                    <h6>
                        {{ $loop->iteration }}.
                        {{ $jawaban->soal->soal }}
                    </h6>

                    <div class="bg-light p-3 rounded">

                        <strong>Jawaban Anda:</strong>

                        <p class="mb-0 mt-2">
                            {{ $jawaban->jawaban }}
                        </p>

                    </div>

                    @if($jawaban->soal->tipe == 'pilihan_ganda')

                        <div class="mt-2">

                            @if($jawaban->benar)

                                <span class="badge bg-success">
                                    Benar
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Salah
                                </span>

                                <small class="d-block mt-1">
                                    Kunci Jawaban:
                                    {{ $jawaban->soal->kunci_jawaban }}
                                </small>

                            @endif

                        </div>

                    @endif

                </div>

                <hr>

            @endforeach

            <a
                href="{{ route('evaluasi') }}"
                class="btn btn-primary">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection