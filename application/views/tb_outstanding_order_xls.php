<?php
include('export_bj.php');
$rowsHeader = array_keys($item[0]);
$rowsHeaderDays = [];
$list_hari = [
    'Minggu',
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu'
];
foreach ($rowsHeader as $key => $header) {
    if ($header != 'ItemCode') $rowsHeaderDays[$key] = $list_hari[(int)date('w', strtotime($rowsHeader[$key]))];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <h3>PT. Beauty Kasatama Indonesia</h3>
    <h4>Laporan Hasil Produksi Barang Jadi</h4>
    <hr>
</head>    
<body>
<table border="1" rules="All" width="100%">
    <thead class="text-primary">
    <tr>
    <th style='text-align:center;'>#</th>
    <th style='text-align:center;'>Item Code</th>
    <th style='text-align:center;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Item&nbsp;Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
    <?php
    $tabel = 0;
    foreach ($rowsHeaderDays as $key => $day) {
        echo "<th style='text-align:center;'>".date_format(date_create($rowsHeader[$key]), "d")."</th>";
        $tabel++;
    }
    echo "<th style='text-align:center;'>TOTAL</th>";
    ?>
    </tr>
    </thead>
    <tbody>
    <?php
    $n = 1;
    foreach ($item as $i) {
        $totalbj = 0;
        echo "<tr>";
        foreach ($rowsHeader as $key) {
            $str = $i[$key];
            $row = explode("|", $str);
            
            if($row['3']==1){
                echo "<td style='text-align:Left;vertical-align:top;'>".$n."</td>";
                echo "<td style='text-align:Left;vertical-align:top;'>".$row['0']."</td>";
                echo "<td style='text-align:Left;vertical-align:top;'>".$row['1']."</td>";  
                $n++;  
            }
            if($row['3']==0){
                echo "<td style='text-align:right;vertical-align:top;'>0</td>";    
            }
            if($row['3']==2){
                echo "<td style='text-align:right;vertical-align:top;' onclick='detail(\"".$row['0']."\",\"".$row['2']."\")'>".number_format($row['1'], 0, '.', ',')."</td>";  
                $totalbj += $row['1'];  
            }
        }
        echo"<td style='text-align:right;vertical-align:top;'>".number_format($totalbj, 0, '.', ',')."</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>