<?php
$row = json_decode($data,true);
include('export_xls_lhkb.php');
?>
<table width="100%" cellspacing="0" border="1" rules='all'>
    <thead>
        <th>No NT / SJ</th>
        <th>Tanggal</th>
        <th>Customer</th>
        <th>Kode barang</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Satuan</th>
        <th>Keterangan</th>
    </thead>
    <tbody>
        <?php
        foreach($row['head'] as $h){
            echo"<tr>";
            echo"<td>".$h['nosj']."</td>";
            echo"<td>".$h['DocDate']."</td>";
            echo"<td>".$h['Customer']."</td>";
            echo"<td>".$h['ItemCode']."</td>";
            echo"<td>".$h['Dscription']."</td>";
            echo"<td style='text-align:right;'>".number_format($h['Quantity'], 2, '.', ',')."</td>";
            echo"<td>".$h['UomCode']."</td>";
            echo"<td>".$h['FreeTxt']."</td>";
            echo"</tr>";
        }
        ?>
    </tbody>
</table>