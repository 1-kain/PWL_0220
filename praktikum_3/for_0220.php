<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengulangan For</title>
</head>
<body>
    <?php
    for($r=1;$r<=10;$r++)
    {
        for($s=1;$s<$r;$s++){
            echo "$s";
        }
        echo "<br>";
    }
    ?>
</body>
</html>