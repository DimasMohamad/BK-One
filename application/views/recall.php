<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Formulir Recall</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Marketing</li>
                <li class="breadcrumb-item active">Formulir Recall</li>
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_dokumen">Formulir Recall</button>
                                </div>
                                <div class="col-xl-12">
                                    <br>
                                    <div id="tampildatarecall"></div>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulir Recall</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                
                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="" method="">
                    <div>
                        <label for="inputNanme4" class="form-label">Nomor Form</label>
                        <input type="text" id="nomor_form" name="nomor_form" class="form-control"></input>
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Nama Produk</label>
                        <textarea id="nama_produk" name="nama_produk" class="form-control"></textarea>
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Nomor Ijin Edar</label>
                        <textarea id="nie" name="nie" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Nomot Batch/LOT</label>
                        <textarea id="batch_lot" name="batch_lot" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Total Recall</label>
                        <input type="text" id="total_recall" name="total_recall" class="form-control"></input>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Alasan</label>
                        <input type="text" id="alasan" name="alasan" class="form-control"></input>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Hasil Inspeksi</label>
                        <input type="text" id="hasil_inspeksi" name="hasil_inspeksi" class="form-control"></input>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Tindakan</label>
                        <input type="text" id="tindakan" name="tindakan" class="form-control"></input>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Status</label>
                        <input type="text" id="status" name="status" class="form-control"></input>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Ketua Tim</label>
                        <input type="text" id="ketua_tim" name="ketua_tim" class="form-control"></input>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Anggota</label>
                        <input type="text" id="anggota" name="anggota" class="form-control"></input>
                    </div>
                    <div>
                        <label for="inputNanme4" class="form-label">Otorisasi</label>
                        <input type="text" id="otorisasi" name="otorisasi" class="form-control"></input>
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
        document.getElementById("tampildatarecall").innerHTML = '';
        $.get("<?= base_url('Marketing/tampil_data_recall') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil').style.display = '';
            $("#tampildatarecall").html(data);
        });
    }

    function printData(id) {
        window.open("<?= base_url('Marketing/print_recall?id=')?>"+id);
    }

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
                url: "<?= base_url('Marketing/hapus_recall'); ?>",
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