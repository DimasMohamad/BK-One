<title>SPK LIST</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/easyui'); ?>/themes/default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/easyui'); ?>/themes/icon.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/easyui'); ?>/demo.css">
<script type="text/javascript" src="<?= base_url('assets/vendor/easyui'); ?>/jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url('assets/vendor/easyui'); ?>/datagrid-filter.js"></script>
<script type="text/javascript" src="<?= base_url('assets/vendor/easyui'); ?>/jquery.easyui.min.js"></script>
<script type="text/javascript" src="https://www.jeasyui.com/easyui/datagrid-detailview.js"></script>
<div style="margin:0px 0;"></div>
<table id="dg" class="easyui-datagrid" title="SPK LIST" style="width:100%;height:100%" data-options="singleSelect:true,toolbar:'#tb',collapsible:false,url:'',method:'get'">
    <thead data-options="frozen:true">
        <tr>

        </tr>
    </thead>
    <thead>
        <tr>
            <th data-options="field:'rowid'">#</th>
            <th data-options="filterable:true,field:'spk'">No SPK</th>
            <th data-options="field:'created_date'">Created Date</th>
            <th data-options="field:'production'">Production</th>
            <th data-options="field:'item_no'">Item Code</th>
            <th data-options="field:'DESCRIPTION'">Item Name</th>
            <th data-options="field:'STATUS'">Status SPK</th>
            <th data-options="field:'qty_order', align:'right', formatter: formatNumber">Qty Order</th>
            <th data-options="field:'qty_buffer', align:'right', formatter: formatNumber">Qty Buffer</th>
            <th data-options="field:'qty_prod', align:'right', formatter: formatNumber">Qty Prod</th>
            <th data-options="field:'uom'">Uom</th>
            <th data-options="field:'mesin'">Mesin</th>
            <th data-options="field:'start_date'">Start date</th>
            <th data-options="field:'end_date'">End date</th>
            <th field="id_spk" width="120" formatter="formatDetail">Actions</th>
        </tr>
    </thead>
</table>
<div id="tb" style="padding:2px 5px;">
    Date From: <input id="mulai" class="easyui-datebox" style="width:120px">
    To: <input id="hingga" class="easyui-datebox" style="width:120px">
    <a href="#" onclick="tampildata()" class="easyui-linkbutton" iconCls="icon-search">View</a>
    <!--
    <a href="#" onclick="buka_semua()" class="easyui-linkbutton">Expand All</a>
    <a href="#" onclick="tutup_semua()" class="easyui-linkbutton">Collapse All</a>
-->
</div>
<div id="w" class="easyui-window" title="SPK Routing" data-options="modal:true,closed:true,maximizable:false,minimizable:false,collapsible:false" style="width:95%;height:95%;padding:10px;">
    <input type="hidden" id="idspk">
    <div class="easyui-panel" style="padding:5px;">
        <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-save'" onclick="cetakspk()">Save xls</a>
        <a href="#" class="easyui-linkbutton" data-options="plain:true,iconCls:'icon-cancel'" onclick="$('#w').window('close')">Close</a>
    </div><br>
    <div id="detailspk"></div>
</div>
<script>
    function doSearch() {
        $('#dg').datagrid('load', {
            attr1: $('#searchbox').val()
        });
    }

    function formatNumber(value, row, index) {
        if (value !== null && value !== undefined) {
            return parseFloat(value).toFixed(4);
        } else {
            return value;
        }
    }

    function tampildata() {
        var table = $('#dg');
        var mulai = $("#mulai").val();
        var hingga = $("#hingga").val();
        var parts1 = mulai.split('/');
        var mulai1 = parts1[2] + '-' + parts1[0] + '-' + parts1[1];
        var parts2 = hingga.split('/');
        var hingga2 = parts2[2] + '-' + parts2[0] + '-' + parts2[1];
        var screenHeight = $(window).height(); // Mengambil tinggi layar
        var tableHeight = screenHeight - 100;
        $('#dg').datagrid({
            view: detailview,
            url: '<?= base_url() ?>ppic/tb_spk_list_ui?s=' + mulai1 + '&e=' + hingga2,
            detailFormatter: function(index, row) {
                return '<div style="padding:2px;position:relative;"><table class="ddv"></table></div>';
            },
            onExpandRow: function(index, row) {
                var ddv = $(this).datagrid('getRowDetail', index).find('table.ddv');
                ddv.datagrid({
                    url: '<?= base_url() ?>ppic/tb_spk_list_dtl?nospk=' + row.id_spk,
                    fitColumns: true,
                    singleSelect: true,
                    rownumbers: true,
                    loadMsg: '',
                    method: 'get',
                    height: 'auto',
                    columns: [
                        [{
                                field: 'spk',
                                title: 'No SPK Child'
                            },
                            {
                                field: 'created_date',
                                title: 'Created date'
                            },
                            {
                                field: 'item_no',
                                title: 'Item Code'
                            },
                            {
                                field: 'DESCRIPTION',
                                title: 'Item Name'
                            },
                            {
                                field: 'STATUS',
                                title: 'Status SPK'
                            },
                            {
                                field: 'qty_order',
                                title: 'Qty Order',
                                align: 'right',
                                formatter: formatNumber
                            },
                            {
                                field: 'qty_buffer',
                                title: 'Qty Buffer',
                                align: 'right',
                                formatter: formatNumber
                            },
                            {
                                field: 'qty_prod',
                                title: 'Qty Prod',
                                align: 'right',
                                formatter: formatNumber
                            },
                            {
                                field: 'mesin',
                                title: 'Mesin'
                            },
                            {
                                field: 'start_date',
                                title: 'Start Date'
                            },
                            {
                                field: 'end_date',
                                title: 'End Date'
                            },
                        ]
                    ],
                    onResize: function() {
                        $('#dg').datagrid('fixDetailRowHeight', index);
                    },
                    onLoadSuccess: function() {
                        setTimeout(function() {
                            $('#dg').datagrid('fixDetailRowHeight', index);
                        }, 0);
                    }
                });
                $('#dg').datagrid('fixDetailRowHeight', index);
                $('#dg').datagrid('enableFilter');
                $('#dg').datagrid('resize', {
                    fitColumns: true,
                    fit: false
                });
            }
        });
    }

    function formatDetail(value) {
        $("#idspk").val(value);
        return '<a href="#" class="easyui-linkbutton" onclick="detailspk(' + value + ')" data-options="iconCls:\'icon-edit\'">Routing</a>';
    }

    function detailspk(id) {
        $("#detailspk").html('');
        $.get("<?= base_url('ppic/tb_spk?spk=') ?>" + id, function(data, status) {
            $("#detailspk").html(data);
        });
        $("#idspk").val(id);
        $('#w').window('open');
    }

    function buka_semua() {
        var dg = $('#dg');
        var count = dg.datagrid('getRows').length;
        for (var i = 0; i < count; i++) {
            dg.datagrid('expandRow', i);
        }
    }

    function tutup_semua() {
        var dg = $('#dg');
        var count = dg.datagrid('getRows').length;
        for (var i = 0; i < count; i++) {
            dg.datagrid('collapseRow', i);
        }
    }

    function cetakspk() {
        var id = $("#idspk").val();
        window.open("<?= base_url('ppic/tb_spk_xls?spk=') ?>" + id, "_self");
    }
</script>