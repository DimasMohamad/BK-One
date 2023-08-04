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
        .custom-table {
            padding: 10px;
            border-collapse: collapse;
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
                <th style='text-align:left;vertical-align:center;' width="70px"></th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:center;'>Tanggal Efektif</th>
                <th style='text-align:left;vertical-align:center;'></th>
            </tr>
            <tr>
                <th rowspan="2" colspan="4">PRODUK PALSU / DIDUGA PALSU</th>
                <th style='text-align:left;vertical-align:center;'>Revisi</th>
                <th style='text-align:left;vertical-align:center;'></th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:center;'>Halaman</th>
                <th style='text-align:left;vertical-align:center;'>
                    <div class="page-number"></div>
                </th>
            </tr>
    </table>
    <table border="1" height="400px" width="100%">
        <thead>
            <tr>
                <th colspan="8">FORM PRODUK PALSU / DIDUGA PALSU</th>
            </tr>
            <tr>
                <th colspan="2"></th>
                <th colspan="1">Nama Produk</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $row['data']['nama_produk']; ?></td>
            </tr>

            <tr>
                <th colspan="2"></th>
                <th colspan="1">Tanggal Upload</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $row['data']['tanggal_upload']; ?></td>
            </tr>
            <tr>
                <th colspan="2"></th>
                <th colspan="1">Masalah</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $row['data']['masalah']; ?></td>
            </tr>
            <tr>
                <th colspan="2"></th>
                <th colspan="1">Hasil Inspeksi</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $row['data']['hasil_inspeksi']; ?></td>
            </tr>
            <tr>
                <th colspan="2"></th>
                <th colspan="1">Tindakan</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $row['data']['tindakan']; ?></td>
            </tr>
            <tr>
                <th colspan="2"></th>
                <th colspan="1">Status</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $row['data']['status']; ?></td>
            </tr>
        </thead>
    </table>
    <br><br><br><br><br><br><br><br>
    <table border="1" width="30%" rules="All" style="font-size:14px;">
        <tbody>
            <tr>
                <th colspan="2">Direktur,</th>
                <th colspan="2">Ketua Tim,</th>
            </tr>
            <tr>
                <th colspan="2" height="80px"><img src="<?= base_url('assets\img\ttd_pur_dibuat.png') ?>" style="width:70px;height:50px;"></th>
                <th colspan="2" height="80px"><img src="<?= base_url('assets\img\ttd_pur_disetujui.png') ?>" style="width:70px;height:50px;"></th>
            </tr>
            <tr>
                <th colspan="2">&nbsp;</th>
                <th colspan="2">&nbsp;</th>
            </tr>
        </tbody>
    </table>
<script>
    window.onload = function() {
        //window.print();
    };
</script>
</html>
