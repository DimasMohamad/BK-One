<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Nota Manual</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Purchasing - A/R</li>
                <li class="breadcrumb-item active">Nota Manual</li>
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
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_nota" onclick="get_filter()">Upload File</button>
                                </div>
                                <div class="col-xl-12">
                                    <br>
                                    <div id="tampildatanm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<div class="modal fade" id="upload_nota" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PO MANUAL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">                
                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="<?= base_url('Purchasing/simpan_nota'); ?>" method="post">
                    <div class="control-group after-add-more row g-3">
                    <div class="col-8"></div>
                    <div class="col-4">
                        <input type="text" class="form-control" placeholder="Nomor PO" id="no_po" name="no_po">
                    </div>
                    <div class="col-8"></div>
                    <div class="col-4">
                        <input type="date" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal">
                    </div>
                    <div class="col-7">
                        <label class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="get_nama" name="get_nama" list="list_nama">
                        <datalist id="list_nama">
                            <select class="form-control" id="nama_cus"></select>
                        </datalist>
                    </div>
                    <div class="col-5">
                        <label class="form-label">Kota</label>
                        <input type="text" class="form-control" id="kota" name="kota">
                    </div>
                    <div class="col-7">
                        <label class="form-label">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                    <div class="col-5">
                        <label class="form-label">Attn</label>
                        <input type="text" class="form-control" id="attn" name="attn">
                    </div>
                    <div class="col-7">
                        <label class="form-label">TOP</label>
                        <select class="form-control" id="top" name="top"></select>
                    </div>
                    <div class="col-5">
                        <label class="form-label">No. Telp</label>
                        <input type="text" class="form-control" id="telepon" name="telepon">
                    </div>
                    <hr>
                    <div class="col-1">
                        <input type="text" onkeyup="isi_otomatis(this)" name="kode_barang[]" class="form-control kode_barang" placeholder="Kode" required>
                    </div>
                    <div class="col-3">
                        <input type="text" name="jenis_barang[]" class="form-control jenis_barang" placeholder="Nama Barang" required>
                    </div>
                    <div class="col-1">
                        <input type="text" name="jumlah[]" class="form-control jumlah" placeholder="Jumlah" required>
                    </div>
                    <div class="col-3">
                        <input type="text" name="satuan[]" class="form-control satuan" placeholder="Satuan" required>    
                    </div>
                    <div class="col-3">
                        <input type="text" name="keterangan[]" class="form-control keterangan" placeholder="Keterangan" required>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-success add-more" type="button">
                            <i class="glyphicon glyphicon-plus"></i> Add
                        </button>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                    </div>
                </form>
                <div class="copy hide">
                    <div class="control-group row g-3">
                        <div class="col-1">
                            <input type="text" onkeyup="isi_otomatis(this)" name="kode_barang[]" class="form-control kode_barang" placeholder="Kode">
                        </div>
                        <div class="col-3">
                            <input type="text" name="jenis_barang[]" class="form-control jenis_barang" placeholder="Nama Barang">
                        </div>
                        <div class="col-1">
                            <input type="text" name="jumlah[]" class="form-control jumlah" placeholder="Jumlah">
                        </div>
                        <div class="col-3">
                            <input type="text" name="satuan[]" class="form-control satuan" placeholder="Satuan">    
                        </div>
                        <div class="col-3">
                            <input type="text" name="keterangan[]" class="form-control keterangan" placeholder="Keterangan">
                        </div>
                        <div class="col-1">
                            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function isi_otomatis(inputElement) {
        var kode = $(inputElement).val();
        var parentControlGroup = $(inputElement).closest(".control-group");
        
        $.ajax({
            url: "<?= base_url('Purchasing/get_list_item'); ?>",
            data: "kode_barang=" + kode,
        }).success(function (data) {
            var obj = JSON.parse(data);
            parentControlGroup.find('.jenis_barang').val(obj.ItemName);
            parentControlGroup.find('.satuan').val(obj.UgpCode);
        });
    }

    $(document).ready(function() {
        $(".add-more").click(function() { 
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        // Saat tombol remove diklik, control group akan dihapus 
        $("body").on("click", ".remove", function() { 
            $(this).parents(".control-group").remove();
        });
        
        // Menyembunyikan elemen dengan class 'copy hide'
        $(".copy.hide").hide();
    });
    
    function tampildata(){
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById("tampildatanm").innerHTML = '';
        $.get("<?= base_url('Purchasing/tampil_nota_manual') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil').style.display = '';
            $("#tampildatanm").html(data);
        });
    }

    function btnprint(no_po) {
        var printURL = "<?= base_url('Purchasing/print_nota_manual') ?>?no_po=" + no_po;
        window.open(printURL);
    }

    function btnhapus(no_po){
        Swal.fire({
        title: 'Are you sure? ',
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
                url: "<?= base_url('Purchasing/hapus_tidak_terpilih'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    no_po: no_po,
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

    $("#f_upld").on("submit", function (e) {
        e.preventDefault();

        var no_po = $("#no_po").val();
        var tanggal = $("#tanggal").val();
        var get_nama = $("#get_nama").val();
        var kota = $("#kota").val();
        var alamat = $("#alamat").val();
        var attn = $("#attn").val();
        var top = $("#top").val();
        var telepon = $("#telepon").val();

        if (no_po === "") {
            pesan('Harap isi Nomor PO sebelum mengupload.');
            return;
        } else if (tanggal === "") {
            pesan('Harap isi Tanggal sebelum mengupload.');
            return;
        } else if (get_nama === "") {
            pesan('Harap isi Nama Pelanggan sebelum mengupload.');
            return;
        } else if (kota === "") {
            pesan('Harap isi Kota sebelum mengupload.');
            return;
        } else if (alamat === "") {
            pesan('Harap isi Alamat sebelum mengupload.');
            return;
        } else if (attn === "") {
            pesan('Harap isi Attn sebelum mengupload.');
            return;
        } else if (top === "0") {
            pesan('Harap pilih Payment Terms sebelum mengupload.');
            return;
        }

        // Jika semua input sudah diisi, kirim formulir
        $.ajax({
            url: $(this).attr("action"),
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data == 1) {
                    pesan('Upload gagal');
                } else {
                    pesan_sukses('Tersimpan');
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                    // Refresh tampilan data setelah upload berhasil
                    tampildata();
                }
            }
        });
    });


    function get_filter(){
        $.get("<?= base_url('Purchasing/get_nama_cus') ?>", function(data, status) {
            $("#nama_cus").html(data);
        });
        $.get("<?= base_url('Purchasing/get_top') ?>", function(data, status) {
            $("#top").html(data);
        });
    }
</script>