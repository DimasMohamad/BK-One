<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>SPK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">PRODUCTION</li>
                <li class="breadcrumb-item active">SPK</li>
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
                                    

                                </div>
                                <div class="col-xl-12">
                                    <br>
                                    <div id="tampildataspk"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </section>
    
    
</main><!-- End #main -->

<!-- Trace spk -->
<div class="modal fade" id="f_trace_spk" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button class="btn btn-success btn-sm" onclick="cetakspk()"><i class="bi bi-download"></i>&nbsp;Unduh SPK</button>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idspk">                            
                <center>
                <div id="loading2" class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                </center>
                    <div id="tampildetailspk"></div>
            </div>
        </div>
    </div>
</div><!-- End Trace GRPO-->

<script>
    
    function tampildata(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        if(mulai == ''){
            pesan('tanggal mulai mohon diisi');
        }else{
            if(hingga == ''){
                pesan('tanggal hingga mohon diisi');
            }else{
                document.getElementById('btntampil').style.display = 'none';
                document.getElementById('btnloading').style.display = '';
                
                $.get("<?= base_url('ppic/tb_spk_list?s=') ?>"+mulai+"&e="+hingga, function(data, status) {
                    document.getElementById('btntampil').style.display = '';
                    document.getElementById('btnloading').style.display = 'none';
                    var obj = $.parseJSON(data);
                    var i = 1;
                    if(status == 'success'){
                        var table = '<table class="table table-sm table-bordered table-hover" style="font-size:14px;">'+
                            '<thead>'+
                            '<th>#</th>'+
                            '<th>Spk</th>'+
                            '<th>Spk Child</th>'+
                            '<th>No Prod</th>'+
                            '<th>Item Code</th>'+
                            '<th>Item Name</th>'+
                            '<th>Qty Order</th>'+
                            '<th>Qty Buffer</th>'+
                            '<th>Qty Prod</th>'+
                            '<th>Uom</th>'+
                            '<th>Status</th>'+
                            '<th>Start date</th>'+
                            '<th>End date</th>'+
                            '</th>'+
                            '</thead>'+
                            '<tbody>';
                    $.each(obj, function(key, row) {
                        table += '<tr>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+i+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['spk']+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['spk_detail']+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['production']+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['item_no']+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['DESCRIPTION']+'</td>';
                        table += '<td style="text-align:right;" onclick="detail('+row['id_spk']+')">'+Number(row['qty_order']).toFixed(4)+'</td>';
                        table += '<td style="text-align:right;" onclick="detail('+row['id_spk']+')">'+Number(row['qty_buffer']).toFixed(4)+'</td>';
                        table += '<td style="text-align:right;" onclick="detail('+row['id_spk']+')">'+Number(row['qty_prod']).toFixed(4)+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['uom']+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['STATUS']+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['start_date']+'</td>';
                        table += '<td onclick="detail('+row['id_spk']+')">'+row['end_date']+'</td>';
                        table += '</tr>';
                        i++;
                    });
                    table += '</tbody>'+
                             '</table>'; 
                    document.getElementById("tampildataspk").innerHTML = table;
                    document.getElementById('loading1').style.display = 'none';                      
                    }
                });                
            }
        }
    }

    function detail(id){        
        $("#idspk").val(id);
        $("#tampildetailspk").html('');
        document.getElementById('loading2').style.display = '';
        $.get("<?= base_url('ppic/tb_spk?spk=') ?>"+id, function(data, status) {
            document.getElementById('loading2').style.display = 'none';
            $("#tampildetailspk").html(data);             
        });        
        $("#f_trace_spk").modal("show");
    }

    $(document).ready(function () {
        $('#example').DataTable();
    });

    function unduh(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        if(mulai == ''){
            pesan('tanggal mulai mohon diisi');
        }else{
            if(hingga == ''){
                pesan('tanggal hingga mohon diisi');
            }else{
                window.open("<?= base_url('produksi/tb_outstanding_order_xls?mulai=')?>"+mulai+"&hingga="+hingga,"_self");
            }
        }
    }

    function pesan(txt){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'error',
        title: txt
        })
    }

    function cetakspk(){
        var id = $("#idspk").val();
        window.open("<?= base_url('ppic/tb_spk_xls?spk=') ?>"+id,"_self");
    }
</script>