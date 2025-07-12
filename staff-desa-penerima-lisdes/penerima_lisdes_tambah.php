<?php
session_start();
if ($_SESSION['status'] != "admin-staff-desa") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Validasi session
$session_user = $_SESSION['status'];
$id_desa = $_SESSION['id_desa'];
$id_kecamatan = $_SESSION['id_kecamatan'];
$id_kab_kota = $_SESSION['id_kab_kota'];

// Sanitasi data POST
$tgl_permintaan = mysqli_real_escape_string($koneksi, date('Y-m-d')); // Format YYYY-MM-DD
$nama_calon_konsumen = mysqli_real_escape_string($koneksi, $_POST['nama_calon_konsumen']);
$nik = mysqli_real_escape_string($koneksi, $_POST['nik']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$membutuhkan_bantuan = mysqli_real_escape_string($koneksi, $_POST['membutuhkan_bantuan']);
$menaati_ketentuan = mysqli_real_escape_string($koneksi, $_POST['menaati_ketentuan']);
$jarak_rumah = mysqli_real_escape_string($koneksi, $_POST['jarak_rumah']);
$catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);
$status_persetujuan_admin = "Pendataan";

// Validasi NIK
$cek_nik = mysqli_query($koneksi, "SELECT nik FROM tb_penerima_lisdes WHERE nik='$nik'");
if (mysqli_num_rows($cek_nik) > 0) {
    header("Location: ../$session_user/penerima-lisdes.php?pesan=nik_sudah_ada");
    exit();
}

// Direktori upload
$upload_dir = "../uploads/";
if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

// Fungsi untuk mengupload file
function upload_file($file, $prefix, $upload_dir) {
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_path = $upload_dir . $prefix . "_" . time() . "_" . basename($file_name);
    
    if (move_uploaded_file($file_tmp, $file_path)) {
        return $file_path;
    } else {
        return false;
    }
}

// Upload file
$photo_rumah_path = upload_file($_FILES['photo_rumah'], 'rumah', $upload_dir);
$photo_ktp_path = upload_file($_FILES['photo_ktp'], 'ktp', $upload_dir);
$photo_sktm_path = upload_file($_FILES['photo_sktm'], 'sktm', $upload_dir);

// Validasi upload file
if (!$photo_rumah_path || !$photo_ktp_path || !$photo_sktm_path) {
    header("Location: ../$session_user/penerima-lisdes.php?pesan=upload_error");
    exit();
}

// Masukkan data ke dalam database
$query = "INSERT INTO tb_penerima_lisdes (
    tgl_permintaan, 
    nama_calon_konsumen, 
    nik, 
    alamat, 
    id_kab_kota, 
    id_kecamatan, 
    id_desa, 
    membutuhkan_bantuan, 
    menaati_ketentuan, 
    jarak_rumah, 
    photo_rumah, 
    photo_ktp, 
    photo_sktm, 
    catatan,
    status_pemasangan
) VALUES (
    '$tgl_permintaan', 
    '$nama_calon_konsumen', 
    '$nik', 
    '$alamat', 
    '$id_kab_kota', 
    '$id_kecamatan', 
    '$id_desa', 
    '$membutuhkan_bantuan', 
    '$menaati_ketentuan', 
    '$jarak_rumah', 
    '$photo_rumah_path', 
    '$photo_ktp_path', 
    '$photo_sktm_path', 
    '$catatan',
    '$status_pemasangan'
)";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../$session_user/penerima-lisdes.php?pesan=tambah_berhasil");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
