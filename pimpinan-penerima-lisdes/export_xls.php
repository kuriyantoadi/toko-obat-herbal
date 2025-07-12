<?php
// Sertakan koneksi database
include '../koneksi.php';

// Set header agar file terunduh sebagai Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data_penerima_lisdes.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Query untuk mengambil data dari database dengan relasi ke tb_desa, tb_kecamatan, dan tb_kab_kota
$query = "SELECT p.*, d.nama_desa, k.nama_kecamatan, kab.nama_kab_kota 
          FROM tb_penerima_lisdes p
          LEFT JOIN tb_desa d ON p.id_desa = d.id_desa
          LEFT JOIN tb_kecamatan k ON p.id_kecamatan = k.id_kecamatan
          LEFT JOIN tb_kab_kota kab ON p.id_kab_kota = kab.id_kab_kota";
$result = mysqli_query($koneksi, $query);

// Buat header tabel Excel
echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Tanggal Permintaan</th>
        <th>Nama Calon Konsumen</th>
        <th>NIK</th>
        <th>Alamat</th>
        <th>Nama Desa</th>
        <th>Nama Kecamatan</th>
        <th>Nama Kab/Kota</th>
        <th>Membutuhkan Bantuan</th>
        <th>Menaati Ketentuan</th>
        <th>Jarak Rumah</th>
        <th>Status Pemasangan</th>
        <th>Catatan</th>
       
      </tr>";

// Loop untuk menampilkan data dari database
$no=1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $no++; "</td>";
    echo "<td>" . $row['tgl_permintaan'] . "</td>";
    echo "<td>" . $row['nama_calon_konsumen'] . "</td>";
    echo "<td>" . $row['nik'] . "</td>";
    echo "<td>" . $row['alamat'] . "</td>";
    echo "<td>" . $row['nama_desa'] . "</td>";
    echo "<td>" . $row['nama_kecamatan'] . "</td>";
    echo "<td>" . $row['nama_kab_kota'] . "</td>";
    echo "<td>" . $row['membutuhkan_bantuan'] . "</td>";
    echo "<td>" . $row['menaati_ketentuan'] . "</td>";
    echo "<td>" . $row['jarak_rumah'] . "</td>";
    echo "<td>" . $row['status_persetujuan_admin'] . "</td>";
    echo "<td>" . $row['catatan'] . "</td>";

    echo "</tr>";
}

echo "</table>";
?>
