<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Biodata</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            line-height: 1.8; 
        }
        h2 {
            text-align: center;
            color: #007bff;
        }
        .result-item {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Hasilnya:</h2>
        <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
               
                $nama = htmlspecialchars($_POST['nama']);
                $email = htmlspecialchars($_POST['email']);
                $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin']);
                $nim = htmlspecialchars($_POST['nim']);
                $tanggal_lahir_str = $_POST['tanggal_lahir'];
                $prodi = htmlspecialchars($_POST['prodi']);

                
                $tgl_lahir_obj = new DateTime($tanggal_lahir_str);
                $hari_ini = new DateTime('today');
                $umur = $hari_ini->diff($tgl_lahir_obj)->y;

                
                $tanggal_lahir_formatted = date('d-m-Y', strtotime($tanggal_lahir_str));

                
                echo "<div class='result-item'>Hallo, <strong>" . $nama . "</strong></div>";
                echo "<div class='result-item'>Email anda adalah <strong>" . $email . "</strong></div>";
                echo "<div class='result-item'>Anda <strong>" . $jenis_kelamin . "</strong></div>";
                echo "<div class='result-item'>NIM anda yaitu <strong>" . $nim . "</strong></div>";
                echo "<div class='result-item'>Tanggal Lahir anda <strong>" . $tanggal_lahir_formatted . "</strong></div>";
                echo "<div class='result-item'>Prodi anda <strong>" . $prodi . "</strong></div>";
                echo "<div class='result-item'>Usia anda saat ini adalah <strong>" . $umur . " tahun</strong></div>";
            } else {
                echo "<p>Silakan isi formulir terlebih dahulu.</p>";
            }
        ?>
    </div>
</body>
</html>