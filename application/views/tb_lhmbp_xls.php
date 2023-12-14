<html>
    <title>BKI | Reporting</title>
    
<?php
$row = json_decode($data,true);
include('export_lhmb.php');
?>
<head>
    <h3>PT. BEAUTY KASATAMA INDONESIA</h3>
    <center>
    <h5>LAPORAN HARIAN MASUK BARANG - GUDANG BAHAN</h5>
    </center>
</head>
<body>
<table border="1" rules="all" width="100%">
    <thead>
        <th>#</th>
        <th>No BPB</th>
        <th>Tgl BPB</th>
        <th>No SJ</th>
        <th>Nama Supplier</th>
        <th>Group</th>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Qty</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>PPN</th>
        <th>Total</th>
        <th>Keterangan</th>
        <th>G/L Account</th>
    </thead>
    <tbody>
    <?php
        $t_usd = 0;
        $t_usd_idr = 0;
        $t_idr = 0;
        $total = 0;
        $i = 1;
        foreach ($row['lhmb'] as $r) {
            echo"<tr>";
            echo"<td>".$i."</td>";
            echo"<td>".$r['NoBPB']."</td>";
            echo"<td>".$r['TglBPB']."</td>";
            echo"<td>".$r['NoSJ']."</td>";
            echo"<td>".$r['Supplier']."</td>";
            echo"<td>".$r['Grup']."</td>";
            echo"<td>".$r['Kode_brg']."</td>";
            echo"<td>".$r['Nama_brg']."</td>";
            echo"<td>".number_format($r['Quantity'], 2, '.', ',')."</td>";
            if($r['UomCode'] == 'Manual'){
                echo"<td></td>";
            }else{
                echo"<td>".$r['UomCode']."</td>";
            }
            echo"<td style='text-align:right;'>".$r['Currency']."&nbsp;".number_format($r['Price'], 2, '.', ',')."</td>";
            echo"<td>".number_format($r['VatPrcnt'], 0, '.', ',')."%</td>";
            echo"<td style='text-align:right;'>".$r['Currency']."&nbsp;".number_format(($r['Quantity']*$r['Price']), 2, '.', ',')."</td>";
            echo"<td>".$r['FreeTxt']."</td>";
            echo"<td>".$r['AcctCode']."</td>";
            echo"</tr>";
            $i++;
            if($r['Currency'] == 'USD'){
                $t_usd += ($r['Quantity']*$r['Price']);
            }
            if($r['Currency'] == 'USD'){
                $t_usd_idr += $r['Total'];
            }
            if($r['Currency'] == 'IDR'){
                $t_idr += $r['Total'];
            }
            $total += $r['Total'];
        }
        ?>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="13" style="text-align:right;"><b>TOTAL USD</b></td>
        <td style="text-align:right;"><b><?= number_format($t_usd, 2, '.', ',');?></b></td>
        <td style="text-align:right;"><b>=>&nbsp;IDR&nbsp;<?= number_format($t_usd_idr, 2, '.', ',');?></b></td>
    </tr>
    <tr>
        <td colspan="13" style="text-align:right;"><b>TOTAL IDR</b></td>
        <td style="text-align:right;"><b><?= number_format($t_idr, 2, '.', ',');?></b></td>
        <td></td>
    </tr>
    <tr>
        <td colspan="13" style="text-align:right;"><b>GRAND TOTAL IDR</b></td>
        <td style="text-align:right;"><b><?= number_format($total, 2, '.', ',');?><b></td>
        <td></td>
    </tr>
    </tfoot>
</table>
    </body>
</html>