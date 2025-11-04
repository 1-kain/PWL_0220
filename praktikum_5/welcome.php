<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if(isset($_SESSION['username'])){ ?>
            <h2>Control Panel</h2>
            <p class="welcome-message">
                Selamat Datang, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>!
            </p>
            <p>
                <a href="logout.php">Logout</a>
            </p>
        <?php } else { ?>
            <h2>Akses Ditolak</h2>
            <p class="error-message">
                Anda tidak berhak mengakses halaman ini.
            </p>
            <p>
                Silakan <a href="login.php">Login</a> terlebih dahulu.
            </p>
        <?php } ?>
    </div>
</body>
</html>