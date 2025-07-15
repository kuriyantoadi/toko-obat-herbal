<!-- Modal Detail Pesanan -->
<div class="modal fade" id="modal_detail_pesanan<?= $row['id_order'] ?>" tabindex="-1" aria-labelledby="modalDetailPesananLabel<?= $row['id_order'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailPesananLabel<?= $row['id_order'] ?>">Detail Pesanan #<?= $row['id_order'] ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">

        <?php
        include '../koneksi.php';
        $id_order = $row['id_order'];
        $order = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_order WHERE id_order = $id_order"));
        ?>

        <div class="row mb-3">
          <div class="col-md-6">
            <p><strong>Nama Pembeli:</strong> <?= htmlspecialchars($order['nama_pembeli']) ?></p>
            <p><strong>Alamat:</strong> <?= htmlspecialchars($order['alamat_pembeli']) ?></p>
            <p><strong>No. HP:</strong> <?= htmlspecialchars($order['no_hp']) ?></p>
            <p><strong>Status Pembayaran:</strong> 
              <span class="badge bg-<?= strtolower($order['status_pembayaran']) == 'lunas' ? 'success' : 'warning' ?>">
                <?= ucfirst($order['status_pembayaran']) ?>
              </span>
            </p>
            <?php if (!empty($order['bukti_transfer'])): ?>
              <p><strong>Bukti Transfer:</strong><br>
                <a href="../uploads/bukti_transfer/<?= $order['bukti_transfer'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                  Lihat Bukti
                </a>
              </p>
            <?php endif; ?>
          </div>
          <div class="col-md-6 text-end">
            <h5><strong>Total:</strong> Rp<?= number_format($order['total'], 0, ',', '.') ?></h5>
            <p><strong>Tanggal Order:</strong> <?= date('d M Y H:i', strtotime($order['tanggal_order'])) ?></p>
          </div>
        </div>

        <hr>

        <h6>Daftar Produk:</h6>
        <div class="table-responsive">
          <table class="table table-bordered table-sm">
            <thead class="table-light">
              <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $total = 0;
              $detail = mysqli_query($koneksi, "
                SELECT d.*, p.nama_produk, p.harga_produk
                FROM tb_order_detail d
                JOIN tb_produk p ON d.id_produk = p.id_produk
                WHERE d.id_order = $id_order
              ");
              while ($item = mysqli_fetch_assoc($detail)) {
                $qty = isset($item['qty']) ? $item['qty'] : (isset($item['jumlah']) ? $item['jumlah'] : 1);
                $subtotal = $item['harga_produk'] * $qty;
                $total += $subtotal;
              ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($item['nama_produk']) ?></td>
                <td>Rp<?= number_format($item['harga_produk'], 0, ',', '.') ?></td>
                <td><?= $qty ?></td>
                <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
              </tr>
              <?php } ?>
              <tr>
                <td colspan="4" class="text-end"><strong>Total</strong></td>
                <td><strong>Rp<?= number_format($total, 0, ',', '.') ?></strong></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
