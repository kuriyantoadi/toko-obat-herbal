<?php
session_start();

// Cek apakah user sudah login sebagai admin
if (!isset($_SESSION['status']) || $_SESSION['status'] != "admin") {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Ambil data dari form
$id_kategori     = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
$nama_kategori   = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);

// Validasi data tidak kosong
if (!empty($id_kategori) && !empty($nama_kategori)) {
    // Lakukan update ke database
    $update = mysqli_query($koneksi, "UPDATE tb_kategori SET nama_kategori = '$nama_kategori' WHERE id_kategori = '$id_kategori'");

    if ($update) {
        header("Location: ../admin/kategori.php?pesan=edit_berhasil");
    } else {
        header("Location: ../admin/kategori.php?pesan=edit_gagal");
    }
} else {
    header("Location: ../admin/kategori.php?pesan=data_kurang");
}
?>
