<div class="modal fade" id="largemodal_edit<?= $d['id_penerima_lisdes']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Penerima Lisdes</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-edit-penerima" action="../admin-penerima-lisdes/penerima_lisdes_edit.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_penerima_lisdes" value="<?= $d['id_penerima_lisdes'] ?>">
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_nama_calon_konsumen">Nama Calon Konsumen</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_calon_konsumen" id="edit_nama_calon_konsumen" class="form-control" value="<?= $d['nama_calon_konsumen'] ?>" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_nik">NIK</label>
                        <div class="col-md-9">
                            <input type="text" name="nik" id="edit_nik" class="form-control" value="<?= $d['nik'] ?>" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_alamat">Alamat</label>
                        <div class="col-md-9">
                            <textarea name="alamat" id="edit_alamat" class="form-control" required><?= $d['alamat'] ?></textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_id_kab_kota">Kabupaten/Kota</label>
                         <div class="col-md-9">
                            <input type="text" name="nama_kab_kota" id="nama_kab_kota" class="form-control" value="<?= $d['nama_kab_kota'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_id_kecamatan">Kecamatan</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_kab_kota" id="nama_kab_kota" class="form-control" value="<?= $d['nama_kecamatan'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_id_desa">Desa</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_kab_kota" id="nama_kab_kota" class="form-control" value="<?= $d['nama_desa'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_membutuhkan_bantuan">Membutuhkan Bantuan</label>
                        <div class="col-md-9">
                            <select name="membutuhkan_bantuan" id="edit_membutuhkan_bantuan" class="form-control" required>
                                <option value="" <?= (empty($d['membutuhkan_bantuan'])) ? 'selected' : '' ?>>Pilihan</option>
                                <option value="Ya" <?= ($d['membutuhkan_bantuan'] == 'Ya') ? 'selected' : '' ?>>Ya</option>
                                <option value="Tidak" <?= ($d['membutuhkan_bantuan'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_menaati_ketentuan">Menaati Ketentuan</label>
                        <div class="col-md-9">
                            <select name="menaati_ketentuan" id="edit_menaati_ketentuan" class="form-control" required>
                                <option value="" <?= (empty($d['menaati_ketentuan'])) ? 'selected' : '' ?>>Pilihan</option>
                                <option value="Ya" <?= ($d['menaati_ketentuan'] == 'Ya') ? 'selected' : '' ?>>Ya</option>
                                <option value="Tidak" <?= ($d['menaati_ketentuan'] == 'Tidak') ? 'selected' : '' ?>>Tidak</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_jarak_rumah">Jarak Rumah (km)</label>
                        <div class="col-md-9">
                            <input type="number" name="jarak_rumah" id="edit_jarak_rumah" class="form-control" value="<?= $d['jarak_rumah'] ?>" step="0.01" required>
                        </div>
                    </div>
                   
                   
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="edit_catatan">Catatan</label>
                        <div class="col-md-9">
                            <textarea name="catatan" id="edit_catatan" class="form-control"><?= $d['catatan'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-sm btn-primary" value="Simpan Perubahan"></input>
                    <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // Fungsi untuk memperbarui select Kecamatan berdasarkan Kabupaten/Kota yang dipilih
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

// Fungsi untuk memperbarui select Desa berdasarkan Kecamatan yang dipilih
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

// Event listener untuk memperbarui select Kecamatan saat select Kabupaten/Kota berubah
document.getElementById('edit_kab_kota').addEventListener('change', function() {
    updateKecamatanSelect(this.value, 'edit_kecamatan');
});

// Event listener untuk memperbarui select Desa saat select Kecamatan berubah
document.getElementById('edit_kecamatan').addEventListener('change', function() {
    updateDesaSelect(this.value, 'edit_desa');
});

</script>