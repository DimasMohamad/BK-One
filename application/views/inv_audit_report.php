<!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Expand row in DataGrid to show subgrid - jQuery EasyUI Demo</title>
        <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/default/easyui.css">
        <link rel="stylesheet" type="text/css" href="https://www.jeasyui.com/easyui/themes/icon.css">
        <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.min.js"></script>
        <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
    </head>
    <body>
        <table id="dg" style="width:100%;height:300px"
                url="<?= base_url();?>Whse/trc_whse?item=BB.ACB.IMP.0001" 
                data-options="method:'get',showHeader:false"
                title="Kartu Stok"
                singleSelect="true" fitColumns="true">
            <thead>
                <tr>
                    <th field="Warehouse" width="100%">Warehouse</th>
                </tr>
            </thead>
        </table>
        <script type="text/javascript">
            
            $(function(){
                $('#dg').datagrid({
                    view: detailview,
                    detailFormatter:function(index,row){
                        return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
                    },
                    onExpandRow: function(index,row){
                        var ddv = $(this).datagrid('getRowDetail',index).find('table.ddv');
                        ddv.datagrid({
                            //url:'datagrid22_getdetail.php?itemid='+row.itemid,
                            url:'<?= base_url();?>Whse/trc_whse_det?item=BB.ACB.IMP.0001'+'&whse='+row.Warehouse,
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
                                {field:'Transdescription',align:'right'},
                                {field:'stok',align:'right', formatter: formatNumber},
                                {field:'Total',align:'right', formatter: formatNumber}
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
            });
            
        function formatNumber(value, row, index) {
            if (value !== null && value !== undefined) {
                return parseFloat(value).toFixed(4);
            } else {
                return value;
            }
        }
        </script>
    </body>
    </html>