<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan Outstanding PO</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Purchasing</li>
                <li class="breadcrumb-item active">Laporan outstanding PO</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row"> 
                                <div class="col-xl-3">
                                    <input type="date" id="mulai" class="form-control">
                                </div>
                                <div class="col-xl-3">
                                    <input type="date" id="hingga" class="form-control">
                                </div>
                                <div class="col-xl-5">
                                    <button class="btn btn-primary" onclick="tampildata()" id="btntampil"><i class="bi bi-search"></i>&nbsp;View</button>
                                    <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...</button>
                                    
                                    <button class="btn btn-success" onclick="unduh()"><i class="bi bi-download"></i>&nbsp;Download</button>

                                </div>
                                <div class="col-xl-12">
                                    <br>
                                    <div id="tampildataspp"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Trace GRPO -->
<div class="modal fade" id="trace_grpo" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Goods Receipt Purchase Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <center>
                <div id="loading2" class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                </center>
                    <div id="tampilgrpo"></div>
            </div>
        </div>
    </div>
</div><!-- End Trace GRPO-->

<script>
    

    function tampildata(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById('btnloading').style.display = '';
        
        $.get("<?= base_url('Purchasing/tb_outstanding_po?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
            document.getElementById('btntampil').style.display = '';
            document.getElementById('btnloading').style.display = 'none';
            
            $("#tampildataspp").html(data);
        });
    }


    function unduh(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        window.open("<?= base_url('Purchasing/tb_outstanding_po_xls?mulai=') ?>"+mulai+"&hingga="+hingga,"_self");
    }

    function trace_grpo(id){
        document.getElementById('loading2').style.display = '';
        document.getElementById("tampilgrpo").innerHTML = '';
        $("#trace_grpo").modal("show");
        $.get("<?= base_url('Purchasing/trace_grpo?grpo=') ?>"+id, function(data, status) {
            var obj = $.parseJSON(data);
            if(status == 'success'){
                var table = '<table class="table table-sm table-bordered" style="font-size:13px;">'+
                        '<thead>';
                    $.each(obj['head'], function(key, row) {
                        table += '<tr>';
                        table += '<th>Vendor</th>';
                        table += '<th colspan="5">'+row['CardName']+'</th>';
                        table += '</tr>';
                        table += '<tr>';
                        table += '<th>No GRPO</th>';
                        table += '<th colspan="5">'+row['DocNum']+'</th>';
                        table += '</tr>';
                        table += '<tr>';
                        table += '<th>Posting Date</th>';
                        table += '<th colspan="5">'+row['Posting_date']+'</th>';
                        table += '</tr>';
                    });
                    table += '<tr>'+
                        '<th>Item Code</th>'+
                        '<th>Item Description</th>'+
                        '<th>Warehouse</th>'+
                        '<th>Qty</th>'+
                        '<th>Uom</th>'+
                        '<th>Free Text</th>'+
                        '</tr></thead><tbody>';
                    $.each(obj['detail'], function(key, row) {
                        table += '<tr>';
                        table += '<td>'+row['ItemCode']+'</td>';
                        table += '<td>'+row['Dscription']+'</td>';
                        table += '<td>'+row['WhsCode']+'</td>';
                        table += '<td style="text-align:right;">'+Number(row['Quantity']).toFixed(4)+'</td>';
                        table += '<td>'+row['UomCode']+'</td>';
                        table += '<td>'+row['FreeTxt']+'</td>';
                        table += '</tr>';
                    });
                    table += '</tbody></table>'; 
                    document.getElementById('loading2').style.display = 'none';
                    document.getElementById("tampilgrpo").innerHTML = table;   
            }
        });
    }
    
</script>