<?php
$rowsHeader = array_keys($kriteria[0]);
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
    if ($header != 'rowid') $rowsHeaderDays[$key] = $list_hari[(int)date('w', strtotime($rowsHeader[$key]))];
}
$tabel = 1;
?>

<table class="table table-sm" border="1" rules="all">
    <thead>
        <th>Supplier</th>
        <th>Alamat</th>
        <th>Telp</th>
        <th>Tgl Seleksi</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($data as $dt){
            echo"<tr>";
            echo"<td>".$dt['id_supp']." - ".$dt['supp']."</td>";
            echo"<td>".$dt['alamat']."</td>";
            echo"<td>".$dt['telp']."</td>";
            echo"<td></td>";
            echo"</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>

<table class="table table-sm" border="1" rules="all">
    <thead class="text-primary">
    <tr>
    <th scope="col" style='text-align:center;'>Kriteria</th>
    <?php
    $tabel = 0;
    foreach ($rowsHeaderDays as $key => $day) {
        echo "<th style='text-align:left;'>".$rowsHeader[$key]."</th>";
        $tabel++;
    }    
    ?>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($kriteria as $i) {
        $totalbj = 0;
        echo "<tr>";
        foreach ($rowsHeader as $key) {
            echo "<td style='text-align:Left;vertical-align:top;'>".$i[$key]."</td>";
        }        
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
