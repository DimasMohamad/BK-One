<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Laporan Klaim</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Sales - A/R</li>
                <li class="breadcrumb-item active">Laporan Klaim</li>
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
                                <button class="btn btn-warning" onclick="printData()"><i class="bi bi-printer"></i>&nbsp;Print</button>
                            </div>
                            <div class="col-xl-12">
                                <br>
                                <div id="tampildataklaim"></div>
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
        $.get("<?= base_url('Marketing/tampil_data_klaim?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
            document.getElementById('btntampil').style.display = '';
            document.getElementById('btnloading').style.display = 'none';
            $("#tampildataklaim").html(data);
        });
    }
</script>