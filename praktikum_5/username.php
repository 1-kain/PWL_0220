<?php
include "config.php";
$sql = "Select*from user";
$query = mysqli_query($config,$sql);
$row = mysqli_fetch_assoc($query);

echo "<pre>";
print_r($row);
echo "<pre>";

echo "Username : ".$row['user_nama']."<br />";
echo "Nama Lengkap :".$row['user_namalengkap']."<br />";
echo "Email :".$row['user_email']."<br />";
?>

<?php
include "config.php";
$sql = "Select*from user";
$query = mysqli_query($config,$sql);

echo"<pre>";
while($row = mysqli_fetch_assoc($query)){
    print_r($row);
}
echo"<pre>";
?>