<?php
include '../koneksi.php';
$id_kecamatan = $_GET['id_kecamatan'];

$desa_data = mysqli_query($koneksi, "SELECT id_desa, nama_desa FROM tb_desa WHERE id_kecamatan = '$id_kecamatan' ORDER BY nama_desa ASC");

$result = array();
while ($row = mysqli_fetch_assoc($desa_data)) {
    $result[] = $row;
}

echo json_encode($result);
?>
