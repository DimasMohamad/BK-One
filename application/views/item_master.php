<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Item Master Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Inventory</li>
                <li class="breadcrumb-item active">Item master data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                                <div class="col-xl-12">
                                    <br>
                                    <table class="table">
                                        <th>#</th>
                                        <th>Item&nbsp;Code</th>
                                        <th>Item&nbsp;Name</th>
                                        <th>Item&nbsp;Group</th>
                                        <th>UoM&nbsp;Code</th>
                                        <th>UoM&nbsp;Group</th>
                                        <th>Valid</th>
                                        <th>Inv&nbsp;Item</th>
                                        <th>Sales&nbsp;Item</th>
                                        <th>Purc&nbsp;Item</th>
                                    <?php
                                    $i = 1;
                                    $row = json_decode($data,true);
                                    foreach($row as $r){
                                        echo"<tr>";
                                        echo"<td>".$i."</td>";
                                        echo"<td>".$r['ItemCode']."</td>";
                                        echo"<td>".$r['ItemName']."</td>";
                                        echo"<td>".$r['ItmsGrpNam']."</td>";
                                        echo"<td>".$r['InvntryUom']."</td>";
                                        echo"<td>".$r['UgpCode']."</td>";
                                        echo"<td>".$r['validFor']."</td>";
                                        echo"<td>".$r['InvntItem']."</td>";
                                        echo"<td>".$r['SellItem']."</td>";
                                        echo"<td>".$r['PrchseItem']."</td>";
                                        echo"</tr>";
                                        $i++;
                                    }
                                    ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</main><!-- End #main -->

<script type="text/javascript">
    $(document).ready(function() {
        
    });
</script>