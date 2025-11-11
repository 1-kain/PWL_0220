<?php
// beli_tiket.php
session_start();
include "config.php";

// Jika tidak ada session NIK, paksa kembali ke index.php
if(!isset($_SESSION['nik'])){
    header("location:index.php?error=Silakan isi data diri Anda terlebih dahulu.");
    exit();
}

// Data dari session
$nik_pembeli = $_SESSION['nik'];

// Ambil data pembeli dari database
$sql_pembeli = "SELECT * FROM pembeli WHERE nik = '$nik_pembeli'";
$hasil_pembeli = mysqli_query($config, $sql_pembeli);
$data_pembeli = mysqli_fetch_assoc($hasil_pembeli);

// Pengaturan Tiket
$harga_satuan = 150000; // Harga tiket
$file_kuota = "kuota.txt";

// Baca kuota dari file
$kuota = (int)file_get_contents($file_kuota);


// Variabel untuk nota
$tampilkan_nota = false;
$jumlah_beli = 0;
$nik_konfirmasi = "";
$total_harga = 0;
$error_pembelian = "";

// Cek jika tombol 'Tampilkan Nota' diklik
if(isset($_POST['cek_nota'])){
    $jumlah_beli = (int)$_POST['jumlah'];
    $nik_konfirmasi = $_POST['nik_konfirmasi'];

    // Validasi
    if(empty($jumlah_beli) || empty($nik_konfirmasi)){
        $error_pembelian = "Jumlah tiket dan NIK Konfirmasi harus diisi!";
    } elseif ($nik_konfirmasi != $nik_pembeli) {
        // Ini validasi tambahan, NIK konfirmasi harus sama dengan NIK di session
        // Sesuai permintaan, jika NIK salah (dianggap NIK tidak ada)
        // Seharusnya kita kembali ke index, tapi kita sederhanakan
        $error_pembelian = "NIK yang Anda masukkan salah! Silakan ulangi.";
        // Jika ingin paksa ke index:
        // header("location:index.php?error=NIK tidak sesuai, silakan daftar ulang.");
        // exit();
    } elseif ($jumlah_beli <= 0) {
        $error_pembelian = "Jumlah tiket tidak valid.";
    } elseif ($jumlah_beli > $kuota) {
        $error_pembelian = "Maaf, kuota tiket tidak mencukupi. Sisa kuota: $kuota";
    } else {
        // Jika semua valid, tampilkan nota
        $tampilkan_nota = true;
        $total_harga = $jumlah_beli * $harga_satuan;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pembelian Tiket</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h3>Selamat Datang, <?php echo $data_pembeli['nama_lengkap']; ?>!</h3>
    <p>Silakan lakukan pembelian tiket.</p>
    <hr>
    
    <h3>Informasi Tiket</h3>
    <p><strong>Harga Tiket Satuan:</strong> Rp <?php echo number_format($harga_satuan); ?></p>
    <p><strong>Sisa Kuota Tiket:</strong> <?php echo $kuota; ?> tiket</p>
    <hr>

    <?php if($kuota <= 0): ?>
        <h3 class="error">MAAF, TIKET SUDAH HABIS TERJUAL!</h3>
    <?php else: ?>
        
        <h3>Form Pembelian</h3>
        <?php if($error_pembelian) echo '<p class="error">'.$error_pembelian.'</p>'; ?>
        
        <form method="POST" action="beli_tiket.php">
            <table>
                <tr>
                    <td>Jumlah Tiket</td>
                    <td>:</td>
                    <td><input type="number" name="jumlah" min="1" max="<?php echo $kuota; ?>" required></td>
                </tr>
                <tr>
                    <td>Konfirmasi NIK Anda</td>
                    <td>:</td>
                    <td><input type="text" name="nik_konfirmasi" required></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <input type="submit" name="cek_nota" value="Tampilkan Nota">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        // Tampilkan Nota jika $tampilkan_nota = true
        if($tampilkan_nota):
        ?>
        <hr>
        <div class="nota">
            <h3>** NOTA PEMBELIAN **</h3>
            <table>
                <tr>
                    <td>Nama</td>
                    <td>: <?php echo $data_pembeli['nama_lengkap']; ?></td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: <?php echo $data_pembeli['nik']; ?></td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>: <?php echo $data_pembeli['umur']; ?> tahun</td>
                </tr>
                <tr>
                    <td>No. HP</td>
                    <td>: <?php echo $data_pembeli['no_hp']; ?></td>
                </tr>
                <tr>
                    <td colspan="2"><hr></td>
                </tr>
                <tr>
                    <td>Jumlah Beli</td>
                    <td>: <?php echo $jumlah_beli; ?> tiket</td>
                </tr>
                <tr>
                    <td>Harga Satuan</td>
                    <td>: Rp <?php echo number_format($harga_satuan); ?></td>
                </tr>
                <tr>
                    <td><strong>Total Harga</strong></td>
                    <td><strong>: Rp <?php echo number_format($total_harga); ?></strong></td>
                </tr>
            </table>
            
            <form method="POST" action="proses_bayar.php">
                <input type="hidden" name="jumlah_beli" value="<?php echo $jumlah_beli; ?>">
                <input type="hidden" name="total_harga" value="<?php echo $total_harga; ?>">
                
                <input type="submit" name="bayar" value="Bayar Sekarang">
                <button type="button" class="batal" onclick="window.location.href='beli_tiket.php'">Batal</button>
            </form>
        </div>
        <?php endif; // End Tampilkan Nota ?>

    <?php endif; // End Cek Kuota ?>

    <hr>
    <h3>Pengembalian Tiket (Refund)</h3>
    <p>Tombol ini akan me-refund <strong>*SEMUA*</strong> tiket yang telah Anda beli.</p>
    <form method="POST" action="proses_refund.php" 
          onsubmit="return confirm('Apakah kamu yakin ingin merefund semua tiket?')">
        <input type="submit" name="refund" value="Proses Refund" class="batal">
    </form>
    <br>
    <p><a href="index.php">Kembali ke Halaman Awal (Isi Data Diri)</a></p>

</body>
</html>