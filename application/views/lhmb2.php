<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan Harian Penerimaan Barang</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Sales - A/R</li>
                <li class="breadcrumb-item active">LHMB (LA.SHR.P)</li>
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
                                    <div id="tampildata"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

</main><!-- End #main -->

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
        $.get("<?= base_url('So/tb_lhmb?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
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

    function unduh(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        window.open("<?= base_url('So/tb_lhmb_xls?mulai=') ?>"+mulai+"&hingga="+hingga,"_self");
    }
</script>