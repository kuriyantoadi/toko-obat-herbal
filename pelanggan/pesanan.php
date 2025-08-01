<?php include('header.php'); ?>
<?php include('header-menu.php'); ?>
<?php include('../koneksi.php'); ?>


<?php $id_pelanggan = $_SESSION['id_pelanggan'];  ?>


<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">

      <!-- PAGE HEADER -->
      <div class="page-header">
        <h1 class="page-title">Pesanan Pelanggan </h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
          </ol>
        </div>
      </div>

      <!-- TABEL PESANAN LUNAS -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Pesanan Pelanggan</h3>
            </div>
            <div class="card-body table-responsive">
            <?php include('../alert.php') ?>
              <table class="table table-bordered table-striped" id="lunas-datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pembeli</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * 
                                                  FROM tb_pelanggan 
                                                  JOIN tb_order ON tb_pelanggan.id_pelanggan = tb_order.id_pelanggan 
                                                  WHERE tb_order.id_pelanggan = $id_pelanggan 
                                                  ORDER BY tb_order.tanggal_order DESC
                                                  ");
                  while ($row = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= date('d-m-Y H:i', strtotime($row['tanggal_order'])) ?></td>
                      <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                      <td><?= htmlspecialchars($row['no_hp_pelanggan']) ?></td>
                      <td><?= htmlspecialchars($row['alamat_pelanggan']) ?></td>
                      <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                      <td>
                        <?php
                          $status = strtolower($row['status_pembayaran']);
                          $badgeClass = 'secondary'; // default badge

                          // Tentukan warna badge berdasarkan status
                          if ($status == 'lunas') {
                              $badgeClass = 'success';
                              $statusText = 'Lunas';
                          } elseif ($status == 'belum lunas') {
                              $badgeClass = 'danger';
                              $statusText = 'Belum Lunas';
                          } elseif ($status == 'menunggu konfirmasi') {
                              $badgeClass = 'warning';
                              $statusText = 'Menunggu Konfirmasi';
                          } elseif ($status == 'ditolak') {
                              $badgeClass = 'danger';
                              $statusText = 'Ditolak';
                          } else {
                              $statusText = ucfirst($row['status_pembayaran']);
                          }
                        ?>
                        <div class="d-flex justify-content-center">
                            <span class="badge bg-<?= $badgeClass ?>"><?= $statusText ?></span>
                        </div>
                    </td>

                      <td>
                        <!-- Tombol Detail -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_detail_pesanan<?= $row['id_order'] ?>">
                          <i class="fe fe-eye"></i> 
                        </button>
                        <?php include('pesanan_modal_detail.php'); ?>

                        <!-- Tombol Cetak Invoice -->
                        <a href="invoice_cetak.php?id=<?= $row['id_order'] ?>" target="_blank" class="btn btn-warning btn-sm">
                          <i class="fe fe-printer"></i> 
                        </a>

                        <!-- Tombol Konfirmasi jika belum lunas -->
                        <?php if ($status == 'belum lunas') : ?>
                          <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_konfirmasi<?= $row['id_order'] ?>">
                            <i class="fe fe-check"></i> 
                          </button>
                          <?php include('pesanan_modal_konfirmasi.php'); ?>
                        <?php endif; ?>

                        <!-- Cek apakah sudah ada ulasan -->
                          <?php
                            $id_order = $row['id_order'];
                            $status_pesanan = strtolower($row['status_pembayaran']);

                            // Cek apakah pesanan sudah lunas
                            if ($status_pesanan == 'lunas') {
                              $cek_ulasan = mysqli_query($koneksi, "SELECT * FROM tb_ulasan WHERE id_order = '$id_order'");
                              
                              // Cek keberhasilan query & hasilnya
                              if ($cek_ulasan && mysqli_num_rows($cek_ulasan) == 0):
                            ?>
                                <!-- Tombol Ulasan jika belum ada dan status lunas -->
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modal_ulasan<?= $row['id_order'] ?>">
                                  <i class="fe fe-message-square"></i>
                                </button>
                                <?php include 'ulasan_form.php'; ?>
                            <?php 
                              endif;
                            } 
                            ?>


                      </td>

                    </tr>
                  <?php } ?>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include('footer.php'); ?>

<!-- DataTable Script -->
<script>
  $(document).ready(function () {
    $('#lunas-datatable').DataTable({
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Berikutnya",
          previous: "Sebelumnya"
        },
        zeroRecords: "Tidak ada data ditemukan",
        infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri"
      }
    });
  });
</script>
