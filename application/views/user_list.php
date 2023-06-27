<main id="main" class="main">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>

    <div class="pagetitle">
        <h1>User List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">user list</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row"> 
                                <div class="col-xl-3">
                                    <button class="btn btn-primary" onclick="tampildata()">View User List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row"> 
                            <div class="col-xl-12">
                                <div id="tampildata" style="overflow-x:auto;"></div>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- User Akses -->
<div class="modal fade" id="f_akses" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User Access</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="id_user">
                <div id="tampildataakses"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End User Akses-->

<script>
    function tampildata(){
        $.get("<?= base_url('User/tb_user_list') ?>", function(data, status) {
            $("#tampildata").html(data);
        });
    }

    function nonaktifkan(id){
        $.ajax({
            url: "<?= base_url('User/nonaktifkan'); ?>",
            type: 'POST',
            cache: false,
            data: {
                id: id,
                csrf_test_name: $.cookie('csrf_cookie_name')
            },
            success: function() {
                // begin
                tampildata();
                //end
            }
        });
    }

    function aktifkan(id){
        $.ajax({
            url: "<?= base_url('User/aktifkan'); ?>",
            type: 'POST',
            cache: false,
            data: {
                id: id,
                csrf_test_name: $.cookie('csrf_cookie_name')
            },
            success: function() {
                // begin
                tampildata();
                //end
            }
        });
    }

    function simpandata(){
        let nama = $("#nama").val();
        let sandi = $("#sandi").val();
        if(nama == '' || sandi == ''){
            error_msg('nama dan sandi masih kosong');
        }else{
            $.ajax({
                url: "<?= base_url('User/simpan_user'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    nama: nama,
                    sandi:sandi,
                    csrf_test_name: $.cookie('csrf_cookie_name')
                },
                success: function() {
                    // begin
                    tampildata();
                    //end
                }
            });
        }
    }

    function hapusdata(id){
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
            //begin
            $.ajax({
            url: "<?= base_url('User/hapus_user'); ?>",
            type: 'POST',
            cache: false,
            data: {
                id:id,
                csrf_test_name: $.cookie('csrf_cookie_name')
            },
            success: function() {
                // begin
                tampildata();
                //end
            }
            });
            //end
        }
        })
    }


function akses(id){
    $.get("<?= base_url('User/tb_menu?id=') ?>"+id, function(data, status) {
        $("#tampildataakses").html(data);
    });
    $("#id_user").val(id);
    $("#f_akses").modal("show");
}

function buka_akses(id_menu,id_sub_menu){
    let id_user = $("#id_user").val();
    $.ajax({
        url: "<?= base_url('User/buka_akses'); ?>",
        type: 'POST',
        cache: false,
        data: {
            id_user:id_user,
            id_menu:id_menu,
            id_sub_menu:id_sub_menu,
            csrf_test_name: $.cookie('csrf_cookie_name')
        },
        success: function() {
            // begin
            akses(id_user);
            //end
        }
    });
}

function tutup_akses(id_akses){
    let id_user = $("#id_user").val();
    var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>',
    csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
    $.ajax({
        url: "<?= base_url('User/tutup_akses'); ?>",
        type: 'POST',
        cache: false,
        data: {
            id_akses:id_akses,
            csrf_test_name: $.cookie('csrf_cookie_name')
        },
        success: function() {
            // begin
            akses(id_user);
            //end
        }
    });
}

function error_msg(pesan){
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'error',
        title: pesan
        })
    }
</script>