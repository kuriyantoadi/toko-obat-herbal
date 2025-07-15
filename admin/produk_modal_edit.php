<!-- Modal Edit Produk -->
<div class="modal fade" id="modal_edit_produk<?= $p['id_produk'] ?>" tabindex="-1" aria-labelledby="modalEditProdukLabel<?= $p['id_produk'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="../admin/produk_update.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditProdukLabel<?= $p['id_produk'] ?>">Edit Produk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">

          <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">

          <div class="mb-3">
            <label for="nama_produk" class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" value="<?= htmlspecialchars($p['nama_produk']) ?>" required>
          </div>

          <div class="mb-3">
            <label for="harga_produk" class="form-label">Harga Produk</label>
            <input type="number" name="harga_produk" class="form-control" value="<?= $p['harga_produk'] ?>" required>
          </div>

          <div class="mb-3">
            <label for="id_kat_produk" class="form-label">Kategori</label>
            <select name="id_kat_produk" class="form-control select1" required>
              <option value="">-- Pilih Kategori --</option>
              <?php
              $kategori_edit = mysqli_query($koneksi, "SELECT * FROM tb_kategori_produk ORDER BY nama_kategori ASC");
              while ($kat_edit = mysqli_fetch_array($kategori_edit)) {
                $selected = ($kat_edit['id_kat_produk'] == $p['id_kat_produk']) ? 'selected' : '';
                echo "<option value='{$kat_edit['id_kat_produk']}' $selected>{$kat_edit['nama_kategori']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="deskripsi_produk" class="form-label">Deskripsi Produk</label>
            <textarea name="deskripsi_produk" class="form-control" rows="3" required><?= htmlspecialchars($p['deskripsi_produk']) ?></textarea>
          </div>

          <div class="mb-3">
            <label for="stok_produk" class="form-label">Stok</label>
            <input type="number" name="stok_produk" class="form-control" value="<?= $p['stok_produk'] ?>" required>
          </div>

          <div class="mb-3">
            <label for="berat_produk" class="form-label">Berat (gram)</label>
            <input type="number" name="berat_produk" class="form-control" value="<?= $p['berat_produk'] ?>" required>
          </div>

          <div class="mb-3">
            <label for="gambar_produk" class="form-label">Gambar Produk</label><br>
            <img src="../uploads/produk/<?= $p['gambar_produk'] ?>" width="100" class="mb-2 img-thumbnail"><br>
            <input type="file" name="gambar_produk" class="form-control" accept=".jpg, .jpeg, .png">
            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar</small>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Update</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
