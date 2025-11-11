<?php
// index.php
session_start();
session_destroy(); // Hapus session lama jika ada, agar mulai dari awal
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pengisian Data Diri Pembeli</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Silakan Isi Data Diri Anda</h3>
    
    <?php
    // Tampilkan pesan error jika ada
    if(isset($_GET['error'])){
        echo '<p class="error">'.$_GET['error'].'</p>';
    }
    // Tampilkan pesan sukses jika NIK sudah ada
    if(isset($_GET['info'])){
        echo '<p class="success">'.$_GET['info'].'</p>';
    }
    ?>

    <form method="POST" action="cek_pembeli.php">
        <table>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><input type="text" name="nik" required></td>
            </tr>
            <tr>
                <td>Nama Lengkap</td>
                <td>:</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Umur</td>
                <td>:</td>
                <td><input type="number" name="umur" required></td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>:</td>
                <td><input type="text" name="no_hp" required></td>
            </tr>
            <tr>
                <td colspan="3">
                    <input type="submit" name="lanjut" value="Lanjut ke Pembelian">
                </td>
            </tr>
        </table>
    </form>
</body>
</html>