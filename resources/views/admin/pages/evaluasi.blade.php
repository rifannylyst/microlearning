@extends('admin.layouts.app')

@section('title', 'Evaluasi')

@section('content')
<div class="flex justify-between items-center mb-8">
    <div>
        <!-- space for visual alignment -->
    </div>
    <div class="flex flex-wrap gap-2.5">
        <a href="{{ route('admin.evaluasi.hasil') }}" class="flex items-center gap-2 bg-white hover:bg-slate-50 text-slate-700 px-4 py-2.5 rounded-xl text-xs font-semibold border border-slate-200/60 transition-all duration-200 no-underline shadow-sm">
            <i class="bi bi-file-earmark-text text-sm"></i>
            <span>Hasil</span>
        </a>
        <button
            type="button"
            class="flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-4 py-2.5 rounded-xl text-xs font-semibold shadow-sm hover:shadow shadow-blue-500/10 transition-all duration-200"
            data-bs-toggle="modal"
            data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i>
            <span>Tambah Evaluasi</span>
        </button>
    </div>
</div>

<div class="bg-white shadow-sm border border-slate-200/60 rounded-2xl p-6">
    <table class="min-w-full table-auto">
        <thead>
            <tr class="bg-slate-50 text-slate-500 uppercase text-[11px] leading-normal font-bold border-b border-slate-100">
                <th class="py-3 px-6 text-left" width="8%">No</th>
                <th class="py-3 px-6 text-left">Judul</th>
                <th class="py-3 px-6 text-left">Jumlah Soal</th>
                <th class="py-3 px-6 text-center" width="20%">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-slate-600 text-xs font-medium">

            @forelse($evaluasis as $evaluasi)

            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition-colors">
                <td class="py-3 px-6 text-left">{{ $loop->iteration }}</td>

                <td class="py-3 px-6 text-left font-semibold text-slate-800">{{ $evaluasi->judul }}</td>

                <td class="py-3 px-6 text-left">{{ $evaluasi->soal_count }}</td>

                <td class="py-3 px-6 text-center">
                    <div class="flex items-center justify-center gap-2">
                        <a
                            href="{{ route('admin.evaluasi.soal', $evaluasi->id) }}"
                            class="w-8 h-8 rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-600 border border-blue-200/30 flex items-center justify-center transition-all duration-200 shadow-sm"
                            title="Daftar Soal">
                            <i class="bi bi-eye-fill"></i>
                        </a>

                        <button
                            type="button"
                            class="w-8 h-8 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-600 border border-amber-200/30 flex items-center justify-center transition-all duration-200 shadow-sm"
                            onclick="editEvaluasi(
                                '{{ $evaluasi->id }}',
                                '{{ $evaluasi->judul }}',
                                `{{ $evaluasi->deskripsi }}`
                            )"
                            title="Edit Evaluasi">
                            <i class="bi bi-pencil-square text-sm"></i>
                        </button>

                        <button
                            type="button"
                            class="w-8 h-8 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 border border-red-200/30 flex items-center justify-center transition-all duration-200 shadow-sm"
                            onclick="hapusEvaluasi('{{ $evaluasi->id }}')"
                            title="Hapus Evaluasi">
                            <i class="bi bi-trash text-sm"></i>
                        </button>
                    </div>
                </td>
            </tr>

            @empty

            <tr>
                <td colspan="4" class="text-center py-6 text-slate-400 font-medium">
                    Belum ada evaluasi
                </td>
            </tr>

            @endforelse

        </tbody>
    </table>

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
