
<table id="tblgrpo" class="cell-border" style="font-size:12px;vertical-align:top;color:black;">
    <thead>
        <tr>
        <th rowspan="2">Tgl PO</th>
        <th rowspan="2">No PO</th>
        <th rowspan="2" width="150px">Supplier</th>
        <th rowspan="2">Kode Barang</th>
        <th rowspan="2" width="350px">Nama&nbsp;Barang</th>
        <th rowspan="2">Qty PO</th>
        <th rowspan="2">Satuan</th>
        <th rowspan="2">Harga</th>
        <th rowspan="2">Total</th>
        <th colspan="3" style='text-align:center;'>Detail GRPO</th>
        <th rowspan="2">Sisa PO</th>
        <th rowspan="2" width="150px">Free Text</th>
        </tr>
        <tr>
        <th>No GRPO</th>
        <th>Tgl GRPO</th>
        <th>Qty GRPO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $row = json_decode($data,true);
        foreach ($row['head1'] as $h1) {
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$h1['tgl_po']."</td>";
            echo"<td style='vertical-align:top;'>".$h1['DocNum']."</td>";
            echo"<td style='vertical-align:top;'>".$h1['Supplier']."</td>";
            echo"<td style='vertical-align:top;'>".$h1['ItemCode']."</td>";
            echo"<td style='vertical-align:top;'>".$h1['Dscription']."</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".number_format($h1['Quantity'], 4, '.', ',')."</td>";
            echo"<td style='vertical-align:top;'>".$h1['UomCode']."</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".$h1['Currency']."&nbsp;".number_format($h1['Price'], 2, '.', ',')."</td>";
            echo"<td style='vertical-align:top;text-align:right;'>".$h1['Currency']."&nbsp;".number_format(($h1['Quantity']*$h1['Price']), 2, '.', ',')."</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['detail'] as $d) {
                if($h1['DocNum'] == $d['No_PO'] && $h1['ItemCode'] == $d['Kode'] && $h1['Linenum'] == $d['BaseLine']){
                    echo "<label style='cursor:pointer;' onclick='trace_grpo(".$d['no_grpo'].")'>".$d['no_grpo']."</label><br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['detail'] as $d) {
                if($h1['DocNum'] == $d['No_PO'] && $h1['ItemCode'] == $d['Kode'] && $h1['Linenum'] == $d['BaseLine']){
                    echo $d['tgl_grpo']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;vertical-align:top;'>";
            foreach ($row['detail'] as $d) {
                if($h1['DocNum'] == $d['No_PO'] && $h1['ItemCode'] == $d['Kode'] && $h1['Linenum'] == $d['BaseLine']){
                    echo number_format($d['Quantity_GRPO'], 4, '.', ',')."<br>";
                }
            }
            echo"</td>";
            $t = 0;
            foreach ($row['detail'] as $d) {
                if($h1['DocNum'] == $d['No_PO'] && $h1['ItemCode'] == $d['Kode'] && $h1['Linenum'] == $d['BaseLine']){
                    $t += $d['Quantity_GRPO'];
                }
            }
            echo"<td style='text-align:right;vertical-align:top;'>".($h1['Quantity'] - $t)."</td>";
            echo"<td style='vertical-align:top;'>".$h1['FreeTxt']."</td>";
            echo"</tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $('#tblgrpo').DataTable({
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        searching:      true,
        autoWidth: false,
    });
</script>