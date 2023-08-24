<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Kepuasan Pelanggan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Marketing</li>
                <li class="breadcrumb-item active">Kepuasan Pelanggan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-xl-2">
                                <select class="form-control" id="filter_smstr" onclick="get_filter_tahun()">
                                    <option value='0'>--Pilih--</option>
                                    <option value='1'>Semester 1</option>
                                    <option value='2'>Semester 2</option>
                                </select>
                            </div>
                            <div class="col-xl-2">
                                <select class="form-control" id="filter_tahun"></select>
                            </div>
                            <div class="col-xl-5">
                                <button class="btn btn-primary" onclick="tampildata()" id="btntampil"><i class="bi bi-search"></i>&nbsp;View</button>
                                <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...</button>
                                <button type="button" class="btn btn-success" class="bi bi-upload" data-bs-toggle="modal" data-bs-target="#add_penilaian" onclick="get_nama()">Upload File</button>
                                <button class="btn btn-warning" onclick="printData()"><i class="bi bi-printer"></i>&nbsp;Print</button>
                            </div>
                            <div class="col-xl-12">
                                <br>
                                <div id="tampildatasurvey"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<div class="modal fade" id="add_penilaian" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="nama_supp">Kepuasan Pelanggan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3">
                    <div>
                        <label class="form-label">Nama Pelanggan</label>
                        <select class="form-control" id="get_nama"></select>
                    </div>
                    <div class="col-8">
                        <label class="form-label">Semester</label>
                        <select id="semester" class="form-control">
                            <option value="0">--Pilih--</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label class="form-label">Tahun</label>
                        <select id="tahun" class="form-control">
                            <option value="0">--Pilih--</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                        </select>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Pemenuhan Persyaratan Produk</label>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">P1</label><br>
                                    <input class="col-8" type="text" id="p1" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">P2</label><br>
                                    <input class="col-8" type="text" id="p2" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">P3</label><br>
                                    <input class="col-8" type="text" id="p3" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">P4</label><br>
                                    <input class="col-8" type="text" id="p4" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">P5</label><br>
                                    <input class="col-8" type="text" id="p5" name="fname">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Kendala / Reliability</label>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">K1</label><br>
                                    <input class="col-8" type="text" id="k1" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">K2</label><br>
                                    <input class="col-8" type="text" id="k2" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">K3</label><br>
                                    <input class="col-8" type="text" id="k3" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">K4</label><br>
                                    <input class="col-8" type="text" id="k4" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">K5</label><br>
                                    <input class="col-8" type="text" id="k5" name="fname">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <label class="form-label">Responsivenes / Empathy</label>
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">R1</label><br>
                                    <input class="col-8" type="text" id="r1" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">R2</label><br>
                                    <input class="col-8" type="text" id="r2" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">R3</label><br>
                                    <input class="col-8" type="text" id="r3" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">R4</label><br>
                                    <input class="col-8" type="text" id="r4" name="fname">
                                </div>
                                <div class="col">
                                    <label class="form-label">R5</label><br>
                                    <input class="col-8" type="text" id="r5" name="fname">
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-12">
                        <label class="form-label">Masukan</label>
                        <textarea id="masukan" class="form-control"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="simpannilai()">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
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
        var nama = $("#get_nama").val();
        var semester = $("#semester").val();
        var tahun = $("#tahun").val();
        var p1 = $("#p1").val();
        var p2 = $("#p2").val();
        var p3 = $("#p3").val();
        var p4 = $("#p4").val();
        var p5 = $("#p5").val();
        var k1 = $("#k1").val();
        var k2 = $("#k2").val();
        var k3 = $("#k3").val();
        var k4 = $("#k4").val();
        var k5 = $("#k5").val();
        var r1 = $("#r1").val();
        var r2 = $("#r2").val();
        var r3 = $("#r3").val();
        var r4 = $("#r4").val();
        var r5 = $("#r5").val();
        var masukan = $("#masukan").val();
        if(nama == "0"){
                pesan('Nama pelanggan belum diisi');
            }else{
                if(semester == "0"){
                    pesan('Semester belum diisi');
                }else{
                    if(tahun == "0"){
                        pesan('Tahun belum diisi');
                    }else{
                        if(masukan == ''){
                            pesan('keterangan belum diisi');
                        }else{
                            if(p1 == ''){
                                pesan('Nilai belum diisi');
                            }else{
                                if(p2 == ''){
                                    pesan('Nilai belum diisi');
                                }else{
                                    if(p3 == ''){
                                        pesan('Nilai belum diisi');
                                    }else{
                                        if(p4 == ''){
                                            pesan('Nilai belum diisi');
                                        }else{
                                            if(p5 == ''){
                                                pesan('Nilai belum diisi');
                                            }else{
                                                if(k1 == ''){
                                                    pesan('Nilai belum diisi');
                                                }else{
                                                    if(k2 == ''){
                                                        pesan('Nilai belum diisi');
                                                    }else{
                                                        if(k3 == ''){
                                                            pesan('Nilai belum diisi');
                                                        }else{
                                                            if(k4 == ''){
                                                                pesan('Nilai belum diisi');
                                                            }else{
                                                                if(k5 == ''){
                                                                    pesan('Nilai belum diisi');
                                                                }else{
                                                                    if(r1 == ''){
                                                                        pesan('Nilai belum diisi');
                                                                    }else{
                                                                        if(r2 == ''){
                                                                            pesan('Nilai belum diisi');
                                                                        }else{
                                                                            if(r3 == ''){
                                                                                pesan('Nilai belum diisi');
                                                                            }else{
                                                                                if(r4 == ''){
                                                                                    pesan('Nilai belum diisi');
                                                                                }else{
                                                                                    if(r5 == ''){
                                                                                        pesan('Nilai belum diisi');
                                                                                    }else{
                                                                                        $.ajax({
                                                                                            url: "<?= base_url('Marketing/simpan_nilai'); ?>",
                                                                                            type: 'POST',
                                                                                            cache: false,
                                                                                            data: {
                                                                                                nama: nama,
                                                                                                semester: semester,
                                                                                                tahun: tahun,
                                                                                                p1: p1,
                                                                                                p2: p2,
                                                                                                p3: p3,
                                                                                                p4: p4,
                                                                                                p5: p5,
                                                                                                k1: k1,
                                                                                                k2: k2,
                                                                                                k3: k3,
                                                                                                k4: k4,
                                                                                                k5: k5,
                                                                                                r1: r1,
                                                                                                r2: r2,
                                                                                                r3: r3,
                                                                                                r4: r4,
                                                                                                r5: r5,
                                                                                                masukan: masukan,
                                                                                                csrf_test_name: $.cookie('csrf_cookie_name')
                                                                                            },
                                                                                            success: function() {
                                                                                                // begin
                                                                                                pesan_sukses('Tersimpan');
                                                                                                tampildata();
                                                                                                $("#add_penilaian").modal("hide");
                                                                                                //end
                                                                                            }
                                                                                        });
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
    }

    function get_nama(){
        $.get("<?= base_url('Marketing/get_nama_pel') ?>", function(data, status) {
            $("#get_nama").html(data);
        });
    }

    function tampildata(){
        var s = $("#filter_smstr").val();
        var t = $("#filter_tahun").val();
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById('btnloading').style.display = '';
        $.get("<?= base_url('Marketing/tampil_data_survey?t=') ?>"+t+"&s="+s, function(data, status) {
            document.getElementById('btntampil').style.display = '';
            document.getElementById('btnloading').style.display = 'none';
            $("#tampildatasurvey").html(data);
        });
    }

    function get_filter_tahun(){
        $.get("<?= base_url('Marketing/get_filter_tahun') ?>", function(data, status) {
            $("#filter_tahun").html(data);
        });
    }
</script>