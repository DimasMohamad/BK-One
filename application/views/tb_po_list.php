<table id="tabel-data" class="table table-sm" style="width:100%;font-size:13px;">
    <thead>
        <th>#</th>
        <th>No. PO</th>
        <th>Tgl PO</th>
        <th width="70px">Supplier</th>
        <th>Item</th>
        <th>Qty</th>
        <th>Uom</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $row = json_decode($data, true);
        foreach ($row['head'] as $r) {
            echo "<tr>";
            echo "<td style='vertical-align:top;'>" . $i . "</td>";
            echo "<td style='vertical-align:top;'><button class='btn btn-warning btn-sm' onclick='add(" . $r['DocNum'] . ",\"" . $r['CardName'] . "\",\"" . $r['CardCode'] . "\",\"";
            foreach ($row['item'] as $it) {
                if ($it['DocNum'] == $r['DocNum']) {
                    echo $it['ItmsGrpNam'];
                    break; // Stop the loop after finding the value
                }
            }
            echo "\")'>  " . $r['DocNum'] . "   </button></td>";
            echo "<td style='vertical-align:top;'>" . $r['Posting_date'] . "</td>";
            echo "<td style='vertical-align:top;'>" . $r['CardName'] . "</td>";
            echo "<td style='vertical-align:top;'>";
            foreach ($row['item'] as $it) {
                if ($it['DocNum'] == $r['DocNum']) {
                    echo $it['ItemCode'] . " - " . $it['Dscription'] . "<br>";
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;vertical-align:top;'>";
            foreach ($row['item'] as $it) {
                if ($it['DocNum'] == $r['DocNum']) {
                    echo number_format($it['Quantity'], 4, '.', ',') . "<br>";
                }
            }
            echo "</td>";
            echo "<td style='vertical-align:top;'>";
            foreach ($row['item'] as $it) {
                if ($it['DocNum'] == $r['DocNum']) {
                    echo $it['UomCode'] . "<br>";
                }
            }
            echo "</td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function() {
        var table = $('#tabel-data').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: true,
            fixedColumns: {
                left: 2
            }
        });
    });
</script>