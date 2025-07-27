<!-- Modal Edit Kategori -->
<div class="modal fade" id="modal_edit_kategori<?= $d['id_kat_produk'] ?>" tabindex="-1" aria-labelledby="modalEditKategoriLabel<?= $d['id_kat_produk'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <form action="../admin/kategori_edit.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditKategoriLabel<?= $d['id_kat_produk'] ?>">Edit Kategori</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_kat_produk" value="<?= $d['id_kat_produk'] ?>">

          <div class="mb-3 row align-items-center">
            <label class="col-sm-4 col-form-label">Nama Kategori</label>
            <div class="col-sm-8">
              <input type="text" name="nama_kategori" class="form-control" value="<?= $d['nama_kategori'] ?>" required>
            </div>
          </div>

          <div class="mb-3 row align-items-center">
            <label class="col-sm-4 col-form-label">Deskripsi</label>
            <div class="col-sm-8">
              <textarea name="deskripsi_kategori" class="form-control" rows="3" required><?= $d['deskripsi_kategori'] ?></textarea>
            </div>
          </div>

          <div class="mb-3 row align-items-center">
            <label class="col-sm-4 col-form-label">Status</label>
            <div class="col-sm-8">
              <select name="status_kategori" class="form-control" required>
                <option value="Aktif" <?= $d['status_kategori'] == 'Aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="Tidak Aktif" <?= $d['status_kategori'] == 'Tidak Aktif' ? 'selected' : '' ?>>Tidak Aktif</option>
              </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Simpan Perubahan</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
