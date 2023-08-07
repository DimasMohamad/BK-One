<?php
?>
<html>
<head>
    <style type="text/css">
        @page { size: A4; margin: 25;}
        body {margin: 1;}
        .page-number {content: counter(page);}
        .custom-table {padding: 10px; border-collapse: collapse;}
        .left {text-align: left;}
        .center {text-align: center;}
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
                <th rowspan="2" colspan="4">Recall, Mandatory Recall dan Voluntary Recall (Internal)</th>
                <th style='text-align:left;vertical-align:center;'>Revisi</th>
                <th style='text-align:left;vertical-align:center;'></th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:center;'>Halaman</th>
                <th style='text-align:left;vertical-align:center;'>
                    <div class="page-number">1</div>
                </th>
            </tr>
    </table>
    <table border="0" height="400px" width="100%" class="left">
        <thead>
            <tr>
                <th colspan="8" class="center">FORM RECALL</th>
            </tr>
            <tr>
                <th colspan="8" class="center">NO : <?php echo $data['nomor_form']; ?></th>
            </tr>
            <tr>
                <th width="110px"></th>
                <th width="150px">Nama Produk</th>
                <th width="10">:</th>
                <td style='vertical-align:center;'><?php echo $data['nama_produk']; ?></td>
            </tr>

            <tr>
                <th width="00px"></th>
                <th >Nomor Ijin Edar</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $data['nie']; ?></td>
            </tr>
            <tr>
                <th width="00px"></th>
                <th>Nomor Batch/LOT</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $data['batch_lot']; ?></td>
            </tr>
            <tr>
                <th width="00px"></th>
                <th >Total Recall</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $data['total_recall']; ?></td>
            </tr>
            <tr>
                <th width="00px"></th>
                <th>Alasan</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $data['alasan']; ?></td>
            </tr>
            <tr>
                <th width="00px"></th>
                <th>Hasil Inspeksi</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $data['hasil_inspeksi']; ?></td>
            </tr>
            <tr>
                <th width="00px"></th>
                <th>Tindakan</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $data['tindakan']; ?></td>
            </tr><tr>
                <th width="00px"></th>
                <th>Status</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $data['status']; ?></td>
            </tr>
        </thead>
    </table>
    <br><br><br>
    <table border="1" width="30%" rules="All" style="font-size:14px;">
        <tbody>
            <tr>
                <th colspan="2">Direktur,</th>
                <th colspan="2">Ketua Tim,</th>
            </tr>
            <tr>
                <th colspan="2" height="80px"></th>
                <th colspan="2" height="80px"></th>
            </tr>
    </table>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
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
                <th rowspan="2" colspan="4">Recall, Mandatory Recall dan Voluntary Recall (Internal)</th>
                <th style='text-align:left;vertical-align:center;'>Revisi</th>
                <th style='text-align:left;vertical-align:center;'></th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:center;'>Halaman</th>
                <th style='text-align:left;vertical-align:center;'>
                    <div class="page-number">2</div>
                </th>
            </tr>
    </table>
    <table border="0" height="150px" width="100%" class="left">
        <thead>
            <tr>
                <th colspan="8" class="center">TEAM RECALL</th>
            </tr>
            <tr>
                <th width="110px"></th>
                <th width="150px">Ketua Tim</th>
                <th width="10">:</th>
                <td style='vertical-align:center;'>Manager Operasional (<?php echo $data['ketua_tim']; ?>)</td>
            </tr>

            <tr>
                <th width="00px"></th>
                <th >Anggota</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'><?php echo $data['anggota']; ?></td>
            </tr>
            <tr>
                <th width="00px"></th>
                <th>Otorisasi</th>
                <th>:</th>
                <td colspan="4" style='vertical-align:center;'>Direktur (<?php echo $data['otorisasi']; ?>)</td>
            </tr>
        </thead>
    </table>
<script>
    window.onload = function() {
        window.print();
    };
</script>
</html>
