<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<html>
    <title>BKI | Reporting</title>    
<?php
$row = json_decode($data,true);
include('export_rekappo.php');
?>
<body>
    <table id="tabel-data" border="1" rules="all" width="100%">
        <thead>
            <h3>PT. BEAUTY KASATAMA INDONESIA</h3>
            <center>
            <h5>REKAP PURCHASE ORDER - PURCHASING</h5>
            </center>
            <th>Tgl PO</th>
            <th>No. PO</th>
            <th>Kode SUP</th>
            <th>Nama&nbsp;SUP&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>Alamat</th>
            <th>Alamat&nbsp;Pengiriman</th>
            <th>Tgl Pengiriman</th>
            <th>Pembayaran</th>
            <th>Kode Barang</th>
            <th>Nama Barang&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>No SPP</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Harga&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>Harga&nbsp;DPP&nbsp;&nbsp;&nbsp;</th>
            <th>Kode PPN</th>
            <th>PPN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>Biaya Lainnya</th>
            <th>Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
            <th>Group</th>
            <th>Keterangan</th>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($row['rekappo'] as $h) {
                echo"<tr>";
                echo"<td style='text-align:top;'>".$h['DocDate']."</td>";
                echo"<td style='text-align:top;'>".$h['DocNum']."</td>";
                echo"<td style='text-align:top;'>".$h['CardCode']."</td>";
                echo"<td style='text-align:top;'>".$h['CardName']."</td>";
                echo"<td style='text-align:top;'>".$h['Address']."</td>";
                echo"<td style='text-align:top;'>".$h['Address2']."</td>";
                echo"<td style='text-align:top;'>".$h['DocDueDate']."</td>";
                echo"<td style='text-align:top;'>".$h['PymntGroup']."</td>";
                echo"<td style='text-align:top;'>".$h['ItemCode']."</td>";
                echo"<td style='text-align:top;'>".$h['Dscription']."</td>";
                echo"<td style='text-align:top;'></td>";
                echo"<td style='text-align:top;'>".$h['Quantity']."</td>";
                echo"<td style='text-align:top;'>".$h['UomCode']."</td>";
                echo"<td style='text-align:top;'>Rp. ";
                echo number_format($h['Price'], 0, '.', ',')."</td>";
                echo"<td style='text-align:top;'>Rp. ";
                echo number_format($h['LineTotal'], 0, '.', ',')."</td>";
                echo"<td style='text-align:top;'>".$h['VatGroup']."</td>";
                echo"<td style='text-align:top;'>Rp. ";
                echo number_format($h['VatSum'], 0, '.', ',')."</td>";
                echo"<td style='text-align:top;'>Rp. ";
                echo number_format($h['TotalExpns'], 0, '.', ',')."</td>";
                echo"<td style='text-align:top;'>Rp. ";
                echo number_format($h['DocTotalSy'], 0, '.', ',')."</td>";
                echo"<td style='text-align:top;'>".$h['ItmsGrpNam']."</td>";
                echo"<td style='text-align:top;'>".$h['Comments']."</td>";
                echo"</tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
</body>
</html>
<script>
    $('#tabel-data').DataTable({
        scrollY: "300px",
        scrollX: true,
        scrollCollapse: true,
        paging: true,
        searching: true,
        autoWidth: false,
        order: [[1, 'asc']],
        drawCallback: function (settings) {
            var api = this.api();
            var rows = api.rows({ page: 'current' }).nodes();
            var lastPoNumber = null;
            var rowspan = 1;

            for (var i = 0; i < rows.length; i++) {
                var poNumberCell = rows[i].querySelector('td:nth-child(2)'); // Diasumsikan No. PO berada di kolom kedua
                var biayaLainnyaCell = rows[i].querySelector('td:nth-child(18)'); // Diasumsikan Biaya Lainnya berada di kolom kedelapan belas
                var totalBiayaCell = rows[i].querySelector('td:nth-child(19)'); // Diasumsikan Total Biaya Lainnya berada di kolom kesembilan belas
                var poNumber = poNumberCell.textContent;

                if (poNumber === lastPoNumber) {
                    rowspan++;
                    biayaLainnyaCell.style.display = 'none'; // Sembunyikan sel Biaya Lainnya
                    totalBiayaCell.style.display = 'none'; // Sembunyikan sel Total Biaya Lainnya
                } else {
                    if (lastPoNumber !== null) {
                        var firstVisiblePoNumberCell = rows[i - rowspan].querySelector('td:nth-child(18)');
                        firstVisiblePoNumberCell.rowSpan = rowspan;
                        var firstVisibleTotalBiayaCell = rows[i - rowspan].querySelector('td:nth-child(19)');
                        firstVisibleTotalBiayaCell.rowSpan = rowspan;
                    }

                    lastPoNumber = poNumber;
                    rowspan = 1;
                }
            }

            if (lastPoNumber !== null) {
                var firstVisiblePoNumberCell = rows[rows.length - rowspan].querySelector('td:nth-child(18)');
                var firstVisibleTotalBiayaCell = rows[rows.length - rowspan].querySelector('td:nth-child(19)');
                firstVisiblePoNumberCell.rowSpan = rowspan;
                firstVisibleTotalBiayaCell.rowSpan = rowspan;
            }
        }
    });
</script>