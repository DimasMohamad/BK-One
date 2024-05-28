<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    function get_filter_posisi() {
        // Mendapatkan dan mengisi data untuk elemen dengan id "nama"
        $.get("<?= base_url('Whse/get_filter_nama') ?>", function(data, status) {
            $("#filter_nama").html(data);
        });

        // Mendapatkan dan mengisi data untuk elemen dengan id "jenis"
        $.get("<?= base_url('Whse/get_filter_jenis') ?>", function(data, status) {
            $("#filter_jenis").html(data);
        });

        // Mendapatkan dan mengisi data untuk elemen dengan id "satuan"
        $.get("<?= base_url('Whse/get_filter_satuan') ?>", function(data, status) {
            $("#filter_satuan").html(data);
        });

        // Mendapatkan dan mengisi data untuk elemen dengan id "supplier"
        $.get("<?= base_url('Whse/get_filter_supplier') ?>", function(data, status) {
            $("#filter_supplier").html(data);
        });
    }

    // Memanggil fungsi get_filter_posisi saat halaman dimuat
    window.onload = get_filter_posisi;
</script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Kartu Stok</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Inventory</li>
                <li class="breadcrumb-item active">Kartu Stok</li>
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
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Stok Masuk</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#doc-list" type="button" role="tab" aria-controls="doc-list" aria-selected="false">Stok Keluar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#doc-location" type="button" role="tab" aria-controls="doc-location" aria-selected="false">Master Stok</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- Konten tab Stok Masuk -->
                                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="" method="">
                                    <div class="col-2">
                                        <label for="inputNanme4" class="form-label">Kode Item</label>
                                        <select id="user_mr" name="user_mr" class="form-control"></select>
                                    </div>
                                    <div class="col-2">
                                        <label for="inputNanme4" class="form-label">Supplier</label>
                                        <select id="filter_supplier" name="filter_supplier" class="form-control"></select>
                                    </div>
                                    <div class="col-5">
                                        <label for="inputNanme4" class="form-label">Nama Item</label>
                                        <select id="filter_nama" name="filter_nama" class="form-control"></select>
                                    </div>
                                    <div class="col-1">
                                        <label for="inputNanme4" class="form-label">Satuan</label>
                                        <select id="filter_satuan" name="filter_satuan" class="form-control"></select>
                                    </div>
                                    <div class="col-2">
                                        <label for="inputNanme4" class="form-label">Jenis</label>
                                        <select id="filter_jenis" name="filter_jenis" class="form-control"></select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary" id="btnUpload">
                                            <span id="uploadText">Input</span>
                                            <span id="loadingText" style="display: none;">Loading...</span>
                                        </button>
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="doc-list" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- Konten tab Stok Keluar -->
                                <div class="row">
                                    <div class='col-xl-3'>
                                        <button class="btn btn-primary" onclick="tampildata2()" id="btntampil1"><i class="bi bi-search"></i>&nbsp;Stok Keluar</button>
                                        <button class="btn btn-primary" type="button" disabled="" id="btnloading1" style="display:none;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <br>
                                        <div id="tampilstokkeluar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="doc-location" role="tabpanel" aria-labelledby="profile-tab2">
                                <!-- Konten tab Master Stok -->
                                <div class="row">
                                    <div class='col-xl-3'>
                                        <button class="btn btn-primary" onclick="tampildata3()" id="btntampil2"><i class="bi bi-search"></i>&nbsp;Master Stok</button>
                                        <button class="btn btn-primary" type="button" disabled="" id="btnloading2" style="display:none;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <br>
                                        <div id="tampilmasterstok"></div>
                                    </div>
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

<script>
    function tampildata() {
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById("tampilstokmasuk").innerHTML = '';
        $.get("<?= base_url('Whse/stok_masuk') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil').style.display = '';
            $("#tampilstokmasuk").html(data);
        });
    }

    function tampildata2() {
        document.getElementById('btnloading1').style.display = '';
        document.getElementById('btntampil1').style.display = 'none';
        document.getElementById("tampilstokkeluar").innerHTML = '';
        $.get("<?= base_url('Whse/stok_keluar') ?>", function(data, status) {
            document.getElementById('btnloading1').style.display = 'none';
            document.getElementById('btntampil1').style.display = '';
            $("#tampilstokkeluar").html(data);
        });
    }

    function tampildata3() {
        document.getElementById('btnloading2').style.display = '';
        document.getElementById('btntampil2').style.display = 'none';
        document.getElementById("tampilmasterstok").innerHTML = '';
        $.get("<?= base_url('Whse/master_stok') ?>", function(data, status) {
            document.getElementById('btnloading2').style.display = 'none';
            document.getElementById('btntampil2').style.display = '';
            $("#tampilmasterstok").html(data);
        });
    }

    function printData(id) {
        window.open("<?= base_url('Marketing/print_recall?id=') ?>" + id);
    }

    function btnhapus(id) {
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

    $("#f_upld").on("submit", function(e) {
        e.preventDefault();
        $.ajax({
            url: "<?= base_url('Marketing/do_upload_recall'); ?>",
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
                    document.getElementById("nomor_form").value = "";
                    document.getElementById("nama_produk").value = "";
                    document.getElementById("nie").value = "";
                    document.getElementById("batch_lot").value = "";
                    document.getElementById("total_recall").value = "";
                    document.getElementById("alasan").value = "";
                    document.getElementById("hasil_inspeksi").value = "";
                    document.getElementById("tindakan").value = "";
                    document.getElementById("status").value = "";
                    document.getElementById("ketua_tim").value = "";
                    document.getElementById("anggota").value = "";
                    document.getElementById("otorisasi").value = "";
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }
            }
        });
    });
</script>