<!-- Modal -->
<div class="modal fade" id="largemodal_edit<?= $d['id_desa']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Desa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../data-master/desa_edit.php" method="POST">
        <div class="modal-body">
          <div class="row mb-4">
            <label class="col-md-3 form-label" for="id_kecamatan">Nama Kecamatan</label>
            <div class="col-md-9">
              <select name="id_kecamatan" class="form-control" id="id_kecamatan_edit" required>
                <option value="<?= $d['id_kecamatan'] ?>">Pilihan Awal = <?= $d['nama_kecamatan'] ?></option>
                <?php
                  $d1 = mysqli_query($koneksi, "SELECT id_kecamatan, nama_kecamatan FROM tb_kecamatan ORDER BY nama_kecamatan ASC");
                  while ($d_kecamatan = mysqli_fetch_array($d1)) {
                    echo "<option value='{$d_kecamatan['id_kecamatan']}'>{$d_kecamatan['nama_kecamatan']}</option>";
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="row mb-4">
            <label class="col-md-3 form-label" for="nama_desa">Nama Desa</label>
            <div class="col-md-9">
              <input type="hidden" name="id_desa" value="<?= $d['id_desa'] ?>" class="form-control" required>
              <input type="text" name="nama_desa" value="<?= $d['nama_desa'] ?>" class="form-control" required>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
