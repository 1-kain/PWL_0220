<?php
$tanggal_lahir_input = '';
$bilangan = 0;
$usia_saat_ini = 0;
$tampilkan_hasil = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tanggal_lahir_input = $_POST['tanggal_lahir'];
    $bilangan = (int)$_POST['bilangan'];
    $tgl_lahir_obj = new DateTime($tanggal_lahir_input);
    $hari_ini_obj = new DateTime('now');
    $selisih = $hari_ini_obj->diff($tgl_lahir_obj);
    $usia_saat_ini = $selisih->y;
    $tampilkan_hasil = true;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas Struktur Kendali</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        form, .output { border: 1px solid #ccc; padding: 15px; border-radius: 8px; width: 350px; }
        div { margin-bottom: 10px; }
        label { display: inline-block; width: 120px; }
        .output h3 { margin-top: 0; }
        .output p { margin: 5px 0; }
    </style>
</head>
<body>

    <h2>Tugas Struktur Kendali Perulangan</h2>

    <form action="" method="POST">
        <div>
            <label for="tanggal">Tanggal Lahir</label>
            <input type="date" id="tanggal" name="tanggal_lahir" required>
        </div>
        <div>
            <label for="bilangan">Bilangan</label>
            <input type="number" id="bilangan" name="bilangan" required>
        </div>
        <div>
            <button type="submit">Submit</button>
        </div>
    </form>

    <?php if ($tampilkan_hasil): ?>
        <div class="output" style="margin-top: 20px;">
            <h3>Hasil Perhitungan</h3>
            
            <p>Usia saat ini adalah: <?php echo $usia_saat_ini; ?> Tahun</p>
            <p>Bilangan yang diinputkan adalah <?php echo $bilangan; ?></p>
            
            <p style="margin-top: 15px;">Usia saya selanjutnya adalah</p>
            
            <?php
            for ($i = 1; $i <= $bilangan; $i++) {
                $usia_selanjutnya = $usia_saat_ini + $i;
                echo $usia_selanjutnya . " Tahun<br>";
            }
            ?>
        </div>
    <?php endif; ?>

</body>
</html>