<?php 
$no = array(1,2,3,4,5);
$nama = array("Raka", "Roki", "Roku", "Roni", "Sani");
$jabatan = array ("Staff", "Direktur","Manager","Sekretaris","Staff");

echo "<table border = 1 width = 300>
<tr> 
<td>No</td>
<td>Nama</td>
<td>Jabatan</td>
</tr>";
for ($i=0;$i<count($nama);$i++){
    echo "<tr>
    <td> $no[$i]</td>
    <td> $nama[$i]</td>
    <td> $jabatan[$i]</td>
    </tr>";
}
    echo "</table>";
    ?>