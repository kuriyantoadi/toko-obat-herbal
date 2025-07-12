<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = sha1(mysqli_real_escape_string($koneksi, $_POST['username']));
$nama_staff_desa = mysqli_real_escape_string($koneksi, $_POST['nama_staff_desa']);
$id_kab_kota = mysqli_real_escape_string($koneksi, $_POST['id_kab_kota']);
$id_kecamatan = mysqli_real_escape_string($koneksi, $_POST['id_kecamatan']);
$id_desa = mysqli_real_escape_string($koneksi, $_POST['id_desa']);
$status = "admin-staff-desa";

// Cek apakah username mengandung spasi
if (preg_match('/\s/', $username)) {
    header("Location: ../$session_user/staff-desa.php?pesan=username_invalid");
    exit();
}

// Insert data into the database
$query = "INSERT INTO tb_user (username, password, nama_staff_desa, id_kab_kota, id_kecamatan, id_desa, status) 
          VALUES ('$username', '$password', '$nama_staff_desa', '$id_kab_kota', '$id_kecamatan', '$id_desa', '$status')";

$cek_tambah = mysqli_query($koneksi, $query);

// Check if the query was successful
if ($cek_tambah) {
    header("Location: ../$session_user/staff-desa.php?pesan=tambah_berhasil");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
