<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Daftar Rekanan Tidak Terpilih</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Business Partner Tidak Terpilih</li>
                <li class="breadcrumb-item active">Daftar Rekanan Tidak Terpilih</li>
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
                                    <button class="btn btn-warning" onclick="printData()"><i class="bi bi-printer"></i>&nbsp;Print</button>
                                </div>
                                <div class="col-xl-12">
                                    <br>
                                    <div id="tampildatabp"></div>
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
    function tampildata(){
        document.getElementById('btnloading').style.display = '';
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById("tampildatabp").innerHTML = '';
        $.get("<?= base_url('Busines_partner/tb_daftar_rekanan_tidakterpilih') ?>", function(data, status) {
            document.getElementById('btnloading').style.display = 'none';
            document.getElementById('btntampil').style.display = '';
            $("#tampildatabp").html(data);
        });
    }

    function printData() {
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        window.open("<?= base_url('Busines_partner/print_rekanan_tidakterpilih?mulai=') ?>");
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
                url: "<?= base_url('Busines_partner/hapus_tidak_terpilih'); ?>",
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