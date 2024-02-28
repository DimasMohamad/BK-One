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
<?php
$rowsHeader = array_keys($kriteria[0]);
$rowsHeaderDays = [];
$list_hari = [
    'Minggu',
    'Senin',
    'Selasa',
    'Rabu',
    'Kamis',
    'Jumat',
    'Sabtu'
];
foreach ($rowsHeader as $key => $header) {
    if ($header != 'rowid') $rowsHeaderDays[$key] = $list_hari[(int)date('w', strtotime($rowsHeader[$key]))];
}
$tabel = 1;
?>
<table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:15px;">
    <thead>
        <tr>
            <th style='text-align: center; vertical-align: middle;' rowspan='4'><img src="<?php echo base_url('assets/img/bki.png'); ?>" style='width:150px;height:45px;'></th>
            <th style='font-size: 18px; text-align: center; vertical-align: middle;' rowspan='4' width='320px'>KRITERIA PEMILIHAN SUPPLIER/OUTSOURCE</th>
            <th colspan='1' style='text-align:left;vertical-align:top;' width='100px'>No. Dokumen</th>
            <th style='text-align:left;vertical-align:top;'>BKI.FM.PUR.01</th>
        </tr>
        <tr>
            <th colspan='1' style='text-align:left;vertical-align:top;'>Tgl efektif</th>
            <th style='text-align:left;vertical-align:top;'>16 Desember 2022</th>
        </tr>
        <tr>
            <th colspan='1' style='text-align:left;vertical-align:top;'>Revisi</th>
            <th style='text-align:left;vertical-align:top;'>03</th>
        </tr>
        <tr>
            <th colspan='1' style='text-align:left;vertical-align:top;'>Halaman</th>
            <th style='text-align:left;vertical-align:top;'>-</th>
        </tr>
        <tr>
            <th colspan="2" style='text-align:left;vertical-align:top;'>Periode :</th>
            <th style='text-align:left;vertical-align:top;'>Material :</th>
        </tr>
    </thead>
</table>
<table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:15px;">
    <thead>
        <tr>
            <th>Supplier</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Tgl Seleksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($data as $dt) {
            echo "<tr>";
            echo "<td>" . $dt['id_supp'] . " - " . $dt['supp'] . "</td>";
            echo "<td>" . $dt['alamat'] . "</td>";
            echo "<td>" . $dt['telp'] . "</td>";
            echo "<td></td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>

<table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:15px;">
    <thead class="text-primary">
        <tr>
            <th rowspan="2" scope="col" style='text-align:center; vertical-align: middle;'>Kriteria Penilaian</th>
            <?php
            $colspan = count($rowsHeaderDays);
            echo "<th colspan='$colspan' scope='col' style='text-align:center;'>Bobot / Nilai Perusahaan</th>";
            ?>
        </tr>
        <tr>
            <?php
            $tabel = 0;
            foreach ($rowsHeaderDays as $key => $day) {
                echo "<th style='text-align:left;'>" . $rowsHeader[$key] . "</th>";
                $tabel++;
            }
            ?>
        </tr>
    </thead>

    <tbody>
        <tr>
            <?php
            foreach ($kriteria as $i) {
                $totalbj = 0;
                echo "<tr>";
                foreach ($rowsHeader as $key) {
                    echo "<td style='text-align:Left;vertical-align:top;'>" . $i[$key] . "</td>";
                }
                echo "</tr>";
            }
            ?>
        </tr>
        <tr>
            <th style='text-align: center; vertical-align: middle;'>Nilai Peringkat</th>
            <?php
            foreach ($datanilai as $key => $value) {
                $totalbj = 0;
                // Di sini, kita menggunakan kunci ($key) dari array asosiatif $datanilai
                // untuk mengakses nilai dari array tersebut
                echo "<th style='text-align:Left;vertical-align:top;'>" . $value . "</th>";
            }
            ?>
        </tr>
        <tr>
            <th colspan="4" style='text-align: left; height: 80px;'>Kesimpulan :</th>
        </tr>
        <tr>
            <th colspan="4" style='text-align: left; height: 80px;'>Catatan :</th>
        </tr>
        <tr>
            <th colspan="4" style='text-align: left; vertical-align: middle;'>Syarat dan Ketentuan : Nilai 70% dapat dipertimbangan sebagai Back Up Supplier. Jika Mencapai 60% akan masuk Tahap Percobaan atau Cadangan.</th>
        </tr>
    </tbody>
</table>

<table class=" table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:13px;">
    <tbody>
        <tr>
            <th style='text-align: center; vertical-align: middle;'>Dibuat Oleh,</th>
            <th style='text-align: center; vertical-align: middle;'>Disetujui oleh,</th>
            <th style='text-align: center; vertical-align: middle;'>Stempel / Cap Perusahaan,</th>
        </tr>
        <tr>
            <th style='text-align: center; vertical-align: middle;' height="80"></th>
            <th style='text-align: center; vertical-align: middle;' height="80"></th>
            <th rowspan="2" height="80"></th>
        </tr>
        <tr>
            <th style='text-align: center; vertical-align: middle;'>Staff Purchasing</th>
            <th style='text-align: center; vertical-align: middle;'>Head Purchasing</th>
        </tr>
    </tbody>
</table>

<script>
    window.onload = function() {
        window.print();
    };
</script>