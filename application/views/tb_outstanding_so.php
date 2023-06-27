<?php 
$row = json_decode($data,true);
?>
<table id="tblso" class="cell-border" width="100%" style="font-size:12px;vertical-align:top;color:black;">
    <thead>
    <tr>
        <th width='40px' rowspan="2">Tgl&nbsp;SO</th>
        <th width='50px' rowspan="2">No&nbsp;SO</th>
        <th width='50px' rowspan="2">No&nbsp;PO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th width='50px' rowspan="2">Customer&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th rowspan="2">Kode&nbsp;barang</th>
        <th rowspan="2" width='350px'>Nama&nbsp;barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th colspan="3" style='vertical-align:top;text-align:center;'>Sales&nbsp;Order</th>
        <th colspan="3" style='vertical-align:top;text-align:center;'>Disc&nbsp;%</th>
        <th width='70px' rowspan="2">DPP</th>
        <th width='70px' rowspan="2">ppn</th>
        <th width='75px' rowspan="2">Total</th>
        <th colspan="3" style='vertical-align:top;text-align:center;'>Delivery&nbsp;Order</th>
        <th rowspan="2">Sisa&nbsp;SO</th>
    </tr>
    <tr>
        <th width='57px'>Qty</th>
        <th width='18px'>Uom</th>
        <th width='70px'>Harga</th>
        <th width='20px'>1</th>
        <th width='20px'>2</th>
        <th width='20px'>3</th>
        <th width='40px'>Tgl&nbsp;DO</th>
        <th width='20px'>No&nbsp;SJ</th>
        <th width='60px'>Jumlah</th>
    </tr>
    </thead>
    <tbody>
        <?php
        foreach($row['head'] as $h){
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$h['Tanggal_SO']."</td>";
            echo"<td style='vertical-align:top;'>".$h['No_SO']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Reff_No_PO']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Nama_Customer']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Kode']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Nama_Barang']."</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".number_format($h['QTY_SO'], 4, '.', ',')."</td>";
            echo"<td style='vertical-align:top;text-align:center;''>".$h['Satuan']."</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".number_format($h['Harga_Satuan'], 2, '.', ',')."</td>";
            echo"<td style='vertical-align:top;'>".$h['Diskon_1']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Diskon_2']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Diskon_3']."</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".number_format($h['DPP'], 2, '.', ',')."</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".number_format($h['PPN'], 2, '.', ',')."</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".number_format($h['Total'], 2, '.', ',')."</td>";
            echo"<td style='vertical-align:top;'>";
            foreach($row['item'] as $i){
                if($i['No_SO']==$h['No_SO'] && $i['Kode']==$h['Kode'] && $i['BaseLine']==$h['LineNum']){
                    echo $i['TGL_Kirim']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            foreach($row['item'] as $i){
                if($i['No_SO']==$h['No_SO'] && $i['Kode']==$h['Kode'] && $i['BaseLine']==$h['LineNum']){
                    echo "<a href='#' onclick='trace_so(".$i['No_SJ'].")'>".$i['No_SJ']."</a><br>";
                }
            }
            echo"</td>";
            echo"</td>";
            echo"<td style='vertical-align:top;text-align:right;'>";
            $jml = 0;
            foreach($row['item'] as $i){
                if($i['No_SO']==$h['No_SO'] && $i['Kode']==$h['Kode'] && $i['BaseLine']==$h['LineNum']){
                    echo number_format($i['Jumlah_Kirim'], 4, '.', ',')."<br>";
                    $jml += $i['Jumlah_Kirim'];
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".number_format(($jml-$h['QTY_SO']), 4, '.', ',')."</td>";
            echo"</tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $('#tblso').DataTable({
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        searching:      true,
        autoWidth: false,
    });
</script>