<?php
session_start();
if ($_SESSION['status'] != "admin") {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Ambil data dari form
$nama_produk       = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$id_kategori       = mysqli_real_escape_string($koneksi, $_POST['id_kat_produk']);
$stok_produk       = mysqli_real_escape_string($koneksi, $_POST['stok_produk']);
$berat_produk      = mysqli_real_escape_string($koneksi, $_POST['berat_produk']);
$harga_produk      = mysqli_real_escape_string($koneksi, $_POST['harga_produk']);
$deskripsi_produk  = mysqli_real_escape_string($koneksi, $_POST['deskripsi_produk']);
$tanggal_tambah    = date("Y-m-d H:i:s");

// Upload gambar
$gambar            = $_FILES['gambar_produk']['name'];
$tmp               = $_FILES['gambar_produk']['tmp_name'];
$folder_upload     = "../uploads/produk/";

$ext = pathinfo($gambar, PATHINFO_EXTENSION);
$gambar_baru = uniqid('produk_') . '.' . $ext;

if (!is_dir($folder_upload)) {
    mkdir($folder_upload, 0777, true);
}

if (move_uploaded_file($tmp, $folder_upload . $gambar_baru)) {
    // Simpan ke database
    $query = "INSERT INTO tb_produk (
        id_kat_produk, nama_produk, stok_produk, gambar_produk, 
        tanggal_ditambahkan, dekripsi_produk, berat_produk, harga_produk
    ) VALUES (
        '$id_kategori', '$nama_produk', '$stok_produk', '$gambar_baru', 
        '$tanggal_tambah', '$deskripsi_produk', '$berat_produk', '$harga_produk'
    )";

    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        header("Location: ../admin/produk.php?pesan=tambah_berhasil");
    } else {
        // header("Location: ../admin/produk.php?pesan=tambah_gagal");
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // header("Location: ../admin/produk.php?pesan=gambar_gagal");
    echo "Error: Gagal mengupload gambar.";
}
?>
