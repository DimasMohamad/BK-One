<?php
$row = json_decode($data, true);
include('export_xls_mutasi_stok.php');
?>
<table width="100%" cellspacing="0" border="1" rules='all'>
    <thead>
        <th>#</th>
        <th>ITEM CODE</th>
        <th>ITEM NAME</th>
        <th>Uom</th>
        <th>WHSE</th>
        <th>SALDO AWAL</th>
        <th>IM(IT)</th>
        <th>SO(GI)</th>
        <th>SI(GR)</th>
        <th>DP(GRPO)</th>
        <th>PR(GRTN)</th>
        <th>SALDO AKHIR</th>
        <th>Conv</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $row = json_decode($data, true);
        foreach ($row['head'] as $h) {
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td style='cursor:pointer;' onclick='detail(\"" . $h['ItemCode'] . "\")'>" . $h['ItemCode'] . "</td>";
            echo "<td style='cursor:pointer;' width='500px;' onclick='detail(\"" . $h['ItemCode'] . "\")'>" . $h['ItemName'] . "</td>";
            echo "<td style='cursor:pointer;' onclick='detail(\"" . $h['ItemCode'] . "\")'>" . $h['InvntryUom'] . "</td>";
            echo "<td>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    echo $r['Warehouse'] . "<br>";
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    if ($r['saldo_awal'] == 0) {
                        echo number_format($r['saldo_awal'], 0, '.', ',') . "<br>";
                    } else {
                        echo number_format($r['saldo_awal'], 4, '.', ',') . "<br>";
                    }
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    if ($r['IM_(IT)'] == 0) {
                        echo number_format($r['IM_(IT)'], 0, '.', ',') . "<br>";
                    } else {
                        echo number_format($r['IM_(IT)'], 4, '.', ',') . "<br>";
                    }
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    if ($r['SO_(GI)'] == 0) {
                        echo number_format($r['SO_(GI)'], 0, '.', ',') . "<br>";
                    } else {
                        echo number_format($r['SO_(GI)'], 4, '.', ',') . "<br>";
                    }
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    if ($r['SI_(GR)'] == 0) {
                        echo number_format($r['SI_(GR)'], 0, '.', ',') . "<br>";
                    } else {
                        echo number_format($r['SI_(GR)'], 4, '.', ',') . "<br>";
                    }
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    if ($r['DP_(GRPO)'] == 0) {
                        echo number_format($r['DP_(GRPO)'], 0, '.', ',') . "<br>";
                    } else {
                        echo number_format($r['DP_(GRPO)'], 4, '.', ',') . "<br>";
                    }
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    if ($r['PR_(GRTN)'] == 0) {
                        echo number_format($r['PR_(GRTN)'], 0, '.', ',') . "<br>";
                    } else {
                        echo number_format($r['PR_(GRTN)'], 4, '.', ',') . "<br>";
                    }
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    if ($r['DN_(DO)'] == 0) {
                        echo number_format($r['DN_(DO)'], 0, '.', ',') . "<br>";
                    } else {
                        echo number_format($r['DN_(DO)'], 4, '.', ',') . "<br>";
                    }
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['item'] as $r) {
                if ($r['ItemCode'] == $h['ItemCode']) {
                    if ($r['saldo_akhir'] == 0) {
                        echo "<label>" . number_format($r['saldo_akhir'], 0, '.', ',') . "</label><br>";
                    } else {
                        echo "<label style='cursor:pointer;' onclick='konversi(\"" . $h['ItemCode'] . "\"," . $r['saldo_akhir'] . ")'>" . number_format($r['saldo_akhir'], 4, '.', ',') . "</label><br>";
                    }
                }
            }
            echo "</td>";
            echo "<td>" . $h['konversi'] . "</td>";
            /*
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    echo $r['Currency'].".".number_format(($r['TransValue']/$r['saldo_akhir']), 4, '.', ',')."<br>";
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    echo $r['Currency'].".".number_format($r['TransValue'], 4, '.', ',')."<br>";
                }
            }
            echo"</td>";
            */
            echo "</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>