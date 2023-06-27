<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <?php
    //$row = json_decode($data, true);
    ?>

    <div class="pagetitle">
        <h1>LAPORAN HARIAN KELUAR BARANG</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Warehouse</li>
                <li class="breadcrumb-item active">Laporan Harian Keluar Barang</li>
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
                                <label class="small mb-1">Mulai</label>
                                <input type="date" id="mulai" class="form-control">
                            </div>
                            <div class="col-xl-3">
                                <label class="small mb-1">Hingga</label>
                                <input type="date" id="hingga" class="form-control">
                            </div>
                            <div class="col-xl-6">
                                <label class="small mb-1">Cari</label>
                                <select class="form-control" id="item" name="item[]" multiple="multiple">
                                    <option value="1">DO</option>
                                    <option value="4">IT</option>
                                    <option value="2">Retur</option>
                                    <option value="3">Pemakaian(GI)</option>
                                </select>
                            </div>
                        </div><br>
                        <select id="sts" class="form-control" style="display:none;">
                                    <option value="0">ALL</option>
                                    <option value="O">OPEN</option>
                                    <option value="C">CLOSE</option>
                        </select>
                        <button type="button" class="btn btn-primary" onclick="tampil()" id="btntampil"><i class="bi bi-search"></i>&nbsp;View</button>
                        <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        Loading...</button>
                        <!--
                        <button type="button" class="btn btn-warning" onclick="pesan()"><i class="bi bi-printer"></i>&nbsp;Print</button>
                        <button type="button" class="btn btn-success" onclick="unduh()"><i class="bi bi-download"></i>&nbsp;Download</button>
-->
                    </div>
                    <div class="card-body">
                    <div id="tampildata"></div>
                    </div>
                </div>
            </div>
    </section>

</main><!-- End #main -->

<!-- Basic Modal -->
<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">My modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->

<script type="text/javascript">
    $(document).ready(function() {
        $('#item').select2({
            placeholder: "Pilih Grup",
            allowClear: true,
            language: "id",
            width: '100%'
        });
    });

    function pesan() {
        Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
        )
    }

    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    function tampil(){
        let item = $("#item").val();
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        //load();
        if(mulai == ""){
            pesan('tgl perlu diisi');
        }else{
            if(hingga == ""){
                pesan('tgl perlu diisi');
            }else{
                if(item == ""){
                    pesan('Grup perlu diisi');
                }else{
                    document.getElementById('btntampil').style.display = 'none';
                    document.getElementById('btnloading').style.display = '';
                    $.get("<?= base_url('Whse/tb_lhkb?mulai=') ?>"+mulai+"&hingga="+hingga+"&item="+item, function(data, status) {
                        $("#tampildata").html(data);
                        if(status == 'success'){
                            document.getElementById('btntampil').style.display = '';
                            document.getElementById('btnloading').style.display = 'none';
                        }
                    });
                }
            }
        }
    }

    function unduh(){
        let item = $("#item").val();
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        let cari = $("#cari").val();
        let sts = $("#sts").val();
        window.open("<?= base_url('Whse/tb_lhmb_xls?mulai=') ?>"+mulai+"&hingga="+hingga+"&grup="+item+"&sts="+sts,"_self");
    }

    function cetak(){
        let item = $("#item").val();
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        let cari = $("#cari").val();
        let sts = $("#sts").val();
        window.open("<?= base_url('Whse/tb_lhmb_cetak?mulai=') ?>"+mulai+"&hingga="+hingga+"&grup="+item+"&sts="+sts);
    }

    var cari = document.getElementById("cari");
    cari.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            tampil();
        }
    });

    function pesan(txt){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: false,
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
</script>