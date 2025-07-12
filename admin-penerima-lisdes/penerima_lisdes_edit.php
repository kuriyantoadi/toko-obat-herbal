<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

$id_penerima_lisdes = mysqli_real_escape_string($koneksi, $_POST['id_penerima_lisdes']);
$nama_calon_konsumen = mysqli_real_escape_string($koneksi, $_POST['nama_calon_konsumen']);
$nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$membutuhkan_bantuan = mysqli_real_escape_string($koneksi, $_POST['membutuhkan_bantuan']);
$menaati_ketentuan = mysqli_real_escape_string($koneksi, $_POST['menaati_ketentuan']);
$jarak_rumah = mysqli_real_escape_string($koneksi, $_POST['jarak_rumah']);
$status_pemasangan = mysqli_real_escape_string($koneksi, $_POST['status_pemasangan']);
$catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);

$cek_edit = mysqli_query($koneksi, "UPDATE tb_penerima_lisdes SET
        nama_calon_konsumen='$nama_calon_konsumen',
        nik='$nik',
        alamat='$alamat',
        membutuhkan_bantuan='$membutuhkan_bantuan',
        menaati_ketentuan='$menaati_ketentuan',
        jarak_rumah='$jarak_rumah',
        status_pemasangan='$status_pemasangan',
        catatan='$catatan'
        WHERE id_penerima_lisdes='$id_penerima_lisdes'
        ");

if ($cek_edit) {
    header("location:../$session_user/penerima-lisdes.php?pesan=edit_berhasil");
} else {
    header("location:../$session_user/penerima-lisdes.php?pesan=edit_gagal");
}
?>
