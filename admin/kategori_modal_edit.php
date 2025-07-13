<!-- Modal Edit Kategori -->
<div class="modal fade" id="modal_edit_kategori<?= $d['id_kategori']; ?>" tabindex="-1" aria-labelledby="editKategoriLabel<?= $d['id_kategori']; ?>" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editKategoriLabel<?= $d['id_kategori']; ?>">Edit Kategori</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../admin/kategori_edit.php" method="POST">
        <div class="modal-body">
          <input type="hidden" name="id_kategori" value="<?= $d['id_kategori'] ?>">
          <div class="mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama_kategori" value="<?= $d['nama_kategori'] ?>" class="form-control" required>
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
