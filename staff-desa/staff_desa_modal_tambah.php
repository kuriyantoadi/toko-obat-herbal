<!-- Modal -->
<div class="modal fade" id="largemodal_tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Staff Desa</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="form-tambah-staff" action="../staff-desa/staff_desa_tambah.php" method="POST">
                <div class="modal-body">   
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="username_tambah">Username</label>
                        <div class="col-md-9">
                            <input type="text" id="username_tambah" name="username" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Nama Staff Desa</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_staff_desa" class="form-control" required>
                        </div>
                    </div>
                     <div class="row mb-4">
                        <label class="col-md-3 form-label">Password</label>
                        <div class="col-md-9">
                            <input type="text" name="password" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Nama Kabupaten/Kota</label>
                        <div class="col-md-9">
                            <select name="id_kab_kota" class="form-control" data-target="kecamatan_tambah" required>
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
                            <select name="id_kecamatan" class="form-control" id="kecamatan_tambah" required>
                                <option value="">-- Pilih Kecamatan --</option>
                                <!-- Options will be populated dynamically by JavaScript -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Nama Desa</label>
                        <div class="col-md-9">
                            <select name="id_desa" id="desa_tambah" class="form-control" required>
                                <option value="">-- Pilih Desa --</option>
                                <!-- Options will be populated dynamically by JavaScript -->
                            </select>
                        </div>
                    </div>
                   
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-sm btn-primary" value="Tambah">
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
        updateKecamatanSelect(this.value, 'kecamatan_tambah');
    });

    document.querySelector('#kecamatan_tambah').addEventListener('change', function() {
        updateDesaSelect(this.value, 'desa_tambah');
    });

    document.getElementById('form-tambah-staff').addEventListener('submit', function(e) {
        const username = document.getElementById('username_tambah').value;
        if (/\s/.test(username)) { // Cek apakah ada spasi
            e.preventDefault(); // Cegah form dari pengiriman
            alert('Username tidak boleh mengandung spasi!');
        }
    });

</script>
