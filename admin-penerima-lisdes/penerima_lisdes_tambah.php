<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

// Ambil data POST dan sanitasi input
$tgl_permintaan = mysqli_real_escape_string($koneksi, date('d-m-Y'));
$nama_calon_konsumen = mysqli_real_escape_string($koneksi, $_POST['nama_calon_konsumen']);
$nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$id_kab_kota = mysqli_real_escape_string($koneksi, $_POST['id_kab_kota']);
$id_kecamatan = mysqli_real_escape_string($koneksi, $_POST['id_kecamatan']);
$id_desa = mysqli_real_escape_string($koneksi, $_POST['id_desa']);
$membutuhkan_bantuan = mysqli_real_escape_string($koneksi, $_POST['membutuhkan_bantuan']);
$menunggu_bantuan = mysqli_real_escape_string($koneksi, $_POST['menunggu_bantuan']);
$menaati_ketentuan = mysqli_real_escape_string($koneksi, $_POST['menaati_ketentuan']);
$jarak_rumah = mysqli_real_escape_string($koneksi, $_POST['jarak_rumah']);
$petugas_survei = mysqli_real_escape_string($koneksi, $_POST['petugas_survei']);
$status_pemasangan = mysqli_real_escape_string($koneksi, $_POST['status_pemasangan']);
$catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);

// Cek apakah NIK sudah ada
$cek_nik = mysqli_query($koneksi, "SELECT nik FROM tb_penerima_lisdes WHERE nik='$nik'");

if (mysqli_num_rows($cek_nik) > 0) {
    // Jika data sudah ada, kembali ke halaman dengan pesan error
    header("Location: ../$session_user/penerima-lisdes.php?pesan=nik_sudah_ada");
    exit();
}

// Masukkan data ke dalam database
$query = "INSERT INTO tb_penerima_lisdes (tgl_permintaan, nama_calon_konsumen, nik, alamat, id_kab_kota, id_kecamatan, id_desa, membutuhkan_bantuan, menunggu_bantuan, menaati_ketentuan, jarak_rumah, petugas_survei, status_pemasangan, catatan) VALUES 
                                            ('$tgl_permintaan', '$nama_calon_konsumen', '$nik', '$alamat', '$id_kab_kota', '$id_kecamatan', '$id_desa', '$membutuhkan_bantuan', '$menunggu_bantuan', '$menaati_ketentuan', '$jarak_rumah', '$petugas_survei', '$status_pemasangan', '$catatan')";

$cek_tambah = mysqli_query($koneksi, $query);

// Cek apakah query berhasil
if ($cek_tambah) {
    header("Location: ../$session_user/penerima-lisdes.php?pesan=tambah_berhasil");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
