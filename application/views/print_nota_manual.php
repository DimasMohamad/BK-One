<?php
$row = json_decode($data, true);
$detail = json_decode($data2, true);

$nama = $row['data'][0]['nama'];
$no_po = $row['data'][0]['no_po'];
$tanggal = $row['data'][0]['tanggal'];
$alamat = $row['data'][0]['alamat'];
$telepon = $row['data'][0]['telepon'];
$kota = $row['data'][0]['kota'];
$telepon = $row['data'][0]['telepon'];
$attn = $row['data'][0]['attn'];
$top = $row['data'][0]['top'];
?>
<html>
<head>
    <style type="text/css">
        @page {
            size: A4;
            margin: 25;
            size: landscape;
        }
        body {
            margin: 1;
        }
        .page-number {
            content: counter(page);
        }
        .custom-table {
            padding: 10px;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table width="100%">
        <thead>
            <tr>
                <th width='300px' style='vertical-align:middle;text-align:left;'>PT. BEAUTY KASATAMA INDONESIA</th>
                <th width='460px'></th>
                <th width='40px' style='vertical-align:middle;text-align:left;'>No.</th>
                <th style='vertical-align:middle;text-align:left;'>: <?php echo $no_po; ?> </th>
            </tr>
            <tr><th></th><th></th>
                <th style='vertical-align:middle;text-align:left;'>Tgl.</th>
                <th style='vertical-align:middle;text-align:left;'>: <?php echo $tanggal; ?></th>
            </tr>
            <tr>
                <th colspan="4" style='vertical-align:middle;text-align:center;'><br><br>PURCHASE ORDER (PO)</th>
            </tr>
            <tr>
                <th style='vertical-align:middle;text-align:left;'>Nama Customer</th>
                <th colspan="3"style='vertical-align:middle;text-align:left;'>: <?php echo $nama; ?></th>
            </tr>
            <tr>
                <th style='vertical-align:middle;text-align:left;'>Alamat</th>
                <th style='vertical-align:middle;text-align:left;'>: <?php echo $alamat; ?></th>
                <th style='vertical-align:middle;text-align:left;'>Kota</th>
                <th style='vertical-align:middle;text-align:left;'>: <?php echo $kota; ?></th>
            </tr>
            <tr>
                <th style='vertical-align:middle;text-align:left;'>No Telp </th>
                <th style='vertical-align:middle;text-align:left;'>: <?php echo $telepon; ?></th>                
                <th style='vertical-align:middle;text-align:left;'>Attn </th>
                <th style='vertical-align:middle;text-align:left;'>: <?php echo $attn; ?></th>
            </tr>
            <tr>
                <th style='vertical-align:middle;text-align:left;'>TOP</th>
                <th colspan="3" style='vertical-align:middle;text-align:left;'>: <?php echo $top; ?></th>
            </tr>
        </thead>
    </table>
    <table id="nilai" border="1" width="100%" rules="All" style="font-size:14px;">
        <thead>
            <tr>
                <th style='vertical-align:middle;text-align:center;'>No.</th>
                <th style='vertical-align:middle;text-align:center;'>Kode Barang</th>
                <th style='vertical-align:middle;text-align:center;'>Jenis Barang</th>
                <th style='vertical-align:middle;text-align:center;'>Jumlah</th>
                <th style='vertical-align:top;text-align:center;'>Satuan</th>
                <th style='vertical-align:top;text-align:center;'>Keterangan</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            foreach($detail['detail'] as $h){
                echo"<tr>";
                echo"<td style='vertical-align:top;'>".$i."</td>";
                echo"<td style='vertical-align:top;'>".$h['kode_barang']."</td>";
                echo"<td style='vertical-align:top;'>".$h['jenis_barang']."</td>";
                echo"<td style='vertical-align:top;'>".$h['jumlah']."</td>";
                echo"<td style='vertical-align:top;'>".$h['satuan']."</td>";
                echo"<td style='vertical-align:top;'>".$h['keterangan']."</td>";
                echo"</tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
</body>
<script>
    window.onload = function() {
        window.print();
    };
</script>
</html>
