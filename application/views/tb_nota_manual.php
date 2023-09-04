<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<?php
$row = json_decode($data,true);
?>
<table id="tabel-data" class="table table-sm" style="font-size:14px;">
    <thead>
        <th>No</th>
        <th>Nama Customer</th>
        <th>No Nota</th>
        <th>Tanggal</th>
        <th>Action</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($row['data'] as $h){
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$i."</td>";
            echo"<td style='vertical-align:top;'>".$h['nama']."</td>";
            echo"<td style='vertical-align:top;'>".$h['no_po']."</td>";
            echo"<td style='vertical-align:top;'>".$h['tanggal']."</td>";
            echo"<td style='vertical-align:top;'>";
            echo "<button type='button' class='btn btn-primary' onclick='btnlihat(".$h['rowid'].")'><i class='bi bi-eye-fill'></i></button>";
            echo "&nbsp;";
            echo "<button type='button' class='btn btn-danger' onclick='btnhapus(".$h['rowid'].")'><i class='bi bi-trash'></i></button>";
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