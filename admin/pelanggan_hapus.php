<?php
session_start();
if ($_SESSION['status'] != "admin") {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

// Ambil ID pelanggan dari parameter URL
$id_pelanggan = mysqli_real_escape_string($koneksi, $_GET['id_pelanggan']);

// Cek apakah ID tidak kosong
if (!empty($id_pelanggan)) {
    // Hapus data pelanggan berdasarkan ID
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_pelanggan WHERE id_pelanggan = '$id_pelanggan'");

    if ($hapus) {
        header("Location: ../$session_user/pelanggan.php?pesan=hapus-berhasil");
    } else {
        header("Location: ../$session_user/pelanggan.php?pesan=hapus-gagal");
    }
} else {
    header("Location: ../$session_user/pelanggan.php?pesan=id-tidak-valid");
}
?>
