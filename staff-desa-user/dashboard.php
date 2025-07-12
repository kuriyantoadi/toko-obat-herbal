<?php
// Koneksi ke database
include('../koneksi.php');

// Query untuk menghitung jumlah baris
$sql = "SELECT COUNT(*) AS jumlah_baris FROM `tb_penerima_lisdes`";
$result = $koneksi->query($sql); // Menghapus parameter yang salah

if ($result) {
    $row = $result->fetch_assoc();
    $jumlah_baris = $row['jumlah_baris'];
} else {
    $jumlah_baris = 0; // Jika query gagal, default nilai 0
}

// jumlah yang sudah acc
$sql = "SELECT COUNT(*) AS jumlah_selesai FROM `tb_penerima_lisdes` WHERE `status_pemasangan` = 'selesai' AND `id_desa` = '$id_desa'";
$result = $koneksi->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $jumlah_selesai = $row['jumlah_selesai'];
} else {
    $jumlah_selesai = 0; // Jika query gagal, default nilai 0
}

// jumlah yang sudah acc
$sql = "SELECT COUNT(*) AS jumlah_pendataan FROM `tb_penerima_lisdes` WHERE `status_pemasangan` = 'pendataan'";
$result = $koneksi->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $jumlah_pendataan = $row['jumlah_pendataan'];
} else {
    $jumlah_pendataan = 0; // Jika query gagal, default nilai 0
}

// jumlah yang sudah pemasangan
$sql = "SELECT COUNT(*) AS jumlah_pemasangan FROM `tb_penerima_lisdes` WHERE `status_pemasangan` = 'pemasangan'";
$result = $koneksi->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $jumlah_pemasangan = $row['jumlah_pemasangan'];
} else {
    $jumlah_pemasangan = 0; // Jika query gagal, default nilai 0
}



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
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-users text-info fa-3x"></i>
                            <h6 class="mt-4 mb-2">Penerima Bantuan LisDes</h6>
                            <h2 class="mb-2 number-font"><?php echo number_format($jumlah_baris); ?></h2>
                            <p class="text-muted">Jumlah Penerima Bantuan Listrik Desa</p>
                        </div>
                    </div>
                </div>

                <!-- COL END -->
                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-search text-primary fa-3x"></i>
                            <h6 class="mt-4 mb-2">Pendataan</h6>
                            <h2 class="mb-2 number-font"><?php echo number_format($jumlah_pendataan); ?></h2>
                            <p class="text-muted">Jumlah Penerima Status Pendataan</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-lightbulb-o text-warning fa-3x"></i>
                            <h6 class="mt-4 mb-2">Pemasangan</h6>
                            <h2 class="mb-2 number-font"><?php echo number_format($jumlah_selesai); ?></h2>
                            <p class="text-muted">Jumlah Status Penerima Listrik Pemasangan</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa fa-check text-success fa-3x"></i>
                            <h6 class="mt-4 mb-2">Selesai</h6>
                            <h2 class="mb-2 number-font"><?php echo number_format($jumlah_selesai); ?></h2>
                            <p class="text-muted">Jumlah Status Penerima Listrik Pemasangan Selesai</p>
                        </div>
                    </div>
                </div>
               
                <!-- COL END -->
            </div>
            <!-- ROW CLOSED -->                  
        </div>
    </div>
</div>
