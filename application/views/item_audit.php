<main id="main" class="main">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- EasyUI -->

<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
<script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>

    <div class="pagetitle">
        <h1>REKAP MUTASI STOK</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Inventory</li>
                <li class="breadcrumb-item active">Mutasi Stok</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">     
                            <div class="col-xl-1">
                                <label class="col-sm-12 col-form-label">Month</label>
                            </div>
                            <div class="col-xl-3">
                                <input type="text" id="periode" class="form-control">
                            </div>
                            <div class="col-xl-4">
                                <button class="btn btn-primary" onclick="tampildata()" id="btntampil"><i class="bi bi-search"></i>&nbsp;View</button>
                                <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...</button>
                                <button class="btn btn-success" onclick="unduh()"><i class="bi bi-download"></i>&nbsp;Download</button>
                            </div>        
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-xl-12">
                                    <div id="tampildata"></div>
                                    
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- kartu stok -->
<div class="modal fade" id="trace" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                
                <h5 class="modal-title" id="t_namabrg">Kartu Stok</h5>
        
                <input type="hidden" id="itemcode">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!--
                    <div id="tampildetail"></div>
-->
                <table id="dg" style="width:100%;height:100%"
                    url="" 
                    data-options="method:'get',showHeader:false,toolbar:'#tb'"
                    title="Kartu Stok"
                    noheader="true"
                    singleSelect="true" fitColumns="true">
                    <thead>
                        <tr>
                            <th field="Warehouse" width="100%">Warehouse</th>
                        </tr>
                    </thead>
                </table>
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="buka_semua()">Expand All</button>
                <button class="btn btn-warning" onclick="tutup_semua()">Collapse All</button>
                <!--
                <button class="btn btn-success" onclick="unduh_detail()">Download</button>
-->
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div><!-- End Basic Modal-->

<!-- konversi -->
<div class="modal fade" id="konversi" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konversi Stok</h5>
                <input type="hidden" id="itemcode">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="tampilkonversi"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End konversi-->

<script type="text/javascript">
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    function tampildata(){
        var periode = $("#periode").val();
        //load();
        if(periode == ''){
            error_msg('Please fill month period');
        }else{
            document.getElementById('btntampil').style.display = 'none';
            document.getElementById('btnloading').style.display = '';
            $.get("<?= base_url('Whse/tb_item_audit?periode=') ?>"+periode, function(data, status) {
                $("#tampildata").html(data);
                if(status == 'success'){
                    //swal.close();
                    document.getElementById('btntampil').style.display = '';
                    document.getElementById('btnloading').style.display = 'none';
                }
            });
        }
        
       /*
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });

        $.get("<?= base_url('Whse/tb_item_audit?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
            var obj = $.parseJSON(data);
            var table = '<table id="tabel-data" class="table table-sm table-hover" width="100%" cellspacing="0" style="font-size:12px;">'+
                        '<thead>'+
                        '<th>Item Code</th>'+
                        '<th>Item Name</th>'+
                        '<th>UoM</th>'+
                        '<th>WHSE</th>'+
                        '<th>S.Awal</th>'+
                        '<th>IM(IT)</th>'+
                        '<th>SO(GI)</th>'+
                        '<th>SI(GR)</th>'+
                        '<th>DP(GRPO)</th>'+
                        '<th>S.Akhir</th>'+
                        '</thead><tbody>';
            var obj = $.parseJSON(data);
            $.each(obj['head'], function(key, head) {
                table += '<tr>';
                table += '<td style="cursor:pointer;" onclick="detail(\''+head['ItemCode']+'\')">' + head['ItemCode'] + '</td>';
                table += '<td style="cursor:pointer;" onclick="detail(\''+head['ItemCode']+'\')">' + head['ItemName'] + '</td>';
                table += '<td>' + head['InvntryUom'] + '</td>';
                //whse
                table += '<td>';
                $.each(obj['item'], function(key, detail) {
                    if(head['ItemCode'] == detail['ItemCode']){
                        table += detail['Warehouse']+'<br>';
                    }
                });
                table += '</td>';
                //saldo awal
                table += '<td style="text-align:right;">';
                $.each(obj['item'], function(key, detail) {
                    if(head['ItemCode'] == detail['ItemCode']){
                        table += Number(detail['saldo_awal']).toFixed(4)+'<br>';
                    }
                });
                table += '</td>';
                //IM IT
                table += '<td style="text-align:right;">';
                $.each(obj['item'], function(key, detail) {
                    if(head['ItemCode'] == detail['ItemCode']){
                        table += detail['IM_(IT)']+'<br>';
                    }
                });
                table += '</td>';
                //SO GI
                table += '<td style="text-align:right;">';
                $.each(obj['item'], function(key, detail) {
                    if(head['ItemCode'] == detail['ItemCode']){
                        table += detail['SO_(GI)']+'<br>';
                    }
                });
                table += '</td>';
                //SI GR
                table += '<td style="text-align:right;">';
                $.each(obj['item'], function(key, detail) {
                    if(head['ItemCode'] == detail['ItemCode']){
                        table += detail['SI_(GR)']+'<br>';
                    }
                });
                table += '</td>';
                //DP GRPO
                table += '<td style="text-align:right;">';
                $.each(obj['item'], function(key, detail) {
                    if(head['ItemCode'] == detail['ItemCode']){
                        table += detail['DP_(GRPO)']+'<br>';
                    }
                });
                table += '</td>';
                //S Akhir
                table += '<td style="text-align:right;">';
                $.each(obj['item'], function(key, detail) {
                    if(head['ItemCode'] == detail['ItemCode']){
                        table += detail['saldo_akhir']+'<br>';
                    }
                });
                table += '</td>';
                table += '</tr>';
            });
            table += '</tbody></table>';
            document.getElementById("tampildata").innerHTML = table;
            $('#tabel-data').DataTable();
        });
        */
    }

    function unduh(){
        var periode = $("#periode").val();
        if(periode == ''){
            error_msg('Please fill month period');
        }else{
        window.open("<?= base_url('Whse/tb_item_audit_xls?periode=') ?>"+periode,"_self");
        }
    }

    function detail(id){
        $("#itemcode").val(id);
        $("#t_namabrg").html(id);
        trace_stok();
        $("#trace").modal("show");
    }

    function load(){
        let timerInterval
        Swal.fire({
        title: 'Loading please wait',
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('Loading done')
        }
        })
    }

    function konversi(id,nilai){
        $("#konversi").modal("show");
        $.get("<?= base_url('Whse/hitung_konversi?id=') ?>"+id+"&qty="+nilai, function(data, status) {
            $("#tampilkonversi").html(data);
        });
    }

    function pesan(id,konv){
        Swal.fire({
        title: 'Konversi tidak ditemukan untuk Item <br>'+id,
        text: "Buat konversi untuk item ini ? ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, buat konversi!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url('Whse/add_konversi'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    konv:konv
                },
                success: function() {
                    // begin
                    Swal.fire(
                    'Success',
                    'Konversi berhasil dibuat',
                    'success'
                    )        
                    //end
                }
            });
        }
        })
    }

    $(function() {
		$("#periode").datepicker({
			changeMonth: true,
			changeYear: true,
			showButtonPanel: true,
			dateFormat: 'mm-yy',
			onClose: function(dateText, inst) {
					$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
			    }
			});
		});

    function error_msg(pesan){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
        icon: 'error',
        title: pesan
        })
    }

    // EasyUI

    function trace_stok(){
        var itemcode = $("#itemcode").val();
        var table = $('#dg');
        $('#dg').datagrid({
            url:'<?= base_url();?>Whse/trc_whse?item='+itemcode, 
            view: detailview,
            showHeader:false,
            detailFormatter:function(index,row){
                return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
            },
            onExpandRow: function(index,row){
                var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
                ddv.datagrid({
                    url:'<?= base_url();?>Whse/trc_whse_det?item='+itemcode+'&whse='+row.Warehouse,
                    fitColumns:true,
                    singleSelect:true,
                    rownumbers:true,
                    loadMsg:'',
                    showHeader:false,
                    method:'get',
                    height:'auto',
                        columns:[[
                            {field:'tgl'},
                            {field:'Comments',width:100},
                            {field:'Transdescription',width:20,align:'center'},
                            {field:'BASE_REF',width:20,align:'center'},
                            {field:'stok',align:'right',width:20, formatter: formatNumber},
                            {field:'Total',align:'right',width:20, formatter: formatNumber}
                        ]],
                        onResize:function(){
                            $('#dg').datagrid('fixDetailRowHeight',index);
                        },
                        onLoadSuccess:function(){
                            setTimeout(function(){
                                $('#dg').datagrid('fixDetailRowHeight',index);
                            },0);
                        }
                });
                $('#dg').datagrid('fixDetailRowHeight',index);
            }
        });
    }
        
    function formatNumber(value, row, index) {
        if (value !== null && value !== undefined) {
            return parseFloat(value).toFixed(4);
        } else {
            return value;
        }
    }

    function buka_semua(){
        var dg = $('#dg');
        var count = dg.datagrid('getRows').length;
        for(var i=0; i<count; i++){
            dg.datagrid('expandRow',i);
        }
    }

    function tutup_semua(){
        var dg = $('#dg');
        var count = dg.datagrid('getRows').length;
        for(var i=0; i<count; i++){
            dg.datagrid('collapseRow',i);
        }
    }

</script>