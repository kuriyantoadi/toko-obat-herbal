<?php 
$status = strtolower($row['status_pembayaran']);

switch ($status) {
    case 'lunas':
        $badgeClass = 'success';
        $statusText = 'Lunas';
        $statusIcon = 'bi-cash-coin';
        break;

    case 'belum lunas':
        $badgeClass = 'danger';
        $statusText = 'Belum Lunas';
        $statusIcon = 'bi-x-circle';
        break;

    case 'menunggu konfirmasi':
        $badgeClass = 'warning';
        $statusText = 'Menunggu Konfirmasi';
        $statusIcon = 'bi-hourglass-split';
        break;

    case 'ditolak':
        $badgeClass = 'danger';
        $statusText = 'Ditolak';
        $statusIcon = 'bi-slash-circle';
        break;

    case 'dikirim':
        $badgeClass = 'info';
        $statusText = 'Dikirim';
        $statusIcon = 'bi-truck';
        break;

    case 'menunggu ulasan':
        $badgeClass = 'primary';
        $statusText = 'Menunggu Ulasan';
        $statusIcon = 'bi-pencil-square';
        break;

    case 'selesai':
        $badgeClass = 'success';
        $statusText = 'Selesai';
        $statusIcon = 'bi-check-circle';
        break;

    default:
        $badgeClass = 'secondary';
        $statusText = ucfirst($row['status_pembayaran']);
        $statusIcon = 'bi-info-circle';
        break;
}
?>

<!-- OUTPUT STATUS POSISI TENGAH -->
<td class="text-center">
    <span class="badge bg-<?php echo $badgeClass; ?>">
        <i class="bi <?php echo $statusIcon; ?>"></i> <?php echo $statusText; ?>
    </span>
</td>
