<?php
include 'config.php';
$query = "Select *FROM events";
$result = mysqli_query($config,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ini File Index</title>
</head>
<body>
    <h3>Daftar Event</h3>
    <?php 
    while($event = mysqli_fetch_assoc($result)){
        ?>
        <h3><?php echo htmlspecialchars($event['nama_event']);?></h3>
        <p>Harga: Rp <?php echo number_format($event['harga']);?></p>
        <P>Sisa Kuota: <?php echo $event['kuota'];?></p>
        <?php
        
        if($event['kuota'] > 0){
            ?>
            <a href="beli.php?id_event=<?php echo $event['id_event']; ?>" class="tombol">Beli Tiket</a>
            <?php
            }else{
                ?> 
                <span class="habis">Tiket Habis</span>
                <?php
            }
            ?>
            <?php
    }
    ?>   
</body>
</html>