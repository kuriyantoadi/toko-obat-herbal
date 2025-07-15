<?php
session_start();
include('header.php');
include('header-menu.php');
include('../koneksi.php');

// Tambah ke keranjang jika ada parameter add
if (isset($_GET['add'])) {
    $id = intval($_GET['add']);

    if (!isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id] = 1;
    } else {
        $_SESSION['cart'][$id]++;
    }

    header("Location: cart.php");
    exit;
}

// Hapus item dari keranjang
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Kosongkan keranjang
if (isset($_GET['clear'])) {
    unset($_SESSION['cart']);
    header("Location: cart.php");
    exit;
}
?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">

            <div class="page-header">
                <h1 class="page-title">Keranjang Belanja</h1>
            </div>

            <?php if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])): ?>
                <div class="alert alert-info">Keranjang belanja Anda kosong.</div>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $id_produk => $qty):
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_produk = $id_produk");
                            $p = mysqli_fetch_assoc($query);
                            $subtotal = $p['harga_produk'] * $qty;
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td>
                                <img src="../uploads/produk/<?= $p['gambar_produk'] ?>" width="50" class="me-2">
                                <?= htmlspecialchars($p['nama_produk']) ?>
                            </td>
                            <td>Rp<?= number_format($p['harga_produk'], 0, ',', '.') ?></td>
                            <td><?= $qty ?></td>
                            <td>Rp<?= number_format($subtotal, 0, ',', '.') ?></td>
                            <td>
                                <a href="cart.php?remove=<?= $id_produk ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Total Bayar:</td>
                            <td colspan="2">Rp<?= number_format($total, 0, ',', '.') ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <a href="produk.php" class="btn btn-secondary"><i class="fe fe-arrow-left"></i> Lanjut Belanja</a>
                    <div>
                        <a href="cart.php?clear=1" class="btn btn-danger me-2" onclick="return confirm('Kosongkan keranjang?')">Kosongkan</a>
                        <a href="checkout.php" class="btn btn-success">Checkout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('footer.php') ?>
