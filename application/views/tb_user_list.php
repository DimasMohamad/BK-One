<table class="table table-sm">
    <thead>
        <th width="40px">#</th>
        <th width="200px">User</th>
        <th width="30px"></th>
        <th width="200px"></th>
        <th width="100px"></th>
    </thead>
    <tbody>
    <?php
    $i = 1;
    foreach($data as $dt){
        echo"<tr>";
        echo"<td>".$i."</td>";
        if($dt['sts'] == 1){
            echo"<td><button type='button' class='btn btn-outline-success btn-sm' onclick='nonaktifkan(".$dt['id_user'].")'><i class='bi bi-check2'></i></button>&nbsp;<button class='btn btn-outline-primary btn-sm' onclick='akses(".$dt['id_user'].")'><i class='bi bi-gear-wide'></i></button>&nbsp;<button type='button' class='btn btn-outline-danger btn-sm' onclick='hapusdata(".$dt['id_user'].")'><i class='bi bi-trash'></i></button>&nbsp;".$dt['nama']."</td>";    
        }
        if($dt['sts'] == 0){
            echo"<td><button type='button' class='btn btn-outline-secondary btn-sm' onclick='aktifkan(".$dt['id_user'].")'><i class='bi bi-x-lg'></i></button>&nbsp;<button type='button' class='btn btn-outline-danger btn-sm' onclick='hapusdata(".$dt['id_user'].")'><i class='bi bi-trash'></i></button>&nbsp;".$dt['nama']."</td>";    
        }
        echo"<td></td>";
        echo"<td></td>";
        echo"<td></td>";
        echo"</tr>";
        $i++;
    }
    ?>
    </tbody>
    <tfoot>
        <td colspan="2"><input type="text" class="form-control" id="nama" placeholder="Username"></td>
        <td colspan="2"><input type="text" class="form-control" id="sandi" placeholder="Password"></td>
        <td><button class="btn btn-primary" onclick="simpandata()">Simpan</button></td>
    </tfoot>
</table>