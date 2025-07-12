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
                <!-- <div class="row mb-4">
                    <label class="col-md-3 form-label">NIK</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['nik'] ?>" disabled>
                    </div>
                </div> -->
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
                    <label class="col-md-3 form-label">Pendataan</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" value="<?= $d['status_persetujuan_admin'] ?>" disabled>
                    </div>
                </div>
            
               
                <div class="row mb-4">
                    <label class="col-md-3 form-label">Catatan</label>
                    <div class="col-md-9">
                        <textarea class="form-control" disabled><?= $d['catatan'] ?></textarea>
                    </div>
                </div>
                
               
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
