<style type="text/css">
            @page {
              size: A4;
              margin: 1; 
            }

            body {
              margin: 1;
            }

            .page-number:before {
            content: counter(page);}
        </style>
<table class="table table-sm table-bordered" width="100%" border="1" rules="all" style="font-size:13px;">
    <?php
    foreach($data as $h){
        echo"<thead>
            <tr>
            <th rowspan='4'><img src=".base_url('assets/img/bk.png')." style='width:80px;height:50px;'></th>
            <th colspan='7'>PT.BEAUTY KASATAMA INDONESIA</th>
            <th colspan='1' style='text-align:left;vertical-align:top;'>No. Dokumen</th>
            <th colspan='2' style='text-align:left;vertical-align:top;'>BKI.FM.PPIC.02</th>        
            </tr>
            <tr>";
            if(isset($h['id_spk']) && isset($h['id_spk_detail'])){
                echo"<th rowspan='3' colspan='7'>Surat Perintah Kerja (Induk)</th>";
            }
            if(isset($h['id_spk']) && $h['id_spk_detail'] == ''){
                echo"<th rowspan='3' colspan='7'>Surat Perintah Kerja</th>";
            }            
            echo"</tr>
            <tr>
                <th colspan='1' style='text-align:left;vertical-align:top;'>Tgl efektif</th>
                <th colspan='2' style='text-align:left;vertical-align:top;'>01/02/2023</th>
            </tr>
            <tr>
                <th colspan='1' style='text-align:left;vertical-align:top;'>Revisi</th>
                <th colspan='2' style='text-align:left;vertical-align:top;'>01</th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:top;'>No SPK</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>".$h['spk']."</th>
            </tr>
            <tr>
                <th style='text-align:left;vertical-align:top;'>Nama produk</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>".$h['DESCRIPTION']."</th>
            </tr>
            <tr>
                <th style='text-align:left;'>Quantity</th>
                <th colspan='10' style='text-align:left;'>".number_format($h['qty_order'], 4, '.', ',')."&nbsp;".$h['uom']."</th>
            </tr>
            <tr>
                <th style='text-align:left;'>Date</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>".$h['start_date']." S/d ".$h['end_date']."</th>
            </tr>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Qty</th>
                <th>Uom</th>
                <th>PB</th>
                <th>PB Ulang</th>
                <th>Uom</th>
                <th>PB Ulang</th>
                <th>ST</th>
                <th>Uom</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($itemhead as $ih) {
            if($ih['id_spk'] == $h['id_spk']){
                echo"<tr>";
                echo"<td style='text-align:left;vertical-align:top;'>".$ih['item_no']."</td>";
                echo"<td style='text-align:left;vertical-align:top;'>".$ih['DESCRIPTION']."</td>";                
                echo"<td style='text-align:right;vertical-align:top;'>".number_format(($ih['qty']*$h['qty_order']), 4, '.', ',')."</td>";
                echo"<td style='text-align:left;vertical-align:top;'>".$ih['uom']."</td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"</tr>";
            }
        }
        echo"<tr><td colspan='11'>&nbsp;</td></tr>";
        echo"</tbody>";        
    }
    ?>    

<?php
    foreach($spkdetail as $spkdtl){
        if(isset($spkdtl['spk_detail'])){
            echo"<thead>
            <tr>
                <th style='text-align:left;'>No SPK</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>".$spkdtl['spk_detail']."</th>
            </tr>
            <tr>
                <th style='text-align:left;'>Nama produk</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>".$spkdtl['DESCRIPTION']."</th>
            </tr>
            <tr>
                <th style='text-align:left;'>Quantity</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>".number_format($spkdtl['qty_order'], 4, '.', ',')."&nbsp;".$h['uom']."</th>
            </tr>
            <tr>
                <th style='text-align:left;'>Date</th>
                <th colspan='10' style='text-align:left;vertical-align:top;'>".$spkdtl['start_date']." S/d ".$spkdtl['end_date']."</th>
            </tr>
            <tr>
                <th>Item Code</th>
                <th>Item Name</th>
                <th>Qty</th>
                <th>Uom</th>
                <th>PB</th>
                <th>PB Ulang</th>
                <th>Uom</th>
                <th>PB Ulang</th>
                <th>ST</th>
                <th>Uom</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>";
        foreach ($spkitem as $spkit) {
            if($spkit['id_spk'] == $spkdtl['id_spk_detail']){
                echo"<tr>";
                echo"<td style='text-align:left;vertical-align:top;'>".$spkit['item_no']."</td>";
                echo"<td style='text-align:left;vertical-align:top;'>".$spkit['DESCRIPTION']."</td>";                
                echo"<td style='text-align:right;vertical-align:top;'>".number_format(($spkit['qty']*$spkdtl['qty_order']), 4, '.', ',')."</td>";
                echo"<td style='text-align:left;vertical-align:top;'>".$spkit['uom']."</td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"<td></td>";
                echo"</tr>";
            }
        }
        echo"</tbody>";
        }
    }
    ?>
</table>
