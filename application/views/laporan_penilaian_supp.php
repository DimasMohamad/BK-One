<table class="table table-bordered" width="100%" border="1" rules="all">
    <thead>
        <tr>
        <th style='text-align:center;vertical-align:top;' rowspan="5" colspan="2"><img src="<?= base_url('assets\img\bk.png')?>" style="width:70px;height:50px;"></th>
        <th style='text-align:center;vertical-align:top;' rowspan="5" colspan="4">PT. BEAUTY KASATAMA INDONESIA<br>EVALUASI KINERJA SUPPLIER</th>
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
        <th style='text-align:left;vertical-align:top;'>1</th>
        </tr>
        <tr>
        <th style='text-align:left;vertical-align:top;'>Halaman</th>
        <th style='text-align:left;vertical-align:top;'>1</th>
        </tr>
        <tr>
        <th colspan="6" style='text-align:left;vertical-align:top;'>Supplier : <?= $supp['CardName'];?></th>
        <th style='text-align:left;vertical-align:top;'>Material</th>
        <th style='text-align:left;vertical-align:top;'>Tgl Evaluasi</th>
        </tr>
        <tr>
        <th>No</th>
        <th>No. PO</th>
        <th>Mutu</th>
        <th>Pelayanan</th>
        <th>Kuantiti</th>
        <th>Total</th>
        <th>Keputusan</th>
        <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $row = json_decode($data,true);
        foreach($row as $r){
            echo"<tr>";
            echo"<td>".$i."</td>";
            echo"<td>".$r['nopo']."</td>";
            echo"<td style='text-align:center;'>".$r['n1']."</td>";
            echo"<td style='text-align:center;'>".$r['n2']."</td>";
            echo"<td style='text-align:center;'>".$r['n3']."</td>";
            echo"<td style='text-align:center;'>".$r['total']."</td>";
            echo"<td style='text-align:center;'>".$r['keputusan']."</td>";
            echo"<td>".$r['keterangan']."</td>";
            echo"</tr>";
            $i++;
        }
        ?>
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
        <th colspan="8" style='text-align:left;'>Syarat : Nilai Minimal Supplier untuk ditetapkan sebagai Pemasok Terpilih adalah 8 (Delapan)</th>
        </tr>
    </tfoot>
</table>