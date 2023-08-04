<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Produk Palsu atau Diduga Palsu</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Sales - A/R</li>
                <li class="breadcrumb-item active">Formulir Produk Palsu atau Diduga Palsu</li>
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_dokumen">Formulir Produk</button>
                                <div>
                                    <br>
                                </div>
                            </div>
                            <div id="tampildataprodukpalsu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->
<div class="modal fade" id="upload_dokumen" tabindex="-1" style="display: none;" aria-hidden="true" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulir Produk Palsu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                
                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="" method="">
                    <div>
                        <label for="inputNanme4" class="form-label">Nama Produk</label>
                        <input type="text" id="nama_produk" name="nama_produk" class="form-control"></input>
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Penjelasan Masalah</label>
                        <textarea id="penjelasan_masalah" name="penjelasan_masalah" class="form-control"></textarea>
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Hasil Inspeksi</label>
                        <textarea id="hasil_inspeksi" name="hasil_inspeksi" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Tindakan yang diambil</label>
                        <textarea id="tindakan" name="tindakan" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Status</label>
                        <input type="text" id="status" name="status" class="form-control"></input>
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
    function tampildata(){
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById("tampildataprodukpalsu").innerHTML = '';
        $.get("<?= base_url('Marketing/tampil_data') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil').style.display = '';
            $("#tampildataprodukpalsu").html(data);
        });
    }

    function printData(id) {
        window.open("<?= base_url('Marketing/print_produk_palsu?id=')?>"+id);

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
            url: "<?= base_url('Marketing/do_upload'); ?>",
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
                    document.getElementById("nama_produk").value = "";
                    document.getElementById("penjelasan_masalah").value = "";
                    document.getElementById("hasil_inspeksi").value = "";
                    document.getElementById("tindakan").value = "";
                    document.getElementById("status").value = "";
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            }
        });
    });

    function btnhapus(id){
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
                url: "<?= base_url('Marketing/hapus_formulir'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    csrf_test_name: $.cookie('csrf_cookie_name')
                }
            });
            Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
            );
            tampildata();
            //end
        }
        })
    }
</script>