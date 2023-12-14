<table class="table table-sm table-bordered">
    <thead>
        <th width="45px">#</th>
        <th width="200px">Item Code</th>
        <th>Item Name</th>
        <th>Foreign Name</th>
        <th>Item Group</th>
        <th>UoM Group</th>
        <th>Valid</th>
        <th>Inv Item</th>
        <th>Sls Item</th>
        <th>Purc Item</th>
        <th>Warehouse</th>
        <th>Qty on whse</th>
        <th width="100px" style='text-align:center;'>Total Qty</th>
        <!--<th width="60px">UoM</th>-->
    </thead>
    <tbody>
        <?php
        $row = json_decode($data, true);
        foreach ($row['stok'] as $r) {
            echo "<tr>";
            echo "<td>" . $r['row'] . "</b></td>";
            echo "<td>" . $r['ItemCode'] . "</b></td>";
            echo "<td>" . $r['ItemName'] . "</b></td>";
            echo "<td>" . $r['FrgnName'] . "</b></td>";
            echo "<td>" . $r['ItmsGrpNam'] . "</b></td>";
            echo "<td>" . $r['UgpCode'] . "</b></td>";
            if ($r['validFor'] == 'Y') {
                echo "<td style='text-align:center;'><i class='bi bi-check-circle' style='color:blue;'></i></td>";
            } else {
                echo "<td style='text-align:center;'><i class='bi bi-x-circle' style='color:red;'></i></td>";
            }
            if ($r['InvntItem'] == 'Y') {
                echo "<td style='text-align:center;'><i class='bi bi-check-circle' style='color:blue;'></i></td>";
            } else {
                echo "<td style='text-align:center;'><i class='bi bi-x-circle' style='color:red;'></i></td>";
            }
            if ($r['SellItem'] == 'Y') {
                echo "<td style='text-align:center;'><i class='bi bi-check-circle' style='color:blue;'></i></td>";
            } else {
                echo "<td style='text-align:center;'><i class='bi bi-x-circle' style='color:red;'></i></td>";
            }
            if ($r['PrchseItem'] == 'Y') {
                echo "<td style='text-align:center;'><i class='bi bi-check-circle' style='color:blue;'></i></td>";
            } else {
                echo "<td style='text-align:center;'><i class='bi bi-x-circle' style='color:red;'></i></td>";
            }
            echo "<td>";
            foreach ($row['dtl'] as $d) {
                if ($d['ItemCode'] == $r['ItemCode']) {
                    echo $d['WhsCode'];
                    echo "<br>";
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>";
            foreach ($row['dtl'] as $d) {
                if ($d['ItemCode'] == $r['ItemCode']) {
                    echo number_format($d['OnHand'], 2, '.', ',');
                    echo "<br>";
                }
            }
            echo "</td>";
            echo "<td style='text-align:right;'>" . number_format($r['OnHand'], 2, '.', ',') . "</b></td>";
            //echo "<td>" . $r['InvntryUom'] . "</b></td>";
        }
        ?>
    </tbody>
</table>
<div class="pagination justify-content-end">
    <?php echo $page; ?>
</div>