<?php
session_start();
include '../koneksi.php';

$id_order = $_POST['id_order'];
$aksi     = $_POST['aksi_konfirmasi'];
$catatan  = mysqli_real_escape_string($koneksi, $_POST['catatan_admin']);

// Cek validitas aksi
if ($aksi == 'lunas') {
    $status = 'lunas';
} elseif ($aksi == 'ditolak') {
    $status = 'ditolak';
} else {
    $_SESSION['error'] = 'Tindakan tidak valid.';
    header('Location: pesanan.php');
    exit;
}

// Update status pembayaran
mysqli_query($koneksi, "UPDATE tb_order SET status_pembayaran='$status', catatan_admin='$catatan' WHERE id_order='$id_order'");

// Set pesan sukses
$_SESSION['success'] = 'Status pembayaran berhasil diperbarui.';
header('Location: pesanan.php');
exit;
?>
