<?php
include '../koneksi.php';

$nama_kategori = $_POST['nama_kategori'];
$deskripsi_kategori = $_POST['deskripsi_kategori'];
$status_kategori = $_POST['status_kategori'];
$tanggal_dibuat = date('Y-m-d H:i:s');

// Cek duplikat
$cek = mysqli_query($koneksi, "SELECT * FROM tb_kategori_produk WHERE nama_kategori='$nama_kategori'");
if (mysqli_num_rows($cek) > 0) {
    header("Location: ../admin/kategori.php?pesan=data_sudah_ada");
    exit();
}

$simpan = mysqli_query($koneksi, "INSERT INTO tb_kategori_produk 
(nama_kategori, deskripsi_kategori, status_kategori, tanggal_dibuat) 
VALUES ('$nama_kategori', '$deskripsi_kategori', '$status_kategori', '$tanggal_dibuat')");

if ($simpan) {
    header("Location: ../admin/kategori.php?pesan=tambah_berhasil");
} else {
    header("Location: ../admin/kategori.php?pesan=gagal");
}
?>
