<?php
session_start();
include 'koneksi.php';

if ($_SESSION['level'] != 'manager') {
    header("location:index.php");
    exit;
}
$nama     = $_POST['nama_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$level    = $_POST['level'];

$cek_user = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username = '$username'");
if (mysqli_num_rows($cek_user) > 0) {
    echo "<script>alert('Username sudah digunakan! Ganti yang lain.'); window.history.back();</script>";
} else {
    $query = "INSERT INTO tb_user (username, password, nama_user, level) VALUES ('$username', '$password', '$nama', '$level')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('User berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>