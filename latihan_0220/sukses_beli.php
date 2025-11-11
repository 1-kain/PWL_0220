<?php
// sukses_beli.php
session_start();
if(!isset($_SESSION['nik'])){
    header("location:index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembelian Berhasil</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3 class="success">PEMBELIAN BERHASIL!</h3>
    <p>Terima kasih telah melakukan pembelian tiket.</p>
    <br>
    <a href="beli_tiket.php">Kembali ke Halaman Pembelian</a>
    <br>
    <a href="index.php">Selesai (Kembali ke Awal)</a>
</body>
</html>