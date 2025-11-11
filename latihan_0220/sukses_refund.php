<?php
// sukses_refund.php
session_start();
// Ambil data dari session
if(!isset($_SESSION['total_refund'])){
    header("location:beli_tiket.php");
    exit();
}

$total_kembali = $_SESSION['total_refund'];
$jumlah_tiket = $_SESSION['jumlah_tiket_refund'];

// Hapus session agar tidak tampil lagi jika di-refresh
unset($_SESSION['total_refund']);
unset($_SESSION['jumlah_tiket_refund']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Refund Berhasil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3 class="success">PROSES REFUND BERHASIL!</h3>
    <p>Sebanyak <strong><?php echo $jumlah_tiket; ?> tiket</strong> telah berhasil di-refund.</p>
    <p>Total nominal yang dikembalikan (100%): <strong>Rp <?php echo number_format($total_kembali); ?></strong></p>
    <br>
    <a href="beli_tiket.php">Kembali ke Halaman Pembelian</a>
    <br>
    <a href="index.php">Selesai (Kembali ke Awal)</a>
</body>
</html>