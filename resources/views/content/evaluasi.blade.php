    @extends('layouts.app')

@section('content')
<div class="container py-4">

    <h3 class="mb-4">Evaluasi</h3>

    <div class="row">

        @forelse($evaluasis as $evaluasi)

        <div class="col-md-4 mb-3">

            <div class="card shadow-sm h-100">

                <div class="card-body">

                    <h5>
                        {{ $evaluasi->judul }}
                    </h5>

                    <p class="text-muted">
                        {{ $evaluasi->deskripsi }}
                    </p>

                    <p>
                        Jumlah Soal:
                        {{ $evaluasi->soal_count }}
                    </p>

                </div>

                <div class="card-footer bg-white">

                    <a
                        href="{{ route('siswa.evaluasi.show',$evaluasi->id) }}"
                        class="btn btn-primary w-100">

                        Mulai Evaluasi

                    </a>

                </div>

            </div>

        </div>

        @empty

        <div class="col-12">
            <div class="alert alert-info">
                Belum ada evaluasi tersedia.
            </div>
        </div>

        @endforelse

    </div>

</div>
@endsection