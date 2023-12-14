<?php
$row = json_decode($data, true);
$pr5 = json_decode($datapr5, true);
?>
<hr>
<table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:13px;">
    <thead>
        <tr>
            <th style='text-align: center; vertical-align: middle;' width="10px">No.</th>
            <th style='text-align: center; vertical-align: middle;'>Sasaran Mutu</th>
            <th width="150px" style='text-align: center; vertical-align: middle;' rowspan='2'>Target Sasatan Mutu</th>
            <th style='text-align: center; vertical-align: middle;'>Nilai</th>
            <th style='text-align: center; vertical-align: middle;'>Analisa Penyebab</th>
            <th style='text-align: center; vertical-align: middle;'>Tindakan Yang Akan Dilakukan</th>
            <th style='text-align: center; vertical-align: middle;'>Rencana Berikutnya</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($row['detail'] as $h) {
            echo "<tr>";
            echo "<td><input type='hidden' name='id_sarmut[]' value='" . $h['id_sarmut'] . "'>" . $i . "</td>";
            echo "<td id='nama_sasaran' name='nama_sasaran[]' style='vertical-align:top;'>" . $h['nama_sasaran'] . "</td>";
            echo "<td id='target_sasaran' name='target_sasaran[]' style='vertical-align:top;'>" . $h['target_sasaran'] . "</td>";
            foreach ($pr5['pur5'] as $d) {
                if ($h['id_sarmut'] == "pur5") {
                    $nilaiBulan = $d['Persentase'];
                    echo "<td><input type='text' class='form-control' id='nilai' name='nilai[]' value='" . $nilaiBulan . "%' readonly></td>";
                } else {
                    echo "<td><input type='text' class='form-control' id='nilai' name='nilai[]' placeholder='-' required></td>";
                }
            }
            echo "<td><textarea class='form-control' id='analisa_penyebab' name='analisa_penyebab[]' rows='4' style='width: 100%;'></textarea></td>";
            echo "<td><textarea class='form-control' id='tindakan_dilakukan' name='tindakan_dilakukan[]' rows='4' style='width: 100%;'></textarea></td>";
            echo "<td><textarea class='form-control' id='rencana_berikutnya' name='rencana_berikutnya[]' rows='4' style='width: 100%;'></textarea></td>";
            echo "</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>

<script>
    $("#f_upld").on("submit", function(e) {
        e.preventDefault();

        var id_sarmut = $("#id_sarmut").val();
        var nilai = $("#nilai").val();
        var filter_bulan1 = $("#filter_bulan1").val();
        var filter_tahun1 = $("#filter_tahun1").val();
        var analisa = $("#analisa_penyebab").val();
        var tindakan = $("#tindakan_dilakukan").val();
        var rencana = $("#rencana_berikutnya").val();

        if (filter_bulan1 === "0" || filter_tahun1 === "0") {
            pesan('Harap isi Bulan dan Tahun sebelum mengupload.');
        } else {
            $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data == 1) {
                        pesan('Upload gagal');
                    } else {
                        $("#f_upload_bt").modal("hide");
                        $("#upload_dokumen").modal("hide");
                        pesan_sukses('Halah');
                        setTimeout(function() {
                            location.reload();
                        }, 500);
                    }
                }
            });
        }
    });
</script>