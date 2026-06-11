@extends('admin.layouts.app')

@section('title', 'Soal Evaluasi')

@section('content')

<div class="container-fluid py-4">

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4>{{ $evaluasi->judul }}</h4>
        <small class="text-muted">
            Kelola soal evaluasi
        </small>
    </div>

    <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah">

        + Tambah Soal
    </button>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Soal</th>
                    <th width="15%">Tipe</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>

            @forelse($soals as $soal)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>

                        <strong>
                            {{ $soal->soal }}
                        </strong>

                        @if($soal->tipe == 'pilihan_ganda')

                            <ul class="mt-2 mb-0">

                                @foreach($soal->opsi_jawaban as $opsi)

                                    <li>{{ chr(65 + $loop->index) }}.{{ $opsi }}</li>

                                @endforeach

                            </ul>

                            <small class="text-success">
                                Kunci:
                                {{ $soal->kunci_jawaban }}
                            </small>

                        @endif

                    </td>

                    <td>

                        @if($soal->tipe == 'pilihan_ganda')
                            <span class="badge bg-primary">
                                Pilihan Ganda
                            </span>
                        @else
                            <span class="badge bg-success">
                                Isian
                            </span>
                        @endif

                    </td>

                    <td>

                        <button
                            class="btn btn-warning btn-sm btn-edit"

                            data-id="{{ $soal->id }}"
                            data-soal="{{ $soal->soal }}"
                            data-tipe="{{ $soal->tipe }}"
                            data-kunci="{{ $soal->kunci_jawaban }}"

                            data-opsi='@json($soal->opsi_jawaban)'>

                            Edit
                        </button>

                        <button
                            class="btn btn-danger btn-sm btn-delete"
                            data-id="{{ $soal->id }}">

                            Hapus
                        </button>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="4" class="text-center">
                        Belum ada soal.
                    </td>
                </tr>

            @endforelse

            </tbody>
        </table>

    </div>
    <div class="card-body">
    <button onclick="window.location.href='{{ route('admin.evaluasi') }}'" class="btn btn-secondary btn-sm"> Kembali </button>
    </div>
</div>

</div>

{{-- MODAL TAMBAH --}}

<div class="modal fade" id="modalTambah">

<div class="modal-dialog modal-lg">

    <form action="{{ route('admin.evaluasi.soal.store') }}" method="POST">

        @csrf

        <input
            type="hidden"
            name="evaluasi_id"
            value="{{ $evaluasi->id }}">

        <div class="modal-content">

            <div class="modal-header">
                <h5>Tambah Soal</h5>
            </div>

            <div class="modal-body">

                <div class="mb-3">
                    <label>Soal</label>

                    <textarea
                        name="soal"
                        class="form-control"
                        rows="3"
                        required></textarea>
                </div>

                <div class="mb-3">
                    <label>Tipe Soal</label>

                    <select
                        name="tipe"
                        id="tipeTambah"
                        class="form-select">

                        <option value="pilihan_ganda">
                            Pilihan Ganda
                        </option>

                        <option value="isian">
                            Isian
                        </option>

                    </select>
                </div>

                <div id="opsiTambah">

                    <div class="mb-3">
                        <label>Opsi A</label>
                        <div class="input-group">
                            <input type="text" name="opsi_a" class="form-control">

                            <div class="input-group-text">
                                <input
                                    type="radio"
                                    name="kunci_jawaban"
                                    value="A">
                                <span class="ms-2">Kunci</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Opsi B</label>
                        <div class="input-group">
                            <input type="text" name="opsi_b" class="form-control">

                            <div class="input-group-text">
                                <input
                                    type="radio"
                                    name="kunci_jawaban"
                                    value="B">
                                <span class="ms-2">Kunci</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Opsi C</label>
                        <div class="input-group">
                            <input type="text" name="opsi_c" class="form-control">

                            <div class="input-group-text">
                                <input
                                    type="radio"
                                    name="kunci_jawaban"
                                    value="C">
                                <span class="ms-2">Kunci</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label>Opsi D</label>
                        <div class="input-group">
                            <input type="text" name="opsi_d" class="form-control">

                            <div class="input-group-text">
                                <input
                                    type="radio"
                                    name="kunci_jawaban"
                                    value="D">
                                <span class="ms-2">Kunci</span>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">
                    Simpan
                </button>
            </div>

        </div>

    </form>

</div>

</div>

{{-- MODAL EDIT --}}

<div class="modal fade" id="modalEdit">

<div class="modal-dialog modal-lg">

    <form id="formEdit" method="POST">

        @csrf
        @method('PUT')

        <div class="modal-content">

            <div class="modal-header">
                <h5>Edit Soal</h5>
            </div>

            <div class="modal-body">

                <div class="mb-3">

                    <label>Soal</label>

                    <textarea
                        id="editSoal"
                        name="soal"
                        class="form-control"
                        rows="3"></textarea>

                </div>

                <div class="mb-3">

                    <label>Tipe</label>

                    <select
                        id="editTipe"
                        name="tipe"
                        class="form-select">

                        <option value="pilihan_ganda">
                            Pilihan Ganda
                        </option>

                        <option value="isian">
                            Isian
                        </option>

                    </select>

                </div>

                <div id="opsiEdit">

                <div class="mb-3">
                    <label>Opsi A</label>
                    <div class="input-group">

                        <input
                            id="editA"
                            type="text"
                            name="opsi_a"
                            class="form-control">

                        <div class="input-group-text">
                            <input
                                type="radio"
                                name="kunci_jawaban"
                                value="A"
                                id="kunciA">
                        </div>

                    </div>
                </div>

                <div class="mb-3">
                    <label>Opsi B</label>
                    <div class="input-group">

                        <input
                            id="editB"
                            type="text"
                            name="opsi_b"
                            class="form-control">

                        <div class="input-group-text">
                            <input
                                type="radio"
                                name="kunci_jawaban"
                                value="B"
                                id="kunciB">
                        </div>

                    </div>
                </div>

                <div class="mb-3">
                    <label>Opsi C</label>
                    <div class="input-group">

                        <input
                            id="editC"
                            type="text"
                            name="opsi_c"
                            class="form-control">

                        <div class="input-group-text">
                            <input
                                type="radio"
                                name="kunci_jawaban"
                                value="C"
                                id="kunciC">
                        </div>

                    </div>
                </div>

                <div class="mb-3">
                    <label>Opsi D</label>
                    <div class="input-group">

                        <input
                            id="editD"
                            type="text"
                            name="opsi_d"
                            class="form-control">

                        <div class="input-group-text">
                            <input
                                type="radio"
                                name="kunci_jawaban"
                                value="D"
                                id="kunciD">
                        </div>

                    </div>
                </div>

            </div>

            </div>

            <div class="modal-footer">
                <button class="btn btn-success">
                    Update
                </button>
            </div>

        </div>

    </form>

</div>

</div>

{{-- MODAL HAPUS --}}

<div class="modal fade" id="modalDelete">

<div class="modal-dialog">

    <form id="formDelete" method="POST">

        @csrf
        @method('DELETE')

        <div class="modal-content">

            <div class="modal-header">
                <h5>Hapus Soal</h5>
            </div>

            <div class="modal-body">

                Yakin ingin menghapus soal ini?

            </div>

            <div class="modal-footer">

                <button class="btn btn-danger">
                    Hapus
                </button>

            </div>

        </div>

    </form>

</div>

</div>

@endsection

@push('scripts')

<script>

function toggleTambah() {

    let tipe = document.getElementById('tipeTambah').value;

    document.getElementById('opsiTambah').style.display =
        tipe === 'pilihan_ganda'
        ? 'block'
        : 'none';
}

document
.getElementById('tipeTambah')
.addEventListener('change', toggleTambah);

toggleTambah();

document.querySelectorAll('.btn-edit')
.forEach(btn => {

    btn.addEventListener('click', function(){

        let id = this.dataset.id;

        let opsi = JSON.parse(this.dataset.opsi || '[]');

        document.getElementById('formEdit').action =
            `/admin/soal/${id}`;

        document.getElementById('editSoal').value =
            this.dataset.soal;

        document.getElementById('editTipe').value =
            this.dataset.tipe;

        document.getElementById('editA').value =
            opsi[0] ?? '';

        document.getElementById('editB').value =
            opsi[1] ?? '';

        document.getElementById('editC').value =
            opsi[2] ?? '';

        document.getElementById('editD').value =
            opsi[3] ?? '';

        document
        .querySelectorAll('#opsiEdit input[type=radio]')
        .forEach(radio => radio.checked = false);

        let kunci = this.dataset.kunci;

        if(kunci){
            let radio =
                document.getElementById('kunci' + kunci);

            if(radio){
                radio.checked = true;
            }
        }

        document.getElementById('opsiEdit').style.display =
            this.dataset.tipe === 'pilihan_ganda'
            ? 'block'
            : 'none';

        new bootstrap.Modal(
            document.getElementById('modalEdit')
        ).show();

    });

});

document.getElementById('editTipe')
.addEventListener('change', function(){

    document.getElementById('opsiEdit').style.display =
        this.value === 'pilihan_ganda'
        ? 'block'
        : 'none';

});

document.querySelectorAll('.btn-delete')
.forEach(btn => {

    btn.addEventListener('click', function(){

        document.getElementById('formDelete').action =
            `/admin/soal/${this.dataset.id}`;

        new bootstrap.Modal(
            document.getElementById('modalDelete')
        ).show();

    });

});

</script>

@endpush
