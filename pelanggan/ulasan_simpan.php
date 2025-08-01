<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_order = isset($_POST['id_order']) ? intval($_POST['id_order']) : 0;
  $ulasan = isset($_POST['ulasan']) ? mysqli_real_escape_string($koneksi, $_POST['ulasan']) : '';
  $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;

  if ($id_order > 0 && $ulasan != '' && $rating > 0) {
    $query = "INSERT INTO tb_ulasan (id_order, ulasan, rating, tanggal_ulasan) 
              VALUES ('$id_order', '$ulasan', '$rating', NOW())";

    if (mysqli_query($koneksi, $query)) {
      header("Location: pesanan.php?pesan=sukses"); // ganti dengan halaman tujuan
    } else {
      echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
  } else {
    echo "Data tidak lengkap.";
  }
}
?>
