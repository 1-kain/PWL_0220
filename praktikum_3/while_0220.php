<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>While</title>
</head>
<body>
    <?php
    $i = 1;

    while($i <=10)
    {
        echo "ini perulangan ke-$i <br/>";
        $i++;
    }
    echo "<br>";
    echo "<br>";
    echo "<br>";
    $x=50;
    while($x >=0){
        echo "Urutan ke-$x <br/>";
        $x-=5;
    }
    ?>
</body>
</html>