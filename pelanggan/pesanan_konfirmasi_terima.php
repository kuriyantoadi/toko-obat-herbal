<?php
session_start();
include '../koneksi.php';

// Pastikan user sudah login
if (!isset($_SESSION['id_pelanggan'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

// Pastikan ada id_order dari form
if (!isset($_POST['id_order'])) {
    header("Location: pesanan.php?pesan=konfirmasi_invalid");
    exit;
}

$id_order   = (int) $_POST['id_order'];
$id_session = (int) $_SESSION['id_pelanggan'];

// Cek apakah pesanan milik user yang login
$cek_order = mysqli_query($koneksi, "SELECT * FROM tb_order WHERE id_order = $id_order AND id_pelanggan = $id_session");
if (mysqli_num_rows($cek_order) == 0) {
    header("Location: pesanan.php?pesan=konfirmasi_invalid");
    exit;
}

// Update status pesanan jadi 'menunggu ulasan'
$update = mysqli_query($koneksi, "
    UPDATE tb_order 
    SET status_pembayaran = 'menunggu ulasan' 
    WHERE id_order = $id_order
");

if ($update) {
    header("Location: pesanan.php?pesan=konfirmasi_diterima");
    exit;
} else {
    header("Location: pesanan.php?pesan=konfirmasi_gagal");
    exit;
}
?>
