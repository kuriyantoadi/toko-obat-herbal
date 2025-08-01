<?php
if (!isset($row['id_order'])) {
  echo "<!-- ID Order tidak tersedia -->";
  return;
}

$id_order = $row['id_order'];

// Ambil data order & pelanggan
$order = mysqli_fetch_assoc(mysqli_query($koneksi, "
  SELECT o.*, p.nama_pelanggan, p.alamat_pelanggan, p.no_hp_pelanggan
  FROM tb_order o
  JOIN tb_pelanggan p ON o.id_pelanggan = p.id_pelanggan
  WHERE o.id_order = '$id_order'
"));

// Ambil detail produk yang dipesan
$produk = mysqli_query($koneksi, "
  SELECT dp.*, pr.nama_produk, pr.foto, pr.harga_produk
  FROM tb_order_detail dp
  JOIN tb_produk pr ON dp.id_produk = pr.id_produk
  WHERE dp.id_order = '$id_order'
");
?>

<!-- Modal Ulasan -->
<div class="modal fade" id="modal_ulasan<?= $id_order ?>" tabindex="-1" aria-labelledby="modalUlasanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="ulasan_simpan.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalUlasanLabel">Kirim Ulasan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_order" value="<?= $id_order ?>">

          <!-- Info Pembeli -->
          <div class="row mb-3">
            <div class="col-md-6">
              <p><strong>Nama Pembeli:</strong> <?= htmlspecialchars($order['nama_pelanggan']) ?></p>
              <p><strong>Alamat:</strong> <?= htmlspecialchars($order['alamat_pelanggan']) ?></p>
              <p><strong>No. HP:</strong> <?= htmlspecialchars($order['no_hp_pelanggan']) ?></p>
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

          <!-- Daftar Produk -->
          <h6><strong>Daftar Produk:</strong></h6>
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

          <hr>

          <!-- Form Ulasan -->
          <div class="mb-3">
            <label for="ulasan" class="form-label">Ulasan Anda</label>
            <textarea name="ulasan" class="form-control" rows="4" required></textarea>
          </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating (1 - 5)</label>
            <select name="rating" class="form-select" required>
                <option value="">-- Pilih Rating --</option>
                <option value="5">⭐️⭐️⭐️⭐️⭐️ (Sangat Baik)</option>
                <option value="4">⭐️⭐️⭐️⭐️ (Baik)</option>
                <option value="3">⭐️⭐️⭐️ (Cukup)</option>
                <option value="2">⭐️⭐️ (Kurang)</option>
                <option value="1">⭐️ (Buruk)</option>
            </select>
        </div>


        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Kirim</button>
        </div>
      </div>
    </form>
  </div>
</div>
