<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<?php
$row = json_decode($data, true);
?>
<table id="tabel-data" class="table table-sm" style="font-size:14px;">
    <thead>
        <th>NO</th>
        <th width="110px">KODE ITEM</th>
        <th>NAMA ITEM</th>
        <th>JENIS BAHAN</th>
        <th>SATUAN</th>
        <th>SUPPLIER</th>
        <th>STOK AWAL</th>
        <th>STOK AKHIR</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($row['head'] as $h) {
            echo "<tr>";
            echo "<td style='vertical-align:top;'>" . $i . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['kode_item'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['kode_name'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['jenis'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['satuan'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['supplier'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['stok_awal'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $h['stok_akhir'] . "</td>";
            echo "</tr>";
            $i++;
        }

        ?>
    </tbody>
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