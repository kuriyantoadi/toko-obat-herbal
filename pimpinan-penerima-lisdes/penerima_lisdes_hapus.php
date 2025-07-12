<?php
session_start();
if ($_SESSION['status'] != "admin-lisdes") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

// Koneksi database
include '../koneksi.php';

$id_penerima_lisdes = mysqli_real_escape_string($koneksi, $_GET['id_penerima_lisdes']);

// Menghapus data dari database
$cek_hapus = mysqli_query($koneksi, "DELETE FROM tb_penerima_lisdes WHERE id_penerima_lisdes='$id_penerima_lisdes'");

// Mengalihkan halaman kembali ke penerima_lisdes.php
if ($cek_hapus) {
    header("location:../$session_user/penerima-lisdes.php?pesan=hapus_berhasil");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
