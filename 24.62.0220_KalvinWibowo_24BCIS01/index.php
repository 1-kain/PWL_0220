<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("location:login.php");
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Storage Manager</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Storage Manager</a>
    <div class="d-flex text-white align-items-center">
        <span class="me-3">Halo, <b><?= $_SESSION['nama_user'] ?></b> (<?= $_SESSION['level'] ?>)</span>
        <a href="logout.php" class="btn btn-danger btn-sm">Logout</a> 
        </div>
  </div>
</nav>

<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between">
            <h5>Data Gudang</h5>
            <div>
                <a href="tambah.php" class="btn btn-success btn-sm">+ Tambah Barang</a>
                
                <?php if($_SESSION['level'] == 'manager'){ ?>
                    <a href="tambah_user.php" class="btn btn-warning btn-sm">+ Tambah User</a>
                <?php } ?>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Kondisi</th>
                        <th>Tgl Masuk</th>
                        <th>Diinput Oleh</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM tb_gudang LEFT JOIN tb_user ON tb_gudang.id_user = tb_user.id_user ORDER BY id_barang DESC");
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <img src="gambar/<?= $row['foto_barang']; ?>" width="80" height="80" style="object-fit:cover;">
                        </td>
                        <td>
                            <b><?= $row['nama_barang']; ?></b><br>
                            <small class="text-muted"><?= $row['deskripsi']; ?></small>
                        </td>
                        <td><?= $row['stok']; ?></td>
                        <td>
                            <span class="badge bg-<?= ($row['kondisi_barang'] == 'Baru') ? 'primary' : 'secondary'; ?>">
                                <?= $row['kondisi_barang']; ?>
                            </span>
                        </td>
                        <td><?= $row['tanggal_masuk']; ?></td>
                        <td>
                            <?php 
                            if ($row['nama_user'] == NULL) {
                                echo "<span class='text-danger fst-italic'>(User Dihapus)</span>";
                            } else {
                                echo $row['nama_user'];
                            }
                            ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $row['id_barang']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="hapus.php?id=<?= $row['id_barang']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>