<?php
$harga_satuan = 0;
$jumlah_barang = 0;
$is_member = false;
$total_pembelian = 0;
$diskon = 0;
$total_bayar = 0;
$member_status_text = "no";
$tampilkan_hasil = false; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $harga_satuan = (int)$_POST['harga_satuan'];
    $jumlah_barang = (int)$_POST['jumlah_barang'];

    if (isset($_POST['member'])) {
        $is_member = true;
        $member_status_text = "yes";
    } else {
        $is_member = false;
        $member_status_text = "no";
    }
    $total_pembelian = $harga_satuan * $jumlah_barang;
    $diskon_persen = 0;

    if ($is_member && $total_pembelian > 100000) {
        $diskon_persen = 0.20;
    } else if ($is_member && $total_pembelian <= 100000) {
        $diskon_persen = 0.10;
    } else if (!$is_member && $total_pembelian > 100000) {
        $diskon_persen = 0.10;
    } else {
        $diskon_persen = 0;
    }
    $diskon = $total_pembelian * $diskon_persen;
    $total_bayar = $total_pembelian - $diskon;
    $tampilkan_hasil = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Diskon</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f4f7f6; 
            margin: 0;
            padding: 20px;
            display: flex; 
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }
        .container {
            max-width: 400px;
            width: 100%;
        }
        .card {
            background-color: #ffffff; 
            border-radius: 12px; 
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); 
            padding: 25px;
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block; 
            margin-bottom: 5px;
            font-weight: 600; 
            color: #555;
        }
        input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box; 
            font-size: 1em;
        }
        input[type="number"]:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0,123,255,0.3);
            outline: none;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px; 
        }
        .checkbox-group label {
            margin-bottom: 0; 
            font-weight: normal;
            cursor: pointer;
        }
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        .button-group {
            display: flex;
            gap: 10px; 
            margin-top: 20px;
        }
        button {
            flex: 1; 
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: white;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        button[type="reset"] {
            background-color: #e0e0e0;
            color: #333;
        }
        button[type="reset"]:hover {
            background-color: #c7c7c7;
        }
        .output h3 {
            color: #007bff;
            margin-top: 0;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }
        pre {
            background-color: #f9f9f9; 
            border: 1px solid #eee;
            border-radius: 8px;
            padding: 15px;
            font-family: 'Consolas', 'Menlo', monospace; 
            font-size: 1.1em;
            line-height: 1.7;
            color: #333;
            overflow-x: auto;
        }
    </style>
</head>
<body>

    <div class="container">
        
        <form action="" method="POST" class="card">
            <h2>Hitung Diskon</h2>
            
            <div class="form-group">
                <label for="harga">Harga Satuan</label>
                <input type="number" id="harga" name="harga_satuan" required>
            </div>
            
            <div class="form-group">
                <label for="jumlah">Jumlah Barang</label>
                <input type="number" id="jumlah" name="jumlah_barang" required>
            </div>
            
            <div class="form-group checkbox-group">
                <input type="checkbox" id="member" name="member" value="yes">
                <label for="member">Member</label> </div>
            
            <div class="button-group">
                <button type="submit">Submit</button>
                <button type="reset">Batal</button>
            </div>
        </form>

        <?php if ($tampilkan_hasil): ?>
            <div class="card output">
                <h3>Total Pembayaran adalah</h3>
                
                <pre>
Harga Satuan     : <?php echo $harga_satuan; ?><br>
Jumlah Barang    : <?php echo $jumlah_barang; ?><br>
Member           : <?php echo $member_status_text; ?><br>
Total Pembelian  : <?php echo $total_pembelian; ?><br>
Diskon           : <?php echo $diskon; ?><br>
Total Bayar      : <?php echo $total_bayar; ?>
                </pre>
            </div>
        <?php endif; ?>
        
    </div> </body>
</html>