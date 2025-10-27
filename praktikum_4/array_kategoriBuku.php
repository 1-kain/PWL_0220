<?php 

$kategoribuku = array("Pemrograman Web","Database","Desain Grafis","Internet",
                    "Office Application","Office Application");
echo "<strong>Daftar Kategori Buku: </strong><br>";
for($i=0;$i < sizeof($kategoribuku);$i++){
    echo "Nama Buku $i: " .$kategoribuku[$i] . "<br>";
}
?>