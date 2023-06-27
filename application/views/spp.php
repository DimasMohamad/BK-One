<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan Outstanding PR</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Purchasing</li>
                <li class="breadcrumb-item active">Laporan outstanding PR</li>
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
                                <div class="col-xl-2">
                                    <select id="dept" class="form-control"></select>
                                </div>
                                <div class="col-xl-4">
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

<!-- Trace PO -->
<div class="modal fade" id="trace_po" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Purchase Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <center>
                <div id="loading1" class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                </center>
                    <div id="tampilpo"></div>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->

<script>
    function trace_po(id){
        document.getElementById('loading1').style.display = '';
        document.getElementById("tampilpo").innerHTML = '';
        $("#trace_po").modal("show");
        $.get("<?= base_url('Purchasing/trace_po?po=') ?>"+id, function(data, status) {
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
                        table += '<th>No PO</th>';
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
                    document.getElementById('loading1').style.display = 'none';
                    document.getElementById("tampilpo").innerHTML = table;   
            }
        });
    }

    $(document).ready(function() {
        var table = $('#tblspp').DataTable({
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            paging:         true,
            searching:         true,
            fixedColumns:   {
                left: 2
            }
        });
        $.get("<?= base_url('Purchasing/dept') ?>", function(data, status) {
            $("#dept").html(data);
        });
    });

    function tampildata(){
        var mulai = $("#mulai").val();
        var hingga = $("#hingga").val();
        var dept = $("#dept").val();
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById('btnloading').style.display = '';
        $.get("<?= base_url('Purchasing/tb_spp?mulai=') ?>"+mulai+"&hingga="+hingga+"&dept="+dept, function(data, status) {
            document.getElementById('btntampil').style.display = '';
            document.getElementById('btnloading').style.display = 'none';
            $("#tampildataspp").html(data);
            var obj = $.parseJSON(data);
            if(status == 'success'){
                document.getElementById('btntampil').style.display = '';
                document.getElementById('btnloading').style.display = 'none';
                $("#tampildataspp").html(data);
                    $('#tblspp').DataTable({
                    scrollY:        'calc(100vh - 200px)',
                    scrollX:        true,
                    scrollCollapse: true,
                    paging:         true,
                    searching:      true,
                    autoWidth: false,
                    fixedColumns:   {
                        left: 2
                    },
                    });
                
            }
        });
    }


    function unduh(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        window.open("<?= base_url('Purchasing/tb_spp_xls?mulai=') ?>"+mulai+"&hingga="+hingga,"_self");
    }

    
</script>