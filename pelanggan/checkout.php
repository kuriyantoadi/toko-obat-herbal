<?php
session_start();
include '../koneksi.php';

// Cek login
if (!isset($_SESSION['id_pelanggan'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='../login/index.php';</script>";
    exit;
}

// Ambil data pelanggan
$id_pelanggan = $_SESSION['id_pelanggan'];
$q_pelanggan = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE id_pelanggan = $id_pelanggan");
$pelanggan = mysqli_fetch_assoc($q_pelanggan);

// Redirect jika keranjang kosong
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "<script>alert('Keranjang belanja kosong.'); window.location='produk.php';</script>";
    exit;
}

// Hitung total
$total = 0;
$produk_data = array();
foreach ($_SESSION['cart'] as $id_produk => $qty) {
    $res = mysqli_query($koneksi, "SELECT nama_produk, harga_produk FROM tb_produk WHERE id_produk = " . intval($id_produk));
    $produk = mysqli_fetch_assoc($res);
    if (!$produk) {
        echo "<script>alert('Produk tidak ditemukan.'); window.location='cart.php';</script>";
        exit;
    }
    $produk_data[$id_produk] = $produk;
    $total += $produk['harga_produk'] * $qty;
}

// Proses checkout
if (isset($_POST['checkout'])) {
    $tanggal = date('Y-m-d H:i:s');

    // Simpan ke tb_order
    $q1 = mysqli_query($koneksi, "INSERT INTO tb_order (id_pelanggan, tanggal_order, total, status_pembayaran, metode_pembayaran)
        VALUES ($id_pelanggan, '$tanggal', $total, 'Belum Lunas', 'Transfer')");
    $id_order = mysqli_insert_id($koneksi);

    // Simpan detail
    foreach ($_SESSION['cart'] as $id_produk => $qty) {
        $harga = $produk_data[$id_produk]['harga_produk'];
        $subtotal = $harga * $qty;
        mysqli_query($koneksi, "INSERT INTO tb_order_detail (id_order, id_produk, jumlah, harga, subtotal)
            VALUES ($id_order, $id_produk, $qty, $harga, $subtotal)");
    }

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
          <div class="col-md-6">
            <div class="card p-4">
              <h4>Informasi Pembeli</h4>
              <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($pelanggan['nama_pelanggan']); ?>" disabled>
              </div>
              <div class="mb-3">
                <label>Alamat</label>
                <textarea class="form-control" disabled><?php echo htmlspecialchars($pelanggan['alamat_pelanggan']); ?></textarea>
              </div>
              <div class="mb-3">
                <label>No. HP</label>
                <input type="text" class="form-control" value="<?php echo htmlspecialchars($pelanggan['no_hp_pelanggan']); ?>" disabled>
              </div>
            </div>
          </div>

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
                      $produk = $produk_data[$id_produk];
                      $subtotal = $produk['harga_produk'] * $qty;
                      echo "<tr>
                              <td>" . htmlspecialchars($produk['nama_produk']) . "</td>
                              <td>" . $qty . "</td>
                              <td>Rp" . number_format($subtotal, 0, ',', '.') . "</td>
                            </tr>";
                  }
                  ?>
                  <tr>
                    <th colspan="2">Total</th>
                    <th>Rp<?php echo number_format($total, 0, ',', '.'); ?></th>
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
