<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Rekap PO</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Purchasing - A/R</li>
                <li class="breadcrumb-item active">Rekap PO</li>
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
                                <button type="button" class="btn btn-success" onclick="unduh()"><i class="bi bi-download"></i>&nbsp;Download</button>
                            </div>
                            <div class="col-xl-12">
                                <br>
                                <div id="tampildatarekappo"></div>
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
        var mulai = $("#mulai").val();
        var hingga = $("#hingga").val();
        if(mulai == ''){
            pesan('Tgl mulai belum diisi');
        }else{
            if(hingga == ''){
                pesan('Tgl hingga belum diisi');
            }else{
                document.getElementById('btntampil').style.display = 'none';
                document.getElementById('btnloading').style.display = '';
                $.get("<?= base_url('Purchasing/tampil_rekap_po?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
                    document.getElementById('btntampil').style.display = '';
                    document.getElementById('btnloading').style.display = 'none';
                    $("#tampildatarekappo").html(data);
                });
            }
        }
    }

    function pesan(txt){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
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

    function unduh(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        if(mulai == ''){
            pesan('Tgl mulai belum diisi');
        }else{
            if(hingga == ''){
                pesan('Tgl hingga belum diisi');
            }else{
                window.open("<?= base_url('Purchasing/tb_rekappo_xls?mulai=') ?>"+mulai+"&hingga="+hingga,"_self");
            }
        }
    }
</script>