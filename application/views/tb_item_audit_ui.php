<?php $row = json_decode($data,true);?>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/easyui');?>/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/easyui');?>/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/vendor/easyui');?>/demo.css">
	<script type="text/javascript" src="<?= base_url('assets/vendor/easyui');?>/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url('assets/vendor/easyui');?>/jquery.easyui.min.js"></script>

	<div style="margin:0px 0;"></div>
	<table class="easyui-datagrid" title="Basic DataGrid" style="width:700px;height:250px"
			data-options="singleSelect:true,collapsible:true,url:'datagrid_data1.json',method:'get'">
		<thead>
			<tr>
				<th data-options="field:'itemid',width:80">Item ID</th>
				<th data-options="field:'productid',width:100">Product</th>
				<th data-options="field:'listprice',width:80,align:'right'">List Price</th>
				<th data-options="field:'unitcost',width:80,align:'right'">Unit Cost</th>
				<th data-options="field:'attr1',width:250">Attribute</th>
				<th data-options="field:'status',width:60,align:'center'">Status</th>
			</tr>
		</thead>
	</table>

    <script>
    function doSearch(){
        $('#dg').datagrid('load',{
            attr1: $('#searchbox').val()
        });
    }
    </script>

