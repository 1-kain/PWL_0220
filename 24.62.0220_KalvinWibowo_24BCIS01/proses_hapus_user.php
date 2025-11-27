<?php
session_start();
include 'koneksi.php';

if ($_SESSION['status'] != "login" || $_SESSION['level'] != 'manager') {
    header("location:index.php");
    exit;
}

$id_hapus = $_GET['id'];
$id_saya  = $_SESSION['id_user'];

if ($id_hapus == $id_saya) {
    echo "<script>alert('Anda tidak bisa menghapus akun sendiri!'); window.location='tambah_user.php';</script>";
    exit;
}

$query = "DELETE FROM tb_user WHERE id_user = '$id_hapus'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('User berhasil dihapus.'); window.location='tambah_user.php';</script>";
} else {
    echo "Gagal menghapus: " . mysqli_error($koneksi);
}
?>