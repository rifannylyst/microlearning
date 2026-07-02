@extends('admin.layouts.app')

@section('title', 'Evaluasi')

@section('content')
<div class="container-fluid py-4">
    <h4>Evaluasi</h4>
    <div class="d-flex mb-3 justify-content-end">
        <a href="{{ route('admin.evaluasi.hasil') }}" class="btn btn-info btn-bg px-4 mx-2">Soal</a>
        <button
            type="button"
            class="btn btn-primary px-4"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">
            Tambah Evaluasi
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
                                class="btn btn-warning btn-sm"
                                onclick="editEvaluasi(
                                    '{{ $evaluasi->id }}',
                                    '{{ $evaluasi->judul }}',
                                    `{{ $evaluasi->deskripsi }}`
                                )">
                                Edit
                            </button>

                            <button
                                class="btn btn-danger btn-sm"
                                onclick="hapusEvaluasi('{{ $evaluasi->id }}')">
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
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.evaluasi.store') }}" method="POST">
            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Evaluasi</h5>

                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input
                            type="text"
                            name="judul"
                            class="form-control"
                            required>
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea
                            name="deskripsi"
                            class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-primary">
                        Simpan
                    </button>

                </div>

            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modalEdit" tabindex="-1">
    <div class="modal-dialog">
        <form id="formEdit" method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Evaluasi</h5>

                    <button
                        class="btn-close"
                        data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <input
                        type="text"
                        id="editJudul"
                        name="judul"
                        class="form-control mb-3">

                    <textarea
                        id="editDeskripsi"
                        name="deskripsi"
                        class="form-control"></textarea>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-primary">
                        Update
                    </button>

                </div>

            </div>

        </form>
    </div>
</div>

<div class="modal fade" id="modalDelete" tabindex="-1">
    <div class="modal-dialog modal-sm">

        <form id="formDelete" method="POST">

            @csrf
            @method('DELETE')

            <div class="modal-content">

                <div class="modal-body text-center">

                    <h5>Hapus evaluasi?</h5>

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-danger">
                        Hapus
                    </button>

                </div>

            </div>

        </form>

    </div>
</div>

<script>
function editEvaluasi(id, judul, deskripsi){

    document.getElementById('editJudul').value = judul;
    document.getElementById('editDeskripsi').value = deskripsi;

    document.getElementById('formEdit').action =
        '/admin/evaluasi/' + id;

    bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalEdit')
    ).show();

}

function hapusEvaluasi(id){

    document.getElementById('formDelete').action =
        '/admin/evaluasi/' + id;

    bootstrap.Modal.getOrCreateInstance(
        document.getElementById('modalDelete')
    ).show();

}
</script>
@endsection
