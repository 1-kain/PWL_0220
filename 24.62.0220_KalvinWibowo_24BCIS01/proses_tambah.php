<?php
session_start();
include 'koneksi.php';

$nama = $_POST['nama_barang'];
$desc = $_POST['deskripsi'];
$stok = $_POST['stok'];
$kondisi = $_POST['kondisi'];
$tgl = $_POST['tgl_masuk'];
$id_user = $_SESSION['id_user'];


$rand = rand();
$filename = $_FILES['foto']['name'];
$ukuran = $_FILES['foto']['size'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array($ext,['png','jpg','jpeg'])){
    echo "<script>alert('File harus gambar!'); window.history.back();</script>";
}else{
    $xx = $rand.'_'.$filename;
    move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/'.$xx);

    
    mysqli_query($koneksi, "INSERT INTO tb_gudang VALUES(NULL,'$nama','$desc','$stok','$kondisi','$tgl','$xx','$id_user')");
    
    header("location:index.php?pesan=berhasil");
}
?>