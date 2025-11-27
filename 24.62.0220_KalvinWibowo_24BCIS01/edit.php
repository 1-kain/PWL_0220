<?php
session_start();
include 'koneksi.php';
if ($_SESSION['status'] != "login") header("location:login.php");

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_gudang WHERE id_barang='$id'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
<div class="container" style="max-width: 600px;">
    <h3>Edit Barang</h3>
    <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_barang" value="<?= $data['id_barang']; ?>">
        
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="<?= $data['nama_barang']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3" required><?= $data['deskripsi']; ?></textarea>
        </div>

        <div class="mb-3">
            <label>Stok</label>
            <input type="number" name="stok" class="form-control" value="<?= $data['stok']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Kondisi</label><br>
            <input type="radio" name="kondisi" value="Baru" <?= ($data['kondisi_barang']=='Baru')?'checked':''; ?>> Baru
            <input type="radio" name="kondisi" value="Bekas" <?= ($data['kondisi_barang']=='Bekas')?'checked':''; ?>> Bekas
        </div>
        
        <div class="mb-3">
            <label>Tanggal Masuk</label>
            <input type="date" name="tgl_masuk" class="form-control" value="<?= $data['tanggal_masuk']; ?>" required>
        </div>

        <div class="mb-3">
            <label>Foto Saat Ini</label><br>
            <img src="gambar/<?= $data['foto_barang']; ?>" width="100" class="mb-2 border">
            <br>
            <label>Ganti Foto (Biarkan kosong jika tidak ingin mengganti)</label>
            <input type="file" name="foto" class="form-control">
            <small class="text-muted">Format: JPG, PNG</small>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>