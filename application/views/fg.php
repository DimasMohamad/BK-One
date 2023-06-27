<main id="main" class="main">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
    <div class="pagetitle">
        <h1>Laporan Barang Jadi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Produksi</li>
                <li class="breadcrumb-item active">Laporan barang jadi</li>
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
                                <div class="col-xl-3">
                                    <button class="btn btn-primary" onclick="tampildata()">View</button>
                                    <button class="btn btn-success" onclick="unduh()"><i class="bi bi-download"></i>&nbsp;Download</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row"> 
                                <div class="col-xl-12">
                                    
                                </div>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Total Hasil Produksi</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Detail Hasil Produksi</button>
                                    </li>
                                </ul>
                                <div class="tab-content pt-2" id="myTabContent">
                                    <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div id="tampildata"></div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div id="tampildetail"></div>
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
        load();
        $.get("<?= base_url('Produksi/tb_bj?mulai=') ?>"+mulai+"&hingga="+hingga, function(data, status) {
            $("#tampildetail").html(data);
            if(status == 'success'){
                swal.close();
            }
        });
    }

    function load(){
        let timerInterval
        Swal.fire({
        title: 'Loading please wait',
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('Loading done')
        }
        })
    }

    $(document).ready(function(){
        $('#tabel-data').DataTable({scrollX: true,});
    });

    function unduh(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        window.open("<?= base_url('Produksi/tb_bj_xls?mulai=') ?>"+mulai+"&hingga="+hingga,"_self");
    }
</script>