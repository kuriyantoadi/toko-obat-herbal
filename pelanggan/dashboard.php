<?php
// Koneksi ke database
include('../koneksi.php');

// Jumlah Produk
$sql = "SELECT COUNT(*) AS jumlah_produk FROM tb_produk";
$result = $koneksi->query($sql);
$jumlah_produk = ($result) ? $result->fetch_assoc()['jumlah_produk'] : 0;

// Jumlah Data di Keranjang
$sql = "SELECT COUNT(*) AS jumlah_keranjang FROM tb_cart";
$result = $koneksi->query($sql);
$jumlah_keranjang = ($result) ? $result->fetch_assoc()['jumlah_keranjang'] : 0;

// Jumlah Pesanan Lunas
$sql = "SELECT COUNT(*) AS pesanan_lunas FROM tb_order WHERE status_pembayaran = 'Lunas'";
$result = $koneksi->query($sql);
$pesanan_lunas = ($result) ? $result->fetch_assoc()['pesanan_lunas'] : 0;

// Jumlah Pesanan Menunggu
$sql = "SELECT COUNT(*) AS pesanan_menunggu FROM tb_order WHERE status_pembayaran = 'Menunggu'";
$result = $koneksi->query($sql);
$pesanan_menunggu = ($result) ? $result->fetch_assoc()['pesanan_menunggu'] : 0;

// Jumlah Pesanan Ditolak
$sql = "SELECT COUNT(*) AS pesanan_ditolak FROM tb_order WHERE status_pembayaran = 'Ditolak'";
$result = $koneksi->query($sql);
$pesanan_ditolak = ($result) ? $result->fetch_assoc()['pesanan_ditolak'] : 0;

// Jumlah Pesanan Belum Bayar
$sql = "SELECT COUNT(*) AS pesanan_belum_bayar FROM tb_order WHERE status_pembayaran = 'Belum Lunas'";
$result = $koneksi->query($sql);
$pesanan_belum_bayar = ($result) ? $result->fetch_assoc()['pesanan_belum_bayar'] : 0;
?>

<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">
      <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
          </ol>
        </div>
      </div>

      <div class="row">
        <!-- Menu Produk -->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <a href="produk.php" class="text-decoration-none">
            <div class="card shadow-sm">
              <div class="card-body text-center">
                <i class="fa fa-cube text-primary fa-3x"></i>
                <h6 class="mt-4 mb-2 text-dark">Produk</h6>
                <h2 class="mb-2 number-font text-dark"><?= number_format($jumlah_produk); ?></h2>
                <p class="text-muted">Jumlah Produk</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Menu Keranjang -->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <a href="cart.php" class="text-decoration-none">
            <div class="card shadow-sm">
              <div class="card-body text-center">
                <i class="fa fa-shopping-basket text-success fa-3x"></i>
                <h6 class="mt-4 mb-2 text-dark">Keranjang</h6>
                <h2 class="mb-2 number-font text-dark"><?= number_format($jumlah_keranjang); ?></h2>
                <p class="text-muted">Data di Keranjang</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Menu Pesanan Lunas -->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <a href="pesanan-lunas.php" class="text-decoration-none">
            <div class="card shadow-sm">
              <div class="card-body text-center">
                <i class="fa fa-check-circle text-success fa-3x"></i>
                <h6 class="mt-4 mb-2 text-dark">Pesanan Lunas</h6>
                <h2 class="mb-2 number-font text-dark"><?= number_format($pesanan_lunas); ?></h2>
                <p class="text-muted">Sudah Dibayar</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Menu Pesanan Menunggu -->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <a href="pesanan-menunggu.php" class="text-decoration-none">
            <div class="card shadow-sm">
              <div class="card-body text-center">
                <i class="fa fa-hourglass-half text-warning fa-3x"></i>
                <h6 class="mt-4 mb-2 text-dark">Menunggu Konfirmasi</h6>
                <h2 class="mb-2 number-font text-dark"><?= number_format($pesanan_menunggu); ?></h2>
                <p class="text-muted">Menunggu Konfirmasi</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Menu Pesanan Ditolak -->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <a href="pesanan-ditolak.php" class="text-decoration-none">
            <div class="card shadow-sm">
              <div class="card-body text-center">
                <i class="fa fa-times-circle text-danger fa-3x"></i>
                <h6 class="mt-4 mb-2 text-dark">Pesanan Ditolak</h6>
                <h2 class="mb-2 number-font text-dark"><?= number_format($pesanan_ditolak); ?></h2>
                <p class="text-muted">Pesanan Ditolak</p>
              </div>
            </div>
          </a>
        </div>

        <!-- Menu Pesanan Belum Bayar -->
        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
          <a href="pesanan-belum-lunas.php" class="text-decoration-none">
            <div class="card shadow-sm">
              <div class="card-body text-center">
                <i class="fa fa-clock-o text-secondary fa-3x"></i>
                <h6 class="mt-4 mb-2 text-dark">Belum Bayar</h6>
                <h2 class="mb-2 number-font text-dark"><?= number_format($pesanan_belum_bayar); ?></h2>
                <p class="text-muted">Menunggu Pembayaran</p>
              </div>
            </div>
          </a>
        </div>

      </div>
    </div>
  </div>
</div>
