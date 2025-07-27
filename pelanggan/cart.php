<?php
session_start();
include('header.php');
include('header-menu.php');
include('../koneksi.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Tambah ke keranjang
if (isset($_GET['add'])) {
    $id = intval($_GET['add']);
    if ($id > 0) {
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = 1;
        } else {
            $_SESSION['cart'][$id]++;
        }
    }
    header("Location: cart.php");
    exit;
}

// Hapus item
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    exit;
}

// Kosongkan
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

            <?php if (empty($_SESSION['cart'])): ?>
                <div class="alert alert-info">Keranjang belanja Anda kosong.</div>
            <?php else: ?>
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-light">
                        <?php
                        $total = 0;
                        foreach ($_SESSION['cart'] as $id_produk => $qty) {
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_produk WHERE id_produk = " . intval($id_produk));
                            if (mysqli_num_rows($query) == 0) {
                                echo "<tr><td colspan='5'>Produk tidak ditemukan. <a href='cart.php?remove=$id_produk'>[Hapus]</a></td></tr>";
                                continue;
                            }
                            $p = mysqli_fetch_assoc($query);
                            $subtotal = $p['harga_produk'] * $qty;
                            $total += $subtotal;

                            $gambar = file_exists("../uploads/produk/" . $p['gambar_produk']) ? $p['gambar_produk'] : 'default.png';
                            ?>
                            <tr>
                                <td><img src="../uploads/produk/<?php echo htmlspecialchars($gambar); ?>" width="50" class="me-2"> <?php echo htmlspecialchars($p['nama_produk']); ?></td>
                                <td>Rp<?php echo number_format($p['harga_produk'], 0, ',', '.'); ?></td>
                                <td><?php echo $qty; ?></td>
                                <td>Rp<?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                                <td><a href="cart.php?remove=<?php echo $id_produk; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus produk ini?')">Hapus</a></td>
                            </tr>
                        <?php } ?>
                        <tr class="fw-bold">
                            <td colspan="3" class="text-end">Total Bayar:</td>
                            <td colspan="2">Rp<?php echo number_format($total, 0, ',', '.'); ?></td>
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between">
                    <a href="produk.php" class="btn btn-secondary"><i class="fe fe-arrow-left"></i> Lanjut Belanja</a>
                    <div>
                        <a href="cart.php?clear=1" class="btn btn-danger me-2" onclick="return confirm('Kosongkan seluruh keranjang?')">Kosongkan</a>
                        <a href="checkout.php" class="btn btn-success">Checkout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
