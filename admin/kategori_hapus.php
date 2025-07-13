<?php
session_start();

// Cek apakah user sudah login dan memiliki hak akses admin
if (!isset($_SESSION['status']) || $_SESSION['status'] != "admin") {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Ambil ID kategori dari URL
$id_kategori = isset($_GET['id_kategori']) ? mysqli_real_escape_string($koneksi, $_GET['id_kategori']) : null;

// Cek apakah ID kategori valid
if (!empty($id_kategori)) {
    // Hapus data dari tabel tb_kategori
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_kategori WHERE id_kategori = '$id_kategori'");

    if ($hapus) {
        // Berhasil dihapus
        header("Location: ../admin/kategori.php?pesan=hapus_berhasil");
    } else {
        // Gagal menghapus
        header("Location: ../admin/kategori.php?pesan=hapus_gagal");
    }
} else {
    // Jika ID tidak valid
    header("Location: ../admin/kategori.php?pesan=id_tidak_valid");
}
?>
