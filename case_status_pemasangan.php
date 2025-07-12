 <?php
    switch ($d['status_persetujuan_admin']) {
        case 'Pendataan':
            echo '<span class="badge bg-primary">Pendataan</span>';
            break;
        case 'Di Tolak':
            echo '<span class="badge bg-danger">Di Tolak</span>';
            break;
        case 'Di Setujui':
            echo '<span class="badge bg-info">Disetujui dan Proses Pemasangan</span>';
            break;
        case 'Selesai':
            echo '<span class="badge bg-success">Selesai</span>';
            break;
        default:
            echo '<span class="badge bg-secondary">Tidak Diketahui</span>';
            break;
    }
    ?>