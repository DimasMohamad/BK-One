<main id="main" class="main">

    <div class="pagetitle">
        <h1>Update Spesifikasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Lab</li>
                <li class="breadcrumb-item active">Update Spesifikasi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <!--Konten daftar dokumen baru-->
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- -->
                                <div class="row">
                                    <div class="col-xl-3">
                                        <button class="btn btn-primary" onclick="tampildata()" id="btntampil1"><i class="bi bi-search"></i>&nbsp;View</button>
                                        <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...</button>
                                        <label class="form-label"></label>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_spek">Upload File</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <br>
                                        <div id="tampildata"></div>
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
<div class="modal fade" id="upload_spek" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Spesifikasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="" method="">
                    <div class="col-6">
                        <input type="text" id="nama_spek" name="nama_spek" class="form-control" placeholder="Nama Spesifikasi">
                    </div>
                    <div class="col-6">
                        <input type="file" name="userfile" size="20" class="form-control" accept="application/pdf" />
                    </div>
                    <div>
                        <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
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
    function tampildata() {
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil1').style.display = 'none';
        document.getElementById("tampildata").innerHTML = '';
        $.get("<?= base_url('Lab/tampil_data_spek') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil1').style.display = '';
            $("#tampildata").html(data);
        });
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

    $("#f_upld").on("submit", function(e) {
        $("#btnUpload").prop('disabled', true); // Menonaktifkan tombol selama proses upload berlangsung
        $("#uploadText").hide(); // Sembunyikan teks "Upload"
        $("#loadingText").show(); // Tampilkan teks "Loading..."
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('Lab/do_upload'); ?>",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                if (data == 1) {
                    alert('Upload gagal');
                } else {
                    $("#btnUpload").prop('disabled', false); // Mengaktifkan tombol setelah proses upload selesai
                    $("#uploadText").show(); // Tampilkan kembali teks "Upload"
                    $("#loadingText").hide(); // Sembunyikan teks "Loading..."
                    $("#tombol-tampil").click();
                    //$("#f_upload_bt").modal("hide");
                    //$("#upload_spek").modal("hide");
                    pesan_sukses('Tersimpan');
                    document.getElementById("nama_spek").value = "";
                    document.getElementById("keterangan").value = "";
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            }
        });
    });

    function btnhapus(id, namafile) {
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
                    url: "<?= base_url('Lab/hapus_spek'); ?>",
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
                tampildata();
            }
        })
    }

    function btndownload(filename) {
        window.open("<?= base_url('uploads_spek/') ?>" + filename, '_blank');
    }
</script>