<?php

include '../koneksi.php';

// Ambil data POST dan sanitasi input
$nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
$email_pelanggan = mysqli_real_escape_string($koneksi, $_POST['email_pelanggan']);
$password_pelanggan = mysqli_real_escape_string($koneksi, $_POST['password_pelanggan']);
$no_hp_pelanggan = mysqli_real_escape_string($koneksi, $_POST['no_hp_pelanggan']);
$alamat_pelanggan = mysqli_real_escape_string($koneksi, $_POST['alamat_pelanggan']);

// Cek apakah email sudah terdaftar
$cek_email = mysqli_query($koneksi, "SELECT email_pelanggan FROM tb_pelanggan WHERE email_pelanggan='$email_pelanggan'");

if (mysqli_num_rows($cek_email) > 0) {
    // Jika email sudah ada, kembali ke halaman dengan pesan error
    header("Location: registrasi.php?pesan=email_sudah_ada");
    exit();
}

// Enkripsi password (opsional tapi direkomendasikan)
$password_hash = password_hash($password_pelanggan, PASSWORD_DEFAULT);

// Masukkan data ke dalam database
$query = "INSERT INTO tb_pelanggan (nama_pelanggan, email_pelanggan, password_pelanggan, no_hp_pelanggan, alamat_pelanggan) VALUES 
          ('$nama_pelanggan', '$email_pelanggan', '$password_hash', '$no_hp_pelanggan', '$alamat_pelanggan')";

$cek_tambah = mysqli_query($koneksi, $query);

// Cek apakah query berhasil
if ($cek_tambah) {
    header("Location: index.php?pesan=registrasi_berhasil");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
