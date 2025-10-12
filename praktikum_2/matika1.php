<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        h2 {
            font-size: 30px;
            text-align: center;
            color: #28a745; 
            margin-bottom: 20px;
        }
        .intro {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }
        .result-table {
            width: 100%;
            border-collapse: collapse; 
            margin-top: 20px;
        }
        .result-table td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }
        .result-table tr:last-child td {
            border-bottom: none; 
        }
        .operator {
            font-weight: bold;
            color: #007bff; 
            width: 40%;
        }
        .judul{
            font-size: 22px;
            font-weight: bold;
            text-align: left;
        }
        .hasil {
            font-weight: bold;
            text-align: right;
        }
        .result{
            font-size: 22px;
            font-weight: bold;
            text-align: right;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 30px;
            text-decoration: none;
            color: #ff0000ff;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📊 Hasil Perhitungan</h2>
        <?php
    
        $angka1 = $_POST['angka1'];
        $angka2 = $_POST['angka2'];

        
        $penjumlahan = $angka1 + $angka2;
        $pengurangan = $angka1 - $angka2;
        $perkalian = $angka1 * $angka2;
        $pembagian = $angka1 / $angka2;
        $modulus = $angka1 % $angka2;
        
        
        echo "<table class='result-table'>";

                echo "<tr><td class='judul'>Proses Aritmatika</td><td class='result'>Hasil</td></tr>";
                echo "<tr><td class='operator'>$angka1 + $angka2</td><td class='hasil'> $penjumlahan</td></tr>";
                echo "<tr><td class='operator'>$angka1 - $angka2</td><td class='hasil'> $pengurangan</td></tr>";
                echo "<tr><td class='operator'>$angka1 x $angka2</td><td class='hasil'> $perkalian</td></tr>";
                echo "<tr><td class='operator'>$angka1 ÷ $angka2</td><td class='hasil'> $pembagian</td></tr>";
                echo "<tr><td class='operator'>$angka1 % $angka2</td><td class='hasil'> $modulus</td></tr>";
                echo "</table>";
    
?>
        <a href="form_aritmatika.php" class="back-link">Kembali ke Kalkulator</a>
    </div>
</body>
</html>