<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<?php
$row = json_decode($data,true);
?>
<table id="tabel-data" class="table table-sm" style="font-size:14px;">
    <thead>
        <tr>
            <th width='40px' rowspan="2" style='vertical-align:middle;text-align:center;'>No</th>
            <th width='50px' rowspan="2" style='vertical-align:middle;text-align:center;'>Tanggal</th>
            <th width='50px' rowspan="2" style='vertical-align:middle;text-align:center;'>Nama</th>
            <th width='200px' rowspan="2" style='vertical-align:middle;text-align:center;'>Alamat</th>
            <th width='50px' rowspan="2" style='vertical-align:middle;text-align:center;'>Asal</th>
            <th colspan="5" style='vertical-align:top;text-align:center;'>Pemenuhan&nbsp;Persyaratan&nbsp;Mutu&nbsp;Produk</th>
            <th rowspan='2'></th>
            <th colspan="5" style='vertical-align:top;text-align:center;'>Kendala&nbsp;/&nbsp;Reliability</th>
            <th rowspan='2'></th>
            <th colspan="6" style='vertical-align:top;text-align:center;'>Responsivenes&nbsp;/&nbsp;Empathy</th>
        </tr>
        <tr>
            <th width='57px'>Kualitas Produk</th>
            <th width='18px'>Kebersihan Produk</th>
            <th width='70px'>Kualitas Kemasan</th>
            <th width='20px'>Kualitas Printing</th>
            <th width='20px'>Kebersihan Kemasan</th>
            <th width='20px'>Kesesuaian Jumlah Produk</th>
            <th width='20px'>Informasi Status Pesanan</th>
            <th width='20px'>Ketepatan Waktu Pengiriman</th>
            <th width='20px'>Kelengkapan Dokumen Pengiriman</th>
            <th width='20px'>Pengetahuan Salesman</th>
            <th width='20px'>Kemudahan Hubungi</th>
            <th width='20px'>Keramahan Sikap</th>
            <th width='20px'>Respon Dalam Penawaran</th>
            <th width='20px'>Respon Dalam Keluhan</th>
            <th width='20px'>Peran Technical Service</th>
            <th width='20px'>Saran dan Masukan</th>
        </tr>
        <!--<th>Contact Person</th>-->
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach($row['data'] as $h){
            //Nama field belum sesuai karena pengerjaan laporan klaim ditunda sampai data SAP dimasukkan
            echo"<tr>";
            echo"<td style='vertical-align:top;'>".$i."</td>";
            echo"<td style='vertical-align:top;'>".$h['tanggal']."</td>";
            echo"<td style='vertical-align:top;'>".$h['nama']."</td>";
            echo"<td style='vertical-align:top;'>".$h['alamat']."</td>";
            echo"<td style='vertical-align:top;'>".$h['asal']."</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['p1'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['p1'] == "2"){
                echo "Tidak Puas";
            }elseif($h['p1'] == "3"){
                echo "Cukup Puas";
            }elseif($h['p1'] == "4"){
                echo "Puas";
            }elseif($h['p1'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['p2'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['p2'] == "2"){
                echo "Tidak Puas";
            }elseif($h['p2'] == "3"){
                echo "Cukup Puas";
            }elseif($h['p2'] == "4"){
                echo "Puas";
            }elseif($h['p2'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['p3'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['p3'] == "2"){
                echo "Tidak Puas";
            }elseif($h['p3'] == "3"){
                echo "Cukup Puas";
            }elseif($h['p3'] == "4"){
                echo "Puas";
            }elseif($h['p3'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['p4'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['p4'] == "2"){
                echo "Tidak Puas";
            }elseif($h['p4'] == "3"){
                echo "Cukup Puas";
            }elseif($h['p4'] == "4"){
                echo "Puas";
            }elseif($h['p4'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['p5'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['p5'] == "2"){
                echo "Tidak Puas";
            }elseif($h['p5'] == "3"){
                echo "Cukup Puas";
            }elseif($h['p5'] == "4"){
                echo "Puas";
            }elseif($h['p5'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'></td>";
            echo"<td style='vertical-align:top;'>";
            if($h['k1'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['k1'] == "2"){
                echo "Tidak Puas";
            }elseif($h['k1'] == "3"){
                echo "Cukup Puas";
            }elseif($h['k1'] == "4"){
                echo "Puas";
            }elseif($h['k1'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['k2'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['k2'] == "2"){
                echo "Tidak Puas";
            }elseif($h['k2'] == "3"){
                echo "Cukup Puas";
            }elseif($h['k2'] == "4"){
                echo "Puas";
            }elseif($h['k2'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['k3'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['k3'] == "2"){
                echo "Tidak Puas";
            }elseif($h['k3'] == "3"){
                echo "Cukup Puas";
            }elseif($h['k3'] == "4"){
                echo "Puas";
            }elseif($h['k3'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['k4'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['k4'] == "2"){
                echo "Tidak Puas";
            }elseif($h['k4'] == "3"){
                echo "Cukup Puas";
            }elseif($h['k4'] == "4"){
                echo "Puas";
            }elseif($h['k4'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['k5'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['k5'] == "2"){
                echo "Tidak Puas";
            }elseif($h['k5'] == "3"){
                echo "Cukup Puas";
            }elseif($h['k5'] == "4"){
                echo "Puas";
            }elseif($h['k5'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'></td>";
            echo"<td style='vertical-align:top;'>";
            if($h['r1'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['r1'] == "2"){
                echo "Tidak Puas";
            }elseif($h['r1'] == "3"){
                echo "Cukup Puas";
            }elseif($h['r1'] == "4"){
                echo "Puas";
            }elseif($h['r1'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['r2'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['r2'] == "2"){
                echo "Tidak Puas";
            }elseif($h['r2'] == "3"){
                echo "Cukup Puas";
            }elseif($h['r2'] == "4"){
                echo "Puas";
            }elseif($h['r2'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['r3'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['r3'] == "2"){
                echo "Tidak Puas";
            }elseif($h['r3'] == "3"){
                echo "Cukup Puas";
            }elseif($h['r3'] == "4"){
                echo "Puas";
            }elseif($h['r3'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['r4'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['r4'] == "2"){
                echo "Tidak Puas";
            }elseif($h['r4'] == "3"){
                echo "Cukup Puas";
            }elseif($h['r4'] == "4"){
                echo "Puas";
            }elseif($h['r4'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>";
            if($h['r5'] == "1"){
                echo "Sangat Tidak Puas";
            }elseif($h['r5'] == "2"){
                echo "Tidak Puas";
            }elseif($h['r5'] == "3"){
                echo "Cukup Puas";
            }elseif($h['r5'] == "4"){
                echo "Puas";
            }elseif($h['r5'] == "5"){
                echo "Sangat Puas";
            }
            echo"</td>";
            echo"<td style='vertical-align:top;'>".$h['masukan']."</td>";
            echo"</tr>";
            $i++;
        }
        ?>
    </tbody>
</table>

<script>
    $('#tabel-data').DataTable({
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        searching:      true,
        autoWidth: false,
    });
</script>