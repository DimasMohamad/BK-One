<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Sasaran Mutu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Document Control</li>
                <li class="breadcrumb-item active">Sasaran Mutu</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Input Sasaran Mutu</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Daftar Sasaran Mutu</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#profile2" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Master Data Sarmut</button>
                            </li>
                        </ul>
                        <!--Konten input sasaran mutu-->
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- -->
                                <div class="row">
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <select class="form-control" id="filter_divisi">
                                                <option value='0'>--Pilih Divisi--</option>,
                                                <option value='FINANCE ACCOUNTING'>FINANCE ACCOUNTING</option>
                                                <option value='GUDANG'>GUDANG</option>
                                                <option value='HRD - GA'>HRD - GA</option>
                                                <option value='IT'>IT</option>
                                                <option value='LEGAL'>LEGAL</option>
                                                <option value='MARKETING'>MARKETING</option>
                                                <option value='PPIC'>PPIC</option>
                                                <option value='PRODUKSI'>PRODUKSI</option>
                                                <option value='Purchasing'>PURCHASING</option>
                                                <option value='QC'>QC</option>
                                                <option value='RND'>RND</option>
                                                <option value='TEKNISI'>TEKNISI</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-1">
                                            <select class="form-control" id="filter_bulan">
                                                <option value='0'>--Bulan--</option>
                                                <option value='1'>JANUARI</option>
                                                <option value='2'>FEBRUARI</option>
                                                <option value='3'>MARET</option>
                                                <option value='4'>APRIL</option>
                                                <option value='5'>MEI</option>
                                                <option value='6'>JUNI</option>
                                                <option value='7'>JULI</option>
                                                <option value='8'>AGUSTUS</option>
                                                <option value='9'>SEPTEMBER</option>
                                                <option value='10'>OKTOBER</option>
                                                <option value='11'>NOVEMBER</option>
                                                <option value='12'>DESEMBER</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-1">
                                            <select class="form-control" id="filter_tahun">
                                                <option value='0'>--Tahun--</option>
                                                <option value='2023'>2023</option>
                                                <option value='2024'>2024</option>
                                                <option value='2025'>2025</option>
                                            </select>
                                        </div>
                                        <div class="col-xl-5">
                                            <button class="btn btn-primary" onclick="tampildata()" id="btntampil"><i class="bi bi-search"></i>&nbsp;View</button>
                                            <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...</button>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_dokumen"><i class="bi bi-upload"></i>&nbsp;Input</button>
                                        </div>
                                        <div class="col-xl-12">
                                            <br>
                                            <div id="tampildatasarmut"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Konten Daftar sasaran mutu-->
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- -->
                                <div class="row">
                                    <div class='col-xl-3'>
                                        <button class="btn btn-primary" onclick="tampildata2()" id="btntampil2"><i class="bi bi-search"></i>&nbsp;View</button>
                                        <button class="btn btn-primary" type="button" disabled="" id="btnloading2" style="display:none;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...</button>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="col-xl-12">
                                        <br>
                                        <div id="tampildatasign2"></div>
                                    </div>
                                </div>
                            </div>
                            <!--Konten Master Data sasaran mutu-->
                            <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- -->
                                <div class="row">
                                    <div class="col-xl-2">
                                        <select class="form-control" id="filter_divisi2">
                                            <option value='0'>--Pilih Divisi--</option>,
                                            <option value='FINANCE ACCOUNTING'>FINANCE ACCOUNTING</option>
                                            <option value='GUDANG'>GUDANG</option>
                                            <option value='HRD - GA'>HRD - GA</option>
                                            <option value='IT'>IT</option>
                                            <option value='LEGAL'>LEGAL</option>
                                            <option value='MARKETING'>MARKETING</option>
                                            <option value='PPIC'>PPIC</option>
                                            <option value='PRODUKSI'>PRODUKSI</option>
                                            <option value='Purchasing'>PURCHASING</option>
                                            <option value='QC'>QC</option>
                                            <option value='RND'>RND</option>
                                            <option value='TEKNISI'>TEKNISI</option>
                                        </select>
                                    </div>
                                    <div class='col-xl-3'>
                                        <button class="btn btn-primary" onclick="tampilmasterdata()" id="btntampilmasterdata"><i class="bi bi-search"></i>&nbsp;Test</button>
                                        <button class="btn btn-primary" type="button" disabled="" id="btnloadingmasterdata" style="display:none;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...</button>
                                        <label class="form-label"></label>
                                    </div>
                                    <div class="col-xl-12">
                                        <br>
                                        <div id="tampilmasterdata"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->
<div class="modal fade" id="upload_dokumen" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Input Sasaran Mutu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="<?= base_url('Document_control/simpan_sarmut'); ?>" method="post">
                    <div class="control-group after-add-more row g-3">
                        <div class="col-3">
                            <select class="form-control" id="filter_divisi_modal">
                                <option value='0'>--Pilih Divisi--</option>
                                <option value='FINANCE ACCOUNTING'>FINANCE ACCOUNTING</option>
                                <option value='GUDANG'>GUDANG</option>
                                <option value='HRD - GA'>HRD - GA</option>
                                <option value='IT'>IT</option>
                                <option value='LEGAL'>LEGAL</option>
                                <option value='MARKETING'>MARKETING</option>
                                <option value='PPIC'>PPIC</option>
                                <option value='PRODUKSI'>PRODUKSI</option>
                                <option value='PURCHASING'>PURCHASING</option>
                                <option value='QC'>QC</option>
                                <option value='RND'>RND</option>
                                <option value='TEKNISI'>TEKNISI</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-control" id="filter_bulan1" name="filter_bulan1">
                                <option value='0'>--Bulan--</option>
                                <option value='1'>JANUARI</option>
                                <option value='2'>FEBRUARI</option>
                                <option value='3'>MARET</option>
                                <option value='4'>APRIL</option>
                                <option value='5'>MEI</option>
                                <option value='6'>JUNI</option>
                                <option value='7'>JULI</option>
                                <option value='8'>AGUSTUS</option>
                                <option value='9'>SEPTEMBER</option>
                                <option value='10'>OKTOBER</option>
                                <option value='11'>NOVEMBER</option>
                                <option value='12'>DESEMBER</option>
                            </select>
                        </div>
                        <div class="col-2">
                            <select class="form-control" id="filter_tahun1" name="filter_tahun1">
                                <option value='0'>--Tahun--</option>
                                <option value='2023'>2023</option>
                                <option value='2024'>2024</option>
                                <option value='2025'>2025</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-success add-more" type="button" id="btnCheck">
                                <i class="glyphicon glyphicon-plus"></i> Check
                            </button>
                        </div>
                        <div id="tampilmodal"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function tampildata() {
        var divisi = $("#filter_divisi").val();
        var bulan = $("#filter_bulan").val();
        var tahun = $("#filter_tahun").val();
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById("tampildatasarmut").innerHTML = '';
        $.get("<?= base_url('Document_control/tampil_sarmut?divisi=') ?>" + divisi + "&bulan=" + bulan + "&tahun=" + tahun, function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil').style.display = '';
            $("#tampildatasarmut").html(data);
        });
    }

    function tampilmasterdata() {
        var divisi = $("#filter_divisi2").val();
        document.getElementById('btnloadingmasterdata').style.display = '';
        document.getElementById('btntampilmasterdata').style.display = 'none';
        document.getElementById("tampilmasterdata").innerHTML = '';
        $.get("<?= base_url('Document_control/tampil_masterdata_sarmut?divisi=') ?>" + divisi, function(data, status) {
            document.getElementById('btnloadingmasterdata').style.display = 'none';
            document.getElementById('btntampilmasterdata').style.display = '';
            $("#tampilmasterdata").html(data);
        });
    }

    function pesan(txt) {
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

    function pesan_sukses(txt) {
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
            icon: 'success',
            title: txt
        })
    }

    $(document).ready(function() {
        // Handler ketika tombol "Check" di-klik
        $(".add-more").click(function() {
            var divisi_modal = $("#filter_divisi_modal").val();
            var bulan1 = $("#filter_bulan1").val();
            var tahun1 = $("#filter_tahun1").val();

            // Mengecek apakah divisi_modal telah dipilih
            if (divisi_modal === "0" || bulan1 === "0" || tahun1 === "0") {
                pesan("Pilih Divisi, Bulan dan Tahun terlebih dahulu.");
                return;
            }

            // Mengambil data dari server berdasarkan divisi_modal
            document.getElementById("tampilmodal").innerHTML = '';
            $.get("<?= base_url('Document_control/tampil_sarmut_detail?divisi=') ?>" + divisi_modal + "&filter_bulan1=" + bulan1 + "&filter_tahun1=" + tahun1, function(data, status) {
                document.getElementById('btnloading').style.display = 'none';
                document.getElementById('btntampil').style.display = '';
                $("#tampilmodal").html(data);
            });
        });
    });
</script>