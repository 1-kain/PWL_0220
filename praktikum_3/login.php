<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Login Sederhana</title>
</head>
<body>
    <form action="proses_login.php" method="POST">
        <center>
            <h2>Masukkan User dan Password Anda</h2>
            <table>
                <tr>
                    <td>Username</td>
                    <td>:</td>
                    <td><input type="text" name="user"></td>
</tr>
<tr>
                    <td>Password</td>
                    <td>:</td>
                    <td><input type="password" name="pass"></td>
</tr>
<tr>
    <td colspan="3"><input type="submit" value ="LOGIN">
    <input type="reset" value="RESET"></td>
</tr>
</table>
</center>
</form>
</body>
</html>