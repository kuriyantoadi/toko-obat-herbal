<div class="mb-3">
  <a href="pesanan.php" class="btn btn-outline-primary <?php if(basename($_SERVER['PHP_SELF']) == 'pesanan.php') echo 'active'; ?>">
    <i class="fe fe-list"></i> Semua Pesanan
  </a>
  <a href="pesanan-lunas.php" class="btn btn-outline-success <?php if(basename($_SERVER['PHP_SELF']) == 'pesanan-lunas.php') echo 'active'; ?>">
    <i class="fe fe-check-circle"></i> Pesanan Lunas
  </a>
  <a href="pesanan-ditolak.php" class="btn btn-outline-danger <?php if(basename($_SERVER['PHP_SELF']) == 'pesanan-ditolak.php') echo 'active'; ?>">
    <i class="fe fe-x"></i> Ditolak
  </a>
  <a href="pesanan-belum-lunas.php" class="btn btn-outline-danger <?php if(basename($_SERVER['PHP_SELF']) == 'pesanan-belum-lunas.php') echo 'active'; ?>">
    <i class="fe fe-clock"></i> Belum Lunas
  </a>
</div>
