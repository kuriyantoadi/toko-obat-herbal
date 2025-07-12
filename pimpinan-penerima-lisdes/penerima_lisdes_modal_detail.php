<div class="modal fade" id="largemodal_detail<?= $d['id_penerima_lisdes']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Penerima Lisdes</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Tanggal Permintaan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['tgl_permintaan'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Nama Calon Konsumen</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['nama_calon_konsumen'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">NIK</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['nik'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Alamat</label>
                    <div class="col-md-9">
                        <textarea class="form-control" disabled><?= $d['alamat'] ?></textarea>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Desa</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['nama_desa'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Kecamatan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['nama_kecamatan'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Kabupaten/Kota</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['nama_kab_kota'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Membutuhkan Bantuan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['membutuhkan_bantuan'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Menaati Ketentuan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['menaati_ketentuan'] ?>" disabled>
                    </div>
                </div>
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Jarak Rumah</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['jarak_rumah'] ?>" disabled>
                    </div>
                </div>
               
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Catatan</label>
                    <div class="col-md-9">
                        <textarea class="form-control" disabled><?= $d['catatan'] ?></textarea>
                    </div>
                </div>
                <!-- Menampilkan Foto -->
                <?php 
                $photos = ['photo_rumah' => 'Foto Rumah', 'photo_ktp' => 'Foto KTP', 'photo_sktm' => 'Foto SKTM', 'photo_kwh' => 'Foto KWH', 'photo_lampu' => 'Foto Lampu', 'photo_saklar' => 'Foto Saklar'];
                foreach ($photos as $key => $label): ?>
                <div class="row mb-4">
                    <label class="col-md-3 form-label"><?= $label ?></label>
                    <div class="col-md-9">
                        <?php if (!empty($d[$key])): ?>
                            <img src="../uploads/<?= basename($d[$key]) ?>" alt="<?= $label ?>" class="img-thumbnail" style="max-height: 200px;">
                        <?php else: ?>
                            <p class="text-muted">Belum ada <?= strtolower($label) ?>.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
                <!-- Akhir Menampilkan Foto -->

                <form action="../pimpinan-penerima-lisdes/penerima_lisdes_persetujuan.php" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_penerima_lisdes" value="<?= $d['id_penerima_lisdes']; ?>">
                    <div class="row mb-4">
                        <label class="col-md-3 form-label">Status Persetujuan</label>
                        <div class="col-md-9">
                            <select class="form-control" name="status_persetujuan_admin">
                                <option value="Pendataan" <?= ($d['status_persetujuan_admin'] === 'Pendataan') ? 'selected' : '' ?>>
                                    Pendataan
                                </option>
                                <option value="Di Setujui" <?= ($d['status_persetujuan_admin'] === 'Di Setujui') ? 'selected' : '' ?>>
                                    Disetujui dan Pemasangan
                                </option>
                                <option value="Di Tolak" <?= ($d['status_persetujuan_admin'] === 'Di Tolak') ? 'selected' : '' ?>>
                                    Ditolak
                                </option>
                            </select>
                        </div>
                    </div>
               
                
            </div>
            <div class="modal-footer">
                    <input type="submit" class="btn btn-sm btn-primary"></input>
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
