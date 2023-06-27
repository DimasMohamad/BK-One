<style>
    body {
        margin: 0 auto;
        padding: 0px;

        width: 100%;
        font-family: "Myriad Pro", "Helvetica Neue", Helvetica, Arial, Sans-Serif;
    }

    #wrapper {
        margin: 0 auto;
        padding: 0px;
        text-align: center;
        width: 995px;
    }

    #wrapper h1 {
        margin-top: 50px;
        font-size: 45px;
        color: #585858;
    }

    #wrapper h1 p {
        font-size: 20px;
    }

    #table_detail {
        width: 500px;
        text-align: left;
        border-collapse: collapse;
        color: #2E2E2E;
        border: #A4A4A4;
        width: 100%;
    }

    #table_detail tr:hover {
        background-color: #F2F2F2;
    }

    #table_detail .hidden_row {
        display: none;
    }
</style>
<table class="table table-sm" id="table_detail" style='font-size:13px;'>
    <thead>
        <th width="50px"></th>
        <th width="35px">#</th>
        <th width="120px" style='text-align:center;'>Date</th>
        <th width="210px" style='text-align:center;'>Customer Ref. No.</th>
        <th colspan="1">Customer</th>
        <th width="120px" style="text-align:center;" colspan="2">Total SO</th>
    </thead>
    <tbody>
        <?php
        $i = 1;
        $total = 0;
        $row = json_decode($data, true);
        foreach ($row['so_head'] as $p) {
            echo "<tr>";
            echo '<td width="35px" style="text-align:center;cursor: pointer;"><i class="bi bi-search" onclick="show_hide_row(' . "'hidden_row" . $i . "'" . ');"></i></td>';
            echo "<td>" . $p['nmr'] . "</td>";
            echo "<td>" . $p['tgl'] . "</td>";
            echo "<td>" . $p['NumAtCard'] . "</td>";
            echo "<td colspan='1'>" . $p['CardName'] . "</td>";
            echo "<td style='text-align:right;' width='150px'>".$p['DocCur'] . "&nbsp;" . number_format($p['DocTotal'], 2, '.', ',') . "</td>";
            echo "</tr>";
            echo '<tr id="hidden_row' . $i . '" class="hidden_row">';
            echo "<td colspan=6>"; // tabel detail
            echo "<table width='100%' rules='rows' style='font-size:13px;'>";
            echo "<th style='text-align:left;' width='210px'>Item Code</th>";
            echo "<th style='text-align:left;'>Item Description</th>";
            echo "<th style='text-align:center;' width='100px'>Qty</th>";
            echo "<th style='text-align:center;' width='100px'>Unit Price</th>";
            echo "<th style='text-align:center;' width='100px'>Total</th>";
            $n = 1;
            foreach ($row['so_detail'] as $b) {
                if ($p['DocEntry'] == $b['DocEntry']) {
                    echo "<tr>";
                    //echo "<td><b>" . $i . ".</b>&nbsp;" . $n . "</td>";
                    echo "<td>" . $b['ItemCode'] . "</td>";
                    echo "<td style='text-align:left;'>" . $b['Dscription'] . "</td>";
                    echo "<td style='text-align:right;'>" . number_format($b['Quantity'], 2, '.', ',') ."&nbsp;" .$b['UomCode'] ."</td>";
                    echo "<td style='text-align:right;' width='100px'>" . $b['Currency'] . "&nbsp;". number_format($b['Price'], 2, '.', ',') . "</td>";
                    echo "<td style='text-align:right;' width='150px'>" . $b['Currency'] . "&nbsp;" . number_format($b['GTotal'], 2, '.', ',') . "</td>";
                    echo "</tr>";
                    $n++;
                }
            }
            echo "</table>";
            echo "</td>";
            echo "</tr>";
            $i++;
            $total += $b['GTotal'];
        }
        ?>
    </tbody>
    <tfoot>
        <td colspan="5" style="text-align:center;"><b>TOTAL SO</b></td>
        <td style='text-align:right;'><b><?= number_format($total_so['total_so'], 2, '.', ',');?></b></td>
    </tfoot>
</table>
<div class="pagination" style="float:right;">
    <?php echo $page; ?>
</div>
<script>
    function show_hide_row(row) {
        $("#" + row).toggle();
    }
</script>