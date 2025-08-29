<?php include('header.php'); ?>
<?php include('header-menu.php'); ?>
<?php include('../koneksi.php'); ?>

<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">

      <!-- PAGE HEADER -->
      <div class="page-header">
        <h1 class="page-title">Pesanan Lunas</h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lunas</li>
          </ol>
        </div>
      </div>

      <!-- TABEL PESANAN LUNAS -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Pesanan yang Sudah Lunas</h3>
            </div>
            <div class="card-body table-responsive">
              <?php include('../alert.php') ?>
              <?php include('pesanan-btn.php') ?>
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
                  $data = mysqli_query($koneksi, "SELECT * 
                                                  FROM tb_pelanggan 
                                                  JOIN tb_order ON tb_pelanggan.id_pelanggan = tb_order.id_pelanggan 
                                                  ORDER BY tb_order.tanggal_order DESC
                                                  ");
                  while ($row = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td></td> <!-- Nomor urut otomatis dari DataTables -->
                      <td><?= date('d-m-Y H:i', strtotime($row['tanggal_order'])) ?></td>
                      <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                      <td><?= htmlspecialchars($row['no_hp_pelanggan']) ?></td>
                      <td><?= htmlspecialchars($row['alamat_pelanggan']) ?></td>
                      <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                      <?php include('../case_status_pembayaran.php'); ?>
                      <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_detail_pesanan<?= $row['id_order'] ?>">
                          <i class="fe fe-eye"></i> 
                        </button>
                        <?php include('pesanan_modal_detail.php'); ?>

                        <a href="invoice_cetak.php?id=<?= $row['id_order'] ?>" target="_blank" class="btn btn-warning btn-sm">
                          <i class="fe fe-printer"></i> 
                        </a>

                        <!-- Tombol Hapus -->
                        <a href="pesanan-hapus.php?id=<?= $row['id_order'] ?>" 
                          onclick="return confirm('Yakin ingin menghapus pesanan ini?')" 
                          class="btn btn-danger btn-sm">
                          <i class="fe fe-trash"></i>
                        </a>
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
    var t = $('#lunas-datatable').DataTable({
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
      },
      columnDefs: [
        { searchable: false, orderable: false, targets: 0 } // kolom No tidak ikut search & sort
      ],
      order: [[1, 'desc']] // urut default berdasarkan tanggal terbaru
    });

    // Nomor urut otomatis
    t.on('order.dt search.dt', function () {
      t.column(0, { search: 'applied', order: 'applied' })
        .nodes()
        .each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
    }).draw();
  });
</script>
