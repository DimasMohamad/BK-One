<main id="main" class="main">
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <div class="pagetitle">
        <h1>INVENTORY COSTING</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Inventory</li>
                <li class="breadcrumb-item active">Inventory costing</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">     
                                <div class="col-xl-1">
                                    <label class="col-sm-12 col-form-label">Month</label>
                                </div>
                                <div class="col-xl-3">
                                   <input type="text" id="periode" class="form-control">
                                </div>

                                <div class="col-xl-4">
                                    <button class="btn btn-primary" onclick="tampildata()" id="btntampil"><i class="bi bi-search"></i>&nbsp;View</button>
                                    <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...</button>
                                    <button class="btn btn-success" onclick="unduh()"><i class="bi bi-download"></i>&nbsp;Download</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-xl-12">
                        
                    </div>
                </div>
                <div id="tampildata"></div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

<!-- kartu stok -->
<div class="modal fade" id="trace" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kartu Stok</h5>
                <input type="hidden" id="itemcode">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                    <div id="tampildetail"></div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End Basic Modal-->

<!-- konversi -->
<div class="modal fade" id="konversi" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konversi Stok</h5>
                <input type="hidden" id="itemcode">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="tampilkonversi"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div><!-- End konversi-->

<script>
    function formatNumber (num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
    }

    function tampildata(){
        var periode = $("#periode").val();
        if(periode == ''){
            error_msg('Please fill month period');
        }else{
            document.getElementById('btntampil').style.display = 'none';
            document.getElementById('btnloading').style.display = '';
            $.get("<?= base_url('Finance/tb_inv_costing?periode=') ?>"+periode, function(data, status) {
                $("#tampildata").html(data);
                if(status == 'success'){
                    //swal.close();
                    document.getElementById('btntampil').style.display = '';
                    document.getElementById('btnloading').style.display = 'none';
                }
            });
        }
    }

    function unduh(){
        var periode = $("#periode").val();
        if(periode == ''){
            error_msg('Please fill month period');
        }else{
        window.open("<?= base_url('Finance/tb_inv_costing_xls?periode=') ?>"+periode,"_self");
        }
    }

    function detail(id){
        $("#itemcode").val(id);
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        let base_url = "<?= base_url();?>";
        $("#tampildetail").html("<center><img src='"+base_url+"assets/img/load.gif' width='80px' height='80px'></center>");
        $.get("<?= base_url('Whse/trace_item?item=') ?>"+id, function(data, status) {
            $("#tampildetail").html(data);
        });
        $("#trace").modal("show");
    }

    function load(){
        let timerInterval
        Swal.fire({
        title: 'Loading please wait',
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        }).then((result) => {
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('Loading done')
        }
        })
    }

    function konversi(id,nilai){
        $("#konversi").modal("show");
        $.get("<?= base_url('Whse/hitung_konversi?id=') ?>"+id+"&qty="+nilai, function(data, status) {
            $("#tampilkonversi").html(data);
        });
    }

    function pesan(id,konv){
        Swal.fire({
        title: 'Konversi tidak ditemukan untuk Item <br>'+id,
        text: "Buat konversi untuk item ini ? ",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, buat konversi!'
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "<?= base_url('Whse/add_konversi'); ?>",
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    konv:konv
                },
                success: function() {
                    // begin
                    Swal.fire(
                    'Success',
                    'Konversi berhasil dibuat',
                    'success'
                    )        
                    //end
                }
            });
        }
        })
    }

    $(function() {
			$("#periode").datepicker({
				changeMonth: true,
				changeYear: true,
				showButtonPanel: true,
				dateFormat: 'mm-yy',
				onClose: function(dateText, inst) {
					$(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
				}
			});
		});

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