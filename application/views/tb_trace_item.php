<?php
echo"<table width='100%' border='1' rules='all'>";
echo"<thead>";
echo"<tr>";
echo"<th width='100px'>Item Code</th>";
echo"<th colspan='4'>".$itemcode."</th>";
echo"</tr>";
echo"</thead>";
echo"<tbody>";
foreach ($datawhse as $w) {
    echo"<tr>";
    echo"<td colspan='5'><b>".$w['Warehouse']."</b></td>";
    echo"</tr>";
    echo"<td colspan='2'>";
    echo"<table width='100%' border='1' rules='rows'>";
    foreach ($datatrace as $d) {
        if($d['Warehouse']==$w['Warehouse']){
            echo"<tr>";
            echo "<td width='100px'>".$d['tgl']."</td>";
            echo "<td width='500px'>".$d['Comments']."</td>";
            echo "<td width='150px'>".$d['Transdescription']." / ".$d['BASE_REF']."</td>";
            echo "<td width='150px' style='text-align:right;' onclick='konversi(\"".$itemcode."\",".$d['stok'].")'>".number_format($d['stok'], 4, '.', ',')."</td>";
            echo "<td width='150px' style='text-align:right;'>".number_format($d['Total'], 4, '.', ',')."</td>";
            echo"</tr>";
        }
    }
    echo"</table>";
    echo"</td>";
}
echo"</tbody>";
echo"</table>";
?>