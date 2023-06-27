<?php 
$row = json_decode($data,true);
include('export_xls_outstanding_pr.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <h3>PT. Beauty Kasatama Indonesia</h3>
    <h4>Laporan Outstanding PR</h4>
    <hr>
</head>    
<body>
<table width="100%" border="1" rules="All" style="vertical-align:top;color:black;">
    <thead>
        <tr>
            <th rowspan="2">Tgl SPP</th>
            <th rowspan="2">No SPP</th>
            <th rowspan="2">Dept</th>
            <th rowspan="2">Req Dept</th>
            <th rowspan="2">Kode Barang</th>
            <th rowspan="2" width="350px">Nama&nbsp;Barang</th>
            <th rowspan="2">Qty SPP</th>
            <th rowspan="2">Satuan</th>
            <th colspan="4" style='text-align:center;'>Detail PO</th>
            <th rowspan="2">Sisa</th>
            <th rowspan="2">Ket</th>
        </tr>
        <tr>
            <th>No PO</th>
            <th>Tgl PO</th>
            <th>Supplier</th>
            <th>Qty PO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($row['head'] as $h) {
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$h['tgl']."</td>";
            echo"<td style='vertical-align:top;'>".$h['No_SPP']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Dept']."</td>";
            echo"<td style='vertical-align:top;'>".$h['OcrCode2']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Kode']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Nama_Barang']."</td>";
            echo"<td style='text-align:right;vertical-align:top;'>".number_format($h['Quantity_PR'], 4, '.', ',')."</td>";
            echo"<td style='vertical-align:top;'>".$h['Satuan']."</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['detail'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo "<label style='cursor:pointer;' onclick='trace_po(".$d['no_po'].")'>".$d['no_po']."</label><br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['detail'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo $d['tgl_po']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['detail'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo $d['Supplier']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;vertical-align:top;'>";
            foreach ($row['detail'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo number_format($d['Quantity_PO'], 4, '.', ',')."<br>";
                }
            }
            echo"</td>";
            $t = 0;
            foreach ($row['detail'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                $t += $d['Quantity_PO'];
                }
            }
            echo"<td style='text-align:right;vertical-align:top;'>".($h['Quantity_PR'] - $t)."</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['detail'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo $d['Keterangan']."<br>";
                }
            }
            echo"</td>";
            echo"</tr>";
            
        }
        ?>
    </tbody>
</table>
</body>
</html>
