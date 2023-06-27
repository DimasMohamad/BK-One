<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Barang Jadi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Produksi</li>
                <li class="breadcrumb-item active">BJ</li>
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
                                    <button class="btn btn-warning" onclick="preview()"><i class="bi bi-arrows-fullscreen"></i>&nbsp;Full Page</button>

                                </div>
                                <div class="col-xl-12">
                                    <br>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </section>
    <div id="tampildata"></div>
    
</main><!-- End #main -->

<!-- Trace GRPO -->
<div class="modal fade" id="f_trace_visit" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul_brg"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="kode_brg">
                <input type="hidden" id="tanggal">
                <center>
                <div id="loading2" class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                </center>
                    <div id="tampilbj"></div>
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
        
        $.get("<?= base_url('produksi/tb_outstanding_order?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
            document.getElementById('btntampil').style.display = '';
            document.getElementById('btnloading').style.display = 'none';
            
            $("#tampildata").html(data);
        });
    }


    function preview(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        window.open("<?= base_url('produksi/tb_outstanding_order_page?mulai=') ?>"+mulai+"&hingga="+hingga,"_blank");
    }

    function detail(id,tgl){
        document.getElementById('loading2').style.display = '';
        document.getElementById("tampilbj").innerHTML = '';
        $('#kode_brg').val(id);
        $('#judul_brg').html(id);
        $('#tgl_brg').html(tgl);
        $('#tanggal').val(tgl);
        $.get("<?= base_url('produksi/trace_bj?item=') ?>"+id+"&tgl="+tgl, function(data, status) {
            document.getElementById('loading2').style.display = 'none';
            var obj = $.parseJSON(data);
            if(status == 'success'){
                var table = '<table class="table table-sm table-bordered">'+
                            '<thead>'+
                            '<th>Date</th>'+
                            '<th>Item Name</th>'+
                            '<th>Warehouse</th>'+
                            '<th>Quantity</th>'+
                            '<th>Uom</th>'+
                            '<th>Remark</th>'+
                            '</thead>'+
                            '<tbody>';
                var ttl = 0;            
                $.each(obj, function(key, row) {
                    table += '<tr>';
                    table += '<td>'+row['DocDate']+'</td>';
                    table += '<td>'+row['Dscription']+'</td>';
                    table += '<td>'+row['WhsCode']+'</td>';
                    table += '<td style="text-align:right;">'+Number(row['Quantity']).toFixed(4)+'</td>';
                    table += '<td>'+row['UomCode']+'</td>';
                    table += '<td>'+row['Comments']+'</td>';
                    table += '</tr>';
                    ttl += parseInt(row['Quantity']);
                });
                table +='</tbody>';
                table +='<tfoot>';
                table +='<td colspan="3">Total</td>';
                table +='<td style="text-align:right;">'+Number(ttl).toFixed(4)+'</td>';
                table +='<td colspan="2"></td>';
                table +='</tfoot>';
                table +='</table>';
            }
            document.getElementById('loading2').style.display = 'none';
            document.getElementById("tampilbj").innerHTML = table;
        });
        $('#f_trace_visit').modal('show');
    }

    $(document).ready(function () {
        $('#example').DataTable();
    });

    function unduh(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        window.open("<?= base_url('produksi/tb_outstanding_order_xls?mulai=')?>"+mulai+"&hingga="+hingga,"_self");
    }
</script>