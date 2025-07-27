<?php
include '../koneksi.php';

// Ambil data dari form
$nama = $_POST['nama_pelanggan'];
$email = $_POST['email_pelanggan'];
$password = password_hash($_POST['password_pelanggan'], PASSWORD_DEFAULT); // penting!
$nohp = $_POST['no_hp_pelanggan'];
$alamat = $_POST['alamat_pelanggan'];
$status = 'aktif';

// Cek email duplikat
$cek = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE email_pelanggan='$email'");
if (mysqli_num_rows($cek) > 0) {
    header("Location: register.php?pesan=email_sudah_ada");
    exit;
}

// Simpan ke database
mysqli_query($koneksi, "INSERT INTO tb_pelanggan (nama_pelanggan, email_pelanggan, password_pelanggan, no_hp_pelanggan, alamat_pelanggan, status) 
VALUES ('$nama', '$email', '$password', '$nohp', '$alamat', '$status')");

header("Location: index.php?pesan=berhasil_daftar");
exit;
?>
