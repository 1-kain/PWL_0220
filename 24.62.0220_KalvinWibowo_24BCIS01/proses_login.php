<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];


$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
if (!$query) {
    die("Query Error: " . mysqli_error($koneksi));
}

$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);
    

    $_SESSION['username'] = $username;
    $_SESSION['nama_user'] = $data['nama_user'];
    $_SESSION['level'] = $data['level'];
    $_SESSION['id_user'] = $data['id_user'];
    $_SESSION['status'] = "login";

    header("location:index.php");
} else {
    echo "<script>alert('Login Gagal! Username/Password salah.'); window.location='login.php';</script>";
}
?>