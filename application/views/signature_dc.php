<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Registrasi Dokumen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Document Control</li>
                <li class="breadcrumb-item active">Registrasi Dokumen</li>
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
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pengajuan Dokumen Baru</button>
                            </li>
                            <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" tabindex="-1">Daftar Dokumen</button>
                            </li>
                        </ul>
                        <!--Konten daftar dokumen baru-->
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- -->
                                <div class="row">
                                    <div class="col-xl-3">
                                        <button class="btn btn-primary" onclick="tampildata1()" id="btntampil1"><i class="bi bi-search"></i>&nbsp;View</button>
                                        <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                        Loading...</button>                                        
                                        <label class="form-label"></label>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_dokumen">Upload File</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <br>
                                        <div id="tampildatasign"></div>
                                    </div>
                                </div>
                            </div>
                        <!--Konten list dokumen-->
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
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </section>

</main><!-- End #main -->
<div class="modal fade" id="upload_dokumen" tabindex="-1" style="display: none;" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                
                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="" method="">
                    <div>
                        <label for="inputNanme4" class="form-label">Nomor Dokumen</label>
                        <textarea id="nomor_dokumen" name="nomor_dokumen" class="form-control"></textarea>
                    </div>
                    <hr>
                    <div>
                        <label for="inputNanme4" class="form-label">Tujuan Dokumen</label>
                        <select id="user_dc" name="user_dc" class="form-control">
                            <option value="0">-- Pilih --</option>
                            <option value="41">Iftitah Dewanty</option>
                        </select>
                    </div>
                    <hr>
                    <div class="col-4">
                        <label for="inputNanme4" class="form-label" >Disetujui</label>
                        <select id="user_mr" name="user_mr" class="form-control">
                            <option value="0">-- Pilih --</option>
                            <option value="42">Wawan Yuswandi</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label for="inputNanme4" class="form-label">Mengetahui</label>
                        <select id="user_gm" name="user_gm" class="form-control">
                            <option value="0">-- Pilih --</option>    
                            <option value="43">Ikhwanul Arifin</option>
                        </select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="form-label">Upload File</label>
                        <input type="file" name="userfile" size="20" class="form-control" accept="application/pdf"/>
                    </div>
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

<script>
    function tampildata1(){
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil1').style.display = 'none';
        document.getElementById("tampildatasign").innerHTML = '';
        $.get("<?= base_url('Document_control/tampil_data') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil1').style.display = '';
            $("#tampildatasign").html(data);
        });
    }

    function tampildata2(){
        document.getElementById('btnloading2').style.display = '';
        document.getElementById('btntampil2').style.display = 'none';
        document.getElementById("tampildatasign").innerHTML = '';
        $.get("<?= base_url('Document_control/list_dokumen') ?>", function(data, status) {
            document.getElementById('btnloading2').style.display = 'none';
            document.getElementById('btntampil2').style.display = '';
            $("#tampildatasign2").html(data);
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

    $("#f_upld").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('Document_control/do_upload'); ?>",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    alert('Upload gagal');
                } else {
                    $("#tombol-tampil").click();
                    $("#f_upload_bt").modal("hide");
                    $("#upload_dokumen").modal("hide");
                    pesan_sukses('Tersimpan');
                    document.getElementById("nomor_dokumen").value = "";
                    document.getElementById("user_dc").value = "0";
                    document.getElementById("user_mr").value = "0";
                    document.getElementById("user_gm").value = "0";
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            }
        });
    });

    function btnhapus(id,namafile){
        Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            //Begin
            $.ajax({
                url: "<?= base_url('Document_control/hapus_dokumen'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    namafile: namafile,
                    csrf_test_name: $.cookie('csrf_cookie_name')
                }
            });
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            );
            tampildata1();
            //end
        }
        })
    }

    function btndownload(namafile){
        window.open("<?= base_url('uploads/')?>"+namafile, '_blank');
    }

    function btnapprove(id){
        Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Ingin menyetujui dokumen ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00a000',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Approve'
        }).then((result) => {
        if (result.isConfirmed) {
            //Begin
            $.ajax({
                url: "<?= base_url('Document_control/sign_approve'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    csrf_test_name: $.cookie('csrf_cookie_name')
                }
            });
            Swal.fire(
            'Approved!',
            'Dokumen telah anda setujui.',
            'success'
            );
            tampildata1();
            //end
        }
        })
    }

    function btnreject(id){
        Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Ingin menolak dokumen ini.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#00a000',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Reject'
        }).then((result) => {
        if (result.isConfirmed) {
            //Begin
            $.ajax({
                url: "<?= base_url('Document_control/sign_reject'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    csrf_test_name: $.cookie('csrf_cookie_name')
                }
            });
            Swal.fire(
            'Rejected!',
            'Dokumen telah anda tolak.',
            'success'
            );
            tampildata1();
            //end
        }
        })
    }

</script>