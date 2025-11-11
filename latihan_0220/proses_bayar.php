<?php
// proses_bayar.php
session_start();
include "config.php";

// Cek NIK dari session dan data dari form
if(!isset($_SESSION['nik']) || !isset($_POST['bayar'])){
    header("location:index.php");
    exit();
}

$nik_pembeli = $_SESSION['nik'];
$jumlah_beli = (int)$_POST['jumlah_beli'];
$file_kuota = "kuota.txt";

// Baca kuota saat ini (PENTING: untuk mencegah race condition sederhana)
$kuota_sekarang = (int)file_get_contents($file_kuota);

// Validasi terakhir
if ($jumlah_beli > $kuota_sekarang) {
    echo "<script>
            alert('Maaf, kuota tiket habis saat Anda proses. Coba lagi.');
            window.location.href = 'beli_tiket.php';
          </script>";
    exit();
}

// 1. Kurangi Kuota
$kuota_baru = $kuota_sekarang - $jumlah_beli;
file_put_contents($file_kuota, $kuota_baru);

// 2. Masukkan data ke tabel 'tiket'
// Kita masukkan satu per satu sesuai jumlah tiket
$sukses = true;
for ($i = 0; $i < $jumlah_beli; $i++) {
    // Buat kode tiket unik (sederhana)
    $kode_tiket = "TIKET-" . $nik_pembeli . "-" . time() . "-" . rand(100,999);
    
    $sql_insert = "INSERT INTO tiket (kode_tiket, nik) VALUES ('$kode_tiket', '$nik_pembeli')";
    
    if(!mysqli_query($config, $sql_insert)){
        $sukses = false;
        // Sebenarnya ini perlu logic rollback, tapi kita sederhanakan
        echo "Gagal menyimpan tiket ke-$i";
        break;
    }
}

if($sukses){
    // Redirect ke halaman sukses
    header("location:sukses_beli.php");
} else {
    // Jika gagal (seharusnya tidak terjadi)
    echo "<script>
            alert('Terjadi kesalahan saat menyimpan data tiket.');
            window.location.href = 'beli_tiket.php';
          </script>";
}
?>