<?php 
$row = json_decode($data,true);
?>
<table id="tblgrpo" class="cell-border" style="font-size:12px;vertical-align:top;color:black;">
    <thead>
        <tr>
            <th rowspan="2">Tgl SPP</th>
            <th rowspan="2">No SPP</th>
            <th rowspan="2">Kode Barang</th>
            <th rowspan="2" width="250px">Nama&nbsp;Barang</th>
            <th rowspan="2">Qty SPP</th>
            <th rowspan="2">Satuan</th>
            <th colspan="4" style='text-align:center;'>Detail PO</th>
            <th rowspan="2">Sisa PR</th>
            <th rowspan="2">Ket</th>
            <th colspan="3" style='text-align:center;'>Detail GRPO</th>
            <th rowspan="2">Sisa PO</th>
        </tr>
        <tr>
            <th>No PO</th>
            <th>Tgl PO</th>
            <th>Supplier</th>
            <th>Qty PO</th>
            <th>No GRPO</th>
            <th>Tgl GRPO</th>
            <th>Qty GRPO</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($row['head'] as $h) {
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$h['tgl']."</td>";
            echo"<td style='vertical-align:top;'>".$h['No_SPP']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Kode']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Nama_Barang']."</td>";
            echo"<td style='text-align:right;vertical-align:top;'>".number_format($h['Quantity_PR'], 4, '.', ',')."</td>";
            echo"<td style='vertical-align:top;'>".$h['Satuan']."</td>";
            // detail PO
            echo"<td style='vertical-align:top;'>";
            foreach ($row['po'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo "<label style='cursor:pointer;' onclick='trace_po(".$d['no_po'].")'>".$d['no_po']."</label><br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['po'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo $d['tgl_po']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['po'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo $d['Supplier']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;vertical-align:top;'>";
            foreach ($row['po'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo number_format($d['Quantity_PO'], 4, '.', ',')."<br>";
                }
            }
            echo"</td>";
            $t = 0;
            foreach ($row['po'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                $t += $d['Quantity_PO'];
                }
            }
            echo"<td style='text-align:right;vertical-align:top;'>".number_format(($h['Quantity_PR'] - $t), 4, '.', ',')."</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['po'] as $d) {
                if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine']){
                echo $d['Keterangan']."<br>";
                }
            }
            echo"</td>";
            // detail GRPO
            echo"<td style='vertical-align:top;'>";
            foreach ($row['po'] as $d) {
                foreach ($row['grpo'] as $g) {
                    if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine'] && $d['no_po'] == $g['No_PO'] && $h['Kode'] == $g['Kode'] && $d['LineNum'] == $g['BaseLine']){
                        //echo $g['no_grpo']."<br>";
                        echo "<label style='cursor:pointer;' onclick='trace_grpo(".$g['no_grpo'].")'>".$g['no_grpo']."</label><br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            foreach ($row['po'] as $d) {
                foreach ($row['grpo'] as $g) {
                    if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine'] && $d['no_po'] == $g['No_PO'] && $h['Kode'] == $g['Kode'] && $d['LineNum'] == $g['BaseLine']){
                        echo $g['tgl_grpo']."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;vertical-align:top;'>";
            foreach ($row['po'] as $d) {
                foreach ($row['grpo'] as $g) {
                    if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine'] && $d['no_po'] == $g['No_PO'] && $h['Kode'] == $g['Kode'] && $d['LineNum'] == $g['BaseLine']){
                        echo number_format($g['Quantity_GRPO'], 4, '.', ',')."<br>";
                    }
                }
            }
            echo"</td>";
            $tgrpo = 0;
            foreach ($row['po'] as $d) {
                foreach ($row['grpo'] as $g) {
                    if($h['No_SPP'] == $d['No_SPP'] && $h['Kode'] == $d['Kode'] && $h['Linenum'] == $d['BaseLine'] && $d['no_po'] == $g['No_PO'] && $h['Kode'] == $g['Kode'] && $d['LineNum'] == $g['BaseLine']){
                        $tgrpo += $g['Quantity_GRPO'];
                    }
                }
            }
            if($t == 0){
                echo"<td style='text-align:right;vertical-align:top;'>".number_format(($h['Quantity_PR'] - $t), 4, '.', ',')."</td>";
            }else{
                echo"<td style='text-align:right;vertical-align:top;'>".number_format(($t - $tgrpo), 4, '.', ',')."</td>";    
            }
            echo"</tr>";
            
        }
        ?>
    </tbody>
</table>
