<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Kabupaten dan Kota</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kabupaten dan Kota</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-3 -->


            <!-- awal tabel -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Kabupaten dan Kota</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <?php include('../alert.php') ?>

                                <button class="btn btn-icon btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#largemodal_tambah">Tambah<i class="fe fe-plus"></i></button>
                                <?php include('kab_kota_modal_tambah.php') ?>

                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0 text-center">No</th>
                                            <th class="wd-15p border-bottom-0 text-center">Nama Kabupaten/Kota</th>                                           
                                            <th class="wd-25p border-bottom-0 text-center">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi.php';
                                        $no = 1;
                                        $data = mysqli_query($koneksi, "SELECT * from tb_kab_kota");
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>

                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class=""><?= $d['nama_kab_kota'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#largemodal_edit<?= $d['id_kab_kota'] ?>"><i class="fe fe-edit"></i></button>
                                                <a href="../data-master/kab_kota_hapus.php?id_kab_kota=<?= $d['id_kab_kota'] ?>" type="button" class="btn btn-icon btn-sm btn-danger" 
                                                onclick="return confirm('Anda yakin Hapus data Kabupaten/Kota <?php echo $d['nama_kab_kota']; ?> ?')"><i class="fe fe-trash-2"></i></a>
                                                <?php include('kab_kota_modal.php') ?>                                                
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
            <!-- End Row -->            
            
        </div>
        <!-- CONTAINER END -->
    </div>
</div>
<!--app-content close-->
</div>