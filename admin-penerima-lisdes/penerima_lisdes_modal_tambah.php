<div class="modal fade" id="largemodal_tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penerima Lisdes</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-tambah-penerima" action="../admin-penerima-lisdes/penerima_lisdes_tambah.php" method="POST">
                <div class="modal-body">
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="nama_calon_konsumen">Nama Calon Konsumen</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_calon_konsumen" class="form-control" required>
                        </div>
                    </div>   
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="nik">NIK</label>
                        <div class="col-md-9">
                            <input type="text" name="nik" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="alamat">Alamat</label>
                        <div class="col-md-9">
                            <textarea name="alamat" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="id_kab_kota">Kabupaten/Kota</label>
                        <div class="col-md-9">
                            <select name="id_kab_kota" class="form-control" id="kab_kota_tambah" required>
                                <option value="">Pilihan</option>
                                <?php
                                    $d1 = mysqli_query($koneksi, "SELECT id_kab_kota, nama_kab_kota FROM tb_kab_kota ORDER BY nama_kab_kota ASC");
                                    while ($d_kab_kota = mysqli_fetch_array($d1)) {
                                ?>
                                    <option value="<?= $d_kab_kota['id_kab_kota'] ?>"><?= $d_kab_kota['nama_kab_kota'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>   
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="id_kecamatan">Kecamatan</label>
                        <div class="col-md-9">
                            <select name="id_kecamatan" class="form-control" id="kecamatan_tambah" required>
                                <option value="">-- Pilih Kecamatan --</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="id_desa">Desa</label>
                        <div class="col-md-9">
                            <select name="id_desa" class="form-control" id="desa_tambah" required>
                                <option value="">-- Pilih Desa --</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="membutuhkan_bantuan">Membutuhkan Bantuan</label>
                        <div class="col-md-9">
                            <select name="membutuhkan_bantuan" class="form-control" required>
                                <option value="">Pilihan</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="menunggu_bantuan">Menunggu Bantuan</label>
                        <div class="col-md-9">
                            <select name="menunggu_bantuan" class="form-control" required>
                                <option value="">Pilihan</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="menaati_ketentuan">Menaati Ketentuan</label>
                        <div class="col-md-9">
                            <select name="menaati_ketentuan" class="form-control" required>
                                <option value="">Pilihan</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="jarak_rumah">Jarak Rumah (km)</label>
                        <div class="col-md-9">
                            <input type="number" name="jarak_rumah" class="form-control" step="0.01" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="petugas_survei">Petugas Survei</label>
                        <div class="col-md-9">
                            <input type="text" name="petugas_survei" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="status_pemasangan">Status Pemasangan</label>
                        <div class="col-md-9">
                            <select name="status_pemasangan" class="form-control" required>
                                <option value="">Pilihan</option>
                                <option value="Belum Terpasang">Belum Terpasang</option>
                                <option value="Sudah Terpasang">Sudah Terpasang</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="catatan_ditolak">Catatan</label>
                        <div class="col-md-9">
                            <textarea name="catatan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-sm btn-primary" value="Tambah"></input>
                    <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
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
        updateKecamatanSelect(this.value, 'kecamatan_tambah');
    });

    document.querySelector('#kecamatan_tambah').addEventListener('change', function() {
        updateDesaSelect(this.value, 'desa_tambah');
    });

    document.getElementById('form-tambah-penerima').addEventListener('submit', function(e) {
        const username = document.getElementById('username_tambah').value;
        if (/\s/.test(username)) { // Cek apakah ada spasi
            e.preventDefault(); // Cegah form dari pengiriman
            alert('Username tidak boleh mengandung spasi!');
        }
    });

</script>
