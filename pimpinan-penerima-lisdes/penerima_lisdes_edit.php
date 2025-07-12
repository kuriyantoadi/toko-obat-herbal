<?php
session_start();
if ($_SESSION['status'] != "admin-lisdes") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

$id_penerima_lisdes = mysqli_real_escape_string($koneksi, $_POST['id_penerima_lisdes']);
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

$cek_edit = mysqli_query($koneksi, "UPDATE tb_penerima_lisdes SET
        nama_calon_konsumen='$nama_calon_konsumen',
        nik='$nik',
        alamat='$alamat',
        id_kab_kota='$id_kab_kota',
        id_kecamatan='$id_kecamatan',
        id_desa='$id_desa',
        membutuhkan_bantuan='$membutuhkan_bantuan',
        menunggu_bantuan='$menunggu_bantuan',
        menaati_ketentuan='$menaati_ketentuan',
        jarak_rumah='$jarak_rumah',
        petugas_survei='$petugas_survei',
        status_pemasangan='$status_pemasangan',
        catatan='$catatan'
        WHERE id_penerima_lisdes='$id_penerima_lisdes'
        ");

if ($cek_edit) {
    header("location:../$session_user/penerima-lisdes.php?pesan=edit-berhasil");
} else {
    header("location:../$session_user/penerima-lisdes.php?pesan=edit-gagal");
}
?>
