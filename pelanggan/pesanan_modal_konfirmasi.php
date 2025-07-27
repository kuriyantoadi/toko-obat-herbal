<!-- Modal Konfirmasi Pembayaran -->
<div class="modal fade" id="modal_konfirmasi<?= $row['id_order'] ?>" tabindex="-1" aria-labelledby="modalKonfirmasiLabel<?= $row['id_order'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="pesanan_konfirmasi_upload.php" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="modalKonfirmasiLabel<?= $row['id_order'] ?>">Konfirmasi Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_order" value="<?= $row['id_order'] ?>">
          <div class="mb-3">
            <label for="bukti" class="form-label">Upload Bukti Transfer</label>
            <input type="file" name="bukti" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
            <small class="text-muted">Format yang diterima: JPG, PNG, PDF</small>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Konfirmasi</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
