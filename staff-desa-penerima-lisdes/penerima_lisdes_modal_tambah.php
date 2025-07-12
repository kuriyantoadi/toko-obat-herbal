<div class="modal fade" id="largemodal_tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Penerima Lisdes</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tambah-penerima" action="../staff-desa-penerima-lisdes/penerima_lisdes_tambah.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <!-- Nama Calon Konsumen -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="nama_calon_konsumen">Nama Calon Konsumen</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_calon_konsumen" id="nama_calon_konsumen" class="form-control" required>
                        </div>
                    </div>   

                    <!-- NIK -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="nik">NIK</label>
                        <div class="col-md-9">
                            <input type="text" name="nik" id="nik" class="form-control" maxlength="16" pattern="\d{16}" title="Harus 16 digit angka" required>
                        </div>
                    </div>

                    <!-- Kabupaten/Kota -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Kabupaten/Kota</label>
                        <div class="col-md-9">
                            <?php
                                $id_kab_kota = $_SESSION['id_kab_kota'];
                                $d1 = mysqli_query($koneksi, "SELECT nama_kab_kota FROM tb_kab_kota WHERE id_kab_kota='$id_kab_kota'");
                                $d_kab_kota = mysqli_fetch_array($d1);
                            ?>
                            <input type="text" class="form-control" value="<?= $d_kab_kota['nama_kab_kota'] ?>" disabled>
                        </div>
                    </div>

                    <!-- Kecamatan -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Kecamatan</label>
                        <div class="col-md-9">
                            <?php
                                $id_kecamatan = $_SESSION['id_kecamatan'];
                                $d1 = mysqli_query($koneksi, "SELECT nama_kecamatan FROM tb_kecamatan WHERE id_kecamatan='$id_kecamatan'");
                                $d_kecamatan = mysqli_fetch_array($d1);
                            ?>
                            <input type="text" class="form-control" value="<?= $d_kecamatan['nama_kecamatan'] ?>" disabled>
                        </div>
                    </div>

                    <!-- Desa -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Desa</label>
                        <div class="col-md-9">
                            <?php
                                $id_desa = $_SESSION['id_desa'];
                                $d1 = mysqli_query($koneksi, "SELECT nama_desa FROM tb_desa WHERE id_desa='$id_desa'");
                                $d_desa = mysqli_fetch_array($d1);
                            ?>
                            <input type="text" class="form-control" value="<?= $d_desa['nama_desa'] ?>" disabled>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="alamat">Alamat</label>
                        <div class="col-md-9">
                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                        </div>
                    </div>

                    <!-- Membutuhkan Bantuan -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="membutuhkan_bantuan">Membutuhkan Bantuan</label>
                        <div class="col-md-9">
                            <select name="membutuhkan_bantuan" id="membutuhkan_bantuan" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- Menaati Ketentuan -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="menaati_ketentuan">Menaati Ketentuan</label>
                        <div class="col-md-9">
                            <select name="menaati_ketentuan" id="menaati_ketentuan" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="Ya">Ya</option>
                                <option value="Tidak">Tidak</option>
                            </select>
                        </div>
                    </div>

                    <!-- Jarak Rumah -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="jarak_rumah">Jarak Rumah (km)</label>
                        <div class="col-md-9">
                            <input type="number" name="jarak_rumah" id="jarak_rumah" class="form-control" step="0.01" required>
                        </div>
                    </div>

                    <!-- Upload Foto Rumah -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="photo_rumah">Upload Foto Rumah</label>
                        <div class="col-md-9">
                            <input type="file" name="photo_rumah" id="photo_rumah" class="form-control" accept="image/*" required>
                        </div>
                    </div>

                    <!-- Upload Foto KTP -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="photo_ktp">Upload Foto KTP</label>
                        <div class="col-md-9">
                            <input type="file" name="photo_ktp" id="photo_ktp" class="form-control" accept="image/*" required>
                        </div>
                    </div>

                    <!-- Upload Foto SKTM -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="photo_sktm">Upload Foto SKTM</label>
                        <div class="col-md-9">
                            <input type="file" name="photo_sktm" id="photo_sktm" class="form-control" accept="image/*" required>
                        </div>
                    </div>

                    <!-- Catatan -->
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="catatan">Catatan</label>
                        <div class="col-md-9">
                            <textarea name="catatan" id="catatan" class="form-control"></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
