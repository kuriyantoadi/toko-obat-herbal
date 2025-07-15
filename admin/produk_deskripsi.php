<?php include('header.php') ?>
<?php include('header-menu.php') ?>
<?php include('../koneksi.php') ?>

<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$produk = mysqli_query($koneksi, "
    SELECT p.*, k.nama_kategori 
    FROM tb_produk p 
    JOIN tb_kategori_produk k ON p.id_kat_produk = k.id_kat_produk 
    WHERE p.id_produk = $id
");
$data = mysqli_fetch_assoc($produk);

if (!$data) {
    echo "<div class='alert alert-danger m-4'>Produk tidak ditemukan.</div>";
    include('footer.php');
    exit;
}
?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">

            <!-- Header -->
            <div class="page-header">
                <h1 class="page-title"><?= htmlspecialchars($data['nama_produk']) ?></h1>
            </div>

            <div class="row">
                <!-- Gambar -->
                <div class="col-lg-5">
                    <img src="../uploads/produk/<?= $data['gambar_produk'] ?>" class="img-fluid rounded shadow" alt="<?= $data['nama_produk'] ?>">
                </div>

                <!-- Detail Produk -->
                <div class="col-lg-7">
                    <h3 class="fw-bold">Rp<?= number_format($data['harga_produk'], 0, ',', '.') ?></h3>
                    <p class="text-muted">Kategori: <?= htmlspecialchars($data['nama_kategori']) ?></p>
                    <p><?= nl2br(htmlspecialchars($data['deskripsi_produk'])) ?></p>
                    <p>Stok: <?= $data['stok_produk'] ?> | Berat: <?= $data['berat_produk'] ?> gram</p>
                    <a href="cart.php?add=<?= $data['id_produk'] ?>" class="btn btn-primary"><i class="fe fe-shopping-cart me-1"></i> Tambah ke Keranjang</a>
                </div>
            </div>

            <hr class="my-5">

            <!-- Review Section -->
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Review Produk</h4>

                    <!-- Form Review -->
                    <form method="POST" action="produk_review_simpan.php">
                        <input type="hidden" name="id_produk" value="<?= $data['id_produk'] ?>">
                        <div class="mb-3">
                            <label class="form-label">Nama Anda</label>
                            <input type="text" name="nama_reviewer" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rating</label>
                            <select name="rating" class="form-control" required>
                                <option value="5">★★★★★ (5)</option>
                                <option value="4">★★★★☆ (4)</option>
                                <option value="3">★★★☆☆ (3)</option>
                                <option value="2">★★☆☆☆ (2)</option>
                                <option value="1">★☆☆☆☆ (1)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Komentar</label>
                            <textarea name="komentar" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Kirim Review</button>
                    </form>

                    <hr class="my-5">

                    <!-- Tampilkan Review -->
                    <?php
                    $reviews = mysqli_query($koneksi, "SELECT * FROM tb_review_produk WHERE id_produk = $id ORDER BY tanggal_review DESC");
                    if (mysqli_num_rows($reviews) == 0) {
                        echo "<p class='text-muted'>Belum ada review.</p>";
                    } else {
                        while ($r = mysqli_fetch_assoc($reviews)) {
                            echo "<div class='mb-4'>";
                            echo "<strong>" . htmlspecialchars($r['nama_reviewer']) . "</strong> ";
                            echo str_repeat("★", $r['rating']) . str_repeat("☆", 5 - $r['rating']);
                            echo "<br><small class='text-muted'>" . date("d M Y", strtotime($r['tanggal_review'])) . "</small>";
                            echo "<p>" . nl2br(htmlspecialchars($r['komentar'])) . "</p>";
                            echo "</div><hr>";
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('footer.php') ?>
