<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/easyui/demo.css">
        <script type="text/javascript" src="<?= base_url()?>assets/vendor/easyui/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url()?>assets/vendor/easyui/jquery.easyui.min.js"></script>

<main id="main" class="main">
    <!-- End Page Title
    <div class="pagetitle">
        <h1>Laporan Harian Pengiriman Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Sales - A/R</li>
                <li class="breadcrumb-item active">LHPB</li>
            </ol>
        </nav>
    </div> -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <!----------------------------------------->
                <table id="myTable" class="easyui-datagrid" title="Laporan Harian Pengiriman Barang" style="width:100%;height:500px"
                                            data-options="rownumbers:true,singleSelect:true,url:'',method:'get',toolbar:'#tb',footer:'#ft', fitColumns:true">
                                    <thead>
                                            <tr>
                                                <th data-options="field:'nosj'">No NT / SJ</th>
                                                <th data-options="field:'DocDate'">Tanggal</th>
                                                <th data-options="field:'Customer',align:'left'">Customer</th>
                                                <th data-options="field:'ItemCode',align:'left'">Kode barang</th>
                                                <th data-options="field:'Dscription'">Nama Barang</th>
                                                <th data-options="field:'Quantity', align:'right', formatter: formatNumber">Jumlah</th>
                                                <th data-options="field:'UomCode',align:'center'">Satuan</th>
                                                <th data-options="field:'FreeTxt'">Free Text</th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <div id="tb" style="padding:2px 5px;">
                                        Date From: <input id="mulai" class="easyui-datebox" style="width:120px">
                                        To: <input id="hingga" class="easyui-datebox" style="width:120px">
                                        <a href="#" onclick="tampildata()" class="easyui-linkbutton" iconCls="icon-search">View</a>
                                        <a href="#" onclick="unduh()" class="easyui-linkbutton" iconCls="icon-download">Download</a>
                                    </div>
                                    <!---->
            </div>
        </div>
    </section>

</main><!-- End #main -->

<script>
    /*
function tampildata(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
        });
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById('btnloading').style.display = '';
        $.get("<?= base_url('So/tb_lhkb?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
            //$("#tampildata").html(data);
            var obj = $.parseJSON(data);
            if(status == 'success'){
                document.getElementById('btntampil').style.display = '';
                document.getElementById('btnloading').style.display = 'none';
                var table = '<table class="table table-sm table-bordered" style="font-size:13px;">'+
                            '<thead>'+
                            '<th>No NT / SJ</th>'+
                            '<th>Tanggal</th>'+
                            '<th>Customer</th>'+
                            '<th>Kode barang</th>'+
                            '<th>Nama Barang</th>'+
                            '<th>Jumlah</th>'+
                            '<th>Satuan</th>'+
                            '<th>Keterangan</th>'+
                            '</thead>';
                            $.each(obj['head'], function(key, h) {
                                table += '<tr>';
                                table += '<td>'+h['nosj']+'</td>';
                                table += '<td>'+h['DocDate']+'</td>';
                                table += '<td>'+h['Customer']+'</td>';
                                table += '<td>'+h['ItemCode']+'</td>';
                                table += '<td>'+h['Dscription']+'</td>';
                                table += '<td style="text-align:right;">'+Number(h['Quantity']).toFixed(4)+'</td>';
                                table += '<td>'+h['UomCode']+'</td>';
                                table += '<td>'+h['FreeTxt']+'</td>';
                                table += '</tr>';
                            });
                    table += '</table>';
                document.getElementById("tampildata").innerHTML = table;            
            }
            
        });
    }
*/
    function unduh(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        var parts1 = mulai.split('/');
        var mulai1 = parts1[2] + '-' + parts1[0] + '-' + parts1[1];
        var parts2 = hingga.split('/');
        var hingga2 = parts2[2] + '-' + parts2[0] + '-' + parts2[1];
        window.open("<?= base_url('So/tb_lhkb_xls?mulai=') ?>"+mulai1+"&hingga="+hingga2,"_self");
    }

    function tampildata(){
        var table = $('#myTable');
        var mulai = $("#mulai").val();
        var hingga = $("#hingga").val();
        var parts1 = mulai.split('/');
        var mulai1 = parts1[2] + '-' + parts1[0] + '-' + parts1[1];
        var parts2 = hingga.split('/');
        var hingga2 = parts2[2] + '-' + parts2[0] + '-' + parts2[1];
        var screenHeight = $(window).height(); // Mengambil tinggi layar
        var tableHeight = screenHeight - 100;
        $.get("<?= base_url('so/tb_lhkb3?mulai=') ?>"+mulai1+"&hingga="+hingga2, function(data, status) {
            var obj = $.parseJSON(data);
            table.datagrid('resize', {
                //fitColumns: true
                fit: true
            });
            table.datagrid({height: tableHeight});
            table.datagrid('loadData', obj);
        });
    }

        function formatNumber(value, row, index) {
            if (value !== null && value !== undefined) {
                return parseFloat(value).toFixed(4);
            } else {
                return value;
            }
        }
</script>