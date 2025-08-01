<?php
session_start();

// Cek apakah user sudah login dan memiliki hak akses admin
if (!isset($_SESSION['status']) || $_SESSION['status'] != "admin") {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Ambil ID kategori dari URL
$id_kat_produk = isset($_GET['id_kat_produk']) ? mysqli_real_escape_string($koneksi, $_GET['id_kat_produk']) : null;

// var_dump($id_kat_produk); // Debugging line to check the ID

// Cek apakah ID kategori valid
if (!empty($id_kat_produk)) {
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_kategori_produk WHERE id_kat_produk = '$id_kat_produk'");

    if ($hapus) {
        header("Location: kategori.php?pesan=hapus_berhasil");
    } else {
        $error_code = mysqli_errno($koneksi);

        if ($error_code == 1451) {
            // Foreign key constraint error
            header("Location: kategori.php?pesan=kategori_dipakai");
        } else {
            // Error umum lainnya
            header("Location: kategori.php?pesan=hapus_gagal");
        }
    }
}

?>
