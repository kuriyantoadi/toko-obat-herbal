<?php
session_start();

// Cek apakah user sudah login sebagai admin
if (!isset($_SESSION['status']) || $_SESSION['status'] != "admin") {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$id_produk = isset($_GET['id_produk']) ? mysqli_real_escape_string($koneksi, $_GET['id_produk']) : null;


if (!empty($id_produk)) {
    // Cek apakah produk ada
    $cek = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_produk = '$id_produk'");

    if (mysqli_num_rows($cek) > 0) {
        $data = mysqli_fetch_assoc($cek);
        $gambar = $data['gambar_produk'];
        $lokasi_gambar = "../uploads/produk/$gambar";

        // Hapus gambar jika ada
        if (!empty($gambar) && file_exists($lokasi_gambar)) {
            unlink($lokasi_gambar);
        }

        // Hapus data dari database
        $hapus = mysqli_query($koneksi, "DELETE FROM tb_produk WHERE id_produk = '$id_produk'");

        if ($hapus) {
            header("Location: produk.php?pesan=hapus_berhasil");
        } else {
            header("Location: produk.php?pesan=hapus_gagal");
        }
    } else {
        header("Location: produk.php?pesan=id_tidak_ditemukan");
    }
} else {
    header("Location: produk.php?pesan=id_tidak_valid");
}
?>
