<?php
$row = json_decode($data, true);
$bulan = array(
    'January' => 'Januari',
    'February' => 'Februari',
    'March' => 'Maret',
    'April' => 'April',
    'May' => 'Mei',
    'June' => 'Juni',
    'July' => 'Juli',
    'August' => 'Agustus',
    'September' => 'September',
    'October' => 'Oktober',
    'November' => 'November',
    'December' => 'Desember'
);
if (!empty($row[0]['tgl'])) {
    // Mengonversi tanggal evaluasi ke format yang diinginkan
    $evaluasi_tgl = date("d F Y", strtotime($row[0]['tgl']));
    $evaluasi_tgl_indonesia = strtr($evaluasi_tgl, $bulan);
} else {
}

// Menentukan keterangan periode berdasarkan bulan evaluasi
if ($s = 1) {
    $periode = 'JANUARI-JUNI';
} elseif ($s = 2) {
    $periode = 'JULI-DESEMBER';
} else {
    $periode = 'Tidak valid';
}
?>
<table class="table table-bordered" width="100%" border="1" rules="all">
    <thead>
        <tr>
            <th style='text-align:center;vertical-align:top;' rowspan="5" colspan="2"><img src="<?= base_url('assets\img\bk.png') ?>" style="width:70px;height:50px;"></th>
            <th style='text-align:center;vertical-align:top;' rowspan="5" colspan="4">PT. BEAUTY KASATAMA INDONESIA<br>EVALUASI KINERJA SUPPLIER<br>PERIODE : <?= $periode ?></th>
        </tr>
        <tr>
            <th style='text-align:left;vertical-align:top;'>No. Dokumen</th>
            <th style='text-align:left;vertical-align:top;'>BKI.FM.PUR.05</th>
        </tr>
        <tr>
            <th style='text-align:left;vertical-align:top;'>Tanggal Efektif</th>
            <th style='text-align:left;vertical-align:top;'>29 Juni 2022</th>
        </tr>
        <tr>
            <th style='text-align:left;vertical-align:top;'>Revisi</th>
            <th style='text-align:left;vertical-align:top;'>2</th>
        </tr>
        <tr>
            <th style='text-align:left;vertical-align:top;'>Halaman</th>
            <th style='text-align:left;vertical-align:top;'>1</th>
        </tr>
        <tr>
            <th colspan="5" style='text-align:left;vertical-align:top;'>Supplier : <?= $supp['CardName']; ?></th>
            <th colspan="2" style='text-align:left;vertical-align:top;'>Material : <?= $row[0]['item']; ?></th><!--Item mengambil baris pertama dari data-->
            <th style='text-align:left;vertical-align:top;'>Tgl Evaluasi : <?php echo isset($evaluasi_tgl_indonesia) ? $evaluasi_tgl_indonesia : ''; ?></th>
        </tr>
        <tr>
            <th>No</th>
            <th>No. PO</th>
            <th>Mutu</th>
            <th>Pelayanan</th>
            <th>Kuantiti</th>
            <th>Total</th>
            <th colspan="2">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $totalSum = 0; // Inisialisasi total sum
        $totalRows = count($row); // Menghitung jumlah baris
        foreach ($row as $r) {
            echo "<tr>";
            echo "<td>" . $i . "</td>";
            echo "<td>" . $r['nopo'] . "</td>";
            echo "<td style='text-align:center;'>" . $r['n1'] . "</td>";
            echo "<td style='text-align:center;'>" . $r['n2'] . "</td>";
            echo "<td style='text-align:center;'>" . $r['n3'] . "</td>";
            echo "<td style='text-align:center;'>" . $r['total'] . "</td>";
            echo "<td colspan='2'>" . $r['keterangan'] . "</td>";
            echo "</tr>";
            $totalSum += $r['total']; // Menambahkan total ke total sum
            $i++;
        }
        // Menghitung rata-rata total
        $averageTotal = ($totalRows > 0) ? $totalSum / $totalRows : 0;
        $averageTotalFormatted = number_format($averageTotal, 2);
        ?>
        <tr>
            <th colspan="5" style="text-align:right;">Nilai Rata-rata :</th>
            <th colspan="3"><?php echo $averageTotalFormatted; ?></th>
        </tr>
        <tr>
            <!--Kesimpulan sudah ada dari data dengan nama "keputusan", disini diganti dengan logika if karena ada penambahan rata"-->
            <th colspan="5" style="text-align:right;">Kesimpulan :</th>
            <th colspan="3">
                <?php
                if ($averageTotalFormatted >= '8') {
                    echo "Terpilih sebagai supplier";
                } else {
                    echo "Tidak terpilih sebagai supplier";
                }
                ?>
            </th>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Dievaluasi oleh</th>
            <th colspan="2">Disetujui oleh</th>
            <th colspan="3">Stempel / Cap Perusahaan</th>
        </tr>
        <tr>
            <th colspan="3" height="80px"></th>
            <th colspan="2" height="80px"></th>
        </tr>
        <tr>
            <th colspan="3">Dyah P</th>
            <th colspan="2">Wawan Y</th>
        </tr>
        <tr>
            <th colspan="8" style='text-align:left;vertical-align:bottom;' height="60px">Keterangan :</th>
        </tr>
        <tr>
            <th width="35px">Nilai</th>
            <th colspan="2">Mutu</th>
            <th colspan="3">Pelayanan</th>
            <th colspan="2">Kuantiti</th>
        </tr>
        <tr>
            <td width="35px" style='text-align:center;'>4</td>
            <td colspan="2">Melebihi persyaratan yang diminta</td>
            <td colspan="3">Sangat Tanggap, Informasi sangat memuaskan, Respon Tepat Waktu</td>
            <td colspan="2">Pas Sesuai Pemintaan</td>
        </tr>
        <tr>
            <td width="35px" style='text-align:center;'>3</td>
            <td colspan="2">Sesuai permintaan yang diminta</td>
            <td colspan="3">Cepat Tanggap, Informasi sangat menjawab, Respon Tepat Waktu</td>
            <td colspan="2">Kelebihan atau Kekurangan < 5%</td>
        </tr>
        <tr>
            <td width="35px" style='text-align:center;'>2</td>
            <td colspan="2">Kurang sesuai permintaan yang diminta</td>
            <td colspan="3">Cukup Tanggap, Informasi Cukup Menjawab, Respon agak lambat</td>
            <td colspan="2">Kelebihan atau Kekurangan ≥ 5%</td>
        </tr>
        <tr>
            <td width="35px" style='text-align:center;'>1</td>
            <td colspan="2">Tidak sesuai persyaratan yang diminta</td>
            <td colspan="3">Kurang Tanggap, Informasi tidak cukup, Respon sangat lambat (≥48 Jam)</td>
            <td colspan="2">Kelebihan atau Kekurangan > 5%</td>
        </tr>
        <tr>
            <th colspan="8" style='text-align:left;'>Syarat : Nilai Minimal Supplier untuk ditetapkan sebagai Pemasok Terpilih adalah 8 (Delapan). Nilai Maksimal adalah 12.</th>
        </tr>
    </tfoot>
</table>