<?php
include '../koneksi.php';

$id_kab_kota = isset($_GET['id_kab_kota']) ? intval($_GET['id_kab_kota']) : 0;

$sql = "SELECT id_kecamatan, nama_kecamatan FROM tb_kecamatan WHERE id_kab_kota = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id_kab_kota);
$stmt->execute();
$result = $stmt->get_result();

$kecamatanList = [];
while ($row = $result->fetch_assoc()) {
    $kecamatanList[] = $row;
}

$stmt->close();
$koneksi->close();

header('Content-Type: application/json');
echo json_encode($kecamatanList);
