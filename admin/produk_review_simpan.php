<?php
include '../koneksi.php';

$id_produk = intval($_POST['id_produk']);
$nama = htmlspecialchars($_POST['nama_reviewer']);
$rating = intval($_POST['rating']);
$komentar = htmlspecialchars($_POST['komentar']);

mysqli_query($koneksi, "
    INSERT INTO tb_review_produk (id_produk, nama_reviewer, rating, komentar)
    VALUES ($id_produk, '$nama', $rating, '$komentar')
");

header("Location: produk_deskripsi.php?id=$id_produk");
exit;
