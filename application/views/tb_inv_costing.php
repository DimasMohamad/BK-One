<table id="tabel-data" class='table table-sm table-hover' width="100%" cellspacing="0" style='font-size:12px;'>
    <thead>
        <th>#</th>
        <th>ITEM CODE</th>
        <th width='500px'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ITEMNAME&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
        <th>Uom</th>
        <th style='text-align:center;'>WHSE</th>
        <th style='text-align:right;'>S.AWAL</th>
        <th style='text-align:right;'>IM(IT)</th>
        <th style='text-align:right;'>SO(GI)</th>
        <th style='text-align:right;'>SI(GR)</th>
        <th style='text-align:right;'>DP(GRPO)</th>
        <th style='text-align:right;'>PR(GRTN)</th>
        <th style='text-align:right;'>S.AKHIR</th>
        <th>Conv</th>
        <th style='text-align:right;'>Cost</th>
        <th style='text-align:right;'>Trans.Value</th>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        $row = json_decode($data,true);
        foreach($row['head'] as $h){
            echo"<tr>";
            echo"<td>".$i."</td>";
            echo"<td style='cursor:pointer;' onclick='detail(\"".$h['ItemCode']."\")'>".$h['ItemCode']."</td>";
            echo"<td style='cursor:pointer;' width='500px;' onclick='detail(\"".$h['ItemCode']."\")'>".$h['ItemName']."</td>";
            echo"<td style='cursor:pointer;' onclick='detail(\"".$h['ItemCode']."\")'>".$h['InvntryUom']."</td>";
            echo"<td>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    echo $r['Warehouse']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    if($r['saldo_awal']==0){
                        echo number_format($r['saldo_awal'], 0, '.', ',')."<br>";    
                    }else{
                        echo number_format($r['saldo_awal'], 4, '.', ',')."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    if($r['IM_(IT)']==0){
                        echo number_format($r['IM_(IT)'], 0, '.', ',')."<br>";
                    }else{
                        echo number_format($r['IM_(IT)'], 4, '.', ',')."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    if($r['SO_(GI)']==0){
                        echo number_format($r['SO_(GI)'], 0, '.', ',')."<br>";
                    }else{
                        echo number_format($r['SO_(GI)'], 4, '.', ',')."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    if($r['SI_(GR)']==0){
                        echo number_format($r['SI_(GR)'], 0, '.', ',')."<br>";
                    }else{
                        echo number_format($r['SI_(GR)'], 4, '.', ',')."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    if($r['DP_(GRPO)']==0){
                        echo number_format($r['DP_(GRPO)'], 0, '.', ',')."<br>";
                    }else{
                        echo number_format($r['DP_(GRPO)'], 4, '.', ',')."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    if($r['PR_(GRTN)']==0){
                        echo number_format($r['PR_(GRTN)'], 0, '.', ',')."<br>";
                    }else{
                        echo number_format($r['PR_(GRTN)'], 4, '.', ',')."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    if($r['saldo_akhir']==0){
                        echo "<label>".number_format($r['saldo_akhir'], 0, '.', ',')."</label><br>";
                    }else{
                        echo "<label style='cursor:pointer;' onclick='konversi(\"".$h['ItemCode']."\",".$r['saldo_akhir'].")'>".number_format($r['saldo_akhir'], 4, '.', ',')."</label><br>";
                    }
                }
            }
            echo"</td>";
            echo"<td>".$h['konversi']."</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    if($r['TransValue'] <= '0' || $r['saldo_akhir'] <= '0'){
                        echo "IDR. 0<br>";
                    }else{
                        echo $r['Currency'].".&nbsp;".number_format(($r['TransValue']/$r['saldo_akhir']), 4, '.', ',')."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;'>";
            foreach($row['item'] as $r){
                if($r['ItemCode'] == $h['ItemCode']){
                    echo $r['Currency'].".&nbsp;".number_format($r['TransValue'], 4, '.', ',')."<br>";
                }
            }
            echo"</td>";
            echo"</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable({scrollX: true,});
    });
    
</script>