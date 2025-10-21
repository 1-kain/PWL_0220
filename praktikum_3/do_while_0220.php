<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struktur perulangan dengan do while</title>
</head>
<body>
    <?php
    $i = 1;
    do{
        echo "Ini juga pengulangan ke-$i<br>";
        $i++;
    }
    while($i<=8);

    echo "<br>";
    echo "<hr>";
    $j=5;
    do{
        echo "<br>Perulangan ini kondisinya tidak terpenuhi<br>";
        $j++;
    }while($j<=3);
    ?>
</body>
</html>