<div class="modal fade" id="modalDelete">
    <div class="modal-dialog">

        <form id="formDelete" method="POST">

            @csrf
            @method('DELETE')

            <div class="modal-content">

                <div class="modal-header">
                    <h5>Hapus Evaluasi</h5>
                </div>

                <div class="modal-body">
                    Yakin ingin menghapus evaluasi?
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