<?php
session_start();
if ($_SESSION['status'] != "login") header("location:login.php");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container" style="max-width: 600px;">
        <h3>Tambah Barang Baru</h3>
        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label>Nama Barang (Text)</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Deskripsi (Text Area)</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Kondisi (Radio Button)</label><br>
                <input type="radio" name="kondisi" value="Baru" required> Baru
                <input type="radio" name="kondisi" value="Bekas" required> Bekas
            </div>

            <div class="mb-3">
                <label>Tanggal Masuk (Date)</label>
                <input type="date" name="tgl_masuk" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Foto Barang (File Upload)</label>
                <input type="file" name="foto" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Simpan Data</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>