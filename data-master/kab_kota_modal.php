<div class="modal fade" id="largemodal_edit<?= $d['id_kab_kota']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kabupaten/Kota</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
            </div>

            <form action="../data-master/kab_kota_edit.php" method="POST">
                <div class="modal-body">
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="example-email">Nama Kabupaten/Kota</label>
                        <div class="col-md-9">
                        <input type="hidden" name="id_kab_kota" class="form-control" value="<?= $d['id_kab_kota'] ?>" require>
                        <input type="text" name="nama_kab_kota" class="form-control" value="<?= $d['nama_kab_kota'] ?>" require>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <input type="submit" class="btn btn-sm btn-primary"></input>
                    <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>