<?php
if(!isset($_GET['id_event'])|| empty($_GET['id_event'])){
    header("Location: index.php");
    exit;
}
$id_event = $_GET['id_event'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Pembelian TIket</h3>
    <form action = "proses.php" method="POST">
        <input type="hidden" name="id_event" value="<?php echo htmlspecialchars($id_event); ?>">
        
        <div>
            <label for="nama">Nama Lengkap:</label> 
            <input type="text" id="nama" name="nama_pembeli" required>
        </div>
        <div>
            <label for="email">Alamat Email:</label> 
            <input type="email" id="email" name="email_pembeli" required>
        </div>
        <div>
            <label for="total">Total Tiket:</label>
            <input type="number" id="total" name="total_tiket" value="1" min="1" required>
        </div>
        <div>
            <button type="submit">Beli Sekarang</button>
        </div>
    </form>
</body>
</html>