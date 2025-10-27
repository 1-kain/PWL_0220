<?php
$harga_satuan = '';
$jumlah_barang = '';
$is_member = false;
$hasil_perhitungan = null; 
function hitungTotalPembayaran($harga, $jumlah, $member) {
    $total_pembelian = $harga * $jumlah;
    $diskon_persen = 0;
    if ($member && $total_pembelian > 100000) {
        $diskon_persen = 20;
    } else if ($member) {
        $diskon_persen = 10;
    } else if ($total_pembelian > 100000) {
        $diskon_persen = 10;
    }
    $diskon_nominal = ($diskon_persen / 100) * $total_pembelian;    
    $total_bayar = $total_pembelian - $diskon_nominal;
    return [
        'total_pembelian' => $total_pembelian,
        'diskon' => $diskon_nominal,
        'total_bayar' => $total_bayar
    ];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $harga_satuan = (int)$_POST['harga_satuan'];
    $jumlah_barang = (int)$_POST['jumlah_barang'];
    $is_member = isset($_POST['member']); 
    $hasil_perhitungan = hitungTotalPembayaran($harga_satuan, $jumlah_barang, $is_member);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Diskon</title>
    <link rel="stylesheet" href="belanja_css.css">
</head>
<body>
    <div class="container">
        <h1>Hitung Diskon</h1>
        
        <form action="belanja.php" method="POST">
            <div class="form-group">
                <label for="harga_satuan">Harga Satuan</label>
                <input type="number" id="harga_satuan" name="harga_satuan" value="<?php echo htmlspecialchars($harga_satuan); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="jumlah_barang">Jumlah Barang</label>
                <input type="number" id="jumlah_barang" name="jumlah_barang" value="<?php echo htmlspecialchars($jumlah_barang); ?>" required>
            </div>
            
            <div class="form-group-check">
                <label for="member">Member</label>
                <input type="checkbox" id="member" name="member" value="yes" <?php if ($is_member) echo 'checked'; ?>>
                <span>Yes</span>
            </div>
            
            <div class="form-buttons">
                <button type="submit">submit</button>
                <button type="reset">batal</button>
            </div>
        </form>
        <?php if ($hasil_perhitungan !== null): ?>
            <div class="hasil">
                <h2>Total Pembayaran adalah</h2>
                <p>
                    <span>Harga Satuan</span>: <?php echo htmlspecialchars($harga_satuan); ?>
                </p>
                <p>
                    <span>Jumlah Barang</span>: <?php echo htmlspecialchars($jumlah_barang); ?>
                </p>
                <p>
                    <span>Member</span>: <?php echo $is_member ? 'yes' : 'no'; ?>
                </p>
                <p>
                    <span>Total Pembelian</span>: <?php echo $hasil_perhitungan['total_pembelian']; ?>
                </p>
                <p>
                    <span>Diskon</span>: <?php echo $hasil_perhitungan['diskon']; ?>
                </p>
                <p>
                    <span>Total Bayar</span>: <?php echo $hasil_perhitungan['total_bayar']; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>