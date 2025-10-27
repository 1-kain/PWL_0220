<?php
function cetak_ganjil () {
    for($i=0;$i<10;$i++){
        if($i%2 == 1){
            echo "$i <br>";
        }
    }
}
//pemanggilan fungsi
cetak_ganjil();
?>