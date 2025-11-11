<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Tambah Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Menambah Data User</h3>
<form method="POST" action="user_tambah_action.php">
<table>
<tr>
<td>Username</td>
<td>:</td>
<td><input type="text" name="username"></td>
</tr>
<tr>
<td>Password</td>
<td>:</td>
<td><input type="Password" name="password"></td>
</tr>
<tr>
<td>Nama Lengkap</td>
<td>:</td>
<td><input type="text" name="namalengkap"></td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><input type="Email" name="email"></td>
</tr>
<tr>
<td colspan=2>
<input type="submit" name="simpan" value="Simpan">
<input type="reset" name="Batal">
</td>
</tr>
</table>
</form>
</body>
</html>