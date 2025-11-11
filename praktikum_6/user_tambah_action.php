<?php
include "config.php";
$user = $_POST['username'];
$pass = $_POST['password'];
$nama = $_POST['namalengkap'];
$email = $_POST['email'];

$sql = "Insert Into user (user_nama,user_password,user_namalengkap,user_email)
values ('$user', '$pass','$nama','$email');";

$hasil = mysqli_query($config, $sql);
if($hasil){
    echo "Data berhasil di tamabhkan";
}else{
    echo "Data gagal disimpan";
}
?>
<br>kembali ke<a href="halamanuser.php"> halaman user</a>