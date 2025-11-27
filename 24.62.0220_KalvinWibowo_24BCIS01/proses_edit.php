<?php
include 'koneksi.php';

$id = $_POST['id_barang'];
$nama = $_POST['nama_barang'];
$desc = $_POST['deskripsi'];
$stok = $_POST['stok'];
$kondisi = $_POST['kondisi'];
$tgl = $_POST['tgl_masuk'];

if ($_FILES['foto']['name'] != "") {
    
    $rand = rand();
    $filename = $_FILES['foto']['name'];
    $ukuran = $_FILES['foto']['size'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
    if (!in_array($ext, ['png','jpg','jpeg'])) {
        echo "<script>alert('Format file tidak valid!'); window.history.back();</script>";
        exit;
    }
    $nama_file_baru = $rand.'_'.$filename;
    move_uploaded_file($_FILES['foto']['tmp_name'], 'gambar/'.$nama_file_baru);

    $query = "UPDATE tb_gudang SET 
              nama_barang='$nama', 
              deskripsi='$desc', 
              stok='$stok', 
              kondisi_barang='$kondisi', 
              tanggal_masuk='$tgl', 
              foto_barang='$nama_file_baru' 
              WHERE id_barang='$id'";
              
} else {
    $query = "UPDATE tb_gudang SET 
              nama_barang='$nama', 
              deskripsi='$desc', 
              stok='$stok', 
              kondisi_barang='$kondisi', 
              tanggal_masuk='$tgl' 
              WHERE id_barang='$id'";
}

if (mysqli_query($koneksi, $query)) {
    header("location:index.php");
} else {
    echo "Gagal update: " . mysqli_error($koneksi);
}
?>