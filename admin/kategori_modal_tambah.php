<!-- Modal Tambah Kategori -->
<div class="modal fade" id="modal_tambah_kategori" tabindex="-1" aria-labelledby="tambahKategoriLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <form action="../admin/kategori_tambah.php" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="tambahKategoriLabel">Tambah Kategori Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
          </div>

          <div class="mb-3">
            <label for="deskripsi_kategori" class="form-label">Deskripsi</label>
            <textarea name="deskripsi_kategori" class="form-control" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label for="status_kategori" class="form-label">Status</label>
            <select name="status_kategori" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="Aktif">Aktif</option>
              <option value="Tidak Aktif">Tidak Aktif</option>
            </select>
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
