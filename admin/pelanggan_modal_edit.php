<!-- Modal Edit Pelanggan -->
<div class="modal fade" id="largemodal_edit<?= $d['id_pelanggan']; ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $d['id_pelanggan']; ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-start" id="editModalLabel<?= $d['id_pelanggan']; ?>">Edit Data Pelanggan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../admin/pelanggan_edit.php" method="POST">
        <div class="modal-body">

          <input type="hidden" name="id_pelanggan" value="<?= $d['id_pelanggan'] ?>" required>

          <div class="row mb-3">
            <label class="col-md-3 form-label text-start">Nama Pelanggan</label>
            <div class="col-md-9">
              <input type="text" name="nama_pelanggan" value="<?= $d['nama_pelanggan'] ?>" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label text-start">Email</label>
            <div class="col-md-9">
              <input type="email" name="email_pelanggan" value="<?= $d['email_pelanggan'] ?>" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label text-start">Password<br><small>(Kosongkan jika tidak diubah)</small></label>
            <div class="col-md-9">
              <input type="password" name="password_pelanggan" class="form-control">
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label text-start">No HP</label>
            <div class="col-md-9">
              <input type="text" name="no_hp_pelanggan" value="<?= $d['no_hp_pelanggan'] ?>" class="form-control" required>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label text-start">Alamat</label>
            <div class="col-md-9">
              <textarea name="alamat_pelanggan" class="form-control" rows="3" required><?= $d['alamat_pelanggan'] ?></textarea>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
