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

<body>
    <?php
    $row = json_decode($data, true);
    ?>
    <table id='tabel-data1' class='table table-sm' style='font-size:14px;'>
        <?php
        $i = 1;
        echo "<thead>
            <th width='30px'>No</th>
            <th>Nama Dokumen</th>
            <th width='200px'>Keterangan</th>
            <th width='300px'>File</th>
            <th width='90px'>Action</th>
            </thead>";
        echo "<tbody>";
        foreach ($row['data'] as $h) {
            echo "<tr>";
            echo "<td style='vertical-align:top;'>" . $i . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['nama_dokumen'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['keterangan'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['file'] . "</td>";
            echo "<td style='vertical-align:top;'>";
            echo "<button type='button' class='btn btn-primary' onclick='btndownload(\"" . $h['file'] . "\")'><i class='bi bi-eye'></i></button>";
            echo "&nbsp;";
            echo "<button type='button' class='btn btn-danger' onclick='btnhapus(" . $h['rowid'] . ", \"" . $h['file'] . "\")'><i class='bi bi-trash'></i></button>";
            echo "</td>";
            $i++;
        }
        echo "</tbody>";
        ?>
    </table>

    <script>
        $(document).ready(function() {
            $('#tabel-data1').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: true,
                searching: true,
                autoWidth: false,
            });
        });
    </script>
</body>