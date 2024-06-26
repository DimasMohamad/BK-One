<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style type="text/css">
    @page {
        size: A4;
        margin: 1;
    }

    body {
        margin: 1;
    }

    .page-number:before {
        content: counter(page);
    }
</style>
<?php
$row = json_decode($data, true);
$pr = json_decode($datapr, true);
$namaDivisi = $this->input->get('divisi');
$periodebulan = $this->input->get('bulan');
$periodetahun = $this->input->get('tahun');
$bulanMap = [
    '1' => 'Januari',
    '2' => 'Februari',
    '3' => 'Maret',
    '4' => 'April',
    '5' => 'Mei',
    '6' => 'Juni',
    '7' => 'Juli',
    '8' => 'Agustus',
    '9' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
];
?>
<table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:13px;">
    <?php
    echo "<thead>
    <tr>
    <th style='text-align: center; vertical-align: middle;' rowspan='4'><img src=" . base_url('assets/img/bki.png') . " style='width:170px;height:50px;'></th>
    <th style='font-size: 18px; text-align: center; vertical-align: middle;' rowspan='2' colspan='8'>LAPORAN PENCAPAIAN SASARAN MUTU</th>
    <th colspan='1' style='text-align:left;vertical-align:top;'>No. Dokumen</th>
    <th colspan='2' style='text-align:left;vertical-align:top;'>BKI.FM.MR-02</th>        
    </tr>";
    echo "<tr>
    <th colspan='1' style='text-align:left;vertical-align:top;'>Tgl efektif</th>
    <th colspan='1' style='text-align:left;vertical-align:top;'>1 April 2021</th>
    </tr>";
    echo "<tr>
    <th style='text-align:left' colspan='8'>Periode&nbsp:&nbsp";
    if (isset($bulanMap[$periodebulan])) {
        echo $bulanMap[$periodebulan] . " $periodetahun";
    } else {
        echo "Bulan tidak valid";
    }
    echo "</th>
    <th colspan='1' style='text-align:left;vertical-align:top;'>Revisi</th>
    <th colspan='2' style='text-align:left;vertical-align:top;'>00</th>
    </tr>";
    echo "<tr>
    <th style='text-align:left' colspan='8'>Bagian&nbsp&nbsp&nbsp:&nbsp$namaDivisi</th>
    <th colspan='1' style='text-align:left;vertical-align:top;'>Halaman</th>
    <th colspan='2' style='text-align:left;vertical-align:top;'>-</th>
    </tr>";
    //echo "<tr><td colspan='11'>&nbsp;</td></tr>";
    ?>
    <table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:13px;">
        <thead>
            <tr>
                <th style='text-align: center; vertical-align: middle;' rowspan='2' width="10px">No.</th>
                <th style='text-align: center; vertical-align: middle;' rowspan='2'>Sasaran Mutu</th>
                <th width="150px" style='text-align: center; vertical-align: middle;' rowspan='2'>Target Sasatan Mutu</th>
                <th style='text-align: center; vertical-align: middle;' colspan='12'>Bulan</th>
            <tr>
                <th width="50px" style='text-align: center; vertical-align: middle;'>1</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>2</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>3</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>4</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>5</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>6</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>7</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>8</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>9</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>10</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>11</th>
                <th width="50px" style='text-align: center; vertical-align: middle;'>12</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($row['head'] as $h) {
                echo "<tr>";
                echo "<td style='text-align: center; vertical-align: middle;'>" . $i . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['nama_sasaran'] . "</td>";
                echo "<td style='vertical-align:top;'>" . $h['target_sasaran'] . "</td>";

                // Mendapatkan nilai untuk bulan yang dipilih
                $selectedBulan = $this->input->get('bulan');

                // Menambahkan perulangan untuk bulan-bulan sebelumnya dan bulan yang dipilih
                for ($bulan = 1; $bulan <= $selectedBulan; $bulan++) {
                    $nilaiBulan = '';
                    foreach ($pr['detail'] as $d) {
                        if ($h['id_sarmut'] == $d['id_sarmut'] && $d['bulan'] == $bulan) {
                            $nilaiBulan = $d['nilai'];
                            break;
                        }
                    }
                    echo "<td style='vertical-align:top;'>" . $nilaiBulan . "</td>";
                }

                echo "</tr>";
                $i++;
            }
            ?>

            <!--ISI GRAFIK-->
            <table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:13px;">
                <tr>
                    <td colspan="14">
                        <canvas id="myChart" width="800" height="100"></canvas>
                    </td>
                </tr>
                <script>
                    // Data grafik dari PHP
                    var dataJSON = <?php echo json_encode($pr); ?>;

                    // Inisialisasi objek untuk menyimpan data nilai per id_sarmut
                    var nilai_per_id_sarmut = {};

                    // Mengisi objek dengan data nilai per id_sarmut
                    dataJSON.detail.forEach(function(entry) {
                        var id_sarmut = entry.id_sarmut;
                        var bulan = parseInt(entry.bulan);
                        if (!nilai_per_id_sarmut[id_sarmut]) {
                            nilai_per_id_sarmut[id_sarmut] = {};
                        }
                        // Menyimpan nilai hanya jika bulan kurang dari atau sama dengan $periodebulan
                        if (bulan <= <?php echo $periodebulan; ?>) {
                            nilai_per_id_sarmut[id_sarmut][bulan] = parseInt(entry.nilai);
                        }
                    });

                    // Label bulan
                    var label_bulan = [];
                    for (var i = 1; i <= 12; i++) {
                        label_bulan.push(i);
                    }

                    // Inisialisasi chart
                    var ctx = document.getElementById('myChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: label_bulan,
                            datasets: []
                        },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });

                    // Menambahkan dataset untuk setiap id_sarmut
                    Object.keys(nilai_per_id_sarmut).forEach(function(id_sarmut, index) {
                        var data_nilai = [];
                        for (var i = 1; i <= 12; i++) {
                            // Menambahkan nilai yang ada, jika tidak ada, disisipkan nilai 0
                            data_nilai.push(nilai_per_id_sarmut[id_sarmut][i] || 0);
                        }

                        // Warna untuk dataset yang berbeda
                        var backgroundColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 0.2)';
                        var borderColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() * 256) + ', 1)';

                        // Menambahkan dataset ke chart
                        myChart.data.datasets.push({
                            label: 'Sarmut ' + (index + 1), // Menggunakan nomor urut atau indeks + 1 sebagai label
                            data: data_nilai,
                            backgroundColor: backgroundColor,
                            borderColor: borderColor,
                            borderWidth: 1
                        });
                    });

                    // Mengupdate chart
                    myChart.update();
                </script>
            </table>

        </tbody>
    </table>
    <table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:13px;">
        <thead>
            <tr>
                <th style='text-align: center; vertical-align: middle;' width="10px">No.</th>
                <th style='text-align: center; vertical-align: middle;'>Analisa Penyebab</th>
                <th style='text-align: center; vertical-align: middle;'>Tindakan Yang Telah Dilakukan</th>
                <th style='text-align: center; vertical-align: middle;'>Rencana Berikutnya</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $selectedBulan = $this->input->get('bulan');

            // Menampilkan Analisa, Tindakan, dan Rencana untuk bulan yang dipilih pada Tabel Kedua
            foreach ($pr['detail'] as $d) {
                if ($selectedBulan == $d['bulan']) {
                    echo "<tr>";
                    $angkaTerakhir = substr($d['id_sarmut'], -1);
                    echo "<td>$angkaTerakhir</td>";
                    echo "<td>{$d['analisa_penyebab']}</td>";
                    echo "<td>{$d['tindakan']}</td>";
                    echo "<td>{$d['rencana_selanjutnya']}</td>";
                    echo "</tr>";
                }
            }
            ?>
        </tbody>
    </table>
    <table class=" table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:13px;">
        <tbody>
            <tr>
                <th rowspan="3" width="1200px"></th>
                <th style='text-align: center; vertical-align: middle;' width="200px">Dibuat Oleh,</th>
                <th style='text-align: center; vertical-align: middle;' width="200px">Mengetahui,</th>
            </tr>
            <tr>
                <th style='text-align: center; vertical-align: middle;' height="80px"></th>
                <th style='text-align: center; vertical-align: middle;' height="80px"></th>
            </tr>
            <tr>
                <th style='text-align: center; vertical-align: middle;' height="28px"><?php echo $namaDivisi ?></th>
                <th style='text-align: center; vertical-align: middle;' height="28px">Management Representative</th>
            </tr>
        </tbody>
    </table>
</table>