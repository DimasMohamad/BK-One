<!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>LHPB</title>
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/easyui/themes/icon.css">
        <link rel="stylesheet" type="text/css" href="<?= base_url()?>assets/vendor/easyui/demo.css">
        <script type="text/javascript" src="<?= base_url()?>assets/vendor/easyui/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url()?>assets/vendor/easyui/jquery.easyui.min.js"></script>
    </head>
    <body>
        <div style="margin:20px 0;"></div>
        <table id="myTable" class="easyui-datagrid" title="Laporan Harian Penerimaan Barang" style="width:100%;height:450px"
                data-options="rownumbers:true,singleSelect:true,url:'',method:'get',toolbar:'#tb',footer:'#ft'">
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
            Date From: <input id="mulai" class="easyui-datebox" style="width:115px">
            To: <input id="hingga" class="easyui-datebox" style="width:115px">
            <a href="#" onclick="tampildata()" class="easyui-linkbutton" iconCls="icon-search">View</a>
            <a href="#" class="easyui-linkbutton" iconCls="icon-download">Download</a>
        </div>
    </body>
    </html>
    <script>
        function formatPrice(val,row){
            if (val < 30){
                return '<span style="color:red;">('+val+')</span>';
            } else {
                return val;
            }
        }

        function tampildata(){
            var table = $('#myTable');
            var mulai = $("#mulai").val();
            var hingga = $("#hingga").val();
            var parts1 = mulai.split('/');
            var mulai1 = parts1[2] + '-' + parts1[0] + '-' + parts1[1];

            var parts2 = hingga.split('/');
            var hingga2 = parts2[2] + '-' + parts2[0] + '-' + parts2[1];

            $.get("<?= base_url('so/tb_lhkb3?mulai=') ?>"+mulai1+"&hingga="+hingga2, function(data, status) {
                var obj = $.parseJSON(data);
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
