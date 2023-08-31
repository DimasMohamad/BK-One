<?php
$row = json_decode($data, true);
$pr = json_decode($datapr, true);
$s = $_GET['s']; // Ambil nilai parameter s dari URL
$t = $_GET['t']; // Ambil nilai parameter t dari URL
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
    <table id="nilai" border="1" width="100%" rules="All" style="font-size:14px;">
        <thead>
            <tr>
            <th colspan="20" style='vertical-align:middle;text-align:center;'>PENILAIAN SURVEY KEPUASAN PELANGGAN BKI <br>PERIODE : 
            <?php
                if ($s == '1') {
                    echo "JANUARI - JUNI";
                }elseif ($s == '2') {
                    echo "JULI - DESEMBER";
                }
                echo " ".$t;
            ?>
            </th>
            </tr>
            <tr>
                <th width='40px' rowspan="2" style='vertical-align:middle;text-align:center;'>NO</th>
                <th width='50px' rowspan="2" style='vertical-align:middle;text-align:center;'>NAMA</th>
                <th width='200px' rowspan="2" style='vertical-align:middle;text-align:center;'>ALAMAT</th>
                <th width='50px' rowspan="2" style='vertical-align:middle;text-align:center;'>ASAL</th>
                <th width='200px' colspan="5" style='vertical-align:top;text-align:center;'>PEMENUHAN&nbsp;PERSYARATAN&nbsp;MUTU&nbsp;PRODUK</th>
                <th width='200px' colspan="5" style='vertical-align:top;text-align:center;'>KENDALA&nbsp;/&nbsp;RELIABILITY</th>
                <th width='200px' colspan="5" style='vertical-align:top;text-align:center;'>RESPONSIVENES&nbsp;/&nbsp;EMPATHY</th>
                <th width='40px' rowspan="2" style='vertical-align:middle;text-align:center;'>NILAI</th>
            </tr>
            <tr>
                <th width='10px'>P1</th>
                <th width='10px'>P2</th>
                <th width='10px'>P3</th>
                <th width='10px'>P4</th>
                <th width='10px'>P5</th>
                <th width='10px'>P6</th>
                <th width='10px'>P7</th>
                <th width='10px'>P8</th>
                <th width='10px'>P9</th>
                <th width='10px'>P10</th>
                <th width='10px'>P11</th>
                <th width='10px'>P12</th>
                <th width='10px'>P13</th>
                <th width='10px'>P14</th>
                <th width='10px'>P15</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
            foreach($row['data'] as $h){
                //Nama field belum sesuai karena pengerjaan laporan klaim ditunda sampai data SAP dimasukkan
                echo"<tr>";
                echo"<td style='vertical-align:top;'>".$i."</td>";
                echo"<td style='vertical-align:top;'>".$h['nama']."</td>";
                echo"<td style='vertical-align:top;'>".$h['alamat']."</td>";
                echo"<td style='vertical-align:top;'>".$h['asal']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['p1']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['p2']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['p3']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['p4']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['p5']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['k1']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['k2']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['k3']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['k4']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['k5']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['r1']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['r2']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['r3']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['r4']."</td>";
                echo"<td style='vertical-align:top;text-align:center;'>".$h['r5']."</td>";
                echo"<th style='vertical-align:top;'>";
                $rata_p1 = $h['p1'];
                $rata_p2 = $h['p2'];
                $rata_p3 = $h['p3'];
                $rata_p4 = $h['p4'];
                $rata_p5 = $h['p5'];

                $rata_k1 = $h['k1'];
                $rata_k2 = $h['k2'];
                $rata_k3 = $h['k3'];
                $rata_k4 = $h['k4'];
                $rata_k5 = $h['k5'];

                $rata_r1 = $h['r1'];
                $rata_r2 = $h['r2'];
                $rata_r3 = $h['r3'];
                $rata_r4 = $h['r4'];
                $rata_r5 = $h['r5'];

                // Menjumlahkan nilai rata_p1 sampai rata_r5
                $total = ($rata_p1 + $rata_p2 + $rata_p3 + $rata_p4 + $rata_p5 +
                        $rata_k1 + $rata_k2 + $rata_k3 + $rata_k4 + $rata_k5 +
                        $rata_r1 + $rata_r2 + $rata_r3 + $rata_r4 + $rata_r5)/15;

                echo number_format($total, 2);
                echo"</th>";
                echo"</tr>";
                $i++;
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <th width='40px' colspan="4" style='vertical-align:middle;text-align:center;'>Rata-rata / Pertanyaan</th>
                <?php
                foreach ($pr['perhitungan'] as $p) {
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_p1'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_p2'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_p3'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_p4'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_p5'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_k1'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_k2'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_k3'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_k4'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_k5'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_r1'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_r2'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_r3'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_r4'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>".number_format($p['rata_r5'], 2)."</th>";
                    echo"<th style='vertical-align:top;'>";
                    $rata_p1 = $p['rata_p1'];
                    $rata_p2 = $p['rata_p2'];
                    $rata_p3 = $p['rata_p3'];
                    $rata_p4 = $p['rata_p4'];
                    $rata_p5 = $p['rata_p5'];

                    $rata_k1 = $p['rata_k1'];
                    $rata_k2 = $p['rata_k2'];
                    $rata_k3 = $p['rata_k3'];
                    $rata_k4 = $p['rata_k4'];
                    $rata_k5 = $p['rata_k5'];

                    $rata_r1 = $p['rata_r1'];
                    $rata_r2 = $p['rata_r2'];
                    $rata_r3 = $p['rata_r3'];
                    $rata_r4 = $p['rata_r4'];
                    $rata_r5 = $p['rata_r5'];

                    // Menjumlahkan nilai rata_p1 sampai rata_r5
                    $total = ($rata_p1 + $rata_p2 + $rata_p3 + $rata_p4 + $rata_p5 +
                            $rata_k1 + $rata_k2 + $rata_k3 + $rata_k4 + $rata_k5 +
                            $rata_r1 + $rata_r2 + $rata_r3 + $rata_r4 + $rata_r5)/15;

                    echo number_format($total, 2);;
                    echo"</th>";
                }
                ?>
            </tr>
            <tr>
                <th width='40px' colspan="4" style='vertical-align:middle;text-align:center;'>Rata-rata / Dimensi</th>
                <?php
                foreach ($pr['perhitungan'] as $p) {
                    echo"<th colspan='5' style='vertical-align:top;text-align:center;'>".number_format($p['rata_dimensiP'], 2)."</th>";
                    echo"<th colspan='5' style='vertical-align:top;text-align:center;'>".number_format($p['rata_dimensiK'], 2)."</th>";
                    echo"<th colspan='5' style='vertical-align:top;text-align:center;'>".number_format($p['rata_dimensiR'], 2)."</th>";
                    echo"<th colspan='5' style='vertical-align:top;text-align:center;'>";
                    $rata_p1 = $p['rata_dimensiP'];
                    $rata_p2 = $p['rata_dimensiK'];
                    $rata_p3 = $p['rata_dimensiR'];
                    // Menjumlahkan nilai rata_p1 sampai rata_r5
                    $total = ($rata_p1 + $rata_p2 + $rata_p3)/3;
                    echo number_format($total, 2);;
                    echo"</th>";
                }
                ?>
            </tr>
        </tfoot>
    </table>
</body>
<script>
    window.onload = function() {
        window.print();
    };
</script>
</html>
