<?php
// proses_refund.php
session_start();
include "config.php";

// Cek NIK dari session
if(!isset($_SESSION['nik'])){
    header("location:index.php");
    exit();
}

$nik_pembeli = $_SESSION['nik'];
$file_kuota = "kuota.txt";
$harga_satuan = 150000; // Pastikan harga sama

// 1. Hitung berapa tiket yang dimiliki NIK ini
$sql_hitung = "SELECT COUNT(*) AS jumlah_tiket FROM tiket WHERE nik = '$nik_pembeli'";
$hasil_hitung = mysqli_query($config, $sql_hitung);
$data_hitung = mysqli_fetch_assoc($hasil_hitung);
$jumlah_tiket_refund = (int)$data_hitung['jumlah_tiket'];

if($jumlah_tiket_refund <= 0){
    // Jika tidak punya tiket
    echo "<script>
            alert('Anda tidak memiliki tiket untuk di-refund.');
            window.location.href = 'beli_tiket.php';
          </script>";
    exit();
}

// 2. Hapus tiket dari database
$sql_delete = "DELETE FROM tiket WHERE nik = '$nik_pembeli'";
$hasil_delete = mysqli_query($config, $sql_delete);

if($hasil_delete){
    // 3. Tambah kuota
    $kuota_sekarang = (int)file_get_contents($file_kuota);
    $kuota_baru = $kuota_sekarang + $jumlah_tiket_refund;
    file_put_contents($file_kuota, $kuota_baru);

    // 4. Hitung total uang kembali dan simpan di session
    $total_kembali = $jumlah_tiket_refund * $harga_satuan;
    $_SESSION['total_refund'] = $total_kembali;
    $_SESSION['jumlah_tiket_refund'] = $jumlah_tiket_refund;

    // Redirect ke halaman sukses refund
    header("location:sukses_refund.php");

} else {
    // Jika gagal hapus
    echo "<script>
            alert('Gagal memproses refund. Silakan coba lagi.');
            window.location.href = 'beli_tiket.php';
          </script>";
}
?>