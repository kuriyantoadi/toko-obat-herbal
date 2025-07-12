<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

// Koneksi database
include '../koneksi.php';

// Ambil id_desa dari parameter GET
$id_desa = mysqli_real_escape_string($koneksi, $_GET['id_desa']);

// Hapus data dari database
$cek_hapus = mysqli_query($koneksi, "DELETE FROM tb_desa WHERE id_desa='$id_desa'");

// Arahkan halaman kembali dengan pesan hasil
if ($cek_hapus) {
    header("Location: ../$session_user/desa.php?pesan=hapus_berhasil");
} else {
    header("Location: ../$session_user/desa.php?pesan=hapus_gagal");
}
?>
