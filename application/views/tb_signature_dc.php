<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<?php
$row = json_decode($data,true);
?>
<table id='tabel-data' class='table table-sm' style='font-size:14px;'>
    <?php
        $i = 1;
        $sesi = $this->session->id_user;
        if ($sesi=='41'||$sesi=='42'||$sesi=='43') {
        echo"<thead>
        <th>No</th>
        <th>Nomor Dokumen</th>
        <th>Pemilik Dokumen</th>
        <th>Tanggal Upload</th>
        <th>Tanggal Acc (DC)</th>
        <th>Tanggal Acc (MR)</th>
        <th>Tanggal Acc (MO)</th>
        <th>Status</th>
        <th width='120px'>Action</th>
        </thead>
        <tbody>";
        foreach($row['user'] as $h){
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$i."</td>";
            echo"<td style='vertical-align:top;'>".$h['docnum']."</td>";
            echo"<td style='vertical-align:top;'>".$h['user_upload']."</td>";
            echo"<td style='vertical-align:top;'>".$h['date_upload']."</td>";
            echo"<td style='vertical-align:top;'>".$h['date_signdc']."</td>";
            echo"<td style='vertical-align:top;'>".$h['date_signmr']."</td>";
            echo"<td style='vertical-align:top;'>".$h['date_signgm']."</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['status'] == "0"){
                echo "<span class='badge bg-warning'>Proses DC</span>";
            }elseif($h['status'] == "1") {
                echo "<span class='badge bg-warning'>Proses MR</span>";
            }elseif($h['status'] == "2") {
                echo "<span class='badge bg-warning'>Proses MO</span>";
            }elseif($h['status'] == "3") {
                echo "<span class='badge bg-success'>Disetujui</span>";
            }elseif($h['status'] == "4") {
                echo "<span class='badge bg-danger'>Ditolak</span>";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if ($sesi == '41') {
                if ($h['status'] == '0') {
                    echo"<button type='button' class='btn btn-success' onclick='btnapprove(".$h['rowid'].")'><i class='bi bi-check-circle'></i></i></button>";
                    echo "&nbsp;";
                    echo"<button type='button' class='btn btn-danger' onclick='btnreject(".$h['rowid'].")'><i class='bi bi-file-earmark-excel'></i></button>";
                    echo "&nbsp;";
                }else{
                    echo"<button type='button' class='btn btn-primary' onclick='btndownload(\"".$h['file']."\")'><i class='bi bi-download'></i></button>";
                }
            }elseif ($sesi == '42') {
                if ($h['status'] == '1') {
                    echo"<button type='button' class='btn btn-success' onclick='btnapprove(".$h['rowid'].")'><i class='bi bi-check-circle'></i></i></button>";
                    echo "&nbsp;";
                    echo"<button type='button' class='btn btn-danger' onclick='btnreject(".$h['rowid'].")'><i class='bi bi-file-earmark-excel'></i></button>";
                    echo "&nbsp;";
                }else{
                    echo"<button type='button' class='btn btn-primary' onclick='btndownload(\"".$h['file']."\")'><i class='bi bi-download'></i></button>";
                }
            }elseif ($sesi == '43') {
                if ($h['status'] == '2') {
                    echo"<button type='button' class='btn btn-success' onclick='btnapprove(".$h['rowid'].")'><i class='bi bi-check-circle'></i></i></button>";
                    echo "&nbsp;";
                    echo"<button type='button' class='btn btn-primary' onclick='btndownload(\"".$h['file']."\")'><i class='bi bi-download'></i></button>";
                }else{
                    echo"<button type='button' class='btn btn-primary' onclick='btndownload(\"".$h['file']."\")'><i class='bi bi-download'></i></button>";
                }
            }else{
                echo"<button type='button' class='btn btn-primary' onclick='btndownload(\"".$h['file']."\")'><i class='bi bi-download'></i></button>";
            }
            echo"</td>";
            echo"</tr>";
            $i++;
        }
        echo"</tbody>";
    }else{
            echo"<thead>
            <th>No</th>
            <th>Nomor Dokumen</th>
            <th>Pemilik Dokumen</th>
            <th>Tanggal Upload</th>
            <th>Tanggal Acc (DC)</th>
            <th>Tanggal Acc (MR)</th>
            <th>Tanggal Acc (GM)</th>
            <th>Status</th>
            <th width='80px'>Action</th>
            </thead>
            <tbody>";
            foreach($row['user'] as $h){
                echo"<tr>";
                echo"<td style='vertical-align:top;'>".$i."</td>";
                echo"<td style='vertical-align:top;'>".$h['docnum']."</td>";
                echo"<td style='vertical-align:top;'>".$h['user_upload']."</td>";
                echo"<td style='vertical-align:top;'>".$h['date_upload']."</td>";
                echo"<td style='vertical-align:top;'>".$h['date_signdc']."</td>";
                echo"<td style='vertical-align:top;'>".$h['date_signmr']."</td>";
                echo"<td style='vertical-align:top;'>".$h['date_signgm']."</td>";
                echo"<td style='vertical-align:top;'>";
                if($h['status'] == "0"){
                    echo "<span class='badge bg-warning'>Proses DC</span>";
                }elseif($h['status'] == "1") {
                    echo "<span class='badge bg-warning'>Proses MR</span>";
                }elseif($h['status'] == "2") {
                    echo "<span class='badge bg-warning'>Proses GM</span>";
                }elseif($h['status'] == "3") {
                    echo "<span class='badge bg-success'>Disetujui</span>";
                }elseif($h['status'] == "4") {
                    echo "<span class='badge bg-danger'>Ditolak</span>";
                }
                echo"</td>";
                echo"<td style='vertical-align:top;'>";
                    echo"<button type='button' class='btn btn-primary' onclick='btndownload(\"".$h['file']."\")'><i class='bi bi-download'></i></button>";
                    echo "&nbsp;";
                    if ($h['date_signdc'] == '') {
                        echo"<button type='button' class='btn btn-danger' onclick='btnhapus(".$h['rowid'].", \"".$h['file']."\")'><i class='bi bi-trash'></i></button>";
                    }
                echo"</td>";
                echo"</tr>";
                $i++;
            }
            echo"</tbody>";
    }
    ?>
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