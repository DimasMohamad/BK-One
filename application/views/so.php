<main id="main" class="main">

    <div class="pagetitle">
        <h1>SALES ORDER</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Sales - A/R</li>
                <li class="breadcrumb-item active">SO</li>
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
                                <label class="small mb-1">Mulai</label>
                                <input type="date" id="mulai" class="form-control">
                            </div>
                            <div class="col-xl-3">
                                <label class="small mb-1">Hingga</label>
                                <input type="date" id="hingga" class="form-control">
                            </div>
                            <div class="col-xl-6">
                                <label class="small mb-1">Customer</label>
                                <input type="text" id="cari" class="form-control">
                            </div>
                            <input type="hidden" name="hlmn" id="hlmn">
                        </div><br>
                        <button type="button" class="btn btn-primary" id="tombol-tampil"><i class="bi bi-search"></i>&nbsp;View</button>
                        <!--
                        <button type="button" class="btn btn-warning" onclick="cetak()"><i class="bi bi-printer"></i>&nbsp;Print</button>
                        <button type="button" class="btn btn-success" onclick="unduh()"><i class="bi bi-download"></i>&nbsp;Download</button>
-->
                        <div class="card-body">
                            <!-- Default Table -->
                            <br>
                            <div id="tampildata" style="overflow-x:auto;"></div>
                            <!-- End Default Table Example -->
                        </div>
                    </div>
                </div>
            </div>
    </section>

</main><!-- End #main -->

<script>
    loadPagination(1);
        document.getElementById('hlmn').value = 1;

        function loadPagination(pagno) {
            var mulai = $('#mulai').val();
            var hingga = $('#hingga').val();
            var cari = $('#cari').val();
            $.get("<?= base_url() ?>index.php/So/tb_so/" + pagno + "?mulai=" + mulai + "&hingga=" + hingga + "&cari=" + cari, function(data, status) {
                $("#tampildata").html(data);
            });
        }

        $("#tombol-tampil").click(function(pagno) {
            var mulai = $('#mulai').val();
            var hingga = $('#hingga').val();
            var cari = $('#cari').val();
            $.get("<?= base_url() ?>index.php/So/tb_so?mulai=" + mulai + "&hingga=" + hingga + "&cari=" + cari, function(data, status) {
                $("#tampildata").html(data);
            });
        });

        $('#tampildata').on('click', 'a', function(e) {
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            loadPagination(pageno);
            $('#hlmn').val(pageno);
        });

        var cari = document.getElementById("cari");
        cari.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            $("#tombol-tampil").click();
        }
        });
</script>