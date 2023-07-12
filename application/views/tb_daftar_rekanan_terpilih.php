<?php
$row = json_decode($data,true);
?>
<table id="tabel-data" class="table table-sm" style="font-size:14px;">
    <thead>
            <th>No</th>
            <th>Perusahaan</th>
            <th>Tanggal PO</th>
            <th>Alamat</th>
            <th>Telephone / Mobile</th>
            <th>Contact Person</th>
            <th>Tahun bergabung</th>
            <th>Email</th>
            <th>Produk Yang Dibeli</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($row['head'] as $h){
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$i."</td>";
            echo"<td style='vertical-align:top;'>".$h['CardName']."</td>";
            echo"<td style='vertical-align:top;'>".$h['DocDate']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Address']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Phone1']."</td>";
            echo"<td style='vertical-align:top;'>".$h['CntctPrsn']."</td>";
            echo"<td style='vertical-align:top;'>".$h['Notes']."</td>";
            echo"<td style='vertical-align:top;'>".$h['E_Mail']."</td>";
            echo"<td style='vertical-align:top;'>";
            foreach($row['detail'] as $d){
                if($d['DocDate']==$h['DocDate']){
                    if($d['CardName']==$h['CardName']){
                        echo $d['ItmsGrpNam']."<br>";
                    }
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
    $('#tabel-data').DataTable({
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        searching:      true,
        autoWidth: false,
    });
</script>