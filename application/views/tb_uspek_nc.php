<head>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <!-- jQuery Cookie -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
// Decode data JSON dari $data
$row = json_decode($data, true);
// Decode data JSON dari $posisi
$posisi_array = json_decode($posisi, true);
// Ambil nilai posisi dari array yang sudah di-decode
$posisi_value = isset($posisi_array[0]['position1']) ? $posisi_array[0]['position1'] : '';

// Filter data sesuai dengan tipe
$filtered_data = array_filter($row['data'], function ($h) use ($tipe) {
    return $h['tipe'] === $tipe;
});
?>

<body>
    <table id="tabel-data4" class="table table-sm" style="font-size: 14px;">
        <thead>
            <tr>
                <th width="30px">No</th>
                <th>Nama Dokumen</th>
                <th width="200px">Keterangan</th>
                <th width="300px">File</th>
                <th width="90px">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($filtered_data as $h) {
                echo "<tr>";
                echo "<td style='vertical-align:top;'>$i</td>";
                echo "<td style='vertical-align:top;'>{$h['nama_dokumen']}</td>";
                echo "<td style='vertical-align:top;'>{$h['keterangan']}</td>";
                echo "<td style='vertical-align:top;'>{$h['file']}</td>";
                echo "<td style='vertical-align:top;'>";
                echo "<button type='button' class='btn btn-primary' onclick='btnview(\"" . $h['file'] . "\", \"" . $h['tipe'] . "\")'><i class='bi bi-eye'></i></button>";
                echo "&nbsp;";
                // Hanya menampilkan tombol hapus jika $posisi_value == 'Lab'
                if ($posisi_value == 'Lab') {
                    echo "<button type='button' class='btn btn-danger' onclick='btnhapus({$h['rowid']}, \"{$h['file']}\", \"{$h['tipe']}\")'><i class='bi bi-trash'></i></button>";
                }
                echo "</td>";
                echo "</tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
</body>

<script>
    $(document).ready(function() {
        $('#tabel-data4').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            searching: true,
            autoWidth: false,
        });
    });
</script>