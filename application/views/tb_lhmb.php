<?php
$row = json_decode($data,true);
?>

<table id="tblhmb" class="table table-sm" style="font-size:13px;overflow-x:auto;">
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
        <!--
        <th>Sts</th> -->
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
            //echo"<td>".$r['DocStatus']."</td>";
            echo"<td>".$r['FreeTxt']."</td>";
            echo"<td>".$r['Comments']."</td>";
            echo"</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>

<script>
   $(document).ready(function() {
        var table = $('#tblhmb').DataTable({
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         true,
            searching:         false,
            fixedColumns:   {
                left: 2
            }
        });
    });
</script>