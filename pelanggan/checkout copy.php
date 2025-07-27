<?php
session_start();
include '../koneksi.php';

// Redirect jika keranjang kosong
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Keranjang belanja kosong.');window.location='produk.php';</script>";
    exit;
}

// Hitung total harga
$total = 0;
foreach ($_SESSION['cart'] as $id_produk => $qty) {
    $result = mysqli_query($koneksi, "SELECT harga_produk FROM tb_produk WHERE id_produk = $id_produk");
    $data = mysqli_fetch_assoc($result);
    $total += $data['harga_produk'] * $qty;
}

// Proses checkout
if (isset($_POST['checkout'])) {
    $nama    = mysqli_real_escape_string($koneksi, $_POST['nama_pembeli']);
    $alamat  = mysqli_real_escape_string($koneksi, $_POST['alamat_pembeli']);
    $no_hp   = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $tanggal = date('Y-m-d H:i:s');

    // Simpan ke tb_order
    mysqli_query($koneksi, "INSERT INTO tb_order (nama_pembeli, alamat_pembeli, no_hp, tanggal_order, total) 
                            VALUES ('$nama', '$alamat', '$no_hp', '$tanggal', $total)");
    $id_order = mysqli_insert_id($koneksi);

    // Simpan detail produk yang dibeli
    foreach ($_SESSION['cart'] as $id_produk => $qty) {
        $result = mysqli_query($koneksi, "SELECT harga_produk FROM tb_produk WHERE id_produk = $id_produk");
        $data = mysqli_fetch_assoc($result);
        $harga = $data['harga_produk'];
        $subtotal = $harga * $qty;

        mysqli_query($koneksi, "INSERT INTO tb_order_detail (id_order, id_produk, jumlah, harga, subtotal) 
                                VALUES ($id_order, $id_produk, $qty, $harga, $subtotal)");
    }

    // Kosongkan keranjang
    unset($_SESSION['cart']);

    echo "<script>alert('Pesanan berhasil!'); window.location='produk.php';</script>";
    exit;
}
?>

<?php include 'header.php'; ?>
<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">
      <div class="page-header">
        <h1 class="page-title">Checkout</h1>
      </div>

      <form method="POST" action="">
        <div class="row">
          <!-- Form Pembeli -->
          <div class="col-md-6">
            <div class="card p-4">
              <h4>Informasi Pembeli</h4>
              <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_pembeli" class="form-control" required>
              </div>
              <div class="mb-3">
                <label>Alamat</label>
                <textarea name="alamat_pembeli" class="form-control" required></textarea>
              </div>
              <div class="mb-3">
                <label>No. HP</label>
                <input type="text" name="no_hp" class="form-control" required>
              </div>
            </div>
          </div>

          <!-- Ringkasan Order -->
          <div class="col-md-6">
            <div class="card p-4">
              <h4>Ringkasan Pesanan</h4>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($_SESSION['cart'] as $id_produk => $qty) {
                      $result = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_produk = $id_produk");
                      $produk = mysqli_fetch_assoc($result);
                      $subtotal = $produk['harga_produk'] * $qty;
                      echo "<tr>
                              <td>" . htmlspecialchars($produk['nama_produk']) . "</td>
                              <td>$qty</td>
                              <td>Rp" . number_format($subtotal, 0, ',', '.') . "</td>
                            </tr>";
                  }
                  ?>
                  <tr>
                    <th colspan="2">Total</th>
                    <th>Rp<?= number_format($total, 0, ',', '.') ?></th>
                  </tr>
                </tbody>
              </table>

              <div class="text-end mt-3">
                <button type="submit" name="checkout" class="btn btn-primary">Proses Checkout</button>
              </div>
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
<?php include 'footer.php'; ?>
