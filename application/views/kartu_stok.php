<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
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
                                <div>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stok_masuk" onclick="get_filter()">Stok Masuk</button>
                                </div>
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
    </section>
</main><!-- End #main -->

<div class="modal fade" id="stok_masuk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stok Masuk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="<?= base_url('Whse/simpan_stok'); ?>" method="post">
                    <div class="control-group after-add-more row g-3">
                        <div class="col-4">
                            <div class="input-group">
                                <input type="text" id="search_kode_item" class="form-control" placeholder="Cari Kode Item">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Pilih</button>
                                <ul id="dropdown_kode_item" class="dropdown-menu">
                                    <!-- Daftar dropdown items akan diisi melalui JavaScript -->
                                </ul>
                            </div>
                        </div>
                        <div class="col-4">
                            <input type="text" name="kode_name[]" class="form-control jumlah" placeholder="Nama Barang" required>
                        </div>
                        <div class="col-2">
                            <input type="text" name="supplier[]" class="form-control jenis_barang" placeholder="Supplier" required>
                        </div>
                        <div class="col-1">
                            <input type="text" name="satuan[]" class="form-control keterangan" placeholder="Satuan" required>
                        </div>
                        <div class="col-1">
                            <input type="text" name="nilai[]" class="form-control keterangan" placeholder="Nilai" required>
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
                <div class="copy d-none">
                    <div class="control-group row g-3">
                        <div class="col-3">
                            <input type="text" onkeyup="isi_otomatis(this)" name="kode_item[]" class="form-control kode_barang" placeholder="Kode Item" required>
                        </div>
                        <div class="col-4">
                            <input type="text" name="kode_name[]" class="form-control jumlah" placeholder="Nama Barang" required>
                        </div>
                        <div class="col-2">
                            <input type="text" name="supplier[]" class="form-control jenis_barang" placeholder="Supplier" required>
                        </div>
                        <div class="col-1">
                            <input type="text" name="satuan[]" class="form-control keterangan" placeholder="Satuan" required>
                        </div>
                        <div class="col-1">
                            <input type="text" name="nilai[]" class="form-control keterangan" placeholder="Nilai" required>
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
    //Script add and remove kolom
    $(document).ready(function() {
        $(".add-more").click(function() {
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });

        $("body").on("click", ".remove", function() {
            $(this).parents(".control-group").remove();
        });

        // Menyembunyikan elemen dengan class 'copy d-none'
        $(".copy.d-none").hide();
    });

    $(document).ready(function() {
        // AJAX request to get data for dropdown
        $.ajax({
            url: '<?php echo base_url('Whse/get_union_kartu_stok'); ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // If request is successful, fill dropdown with received data
                if (response.union_kartu_stok.length > 0) {
                    var options = '';
                    $.each(response.union_kartu_stok, function(index, item) {
                        options += '<li><a class="dropdown-item" href="#" data-value="' + item.rowid + '">' + item.kode_item + '</a></li>';
                    });
                    $('#dropdown_kode_item').html(options);
                }
            }
        });

        // Handle input text keyup event for filtering dropdown
        $('#search_kode_item').on('keyup', function() {
            var searchText = $(this).val().toLowerCase();
            $('#dropdown_kode_item li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
            });
        });

        // Handle dropdown item click event
        $(document).on('click', '.dropdown-item', function() {
            var selectedValue = $(this).data('value');
            var selectedText = $(this).text();
            $('#search_kode_item').val(selectedText);
        });
    });

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
</script>