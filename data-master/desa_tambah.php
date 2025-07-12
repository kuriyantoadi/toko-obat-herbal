<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

// Ambil data POST dan sanitasi input
$id_kecamatan = mysqli_real_escape_string($koneksi, $_POST['id_kecamatan']);
$nama_desa = mysqli_real_escape_string($koneksi, $_POST['nama_desa']);

// Cek apakah nama desa sudah ada di kecamatan yang sama
$cek_desa = mysqli_query($koneksi, "SELECT nama_desa FROM tb_desa WHERE nama_desa='$nama_desa' AND id_kecamatan='$id_kecamatan'");

if (mysqli_num_rows($cek_desa) > 0) {
    // Jika data sudah ada, kembali ke halaman dengan pesan error
    header("Location: ../$session_user/desa.php?pesan=data_sudah_ada");
    exit();
}

// Masukkan data ke dalam database
$query = "INSERT INTO tb_desa (id_kecamatan, nama_desa) VALUES ('$id_kecamatan', '$nama_desa')";

$cek_tambah = mysqli_query($koneksi, $query);

// Cek apakah query berhasil
if ($cek_tambah) {
    header("Location: ../$session_user/desa.php?pesan=tambah_berhasil");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
