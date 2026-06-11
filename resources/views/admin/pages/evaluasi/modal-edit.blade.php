<div class="modal fade" id="modalEdit">
    <div class="modal-dialog">

        <form id="formEdit" method="POST">

            @csrf
            @method('PUT')

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Evaluasi</h5>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label>Judul</label>
                        <input
                            type="text"
                            id="editJudul"
                            name="judul"
                            class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Deskripsi</label>
                        <textarea
                            id="editDeskripsi"
                            name="deskripsi"
                            class="form-control"></textarea>
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