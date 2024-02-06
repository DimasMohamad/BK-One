<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<?php
$row = json_decode($data, true);
?>
<table id='tabel-data' class='table table-sm' style='font-size:14px;'>
    <?php
    $i = 1;
    echo "<thead>
    <th width='40px'>NO</th>
    <th>DIVISI</th>
    <th>LOKASI DOKUMEN</th>
    <th width='80px'>ACTION</th>
    </thead>
    <tbody>";
    foreach ($row['head'] as $h) {
        echo "<tr>";
        echo "<td style='vertical-align:top;'>" . $i . "</td>";
        echo "<td style='vertical-align:top;'>" . $h['divisi'] . "</td>";
        echo "<td style='vertical-align:top;'>" . $h['lokasi'] . "</td>";
        echo "<td style='vertical-align:top;'>";
        echo "<button type='button' class='btn btn-danger' onclick='btnhapuslok(" . $h['rowid'] . ")'><i class='bi bi-trash'></i></button>";
        echo "</td>";
        echo "</tr>";
        $i++;
    }
    ?>
</table>
<script>
    $('#tabel-data').DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        searching: true,
        autoWidth: false,
    });
</script>