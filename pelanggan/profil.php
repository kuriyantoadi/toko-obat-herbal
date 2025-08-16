<?php
include('header.php');
include('header-menu.php');
include('../koneksi.php');

// Ambil data profil dari database
$query = mysqli_query($koneksi, "SELECT * FROM tb_profil LIMIT 1");
$profil = mysqli_fetch_assoc($query);
?>

<!-- Konten -->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">


            <!-- Konten Profil -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= htmlspecialchars($profil['judul']) ?></h3>
                        </div>
                        <div class="card-body">
                            <?= nl2br(htmlspecialchars($profil['deskripsi'])) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>
