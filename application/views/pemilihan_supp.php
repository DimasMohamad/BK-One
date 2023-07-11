<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Pemilihan supplier</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Purchasing</li>
                <li class="breadcrumb-item active">Pemilihan supplier</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-xl-2">
                                <input type="date" id="mulai" class="form-control">
                            </div>
                            <div class="col-xl-2">
                                <input type="date" id="hingga" class="form-control">
                            </div>
                            <div class="col-xl-8">
                                <button type="button" class="btn btn-primary" onclick="tampil()" id="btntampil"><i class="bi bi-search"></i>&nbsp;View</button>
                                <button class="btn btn-primary" type="button" disabled="" id="btnloading" style="display:none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...</button>
                                <button type="button" class="btn btn-warning" onclick="add_supp()">Penilaian</button>
                                <a href="<?= base_url('purchasing/master_kriteria_penilaian')?>" class="btn btn-secondary">master nilai</a>
                            </div>
                            
                        </div><br>
                        
                    </div>
                    <div class="card-body">
                    <div id="tampildata"></div>
                    </div>
                </div>
            </div>
    </section>

</main><!-- End #main -->

<!-- Basic Modal -->
<div class="modal fade" id="f_add_supp">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <form id="input_supp" name="input_supp" method="POST" action="">
            <input type="hidden" name="tglmulai" id="tglmulai">
            <input type="hidden" name="tglhingga" id="tglhingga">
            <div class="modal-header">
                <h5 class="modal-title">Add Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-xl-12">
                    <div class="form-check" style="float:right;">
                        <input class="form-check-input" type="checkbox" id="gridCheck1" onclick="pilih_semua()">
                        <label class="form-check-label" for="gridCheck1">Select All</label>
                    </div>
                </div>
                <div class="col-xl-12">
                    <label class="small mb-1">Supplier</label>
                    <select class="form-control" id="supp" name="supp[]" multiple="multiple"></select>
                </div>
                <div class="col-xl-12">
                <label class="small mb-1">Penilaian</label>
                    <table class="table table-sm">
                        <tbody>
                            <?php
                            $i = 1;
                            foreach($judul as $j){
                                echo"<tr>";
                                echo"<td>".$i."</td>";
                                echo"<td>".$j['penilaian']."<input type='hidden' id='idnilai' name='idnilai[]' value='".$j['rowid']."'></td>";
                                echo"<td><select id='addnilai' name='addnilai[]' class='form-control'>";
                                foreach($subtitle as $st){
                                    if($st['fatherid'] == $j['rowid']){
                                        echo"<option value='".$st['nilai']."'>".$st['penilaian']."&nbsp(".$st['nilai'].")</option>";
                                    }                                    
                                }
                                echo"</select></td>";
                                echo"</td>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="button" disabled="" id="btnloading2" style="display:none;">
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Loading...</button>
                <button type="submit" class="btn btn-primary" id="btnsimpan2">Save changes</button>
            </div>
        </form>
        </div>
    </div>
</div><!-- End Basic Modal-->

<script type="text/javascript">
    $(document).ready(function() {
        $('#supp').select2({
            placeholder: "Pilih Grup",
            allowClear: true,
            language: "id",
            width: '100%',
            dropdownParent: $("#f_add_supp")
        });

        $('#input_supp').on('submit', function(e) {
            document.getElementById('btnsimpan2').style.display = 'none';
            document.getElementById('btnloading2').style.display = '';
            e.preventDefault();
            $.ajax({
                url: "<?= base_url('Purchasing/simpan_pemilihan_supp') ?>",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(status) {                    
                    document.getElementById('btnsimpan2').style.display = '';
                    document.getElementById('btnloading2').style.display = 'none';
                    pesan_sukses('Nilai telah disimpan');
                    $("#f_add_supp").modal("hide");  
                    tampil();    
                }
            });
        });
    });

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

    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    function tampil(){
        let mulai = $("#mulai").val();
        let hingga = $("#hingga").val();
        //load();
        document.getElementById('btntampil').style.display = 'none';
        document.getElementById('btnloading').style.display = '';
        $.get("<?= base_url('purchasing/tb_penilaian_supplier?s=') ?>"+mulai+"&e="+hingga, function(data, status) {
            $("#tampildata").html(data);
            if(status == 'success'){
                document.getElementById('btntampil').style.display = '';
                document.getElementById('btnloading').style.display = 'none';
            }
        });
    }

    

    function add_supp(){
        var s = $("#mulai").val();
        var e = $("#hingga").val();
        document.getElementById('tglmulai').value= s;
        document.getElementById('tglhingga').value= e;
        if(s == ''){
            pesan('Tanggal harus diisi');
            $("#mulai").focus();
        }else{
            if(e == ''){
                pesan('Tanggal harus diisi');
                $("#hingga").focus();
            }else{
                $("#f_add_supp").modal("show");
                $.get("<?= base_url('Purchasing/get_supp_penilaian?s=') ?>"+s+"&e="+e, function(data, status) {
                    $("#supp").html(data);
                });
            }
        }
    }

    var cari = document.getElementById("cari");
    cari.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            tampil();
        }
    });

    function pilih_semua(){
        var checkBox = document.getElementById("gridCheck1");
        if (checkBox.checked == true){
            $('#supp').select2('destroy').find('option').prop('selected', 'selected').end().select2();
        } else {
            $('#supp').select2('destroy').find('option').prop('selected', false).end().select2();
            $('#supp').select2({
            placeholder: "Pilih Grup",
            allowClear: true,
            language: "id",
            width: '100%',
            dropdownParent: $("#f_add_supp")
            });
        }
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

</script>
