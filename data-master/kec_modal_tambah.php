<div class="modal fade" id="largemodal_tambah" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kecamatan</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../data-master/kec_tambah.php" method="POST">
                <div class="modal-body">
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="example-email">Nama Kabupaten</label>
                        <div class="col-md-9">                            
                           <select name="id_kab_kota" class="form-control" id="" required>
                                <option value="">Pilihan</option>
                                    <?php

                                        $d1 = mysqli_query($koneksi, "SELECT id_kab_kota, nama_kab_kota from tb_kab_kota ORDER BY nama_kab_kota ASC");
                                        while ($d_kab_kota = mysqli_fetch_array($d1)) {
                                    ?>
                                        <option value="<?= $d_kab_kota['id_kab_kota'] ?>"><?= $d_kab_kota['nama_kab_kota'] ?></option>
                                    <?php } ?>
                            </select>
                        </div>
                    </div>   
                    <div class="row mb-4">
                        <label class="col-md-3 form-label" for="example-email">Nama Kecamatan</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_kecamatan"  class="form-control" required>
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
