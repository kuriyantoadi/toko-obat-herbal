<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

// Get POST data and sanitize inputs
$id_kab_kota = mysqli_real_escape_string($koneksi, $_POST['id_kab_kota']);
$nama_kecamatan = mysqli_real_escape_string($koneksi, $_POST['nama_kecamatan']);

// cek nama kab kota jika sama
$cek_kec = mysqli_query($koneksi, "SELECT nama_kecamatan from tb_kecamatan WHERE nama_kecamatan='$nama_kecamatan'");

if (mysqli_num_rows($cek_kec) > 0) {
    // Jika null, anggap berhasil
    header("Location: ../$session_user/kec.php?pesan=data_sudah_ada");
    exit();
}

// Insert data into the database
$query = "INSERT INTO tb_kecamatan (id_kab_kota, nama_kecamatan) 
          VALUES ('$id_kab_kota','$nama_kecamatan')";

$cek_tambah = mysqli_query($koneksi, $query);

// Check if the query was successful
if ($cek_tambah) {
    header("Location: ../$session_user/kec.php?pesan=tambah_berhasil");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
