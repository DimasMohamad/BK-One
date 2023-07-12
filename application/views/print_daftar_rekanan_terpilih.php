<?php
$row = json_decode($data, true);
?>
<html>
<head>
    <style type="text/css">
        @page {
            size: A4;
            margin: 25;
        }
        body {
            margin: 1;
        }
        .page-number {
            content: counter(page);
        }
    </style>
</head>
<body>
    <table border="1" width="100%" rules="All" style="font-size:14px;">
        <thead>
            <tr>
                <th rowspan="5" colspan="2"><img src="<?= base_url('assets\img\bk.png') ?>" style="width:70px;height:50px;"></th>
                <th rowspan="3" colspan="4" style="font-size:20px;">PT. BEAUTY KASATAMA INDONESIA</th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:center;'>No. Dokumen</th>
                <th style='text-align:left;vertical-align:center;'>BKI.FM.PUR.04</th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:center;'>Tanggal Efektif</th>
                <th style='text-align:left;vertical-align:center;'>12 Desember 2022</th>
            </tr>
            <tr>
                <th rowspan="2" colspan="4">DAFTAR REKANAN TERPILIH</th>
                <th style='text-align:left;vertical-align:center;'>Revisi</th>
                <th style='text-align:left;vertical-align:center;'>1</th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:center;'>Halaman</th>
                <th style='text-align:left;vertical-align:center;'>
                    <div class="page-number"></div>
                </th>
            </tr>
            <th width="10px">No</th>
            <th width="100px">Perusahaan</th>
            <th width="170px">Alamat</th>
            <th width="110px">Telephone / Mobile</th>
            <th width="100px">Contact Person</th>
            <th width="70px">Tahun Bergabung</th>
            <th width="70px">E-Mail</th>
            <th width="145px">Produk Yang Dibeli</th>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($row['head'] as $h) {
                echo "<tr>";
                echo "<td style='vertical-align:top;'>" . $i . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['CardName'] . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['Address'] . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['Phone1'] . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['CntctPrsn'] . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['Notes'] . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['E_Mail'] . "</td>";
                echo "<td style='vertical-align:top;'>";
                foreach ($row['detail'] as $d) {
                    if ($d['DocDate'] == $h['DocDate'] && $d['CardName'] == $h['CardName']) {
                        echo $d['ItmsGrpNam'] . "<br>";
                    }
                }
                echo "</td>";
                echo "</tr>";
                $i++;
            }
            ?>
            <tr>
                <th colspan="8" height="20px"></th>
            </tr>
            <tr>
                <th rowspan="3" colspan="4"></th>
                <th colspan="2">Dibuat Oleh,</th>
                <th colspan="2">Disetujui Oleh,</th>
            </tr>
            <tr>
                <th colspan="2" height="80px"><img src="<?= base_url('assets\img\ttd_pur_dibuat.png') ?>" style="width:70px;height:50px;"></th>
                <th colspan="2" height="80px"><img src="<?= base_url('assets\img\ttd_pur_disetujui.png') ?>" style="width:70px;height:50px;"></th>
            </tr>
            <tr>
                <th colspan="2">Staff Purchasing</th>
                <th colspan="2">Kepala Purchasing</th>
            </tr>
        </tbody>
    </table>
</body>
<script>
    window.onload = function() {
        window.print();
    };
</script>
</html>
