<?php
$user=$_POST['user'];
$pass=$_POST['pass'];

if($user =="" or $pass==""){
    $pesan="User dam Password Kosong";
}elseif($user != "kalvin"){
    $pesan="User tidak terdaftar";
}elseif($user == "" and $pass !="1234"){
    $pesan="Password anda SALAH";
}else{
    $pesan="Login Sukses! Selamat Datang $user";
}

echo "<center><b>$pesan</b></center>";
echo "<center><a href='login.php'>Back</a></center>";
?>