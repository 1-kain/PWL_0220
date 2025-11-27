<?php
include 'koneksi.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM tb_gudang WHERE id_barang='$id'");
header("location:index.php");
?>