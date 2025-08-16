<?php
include('header.php');
include('header-menu.php');
include('../koneksi.php');

// Ambil data profil
$query = mysqli_query($koneksi, "SELECT * FROM tb_profil LIMIT 1");
$profil = mysqli_fetch_assoc($query);

// Proses update data
if (isset($_POST['simpan'])) {
    $judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    mysqli_query($koneksi, "UPDATE tb_profil SET judul='$judul', deskripsi='$deskripsi' WHERE id={$profil['id']}");

    header("Location: profil_edit.php?pesan=update_sukses");
    exit;
}
?>

<!-- Konten -->
<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">

            <!-- Header Halaman -->
            <div class="page-header">
                <h1 class="page-title">Edit Profil Toko</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                </ol>
            </div>

            <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'update_sukses') { ?>
                <div class="alert alert-success">Profil berhasil diperbarui.</div>
            <?php } ?>

            <!-- Form Edit Profil -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST">
                                <div class="mb-3">
                                    <label class="form-label">Judul</label>
                                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($profil['judul']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="6" required><?= htmlspecialchars($profil['deskripsi']) ?></textarea>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('footer.php'); ?>
