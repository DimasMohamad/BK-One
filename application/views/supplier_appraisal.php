<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
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
                        <!-- Default Tabs -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">PO LIST</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Penilaian</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <button class="btn btn-primary" onclick="tampilpo()">View</button>
                                <br><br>
                                <div id="tbpo"></div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Default Tabs -->

                    </div>
                </div>
                
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- penilaian -->
<div class="modal fade" id="add_penilaian" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nama_supp">Penilaian Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <input type="hidden" id="id_penilaian">
            <form class="row g-3">
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Tgl Penilaian</label>
                    <input type="date" id="tglnilai" class="form-control">
                </div>
                <div class="col-4">
                    <label for="inputNanme4" class="form-label">Mutu</label>
                    <select id="mutu" class="form-control">
                        <option value="0">-- Pilih --</option>
                        <option value="1">Tidak sesuai persyaratan yang diminta</option>
                        <option value="2">Kurang sesuai permintaan yang diminta</option>
                        <option value="3">Sesuai permintaan yang diminta</option>
                        <option value="4">Melebihi persyaratan yang diminta</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="inputNanme4" class="form-label">Pelayanan</label>
                    <select id="pelayanan" class="form-control">
                        <option value="0">-- Pilih --</option>
                        <option value="1">Tidak sesuai persyaratan yang diminta</option>
                        <option value="2">Kurang sesuai permintaan yang diminta</option>
                        <option value="3">Sesuai permintaan yang diminta</option>
                        <option value="4">Melebihi persyaratan yang diminta</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="inputNanme4" class="form-label">Kuantiti</label>
                    <select id="kuantiti" class="form-control">
                        <option value="0">-- Pilih --</option>
                        <option value="1">Tidak sesuai persyaratan yang diminta</option>
                        <option value="2">Kurang sesuai permintaan yang diminta</option>
                        <option value="3">Sesuai permintaan yang diminta</option>
                        <option value="4">Melebihi persyaratan yang diminta</option>
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Keterangan</label>
                    <textarea id="keterangan" class="form-control"></textarea>
                </div>
            </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="simpannilai()">Simpan Penilaian</button>
            </div>
        </div>
    </div>
</div>

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

    function add(docnum,supp){
        $("#nama_supp").html(supp);
        $("#id_penilaian").val(docnum);
        $("#add_penilaian").modal("show");
    }

    function tampilpo(){
        $.get("<?= base_url('purchasing/tb_po_list') ?>", function(data, status) {
            document.getElementById('btntampil').style.display = '';
            document.getElementById('btnloading').style.display = 'none';
            
            $("#tbpo").html(data);
        });
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

    function pesan_sukses(txt){
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

    function simpannilai(){
        var id_penilaian = $("#id_penilaian").val();
        var tgl = $("#tglnilai").val();
        var mutu = $("#mutu").val();
        var pelayanan = $("#pelayanan").val();
        var kuantiti = $("#kuantiti").val();
        var keterangan = $("#keterangan").val();
        if(tgl==''){
            pesan('tanggal pengisian mohon diisi');
        }else{
            if(mutu == 0){
                pesan('Penilaian Mutu belum diisi');
            }else{
                if(pelayanan == 0){
                    pesan('Penilaian pelayanan belum diisi');
                }else{
                    if(kuantiti == 0){
                        pesan('Penilaian kuantiti belum diisi');
                    }else{
                        if(keterangan == ''){
                            pesan('keterangan belum diisi');
                        }else{
                            $.ajax({
                                url: "<?= base_url('Purchasing/simpan_nilai'); ?>",
                                type: 'POST',
                                cache: false,
                                data: {
                                    id_penilaian: id_penilaian,
                                    tgl: tgl,
                                    mutu: mutu,
                                    pelayanan: pelayanan,
                                    kuantiti: kuantiti,
                                    keterangan : keterangan,
                                    csrf_test_name: $.cookie('csrf_cookie_name')
                                },
                                success: function() {
                                    // begin
                                    pesan_sukses('Tersimpan');
                                    tampilpo();
                                    $("#add_penilaian").modal("hide");
                                    document.getElementById("tglnilai").value = "";
                                    document.getElementById("mutu").value = "0";
                                    document.getElementById("pelayanan").value = "0";
                                    document.getElementById("kuantiti").value = "0";
                                    document.getElementById("keterangan").value = "";
                                    //end
                                }
                            });
                        }
                    }
                }
            }
        }
    }
</script>