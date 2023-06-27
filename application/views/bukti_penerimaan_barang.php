<html>
    <?php 
    $row = json_decode($data,true);
    $no_bpb = 0;
    $tgl_bpb = '';
    foreach($row['bpb'] as $h){
        $no_bpb = $h['No.'];
        $tgl_bpb = $h['Date'];
    }
    ?>
<table width="100%">
    <tr>
        <th style='text-align:left;' colspan="3">PT. BEAUTY KASATAMA INDONESIA</th>
    </tr>
    <tr>
        <th></th>
        <th width="35px">No : </th>
        <th width="250px" style='text-align:left;'><?= $no_bpb;?></th>
    </tr>
    <tr>
        <th></th>
        <th width="35px">Tgl : </th>
        <th width="250px" style='text-align:left;'><?= substr($tgl_bpb,0,10);?></th>
    </tr>
</table>
<center>
<h3>BUKTI PENERIMAAN BARANG</h3>
</center>
<table width="100%">
    <tr>
        <th style='text-align:left;' width="120px">Nama Supplier</th>
        <th width="10px">:</th>
        <th></th>
    </tr>
    <tr>
        <th style='text-align:left;' width="120px">No Surat Jalan</th>
        <th width="10px">:</th>
        <th></th>
    </tr>
    <tr>
        <th style='text-align:left;' width="120px">No PO</th>
        <th width="10px">:</th>
        <th></th>
    </tr>
</table>
<table width="100%" border="1" rules="all">
    <thead>
    <th>NO.</th>
    <th>KODE BARANG</th>
    <th>JENIS BARANG</th>
    <th>QTY</th>
    <th>SATUAN</th>
    <th>HARGA SATUAN</th>
    <th>PPN</th>
    <th>TOTAL</th>
    <th>KETERANGAN</th>
</thead>
<tbody>
    <?php
    $i = 1;
    foreach($row['bpb'] as $b){
        echo"<tr>";
        echo"<td>" . $i . "</td>";
        echo"<td>" . $b['Kode Barang'] . "</td>";
        echo"<td>" . $b['Jenis Barang'] . "</td>";
        echo"<td style='text-align:right;'>" . number_format($b['QTY'], 0, '.', ',') . "</td>";
        echo"<td>" . $b['Satuan'] . "</td>";
        echo"<td style='text-align:right;'>" . number_format($b['Harga Satuan'], 0, '.', ',') . "</td>";
        echo"<td style='text-align:right;'>" . number_format($b['PPN'], 0, '.', ',') . "</td>";
        echo"<td style='text-align:right;'>" . number_format($b['TOTAL'], 0, '.', ',') . "</td>";
        echo"<td>" . $b['Alasan'] . "</td>";
        echo"</td>";
        $i++;
    }
    ?>
</tbody>
</table>
</html>