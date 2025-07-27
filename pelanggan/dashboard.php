<?php
// Koneksi ke database
include('../koneksi.php');

// jumlah kategori produk
$sql = "SELECT COUNT(*) AS jumlah_kategori FROM `tb_kategori_produk`";
$result = $koneksi->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $jumlah_kategori = $row['jumlah_kategori'];
} else {
    $jumlah_kategori = 0; // Jika query gagal, default 0
}

$sql = "SELECT COUNT(*) AS jumlah_produk FROM tb_produk";
$result = $koneksi->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $jumlah_produk = $row['jumlah_produk'];
} else {
    $jumlah_produk = 0;
}


// Jumlah total order
$sql = "SELECT COUNT(*) AS jumlah_order FROM tb_order";
$result = $koneksi->query($sql);
$jumlah_order = ($result) ? $result->fetch_assoc()['jumlah_order'] : 0;

// Jumlah order Lunas
$sql = "SELECT COUNT(*) AS order_lunas FROM tb_order WHERE status_pembayaran = 'Lunas'";
$result = $koneksi->query($sql);
$order_lunas = ($result) ? $result->fetch_assoc()['order_lunas'] : 0;

// Jumlah order Belum Bayar
$sql = "SELECT COUNT(*) AS order_belum_bayar FROM tb_order WHERE status_pembayaran = 'belum'";
$result = $koneksi->query($sql);
$order_belum_bayar = ($result) ? $result->fetch_assoc()['order_belum_bayar'] : 0;

// Total omset dari order Lunas
$sql = "SELECT SUM(total) AS total_omset FROM tb_order WHERE status_pembayaran = 'Lunas'";
$result = $koneksi->query($sql);
$total_omset = ($result) ? $result->fetch_assoc()['total_omset'] : 0;




// $conn->close();
?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">
            <div class="page-header">
                <h1 class="page-title">Dashboard</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </div>
            </div>

            <!-- ROW OPEN -->
            <div class="row">
                
                <!-- COL END -->
               <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a href="kategori.php" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <i class="fa fa-tags text-success fa-3x"></i>
                                <h6 class="mt-4 mb-2 text-dark">Kategori Produk</h6>
                                <h2 class="mb-2 number-font text-dark"><?php echo number_format($jumlah_kategori); ?></h2>
                                <p class="text-muted">Jumlah Kategori</p>
                            </div>
                        </div>
                    </a>
                </div>


               <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a href="produk.php" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <i class="fa fa-cube text-info fa-3x"></i>
                                <h6 class="mt-4 mb-2 text-dark">Produk</h6>
                                <h2 class="mb-2 number-font text-dark"><?php echo number_format($jumlah_produk); ?></h2>
                                <p class="text-muted">Jumlah Produk Terdaftar</p>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a href="pesanan.php" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <i class="fa fa-shopping-cart text-info fa-3x"></i>
                                <h6 class="mt-4 mb-2 text-dark">Total Order</h6>
                                <h2 class="mb-2 number-font text-dark"><?= number_format($jumlah_order); ?></h2>
                                <p class="text-muted">Pesanan Masuk</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a href="pesanan-lunas.php" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <i class="fa fa-check-circle text-success fa-3x"></i>
                                <h6 class="mt-4 mb-2 text-dark">Pesanan Lunas</h6>
                                <h2 class="mb-2 number-font text-dark"><?= number_format($order_lunas); ?></h2>
                                <p class="text-muted">Sudah Dibayar</p>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                    <a href="pesanan-belum-lunas.php" class="text-decoration-none">
                        <div class="card shadow-sm">
                            <div class="card-body text-center">
                                <i class="fa fa-clock-o text-warning fa-3x"></i>
                                <h6 class="mt-4 mb-2 text-dark">Belum Bayar</h6>
                                <h2 class="mb-2 number-font text-dark"><?= number_format($order_belum_bayar); ?></h2>
                                <p class="text-muted">Menunggu Pembayaran</p>
                            </div>
                        </div>
                    </a>
                </div>

               
                <!-- COL END -->
            </div>
            <!-- ROW CLOSED -->                  
        </div>
    </div>
</div>
