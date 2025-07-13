<?php
session_start();
include '../koneksi.php';

$id = mysqli_real_escape_string($koneksi, $_POST['id_kat_produk']);
$nama = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi_kategori']);
$status = mysqli_real_escape_string($koneksi, $_POST['status_kategori']);

// Update data
$update = mysqli_query($koneksi, "UPDATE tb_kategori_produk SET 
    nama_kategori = '$nama', 
    deskripsi_kategori = '$deskripsi', 
    status_kategori = '$status'
    WHERE id_kat_produk = '$id'
");

if ($update) {
    header("Location: ../admin/kategori.php?pesan=edit_berhasil");
} else {
    header("Location: ../admin/kategori.php?pesan=gagal");
}
?>
