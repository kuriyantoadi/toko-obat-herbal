<?php include('header.php') ?>
<?php include('header-menu.php') ?>

<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Data Kategori</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kategori Produk</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <?php include('../alert.php') ?>

                                <!-- Tambah Kategori Button -->
                                <button class="btn btn-icon btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal_tambah_kategori">Tambah <i class="fe fe-plus"></i></button>
                                <?php include('kategori_modal_tambah.php') ?>

                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Kategori</th>
                                            <th class="text-center">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi.php';
                                        $no = 1;
                                        $data = mysqli_query($koneksi, "SELECT * FROM tb_kategori");
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>
                                            <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $d['nama_kategori'] ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal_edit_kategori<?= $d['id_kategori'] ?>"><i class="fe fe-edit"></i></button>
                                                    <a href="../admin/kategori_hapus.php?id_kategori=<?= $d['id_kategori'] ?>" class="btn btn-icon btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')"><i class="fe fe-trash"></i></a>
                                                    <?php include('kategori_modal_edit.php') ?>
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
        <!-- CONTAINER END -->
    </div>
</div>
<!--app-content close-->
</div>

<?php include('footer.php') ?>
