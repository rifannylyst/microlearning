<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <form action="{{ route('admin.evaluasi.store') }}" method="POST">

            @csrf

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Tambah Evaluasi</h5>
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
                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </div>

        </form>
    </div>
</div>