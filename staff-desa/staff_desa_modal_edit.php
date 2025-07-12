<!-- Modal -->
<div class="modal fade" id="largemodal_edit<?= $d['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Staff Desa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="../staff-desa/staff_desa_edit.php" method="POST">
        <div class="modal-body">
            <div class="row mb-4">
                <label class="col-md-3 form-label" for="username_edit">Username</label>
                <div class="col-md-9">
                <input type="hidden" name="id_user" value="<?= $d['id_user'] ?>" required>
                <input type="text" id="username_edit" name="username" value="<?= $d['username'] ?>" class="form-control" required>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-md-3 form-label">Nama Staff Keluarahan</label>
                <div class="col-md-9">
                <input type="text" name="nama_staff_desa" value="<?= $d['nama_staff_desa'] ?>" class="form-control" required>
                </div>
            </div>

            <div class="row mb-4">
                <label class="col-md-3 form-label">Nama Kabupaten/Kota</label>
                <div class="col-md-9">
                    <select name="id_kab_kota" class="form-control" required onchange="updateKecamatanSelect(this.value, 'kecamatan_edit')">
                        <option value="">-- Pilih Kabupaten/Kota --</option>
                        <?php
                            include '../koneksi.php';
                            $kab_kota_data = mysqli_query($koneksi, "SELECT id_kab_kota, nama_kab_kota FROM tb_kab_kota ORDER BY nama_kab_kota ASC");
                            while ($row = mysqli_fetch_assoc($kab_kota_data)) {
                                echo "<option value='{$row['id_kab_kota']}'>{$row['nama_kab_kota']}</option>";
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-md-3 form-label">Nama Kecamatan</label>
                <div class="col-md-9">
                    <select name="id_kecamatan" id="kecamatan_edit" class="form-control" required onchange="updateDesaSelect(this.value, 'desa_edit')">
                        <option value="">-- Pilih Kecamatan --</option>
                        <!-- Options will be populated dynamically by JavaScript -->
                    </select>
                </div>
            </div>
            <div class="row mb-4">
                <label class="col-md-3 form-label">Nama Desa</label>
                <div class="col-md-9">
                    <select name="id_desa" id="desa_edit" class="form-control" required>
                        <option value="">-- Pilih Desa --</option>
                        <!-- Options will be populated dynamically by JavaScript -->
                    </select>
                </div>
            </div>
        
            <div class="row mb-4">
                <label class="col-md-3 form-label">Status Staff</label>
                <div class="col-md-9">
                <select name="status_staff" class="form-control" required>
                    <option value="Aktif" <?= ($d['status_staff'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                    <option value="Nonaktif" <?= ($d['status_staff'] == 'Nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                </select>
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

<script>
    function updateKecamatanSelect(id_kab_kota, targetId) {
        const kecamatanSelect = document.getElementById(targetId);
        kecamatanSelect.innerHTML = '<option value="">Loading...</option>'; // Menampilkan loading

        if (id_kab_kota) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_kecamatan.php?id_kab_kota=' + id_kab_kota, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const kecamatanList = JSON.parse(xhr.responseText);
                    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>'; // Hapus opsi loading

                    kecamatanList.forEach(kecamatan => {
                        const option = document.createElement('option');
                        option.value = kecamatan.id_kecamatan;
                        option.textContent = kecamatan.nama_kecamatan;
                        kecamatanSelect.appendChild(option);
                    });
                }
            };
            xhr.send();
        } else {
            kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>'; // Reset jika tidak ada pilihan
        }
    }

    function updateDesaSelect(id_kecamatan, targetId) {
        const desaSelect = document.getElementById(targetId);
        desaSelect.innerHTML = '<option value="">Loading...</option>'; // Menampilkan loading

        if (id_kecamatan) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_desa.php?id_kecamatan=' + id_kecamatan, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const desaList = JSON.parse(xhr.responseText);
                    desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>'; // Hapus opsi loading

                    desaList.forEach(desa => {
                        const option = document.createElement('option');
                        option.value = desa.id_desa;
                        option.textContent = desa.nama_desa;
                        desaSelect.appendChild(option);
                    });
                }
            };
            xhr.send();
        } else {
            desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>'; // Reset jika tidak ada pilihan
        }
    }

    document.querySelector('select[name="id_kab_kota"]').addEventListener('change', function() {
        updateKecamatanSelect(this.value, 'kecamatan_edit');
    });

    document.querySelector('#kecamatan_edit').addEventListener('change', function() {
        updateDesaSelect(this.value, 'desa_edit');
    });

</script>
