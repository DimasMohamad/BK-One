<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
</head>
<body>
    <?php
    $row = json_decode($data, true);
    ?>
    <table id="tabel-data" class="table table-sm" style="font-size:14px;">
        <thead>
            <th>No</th>
            <th>Nama Customer</th>
            <th>No Nota</th>
            <th>Tanggal</th>
            <th width="80px" >Action</th>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($row['data'] as $h) {
                echo "<tr>";
                echo "<td style='vertical-align:top;'>" . $i . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['nama'] . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['no_po'] . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['tanggal'] . "</td>";
                echo "<td style='vertical-align:top;'>";
                echo "<button class='btn btn-warning' onclick=\"btnprint('" . $h['no_po'] . "')\"><i class='bi bi-printer'></i></button>";
                echo "&nbsp;";
                echo "<button type='button' class='btn btn-danger' onclick=\"btnhapus('" . $h['no_po'] . "')\"><i class='bi bi-trash'></i></button>";
                echo "</td>";
                echo "</tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>

    <script>
        $(document).ready(function() {
            $('#tabel-data').DataTable({
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
</html>
