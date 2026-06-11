@extends('admin.layouts.app')

@section('title', 'Evaluasi')

@section('content')
<div class="container-fluid py-4">
    <h4>Evaluasi</h4>
    <div class="d-flex mb-3 justify-content-end">
        <a href="{{ route('admin.evaluasi.hasil') }}" class="btn btn-info btn-bg px-4 mx-2">Soal</a>
        <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">
            + Tambah Evaluasi
        </button>
        
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Judul</th>
                        <th>Jumlah Soal</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($evaluasis as $evaluasi)

                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>{{ $evaluasi->judul }}</td>

                        <td>{{ $evaluasi->soal_count }}</td>

                        <td>

                            <a
                                href="{{ route('admin.evaluasi.soal',$evaluasi->id) }}"
                                class="btn btn-info btn-sm">
                                Soal
                            </a>

                            <button
                                class="btn btn-warning btn-sm btn-edit"
                                data-id="{{ $evaluasi->id }}"
                                data-judul="{{ $evaluasi->judul }}"
                                data-deskripsi="{{ $evaluasi->deskripsi }}">
                                Edit
                            </button>

                            <button
                                class="btn btn-danger btn-sm btn-delete"
                                data-id="{{ $evaluasi->id }}">
                                Hapus
                            </button>

                        </td>
                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            Belum ada evaluasi
                        </td>
                    </tr>

                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

@include('admin.pages.evaluasi.modal-tambah')
@include('admin.pages.evaluasi.modal-edit')
@include('admin.pages.evaluasi.modal-hapus')

@endsection

@push('scripts')
<script>

document.querySelectorAll('.btn-edit')
.forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.dataset.id;

        document.getElementById('editJudul').value =
            this.dataset.judul;

        document.getElementById('editDeskripsi').value =
            this.dataset.deskripsi ?? '';

        document.getElementById('formEdit').action =
            `/admin/evaluasi/${id}`;

        new bootstrap.Modal(
            document.getElementById('modalEdit')
        ).show();

    });

});

document.querySelectorAll('.btn-delete')
.forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.dataset.id;

        document.getElementById('formDelete').action =
            `/admin/evaluasi/${id}`;

        new bootstrap.Modal(
            document.getElementById('modalDelete')
        ).show();

    });

});

</script>
@endpush