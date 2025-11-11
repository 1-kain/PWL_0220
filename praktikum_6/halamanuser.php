<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data User</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <body>
<h3>Data User</h3>
<p><a href="user_tambah.php"> +Tambah User</a></p>
<table>
<tr>
<th width="30"> No. </th>
<th width="30"> Username </th>
<th width="30"> Password </th>
<th width="30"> Nama Lengkap </th>
<th width="30"> E-Mail </th>
<th width="150"> Kelola </th>
</tr>
<?php
include "config.php";
$sql = "SELECT user_nama, user_password, user_namalengkap,
user_email FROM user ORDER BY user_namalengkap";
$hasil = mysqli_query($config, $sql);
$no = 1;
while ($data = mysqli_fetch_array($hasil)){
?>
<tr>
<td><?php echo $no ; ?></td>
<td><?php echo $data['user_nama'] ; ?></td>
<td><?php echo $data['user_password'] ; ?></td>
<td><?php echo $data['user_namalengkap'] ; ?></td>
<td><?php echo $data['user_email'] ; ?></td>
<td align = "center">
    <a href="user_edit.php?user_nama=<?php echo $data['user_nama'];?>">Edit</a>
    <a href="user_hapus.php?user_nama=<?php echo $data['user_nama'];?>">Hapus</a>
</td>
</tr>
<?php
$no++;
}
echo "</table>";
?>
</body>
</html>