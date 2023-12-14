<html>
<table class="table table-sm table-bordered" width="100%" border="1" rules="all">
    <?php
    include('export_spk.php');
    echo "<thead>
    <tr>
    <th rowspan='4'><img src=" . base_url('assets/img/bk.png') . " style='width:80px;height:50px;'></th>
    <th colspan='7'>PT.BEAUTY KASATAMA INDONESIA</th>
    <th colspan='1' style='text-align:left;vertical-align:top;'>No. Dokumen</th>
    <th colspan='2' style='text-align:left;vertical-align:top;'>BKI.FM.PPIC.02</th>        
    </tr>
    <tr>";
    echo "<th rowspan='3' colspan='7'>Surat Perintah Kerja</th>";
    echo "</tr>
    <tr>
        <th colspan='1' style='text-align:left;vertical-align:top;'>Tgl efektif</th>
        <th colspan='2' style='text-align:left;vertical-align:top;'>01/02/2023</th>
    </tr>
    <tr>
        <th colspan='1' style='text-align:left;vertical-align:top;'>Revisi</th>
        <th colspan='2' style='text-align:left;vertical-align:top;'>01</th>
    </tr>";
    foreach ($data as $h) {
        if ($h['STATUS'] !== 'Cancelled') {
            echo "
            <tr>
                <th style='text-align:left;vertical-align:top;'>No SPK</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>" . $h['spk'] . "</th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:top;'>Nama produk</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>" . $h['item_no'] . " - " . $h['DESCRIPTION'] . " (" . $h['mesin'] . ")</th>
            </tr>
            <tr>
                <th style='text-align:left;'>Quantity</th>
                <th colspan='10' style='text-align:left;'>" . number_format($h['qty_order'], 0, '.', ',') . "&nbsp;" . $h['uom'] . "</th>
            </tr>
            <tr>
                <th style='text-align:left;'>Date</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>" . $h['start_date'] . " S/d " . $h['end_date'] . "</th>
            </tr>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Qty</th>
                <th>Uom</th>
                <th>PB</th>
                <th>PB Ulang</th>
                <th>Uom</th>
                <th>PB Ulang</th>
                <th>ST</th>
                <th>Uom</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>";
            foreach ($itemhead as $ih) {
                if ($ih['id_spk'] == $h['id_spk']) {
                    echo "<tr>";
                    echo "<td style='text-align:left;vertical-align:top;'>" . $ih['item_no'] . "</td>";
                    echo "<td style='text-align:left;vertical-align:top;'>" .

                        $ih['DESCRIPTION'] . "</td>";
                    if ($ih['uom'] == "Meter") {
                        echo "<td style='text-align:right;vertical-align:top;'>" . number_format(($ih['qty'] * $h['qty_order']), 6, '.', ',') . "</td>";
                    } elseif ($ih['uom'] == "Kilogram") {
                        echo "<td style='text-align:right;vertical-align:top;'>" . number_format(($ih['qty'] * $h['qty_order']), 6, '.', ',') . "</td>";
                    } else {
                        echo "<td style='text-align:right;vertical-align:top;'>" . number_format(($ih['qty'] * $h['qty_order']), 0, '.', ',') . "</td>";
                    }
                    //echo "<td style='text-align:right;vertical-align:top;'>" . number_format(($ih['qty'] * $h['qty_order']), 4, '.', ',') . "</td>";
                    echo "<td style='text-align:left;vertical-align:top;'>" . $ih['uom'] . "</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "</tr>";
                }
            }
            echo "<tr><td colspan='11'>&nbsp;</td></tr>";
            echo "</tbody>";
        }
    }
    ?>
</table>

</html>