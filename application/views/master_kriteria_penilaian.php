<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Master Kriteria Penilaian</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Purchasing</li>
                <li class="breadcrumb-item active">Master Kriteria Penilaian</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row"> 
                                <div class="col-xl-5">
                                    <button class="btn btn-primary" onclick="tampildata()" id="btntampil"><i class="bi bi-search"></i>&nbsp;View</button>
                                    <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...</button>
                                    <!--
                                    <button class="btn btn-success" onclick="unduh()"><i class="bi bi-download"></i>&nbsp;Download</button>
-->
                                </div>
                                <div class="col-xl-12">
                                    <br>
                                    <div id="tampildatabp"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- add head -->
<div class="modal fade" id="f_add_head" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul_brg"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idtitle">
                <div class="row"> 
                    <div class="col-xl-9">
                        <input type="text" id="subtitle" class="form-control" placeholder="Add Subtitle">
                    </div>
                    <div class="col-xl-3">
                        <input type="number" id="nilai" class="form-control" placeholder="Nilai">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="simpan_subtitle()">Add Subtitle</button>
            </div>    
        </div>
    </div>
</div><!-- End -->

<script>
    function tampildata(){
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById("tampildatabp").innerHTML = '';
        $.get("<?= base_url('Purchasing/tb_kriteria_penilaian') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil').style.display = '';
            $("#tampildatabp").html(data);
        });
    }

    function add_head(){
        (async () => {
            const { value: header } = await Swal.fire({
            input: 'text',
            inputPlaceholder: 'Add Title',
            allowOutsideClick: false,
            allowEscapeKey: false
            })

            if (header == '') {
                pesan('Title gagal disimpan');
            }else{
                $.ajax({
                    url: "<?= base_url('Purchasing/simpan_kriteria_nilai_head'); ?>",
                    type: 'POST',
                    cache: false,
                    data: {
                        header: header,
                        csrf_test_name: $.cookie('csrf_cookie_name')
                        },
                    success: function() {
                        //Swal.fire('Title berhasil disimpan');  
                        tampildata();               
                    }
                });
            }
        })()
    }

    function add_child(id,judul){
        $("#idtitle").val(id);
        $("#judul_brg").html(judul);
        $("#f_add_head").modal("show");
    }

    function simpan_subtitle(){
        var idjudul = $("#idtitle").val();
        var subtitle = $("#subtitle").val();
        var nilai = $("#nilai").val();
        if(subtitle == ''){
            pesan('Subtitle harus diisi');
            $("#subtitle").focus();
        }else{
            if(nilai == ''){
                pesan('Nilai harus diisi');
                $("#nilai").focus();
            }else{
                $.ajax({
                    url: "<?= base_url('Purchasing/simpan_kriteria_nilai_subtitle'); ?>",
                    type: 'POST',
                    cache: false,
                    data: {
                        idjudul: idjudul,
                        subtitle: subtitle,
                        nilai: nilai,
                        csrf_test_name: $.cookie('csrf_cookie_name')
                        },
                    success: function() {
                        //Swal.fire('Subtitle berhasil disimpan');  
                        $("#f_add_head").modal("hide");
                        document.getElementById('subtitle').value='';
                        document.getElementById('nilai').value='';
                        tampildata();               
                    }
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
</script>