<table class="table table-sm table-bordered">
    <thead>
        <th><i class="bi bi-plus-circle" style="cursor:pointer;" onclick="add_head()"></i></th>
        <th colspan='2'>Kriteria Penilaian</th>
        <th>Nilai</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($head as $h){
            echo"<tr>";
            echo"<td width='35px'>".$i."</td>";
            echo"<td colspan='3'><i class='bi bi-plus-circle' style='cursor:pointer;' onclick='add_child(".$h['rowid'].",\"".$h['penilaian']."\")'></i>&nbsp;".$h['penilaian']."</td>";
            echo"</tr>";
            $n = 1;
            foreach($child as $c){
                if($c['fatherid'] == $h['rowid']){
                    echo"<tr>";
                    echo"<td></td>";
                    echo"<td width='35px'>".$n."</td>";
                    echo"<td>".$c['penilaian']."</td>";
                    echo"<td width='80px'>".$c['nilai']."</td>";
                    echo"</tr>";
                    $n++;
                }
            }
            $i++;
        }
        ?>
    </tbody>
</table>
