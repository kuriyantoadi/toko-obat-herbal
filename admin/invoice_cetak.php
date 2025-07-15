<?php
include '../koneksi.php';

$id_order = isset($_GET['id']) ? intval($_GET['id']) : 0;
$order = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_order WHERE id_order = $id_order"));

if (!$order) {
    die("Data pesanan tidak ditemukan.");
}

// Ambil detail produk
$produk = mysqli_query($koneksi, "
    SELECT d.*, p.nama_produk, p.harga_produk
    FROM tb_order_detail d
    JOIN tb_produk p ON d.id_produk = p.id_produk
    WHERE d.id_order = $id_order
");

// Header untuk mendownload sebagai PDF jika diinginkan:
// header("Content-type: application/pdf");
// header("Content-Disposition: attachment; filename=invoice_$id_order.pdf");

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Invoice #<?= $order['id_order'] ?></title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 14px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
    h2 { margin-bottom: 0; }
  </style>
</head>
<body>
  <h2>Invoice #<?= $order['id_order'] ?></h2>
  <p><strong>Nama:</strong> <?= htmlspecialchars($order['nama_pembeli']) ?></p>
  <p><strong>Alamat:</strong> <?= htmlspecialchars($order['alamat_pembeli']) ?></p>
  <p><strong>No. HP:</strong> <?= htmlspecialchars($order['no_hp']) ?></p>
  <p><strong>Tanggal:</strong> <?= date('d-m-Y H:i', strtotime($order['tanggal_order'])) ?></p>
  <p><strong>Status Pembayaran:</strong> <?= ucfirst($order['status_pembayaran']) ?></p>

  <h4>Detail Produk</h4>
  <table>
    <thead>
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
      while ($row = mysqli_fetch_assoc($produk)) {
        $qty = isset($row['qty']) ? $row['qty'] : $row['jumlah'];
        $subtotal = $row['harga_produk'] * $qty;
        $total += $subtotal;
        echo "<tr>
          <td>{$no}</td>
          <td>" . htmlspecialchars($row['nama_produk']) . "</td>
          <td>Rp" . number_format($row['harga_produk'], 0, ',', '.') . "</td>
          <td>$qty</td>
          <td>Rp" . number_format($subtotal, 0, ',', '.') . "</td>
        </tr>";
        $no++;
      }
      ?>
      <tr>
        <td colspan="4"><strong>Total</strong></td>
        <td><strong>Rp<?= number_format($total, 0, ',', '.') ?></strong></td>
      </tr>
    </tbody>
  </table>

  <p style="margin-top:40px;">Terima kasih telah berbelanja di toko kami!</p>
  <script>
  window.onload = function() {
    window.print();
  }
</script>
</body>
</html>
