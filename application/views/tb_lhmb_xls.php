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
        <th width="100px">Tgl BPB</th>
        <th width="75px">No SJ</th>
        <th width="200px">Nama Supplier</th>
        <th>Group</th>
        <th>Kode Barang</th>
        <th width="200px">Nama Barang</th>
        <th>Qty</th>
        <th>Satuan</th>
        <th width="200px">Free Text</th>
        <th width="500px">Comments</th>
    </thead>
    <tbody>
        <?php
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
            echo"<td>".$r['UomCode']."</td>";
            echo"<td>".$r['FreeTxt']."</td>";
            echo"<td>".$r['Comments']."</td>";
            echo"</tr>";
            $i++;
        }
        ?>
    </tbody>
        <tfooter>
            
        </tfooter>
    </table>
    <br>
    <table border="1" rules="all">
        <tr>
        <th style="text-align:center;" width="166px">Disetujui</th>
        <th style="text-align:center;" width="200px">Dibuat</th>
        </tr>
        <td height="100px"></td>
        <td height="100px"></td>
    </table>
</body>

</html>