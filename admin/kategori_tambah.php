<?php
session_start();
if ($_SESSION['status'] != "admin") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Ambil data dari form
$nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);

// Cek apakah nama kategori sudah ada
$cek = mysqli_query($koneksi, "SELECT * FROM tb_kategori WHERE nama_kategori = '$nama_kategori'");
if (mysqli_num_rows($cek) > 0) {
    // Jika kategori sudah ada
    header("location:../admin/kategori.php?pesan=duplikat");
    exit();
}

// Simpan ke database
$simpan = mysqli_query($koneksi, "INSERT INTO tb_kategori (nama_kategori) VALUES ('$nama_kategori')");

if ($simpan) {
    header("location:../admin/kategori.php?pesan=tambah-berhasil");
} else {
    header("location:../admin/kategori.php?pesan=tambah-gagal");
}
?>
