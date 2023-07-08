<table class="table table-sm">
    <thead>
        <th>#</th>
        <th>Supplier</th>
        <th>Alamat</th>
        <th>Telp</th>
        <th>Tgl Seleksi</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($data as $dt){
            echo"<tr>";
            echo"<td>".$i."</td>";
            echo"<td><a href='#' onclick='pilihsupp()'>".$dt['supp']."</a></td>";
            echo"<td>".$dt['alamat']."</td>";
            echo"<td>".$dt['telp']."</td>";
            echo"<td></td>";
            echo"</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>