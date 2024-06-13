<?php
$row = json_decode($data, true);
?>

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
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="masker-existing" data-bs-toggle="tab" data-bs-target="#me" type="button" role="tab" aria-controls="home" aria-selected="true">Masker Existing</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="masker-alternative" data-bs-toggle="tab" data-bs-target="#ma" type="button" role="tab" aria-controls="doc-list" aria-selected="false">Masker Alternative</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="underpad" data-bs-toggle="tab" data-bs-target="#un" type="button" role="tab" aria-controls="doc-location" aria-selected="false">Underpad</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="polibib" data-bs-toggle="tab" data-bs-target="#po" type="button" role="tab" aria-controls="doc-location" aria-selected="false">Polibib</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="nurse-cap" data-bs-toggle="tab" data-bs-target="#nc" type="button" role="tab" aria-controls="doc-location" aria-selected="false">Nurse Cap</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2" id="myTabContent">
                            <?php
                            $categories = [
                                'me' => 'Masker Existing',
                                'ma' => 'Masker Alternative',
                                'un' => 'Underpad',
                                'po' => 'Polibib',
                                'nc' => 'Nurse Cap'
                            ];
                            foreach ($categories as $key => $label) { ?>
                                <div class="tab-pane fade <?php echo $key === 'me' ? 'active show' : ''; ?>" id="<?php echo $key; ?>" role="tabpanel" aria-labelledby="<?php echo $key; ?>">
                                    <!-- Konten tab <?php echo $label; ?>  -->
                                    <div class="row">
                                        <div class='col-xl-3'>
                                            <button class="btn btn-primary" onclick="tampildata('<?php echo $key; ?>')" id="btntampil<?php echo $key; ?>"><i class="bi bi-search"></i>&nbsp;<?php echo $label; ?></button>
                                            <button class="btn btn-primary" type="button" disabled="" id="btnloading<?php echo $key; ?>" style="display:none;">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                Loading...</button>
                                            <?php if (isset($row[0]['position1']) && $row[0]['position1'] == 'Lab') {
                                                echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#upload_spek_$key'>Upload File</button>";
                                            } ?>
                                        </div>
                                        <div class="col-xl-12">
                                            <br>
                                            <div id="tampil<?php echo $key; ?>"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
foreach ($categories as $key => $label) { ?>
    <!-- Modal <?php echo $label; ?> -->
    <div class="modal fade" id="upload_spek_<?php echo $key; ?>" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Spesifikasi <?php echo $label; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" id="f_upld_<?php echo $key; ?>" name="f_upld_<?php echo $key; ?>" enctype="multipart/form-data" method="post">
                        <div class="col-6">
                            <input type="text" id="nama_spek_<?php echo $key; ?>" name="nama_spek" class="form-control" placeholder="Nama Spesifikasi">
                        </div>
                        <div class="col-6">
                            <input type="file" name="userfile" size="20" class="form-control" accept="application/pdf" />
                        </div>
                        <div>
                            <textarea id="keterangan_<?php echo $key; ?>" name="keterangan" class="form-control" placeholder="Keterangan"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="btnUpload_<?php echo $key; ?>">Upload</button>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<script>
    function tampildata(type) {
        const btnloading = document.getElementById('btnloading' + type);
        const btntampil = document.getElementById('btntampil' + type);
        const tampil = document.getElementById('tampil' + type);
        btnloading.style.display = '';
        btntampil.style.display = 'none';
        tampil.innerHTML = '';
        $.get("<?= base_url('Lab/tampil_') ?>" + type, function(data, status) {
            btnloading.style.display = 'none';
            btntampil.style.display = '';
            tampil.innerHTML = data;
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
        });

        Toast.fire({
            icon: 'success',
            title: txt
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($categories as $key => $label) { ?>
            $("#f_upld_<?php echo $key; ?>").on("submit", function(e) {
                handleUpload(e, '<?php echo $key; ?>');
            });
        <?php } ?>
    });

    function handleUpload(e, type) {
        e.preventDefault();
        const btnUpload = $("#btnUpload_" + type);
        btnUpload.prop('disabled', true);

        $.ajax({
            url: "<?= base_url('Lab/upload_file/'); ?>" + type,
            type: "POST",
            data: new FormData(e.target),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                let response = JSON.parse(data);
                if (response.status === 'error') {
                    alert(response.message);
                } else {
                    btnUpload.prop('disabled', false);
                    $(".modal").modal("hide");
                    pesan_sukses('Tersimpan');
                    e.target.reset();
                    setTimeout(function() {
                        location.reload();
                    }, 800);
                }
            }
        });
    }

    function alert(txt) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: txt,
        });
    }

    function btnhapus(id, namafile, tipe) {
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
                        tipe: tipe,
                        namafile: namafile,
                        csrf_test_name: getCookie('csrf_cookie_name') // Menggunakan fungsi getCookie untuk mendapatkan nilai cookie
                    }
                }).done(function() {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    );
                    // Refresh tampilan setelah penghapusan
                    tampildata(tipe); // Memanggil fungsi tampildata dengan parameter tipe
                });
            }
        });
    }

    // Fungsi untuk mendapatkan nilai cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    // Fungsi untuk mendapatkan nilai cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    function btnview(filename, tipe) {
        window.open("<?= base_url('uploads/uploads_spek_') ?>" + tipe + '/' + filename, '_blank');
    }


    function btnview1(filename) {
        const url = "<?= base_url('uploads_spek/') ?>" + filename;
        window.open("<?= site_url('Lab/view_update_spek?file=') ?>" + encodeURIComponent(url), '_blank', 'noopener,noreferrer');
    }
</script>