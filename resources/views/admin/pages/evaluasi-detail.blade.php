@extends('admin.layouts.app')

@section('content')
@php
    $jumlahBenar = $jawabans->where('benar', 1)->count();

    $totalSoal = $jawabans->count();

    $nilai = $totalSoal > 0
        ? round(($jumlahBenar / $totalSoal) * 100)
        : 0;
@endphp
<h3 class="mb-4">
    Hasil Evaluasi - {{ $user->name }}
</h3>
        <p>
            Nilai Akhir:
            <span class="badge bg-primary fs-6">
                {{ $nilai }}
            </span>
        </p>

        <p>
            Benar:
            {{ $jumlahBenar }}
            dari
            {{ $totalSoal }}
            soal
        </p>

@foreach($jawabans as $jawaban)

<div class="card mb-3">

    <div class="card-body">

        <h5>
            {{ $jawaban->soal->soal }}
        </h5>

        <p>
            <strong>Jawaban:</strong><br>
            {{ $jawaban->jawaban }}
        </p>

        @if($jawaban->soal->tipe == 'pilihan_ganda')

            @if($jawaban->benar)

                <span class="badge bg-success">
                    Benar
                </span>

            @else

                <span class="badge bg-danger">
                    Salah
                </span>

            @endif

        @endif

        @if(
            $jawaban->soal->tipe == 'isian'
            && is_null($jawaban->benar)
        )

            <form
                action="{{ route('admin.evaluasi.nilai', $jawaban->id) }}"
                method="POST"
                class="mt-3">

                @csrf
                @method('PUT')

                <button
                    name="benar"
                    value="1"
                    class="btn btn-success btn-sm">

                    ✓ Benar

                </button>

                <button
                    name="benar"
                    value="0"
                    class="btn btn-danger btn-sm">

                    ✗ Salah

                </button>

            </form>

        @endif

    </div>

</div>

@endforeach

<button onclick="window.location.href='{{ route('admin.evaluasi.hasil') }}'" class="btn btn-secondary btn-md">
    Kembali
</button>

@endsection