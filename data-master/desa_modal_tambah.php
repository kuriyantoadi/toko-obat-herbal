<div class="modal fade" id="largemodal_tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Desa</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../data-master/desa_tambah.php" method="POST">
                <div class="modal-body">
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="id_kab_kota">Nama Kabupaten</label>
                        <div class="col-md-9">
                            <select name="id_kab_kota" class="form-control" id="id_kab_kota" required onchange="updateKecamatanSelect(this.value)">
                                <option value="">Pilihan</option>
                                <?php
                                    $d1 = mysqli_query($koneksi, "SELECT id_kab_kota, nama_kab_kota FROM tb_kab_kota ORDER BY nama_kab_kota ASC");
                                    while ($d_kab_kota = mysqli_fetch_array($d1)) {
                                        echo "<option value='{$d_kab_kota['id_kab_kota']}'>{$d_kab_kota['nama_kab_kota']}</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>   
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="id_kecamatan">Nama Kecamatan</label>
                        <div class="col-md-9">
                            <select name="id_kecamatan" class="form-control" id="id_kecamatan" required>
                                <option value="">Pilihan</option>
                                <!-- Kecamatan akan di-update secara dinamis -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="nama_desa">Nama Desa</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_desa" id="nama_desa" class="form-control" required>
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
    function updateKecamatanSelect(id_kab_kota) {
        const kecamatanSelect = document.getElementById('id_kecamatan');
        kecamatanSelect.innerHTML = '<option value="">Loading...</option>'; // Menampilkan loading

        if (id_kab_kota) {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', 'get_kecamatan.php?id_kab_kota=' + id_kab_kota, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const kecamatanList = JSON.parse(xhr.responseText);
                    kecamatanSelect.innerHTML = '<option value="">Pilihan</option>'; // Hapus opsi loading

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
            kecamatanSelect.innerHTML = '<option value="">Pilihan</option>'; // Reset jika tidak ada pilihan
        }
    }
</script>
