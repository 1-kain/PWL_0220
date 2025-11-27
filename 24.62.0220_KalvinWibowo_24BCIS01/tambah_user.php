<?php
session_start();
include 'koneksi.php';

if ($_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}
if ($_SESSION['level'] != 'manager') {
    echo "<script>alert('Akses Ditolak!'); window.location='index.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola User (Manager)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4 bg-light">
    <div class="container" style="max-width: 800px;">
        
        <div class="card shadow mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Tambah User Baru</h5>
            </div>
            <div class="card-body">
                <form action="proses_tambah_user.php" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_user" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Level Akses</label>
                            <select name="level" class="form-select" required>
                                <option value="staff">Staff</option>
                                <option value="manager">Manager</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Simpan User</button>
                </form>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar User Terdaftar</h5>
                <a href="index.php" class="btn btn-light btn-sm">Kembali ke Dashboard</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $query = mysqli_query($koneksi, "SELECT * FROM tb_user ORDER BY level ASC");
                        while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row['nama_user']; ?></td>
                            <td><?= $row['username']; ?></td>
                            <td>
                                <span class="badge bg-<?= ($row['level'] == 'manager') ? 'primary' : 'info'; ?>">
                                    <?= $row['level']; ?>
                                </span>
                            </td>
                            <td>
                                <?php if($row['id_user'] != $_SESSION['id_user']) { ?>
                                    <a href="proses_hapus_user.php?id=<?= $row['id_user']; ?>" 
                                       class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Yakin hapus user ini? PERINGATAN: User ini tidak akan bisa menggunakan website ini setelah di hapus.')">
                                       Hapus
                                    </a>
                                <?php } else { ?>
                                    <span class="text-muted small">Akun Saya</span>
                                <?php } ?>
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