<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perulangan Array</title>
</head>
<body>
    <h2>Latihan Membuat Array</2>

    <?php
    //Membuat Array Berindeks
    $kategoribuku[0] = "Pemograman Web";
    $kategoribuku[1] = "Database";
    $kategoribuku[2] = "Desain Grafis";
    $kategoribuku[3] = "Internet";
    $kategoribuku[4] = "Office Application";
    $kategoribuku[5] = "Office Application";

    //membuat Array Asosiatif
    $buku = array("isbn" => "979-96446-9-2",
                    "judul" => "Modul Pemograman Web Lanjut",
                    "pengarang" => "Kartika Dewi Arum",
                    "penerbit" => "ANDI OFFSET" );

    //mengakses Array Berindeks Menggunakan for
    echo "<strong>Daftar Kategori Buku: </strong><br>";
    for($i = 0;$i<sizeof($kategoribuku);$i++){
        echo "Nama Buku $i:".$kategoribuku[$i]."<br>";
    }
    echo "<br>";
    //mengakses Array Asosiatif Menggunakan foreach
    echo "<strong>Contoh Buku: </strong><br>";
    foreach ($buku as $kunci => $nilai){
        echo "$kunci : $nilai". "<br>";
    }
    ?>
</body>
</html>