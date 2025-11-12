<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_event = $_POST['id_event'];
    $nama_pembeli = mysqli_real_escape_string($config, $_POST['nama_pembeli']);
    $email_pembeli = mysqli_real_escape_string($config, $_POST['email_pembeli']);
    $total_tiket = (int)$_POST['total_tiket']; 

    $sql_check = "SELECT kuota FROM events WHERE id_event = '$id_event'";
    $result_check = mysqli_query($config, $sql_check);
    $data_event = mysqli_fetch_assoc($result_check);
    $kuota_saat_ini = $data_event['kuota'];

    if ($kuota_saat_ini > 0) {
        
        
        $sql_update = "UPDATE events SET kuota = kuota - 1 WHERE id_event = '$id_event'";
        mysqli_query($config, $sql_update);
        
        $kode_tiket = "TIX-" . time() . rand(100, 999);
        
        $sql_insert = "INSERT INTO pembelian (event_id, nama_pembeli, email_pembeli, kode_tiket, total_tiket)
                       VALUES ('$id_event', '$nama_pembeli', '$email_pembeli', '$kode_tiket', '$total_tiket')";
        mysqli_query($config, $sql_insert);
        
        echo "<h1>Pembelian Berhasil!</h1>";
        echo "<p>Selamat, pembelian tiket Anda berhasil!</p>";
        echo "<p>Kode tiket Anda adalah: <strong>" . $kode_tiket . "</strong></p>";
        echo '<a href="index.php">Kembali ke Daftar Event</a>';

    } else {
        echo "<h1>Pembelian Gagal!</h1>";
        echo "<p>Mohon maaf, tiket untuk event ini sudah habis terjual.</p>";
        
        echo '<a href="index.php">Kembali ke Daftar Event</a>';
    }

} else {
    header("Location: index.php");
    exit;
}
?>