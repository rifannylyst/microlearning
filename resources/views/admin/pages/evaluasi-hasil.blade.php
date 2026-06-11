@extends('admin.layouts.app')

@section('content')
<div class='container px-2 py-4'>
    <div class="container py-4">

    <div class="row">

        @foreach($hasil as $userId => $jawabans)

            @php
                $user = $jawabans->first()->user;

                $belumDinilai = $jawabans
                    ->where('soal.tipe', 'isian')
                    ->whereNull('benar')
                    ->count();

                $jumlahBenar = $jawabans
                    ->where('benar', 1)
                    ->count();

                $totalSoal = $jawabans->count();

                $nilai = $totalSoal > 0
                    ? round(($jumlahBenar / $totalSoal) * 100)
                    : 0;
            @endphp

            <div class="col-md-4 mb-4">

                <div class="card shadow-sm h-100">

                    <div class="card-body">

                        <h5 class="card-title">
                            {{ $user->name }}
                        </h5>

                        <p class="text-muted mb-2">
                            {{ $user->email }}
                        </p>

                        <p>
                            Total Jawaban:
                             <strong>{{ $totalSoal }}</strong>
                        </p>

                        <p>
                            Nilai:
                            <span class="badge bg-primary">
                                {{ $nilai }}
                            </span>
                        </p>

                        @if($belumDinilai > 0)

                            <span class="badge bg-warning">
                                {{ $belumDinilai }}
                                Isian Belum Dinilai
                            </span>

                        @else

                            <span class="badge bg-success">
                                Semua Dinilai
                            </span>

                        @endif

                    </div>

                    <div class="card-footer bg-white">

                        <a
                            href="{{ route('admin.evaluasi.detail', $user->id) }}"
                            class="btn btn-primary w-100">

                            Lihat Hasil

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

</div>
<button onclick="window.location.href='{{ route('admin.evaluasi.hasil') }}'" class="btn btn-secondary btn-md">
    Kembali
</button>

</div>
@endsection