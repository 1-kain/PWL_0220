<?php
$config = mysqli_connect("localhost","root","","dataweb0220");
if(!$config){
    die('Gagal terhubung ke MySQLi : '.mysqli_connect_error());
}
?>