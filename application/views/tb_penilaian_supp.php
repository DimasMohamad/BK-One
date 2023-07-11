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
?>

<table id="tbldata" class="display cell-border">
    <thead class="text-primary">
    <tr>
    <th scope="col" style='text-align:center;'>Kriteria</th>
    <?php
    $tabel = 0;
    foreach ($rowsHeaderDays as $key => $day) {
        echo "<th style='text-align:center;'>".$rowsHeader[$key]."</th>";
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
