<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Dinamis Aritmatika</title>
</head>
<body>
    <form action="aritmatika.php" method="GET">
        Masukkan Angka Pertama (1-10) : <input type = "number" name="angka1"> <br>
        Masukkan Angka Kedua (1-10) : <input type = "number" name="angka2"> <br>
        <input type= "submit" name="submit" value="sent">
</body>
<?php
if(isset($_GET['submit'])){
    $angka1 = $_GET ["angka1"];
    $angka2 = $_GET ["angka2"];
    $penjumlahan=$angka1+$angka2;
    $pengurangan=$angka1-$angka2;
    $perkalian=$angka1*$angka2;

    echo"<br>";
   echo"Hasil penjumlahan Anda adalah :  $penjumlahan";
   echo"<br>";
    echo"Hasil pengurangan Anda adalah :  $pengurangan";
    

}
?>
</html>