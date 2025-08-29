<?php
// Pastikan dipanggil DI DALAM loop yang punya $row
if (!isset($row) || !isset($row['id_order'])) {
  echo "<!-- pesanan_modal_detail.php: \$row['id_order'] tidak tersedia. Pastikan file ini di-include di dalam loop yang mendefinisikan \$row. -->";
  return;
}

$id_order = (int)$row['id_order'];

include_once '../koneksi.php';

// Ambil data order + pelanggan
$orderRes = mysqli_query($koneksi, "
  SELECT o.*, p.nama_pelanggan, p.alamat_pelanggan, p.no_hp_pelanggan
  FROM tb_order o
  JOIN tb_pelanggan p ON o.id_pelanggan = p.id_pelanggan
  WHERE o.id_order = $id_order
");
$order = mysqli_fetch_assoc($orderRes);

// Ambil detail produk
$detail = mysqli_query($koneksi, "
  SELECT d.*, pr.nama_produk, pr.harga_produk
  FROM tb_order_detail d
  JOIN tb_produk pr ON d.id_produk = pr.id_produk
  WHERE d.id_order = $id_order
");

// Ambil ulasan jika ada
$ulasan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_ulasan WHERE id_order = $id_order"));

// Map badge status
$status = strtolower($order['status_pembayaran']);
$badgeClass = 'secondary';
$statusText = ucfirst($order['status_pembayaran']);
if ($status === 'lunas') { $badgeClass = 'success'; }
elseif ($status === 'belum lunas') { $badgeClass = 'danger'; }
elseif ($status === 'menunggu konfirmasi') { $badgeClass = 'warning'; }
elseif ($status === 'ditolak') { $badgeClass = 'danger'; }
elseif ($status === 'dikirim') { $badgeClass = 'info'; }
?>

<!-- Modal Detail Pesanan -->
<div class="modal fade" id="modal_detail_pesanan<?= $id_order ?>" tabindex="-1" aria-labelledby="modalDetailPesananLabel<?= $id_order ?>" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailPesananLabel<?= $id_order ?>">Detail Pesanan #<?= $id_order ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">

        <div class="row mb-3">
          <div class="col-md-6">
            <p><strong>Nama Pembeli:</strong> <?= htmlspecialchars($order['nama_pelanggan']) ?></p>
            <p><strong>Alamat:</strong> <?= htmlspecialchars($order['alamat_pelanggan']) ?></p>
            <p><strong>No. HP:</strong> <?= htmlspecialchars($order['no_hp_pelanggan']) ?></p>
            <p><strong>Status:</strong>
              <span class="badge bg-<?= $badgeClass ?>"><?= $statusText ?></span>
            </p>

            <?php if (!empty($order['bukti_transfer'])): ?>
              <p><strong>Bukti Transfer:</strong><br>
                <a href="../uploads/bukti_transfer/<?= $order['bukti_transfer'] ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                  Lihat Bukti
                </a>
              </p>
            <?php endif; ?>

            <?php if (!empty($order['no_resi'])): ?>
              <p><strong>Nomor Resi:</strong>
                <span class="badge bg-primary"><?= htmlspecialchars($order['no_resi']) ?></span>
              </p>
            <?php endif; ?>
          </div>
          <div class="col-md-6 text-end">
            <h5><strong>Total:</strong> Rp<?= number_format($order['total'], 0, ',', '.') ?></h5>
            <p><strong>Tanggal Order:</strong> <?= date('d M Y H:i', strtotime($order['tanggal_order'])) ?></p>
          </div>
        </div>

        <hr>

        <h6 class="fw-bold">Daftar Produk:</h6>
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
              $grand = 0;
              mysqli_data_seek($detail, 0);
              while ($item = mysqli_fetch_assoc($detail)) {
                $qty = isset($item['qty']) ? (int)$item['qty'] : (isset($item['jumlah']) ? (int)$item['jumlah'] : 1);
                $subtotal = ((int)$item['harga_produk']) * $qty;
                $grand += $subtotal;
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
                <td><strong>Rp<?= number_format($grand, 0, ',', '.') ?></strong></td>
              </tr>
            </tbody>
          </table>
        </div>

        <hr>

        <!-- Konfirmasi Pembayaran (hanya jika bukti belum ada) -->
        <?php if (empty($order['bukti_transfer'])): ?>
          <h6 class="fw-bold">Konfirmasi Pembayaran</h6>
          <form action="pesanan_konfirmasi_upload.php" method="POST" enctype="multipart/form-data" onsubmit="return confirm('Yakin ingin mengirim bukti pembayaran?')">
            <input type="hidden" name="id_order" value="<?= $id_order ?>">
            <div class="mb-3">
              <label for="bukti<?= $id_order ?>" class="form-label">Upload Bukti Transfer</label>
              <input type="file" id="bukti<?= $id_order ?>" name="bukti" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
              <small class="text-muted">Format yang diterima: JPG, PNG, PDF</small>
            </div>
            <button type="submit" class="btn btn-success btn-sm">Kirim Konfirmasi</button>
          </form>
        <?php endif; ?>

        <hr>

        <!-- Ulasan -->
        <h6 class="fw-bold">Ulasan</h6>
        <?php if ($ulasan): ?>
          <p><strong>Rating:</strong>
            <?php
              $rating = (int)$ulasan['rating'];
              for ($i=1;$i<=5;$i++) echo $i <= $rating ? '★' : '☆';
            ?>
          </p>
          <p><strong>Ulasan:</strong><br><?= nl2br(htmlspecialchars($ulasan['ulasan'])) ?></p>
        <?php elseif ($status === 'dikirim'): ?>
          <!-- Tampilkan form ulasan jika belum ada dan status sudah dikirim -->
          <form action="ulasan_simpan.php" method="POST">
            <input type="hidden" name="id_order" value="<?= $id_order ?>">
            <div class="mb-3">
              <label for="ulasan<?= $id_order ?>" class="form-label">Tulis Ulasan</label>
              <textarea id="ulasan<?= $id_order ?>" name="ulasan" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="rating<?= $id_order ?>" class="form-label">Rating (1-5)</label>
              <select id="rating<?= $id_order ?>" name="rating" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="5">⭐️⭐️⭐️⭐️⭐️ (Sangat Baik)</option>
                <option value="4">⭐️⭐️⭐️⭐️ (Baik)</option>
                <option value="3">⭐️⭐️⭐️ (Cukup)</option>
                <option value="2">⭐️⭐️ (Kurang)</option>
                <option value="1">⭐️ (Buruk)</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary btn-sm">Kirim Ulasan</button>
          </form>
        <?php else: ?>
          <p class="text-muted fst-italic">Belum ada ulasan.</p>
        <?php endif; ?>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
