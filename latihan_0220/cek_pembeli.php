<?php
// cek_pembeli.php
include "config.php";
session_start(); // Mulai session

// Ambil data dari form
$nik = $_POST['nik'];
$nama = $_POST['nama'];
$umur = $_POST['umur'];
$no_hp = $_POST['no_hp'];

// Cek apakah semua data terisi
if(empty($nik) || empty($nama) || empty($umur) || empty($no_hp)){
    header("location:index.php?error=Semua data harus diisi!");
    exit();
}

// Cek apakah NIK sudah ada di database
$sql_cek = "SELECT * FROM pembeli WHERE nik = '$nik'";
$hasil_cek = mysqli_query($config, $sql_cek);
$data = mysqli_fetch_assoc($hasil_cek);

if($data){
    // Jika NIK sudah ada, tidak perlu insert, langsung lanjut
    // Simpan NIK ke session
    $_SESSION['nik'] = $data['nik'];
    
    // Kirim info ke index.php lalu redirect ke beli_tiket.php
    echo "<script>
            alert('NIK $nik sudah terdaftar. Anda akan diarahkan ke halaman pembelian.');
            window.location.href = 'beli_tiket.php';
          </script>";
}else{
    // Jika NIK belum ada, insert data baru
    $sql_insert = "INSERT INTO pembeli (nik, nama_lengkap, umur, no_hp) 
                   VALUES ('$nik', '$nama', '$umur', '$no_hp')";
    $hasil_insert = mysqli_query($config, $sql_insert);

    if($hasil_insert){
        // Simpan NIK ke session
        $_SESSION['nik'] = $nik;
        // Langsung redirect ke halaman pembelian
        header("location:beli_tiket.php");
    }else{
        // Gagal menyimpan
        header("location:index.php?error=Gagal menyimpan data pembeli!");
    }
}
?>