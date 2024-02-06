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
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#doc-list" type="button" role="tab" aria-controls="doc-list" aria-selected="false">Daftar Dokumen</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab2" data-bs-toggle="tab" data-bs-target="#doc-location" type="button" role="tab" aria-controls="doc-location" aria-selected="false">Lokasi Dokumen</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <div class="tab-pane fade active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <!-- Konten tab home -->
                                <div class="row">
                                    <div class="col-xl-3">
                                        <button class="btn btn-primary" onclick="tampildata1()" id="btntampil1"><i class="bi bi-search"></i>&nbsp;View</button>
                                        <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...</button>

                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_dokumen">Upload File</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <br>
                                        <div id="tampildatasign"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="doc-list" role="tabpanel" aria-labelledby="profile-tab">
                                <!-- Konten tab daftar dokumen -->
                                <div class="row">
                                    <div class='col-xl-3'>
                                        <button class="btn btn-primary" onclick="tampildata2()" id="btntampil2"><i class="bi bi-search"></i>&nbsp;View</button>
                                        <button class="btn btn-primary" type="button" disabled="" id="btnloading2" style="display:none;">
                                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                            Loading...</button>
                                    </div>
                                    <div class="col-xl-12">
                                        <br>
                                        <div id="tampildatasign2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="doc-location" role="tabpanel" aria-labelledby="profile-tab2">
                                <!-- Konten tab lokasi dokumen -->
                                <div class="row">
                                    <div class="col-xl-3">
                                        <input id="lokasi_dokumen" type="text" class="form-control" placeholder="Contoh lokasi dokumen : L1.A">
                                    </div>
                                    <div class="col-xl-2">
                                        <select class="form-control" id="filter_divisi2">
                                            <option value='0'>--Pilih Divisi--</option>
                                            <option value='FINANCE ACCOUNTING'>FINANCE ACCOUNTING</option>
                                            <option value='GUDANG'>GUDANG</option>
                                            <option value='HRD - GA'>HRD - GA</option>
                                            <option value='IT'>IT</option>
                                            <option value='LEGAL'>LEGAL</option>
                                            <option value='MARKETING'>MARKETING</option>
                                            <option value='PPIC'>PPIC</option>
                                            <option value='PRODUKSI'>PRODUKSI</option>
                                            <option value='Purchasing'>PURCHASING</option>
                                            <option value='QC'>QC</option>
                                            <option value='RND'>RND</option>
                                            <option value='TEKNISI'>TEKNISI</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-2">
                                        <button class="btn btn-primary" onclick="simpandaftar()">Save</button>
                                    </div>
                                    <div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-2">
                                            <select class="form-control" id="filter_divisi">
                                                <option value='0'>--Pilih Divisi--</option>
                                                <option value='FINANCE ACCOUNTING'>FINANCE ACCOUNTING</option>
                                                <option value='GUDANG'>GUDANG</option>
                                                <option value='HRD - GA'>HRD - GA</option>
                                                <option value='IT'>IT</option>
                                                <option value='LEGAL'>LEGAL</option>
                                                <option value='MARKETING'>MARKETING</option>
                                                <option value='PPIC'>PPIC</option>
                                                <option value='PRODUKSI'>PRODUKSI</option>
                                                <option value='Purchasing'>PURCHASING</option>
                                                <option value='QC'>QC</option>
                                                <option value='RND'>RND</option>
                                                <option value='TEKNISI'>TEKNISI</option>
                                            </select>
                                        </div>
                                        <div class='col-xl-3'>
                                            <button class="btn btn-primary" onclick="tampildatalokasi()" id="btntampillokasi"><i class="bi bi-search"></i>&nbsp;View</button>
                                            <button class="btn btn-primary" type="button" disabled="" id="btnloadinglokasi" style="display:none;">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-xl-12">
                                            <div id="tampildatalokasi"></div>
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
<div class="modal fade" id="upload_dokumen" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Dokumen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <script>
                    function get_filter_posisi() {
                        // Mendapatkan dan mengisi data untuk elemen dengan id "user_dc"
                        $.get("<?= base_url('Document_control/get_filter_dc') ?>", function(data, status) {
                            $("#user_dc").html(data);
                        });

                        // Mendapatkan dan mengisi data untuk elemen dengan id "user_mr"
                        $.get("<?= base_url('Document_control/get_filter_mr') ?>", function(data, status) {
                            $("#user_mr").html(data);
                        });

                        // Mendapatkan dan mengisi data untuk elemen dengan id "user_mo"
                        $.get("<?= base_url('Document_control/get_filter_mo') ?>", function(data, status) {
                            $("#user_mo").html(data);
                        });

                        // Mendapatkan dan mengisi data untuk elemen dengan id "divisi"
                        $.get("<?= base_url('Document_control/get_filter_divisi') ?>", function(data, status) {
                            $("#divisi").html(data);
                        });

                        // Mengambil nilai divisi yang dipilih dan memuat data lokasi berdasarkan divisi yang dipilih
                        $("#divisi").change(function() {
                            var selectedDivisi = $(this).val();
                            $.get("<?= base_url('Document_control/get_filter_lokasi') ?>", {
                                divisi: selectedDivisi
                            }, function(data, status) {
                                $("#lokasi_hardcopy").html(data);
                            });
                        });
                    }

                    // Memanggil fungsi get_filter_posisi saat halaman dimuat
                    window.onload = get_filter_posisi;
                </script>
                <form class="row g-3" id="f_upld" name="f_upld" enctype="multipart/form-data" action="" method="">
                    <div>
                        <label for="inputNanme4" class="form-label">Nomor Dokumen</label>
                        <textarea id="nomor_dokumen" name="nomor_dokumen" class="form-control" placeholder="Contoh : BKI.FM.MR-01" required></textarea>
                    </div>
                    <hr>
                    <div>
                        <label for="inputNanme4" class="form-label">Tujuan Dokumen</label>
                        <select id="user_dc" name="user_dc" class="form-control" required></select>
                    </div>
                    <hr>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Disetujui</label>
                        <select id="user_mr" name="user_mr" class="form-control"></select>
                    </div>
                    <div class="col-6">
                        <label for="inputNanme4" class="form-label">Mengetahui</label>
                        <select id="user_mo" name="user_mo" class="form-control"></select>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="form-label">Upload File</label>
                        <input type="file" name="userfile" size="20" class="form-control" accept=".pdf, .doc, .docx" required />
                    </div>
                    <hr>
                    <div class="col-6">
                        <label class="form-label">Divisi</label>
                        <select id="divisi" name="divisi" class="form-control"></select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Lokasi Hardcopy</label>
                        <select id="lokasi_hardcopy" name="lokasi_hardcopy" class="form-control"></select>
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
</div>

<script>
    function tampildata1() {
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil1').style.display = 'none';
        document.getElementById("tampildatasign").innerHTML = '';
        $.get("<?= base_url('Document_control/tampil_data?') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil1').style.display = '';
            $("#tampildatasign").html(data);
        });
    }

    function tampildata2() {
        document.getElementById('btnloading2').style.display = '';
        document.getElementById('btntampil2').style.display = 'none';
        document.getElementById("tampildatasign").innerHTML = '';
        $.get("<?= base_url('Document_control/list_dokumen') ?>", function(data, status) {
            document.getElementById('btnloading2').style.display = 'none';
            document.getElementById('btntampil2').style.display = '';
            $("#tampildatasign2").html(data);
        });
    }

    function tampildatalokasi() {
        var divisi = $("#filter_divisi").val();
        document.getElementById('btnloadinglokasi').style.display = '';
        document.getElementById('btntampillokasi').style.display = 'none';
        document.getElementById("tampildatasign").innerHTML = '';
        $.get("<?= base_url('Document_control/list_lokasi?divisi=') ?>" + divisi, function(data, status) {
            document.getElementById('btnloadinglokasi').style.display = 'none';
            document.getElementById('btntampillokasi').style.display = '';
            $("#tampildatalokasi").html(data);
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

    function btndownload(filename, status) {
        // Membuat URL dengan nama file dan status yang diberikan
        var url = "<?= base_url('Document_control/downloadWithWatermark?file=') ?>" + filename + "&status=" + status;

        // Membuka URL dalam jendela baru
        window.open(url, '_blank');
    }

    function btnapprove(id) {
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

    function btnreject(id) {
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
                Swal.fire({
                    title: 'Masukkan alasan penolakan:',
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Reject',
                    showLoaderOnConfirm: true,
                    preConfirm: (text) => {
                        return $.ajax({
                            url: "<?= base_url('Document_control/sign_reject'); ?>",
                            type: 'POST',
                            cache: false,
                            data: {
                                id: id,
                                reason: text,
                                csrf_test_name: $.cookie('csrf_cookie_name')
                            }
                        });
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                            'Rejected!',
                            'Dokumen telah anda tolak.',
                            'success'
                        );
                        tampildata1();
                    }
                });
            }
        });
    }

    function btnhapuslok(id, namafile) {
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
                    url: "<?= base_url('Document_control/hapus_lokasidokumen'); ?>",
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
                tampildatalokasi();
                //end
            }
        })
    }

    function simpandaftar() {
        var lokasi = $("#lokasi_dokumen").val();
        var divisi = $("#filter_divisi2").val();
        if (lokasi === '') {
            pesan('Lokasi Dokumen belum diisi');
        } else if (divisi === '') {
            pesan('Divisi belum diisi');
        } else {
            $.ajax({
                url: "<?= base_url('Document_control/simpan_lokasi'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    lokasi: lokasi,
                    divisi: divisi,
                    csrf_test_name: $.cookie('csrf_cookie_name')
                },
                success: function() {
                    pesan_sukses('Tersimpan');
                    tampildatalokasi();
                    document.getElementById("lokasi_dokumen").value = "";
                    document.getElementById("filter_divisi2").value = "";
                },
                error: function() {
                    pesan('Gagal menyimpan data');
                }
            });
        }
    }
</script>