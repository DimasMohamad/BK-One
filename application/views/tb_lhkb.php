<?php
$row = json_decode($data,true);
?>

<table id="tbldata" class="display cell-border" style="font-size:12px;overflow-x:auto;">
    <thead>
        <tr>
        <th rowspan="2" width="30px">#</th>
        <th rowspan="2">No&nbsp;BKB</th>
        <th rowspan="2">Tgl&nbsp;BKB</th>
        <th rowspan="2">Item&nbsp;Code</th>
        <th rowspan="2" width='85%'>Item&nbsp;Name</th>
        <th rowspan="2" width="50px">Qty</th>
        <th rowspan="2" width="35px">Uom</th>
        <th rowspan="2" width="35px">Type</th>
        <th colspan="2">Warehouse</th>
        <th rowspan="2" width="100px">Shipment To</th>
        <th rowspan="2" width="100px">Keterangan</th>
        </tr>
        <tr>
        <th width="50px">From</th>
        <th width="50px">To</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($row['head'] as $h){
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$h['num']."</td>";
            echo"<td style='vertical-align:top;'>".$h['DocNum']."</td>";
            echo"<td style='vertical-align:top;'>".$h['TglBPB']."</td>";
            echo"<td style='vertical-align:top;'>"; //itemcode
            foreach($row['detail'] as $d){
                if($d['DocNum']==$h['DocNum'] && $d['tipe']==$h['tipe']){
                    echo $d['ItemCode']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>"; //itemname
            foreach($row['detail'] as $d){
                if($d['DocNum']==$h['DocNum'] && $d['tipe']==$h['tipe']){
                    echo $d['Dscription']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='text-align:right;vertical-align:top;'>"; //qty
            foreach($row['detail'] as $d){
                if($d['DocNum']==$h['DocNum'] && $d['tipe']==$h['tipe']){
                    echo number_format($d['Quantity'], 4, '.', ',')."<br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>"; //Uom
            foreach($row['detail'] as $d){
                if($d['DocNum']==$h['DocNum'] && $d['tipe']==$h['tipe']){
                    echo $d['UomCode']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>"; //tipe
            foreach($row['detail'] as $d){
                if($d['DocNum']==$h['DocNum'] && $d['tipe']==$h['tipe']){
                    echo $d['tipe']."<br>";
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>"; //whs
            foreach($row['detail'] as $d){
                if($d['DocNum']==$h['DocNum'] && $d['tipe']==$h['tipe']){
                    if($d['tipe']=='GI' || $d['tipe']=='DO' || $d['tipe']=='Return'){
                        echo $d['WhsCode']."<br>";
                    }else{
                        echo $d['FromWhsCod']."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>"; //whs
            foreach($row['detail'] as $d){
                if($d['DocNum']==$h['DocNum'] && $d['tipe']==$h['tipe']){
                    if($d['tipe']=='GI' || $d['tipe']=='DO' || $d['tipe']=='Return'){
                    }else{
                        echo $d['WhsCode']."<br>";
                    }
                }
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>".$h['CardName']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Comments']."</td>";
            echo"</tr>";
        }
        ?>
    </tbody>
</table>

<script>
    $('#tbldata').DataTable({
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        searching:      true,
        autoWidth: false,
        height: $(window).height(),
    });
</script>