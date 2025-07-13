<!-- Modal Tambah Produk -->
<div class="modal fade" id="modal_tambah_produk" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <form action="../admin/produk_tambah.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahProdukLabel">Tambah Produk Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">

          <div class="row mb-3">
            <label class="col-md-3 form-label">Nama Produk</label>
            <div class="col-md-9">
              <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" required>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label">Harga</label>
            <div class="col-md-9">
              <input type="number" name="harga_produk" class="form-control" placeholder="Harga Produk" required>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label">Kategori</label>
            <div class="col-md-9">
              <select name="id_kat_produk" class="form-control select2" required>
                <option value="">-- Pilih Kategori --</option>
                <?php
                include '../koneksi.php';
                $kategori = mysqli_query($koneksi, "SELECT * FROM tb_kategori_produk ORDER BY nama_kategori ASC");
                while ($kat = mysqli_fetch_array($kategori)) {
                  echo "<option value='{$kat['id_kat_produk']}'>{$kat['nama_kategori']}</option>";
                }
                ?>
              </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label">Deskripsi Produk</label>
            <div class="col-md-9">
              <textarea name="dekripsi_produk" class="form-control" rows="3" placeholder="Deskripsi produk..." required></textarea>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label">Stok Produk</label>
            <div class="col-md-9">
              <input type="number" name="stok_produk" class="form-control" placeholder="Jumlah Stok" required>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-md-3 form-label">Berat Produk (gram)</label>
            <div class="col-md-9">
              <input type="number" name="berat_produk" class="form-control" placeholder="Contoh: 500" required>
            </div>
          </div>

          <div class="row mb-4">
            <label class="col-md-3 form-label">Upload Gambar</label>
            <div class="col-md-9">
              <input type="file" name="gambar_produk" class="form-control" accept=".jpg, .jpeg, .png" required>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary btn-sm">Simpan Produk</button>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
