<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nilai</title>
</head>
<body>
    <?php 
    echo "<form method = 'POST' action='ifelseif_dinamis_0220.php'>
    <h2>Menghitung Nilai Huruf</h2>
    Masukkan Nilai Anda (10-100) : <input type=text name='nilai'>
    <input type='submit' name='hitung' value='Kirim'>
    </form>";

    if(isset($_POST['hitung']))
    {
        if($_POST['nilai']>=90){
            echo "Nilai $_POST[nilai] Sangat Bagus";
        }
        elseif ($_POST['nilai']>=80){
            echo "Nilai $_POST[nilai] Bagus";
        }
        elseif($_POST['nilai']>=65){
            echo "Nilai $_POST[nilai] Cukup";
        }
        elseif($_POST['nilai']>=50){
            echo "Nilai $_POST[nilai] Kurang";
        }
        else{
            echo "Nilai $_POST[nilai] Kurang Sekali";
        }
    }
    ?>
</body>
</html>