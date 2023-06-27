<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Penilaian Supplier</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Purchasing</li>
                <li class="breadcrumb-item active">Penilaian Supplier</li>
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
                                    
                                    <button class="btn btn-success" onclick="add()"><i class="bi bi-download"></i>&nbsp;Add</button>

                                </div>
                                <div class="col-xl-12">
                                    <br>
                                    <div id="tampildataspp"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Trace GRPO -->
<div class="modal fade" id="add_penilaian" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Penilaian Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
            <input type="text" id="id_penilaian">
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
        
        $.get("<?= base_url('Purchasing/tb_outstanding_po?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
            document.getElementById('btntampil').style.display = '';
            document.getElementById('btnloading').style.display = 'none';
            
            $("#tampildataspp").html(data);
        });
    }

    function add(){
        $.get("<?= base_url('Purchasing/idunik') ?>", function(data, status) {
            $("#id_penilaian").val(data);
        });
        $("#add_penilaian").modal("show");
    }

</script>