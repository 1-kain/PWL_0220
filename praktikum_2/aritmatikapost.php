<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aritmatika 0220</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaeff4ff; 
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 100vh; */
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
        }
        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            box-sizing: border-box;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        input[type="text"]:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #80bdff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }
        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #28a745; 
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>🔢 Kalkulator Sangat Sederhana</h2>
        <form action="matika1.php" method="POST">
            <div class="form-group">
                <label for="angka1">Angka Pertama:</label>
                <input type="number" id="angka1" name="angka1" placeholder="Masukkan angka pertama" required>
            </div>
            <div class="form-group">
                <label for="angka2">Angka Kedua:</label>
                <input type="number" id="angka2" name="angka2" placeholder="Masukkan angka kedua" required>
            </div>
            <button type="submit">Hitung Sekarang</button>
        </form>
    </div>
</body>
</html>