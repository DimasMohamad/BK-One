<main id="main" class="main">

    <div class="pagetitle">
        <h1>Item Master Data</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Inventory</li>
                <li class="breadcrumb-item active">Item master data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="search-form d-flex align-items-center">
                                    <input type="text" name="cari" id="cari" class="form-control" placeholder="Cari barang" title="Enter search keyword">
                                    <button type="button" id="tombol-tampil" title="Search" class="btn btn-primary"><i class="bi bi-search"></i></button>
                                </div>
                            </div>
                            <input type="hidden" name="hlmn" id="hlmn">
                        </div>
                        <!--<div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Aktifkan untuk mengganti database ke BKI_2024</label>
                        </div>-->
                    </div>
                </div>
                <div id="tampildata" style="overflow-x:auto;"></div>
            </div>
    </section>

</main><!-- End #main -->

<script>
    $(document).ready(function() {
        // Fungsi untuk menangani perubahan pada switch
        $('#flexSwitchCheckDefault').change(function() {
            var isChecked = $(this).prop('checked');
            // Jika switch aktif
            if (isChecked) {
                // Ganti URL AJAX dengan URL untuk database BKI_KONFIRM
                $('#tombol-tampil').off('click').on('click', function(pagno) {
                    var cari = $('#cari').val();
                    $.get("<?= base_url() ?>index.php/Whse/tb_stok_confirm?cari=" + cari, function(data, status) {
                        $("#tampildata").html(data);
                    });
                });
            } else {
                // Ganti URL AJAX dengan URL untuk database BKI_LIVE
                $('#tombol-tampil').off('click').on('click', function(pagno) {
                    var cari = $('#cari').val();
                    $.get("<?= base_url() ?>index.php/Whse/tb_stok?cari=" + cari, function(data, status) {
                        $("#tampildata").html(data);
                    });
                });
            }
        });

        // Fungsi untuk memuat data stok ketika halaman pertama dimuat
        loadPagination(1);
        document.getElementById('hlmn').value = 1;

        // Fungsi untuk memuat data stok berdasarkan nomor halaman yang diberikan
        function loadPagination(pagno) {
            var cari = $('#cari').val();
            $.get("<?= base_url() ?>index.php/Whse/tb_stok/" + pagno + "?cari=" + cari, function(data, status) {
                $("#tampildata").html(data);
            });
        }

        // Event handler untuk tombol tampilkan
        $("#tombol-tampil").click(function(pagno) {
            var cari = $('#cari').val();
            $.get("<?= base_url() ?>index.php/Whse/tb_stok?cari=" + cari, function(data, status) {
                $("#tampildata").html(data);
            });
        });

        // Event handler untuk navigasi halaman
        $('#tampildata').on('click', 'a', function(e) {
            e.preventDefault();
            var pageno = $(this).attr('data-ci-pagination-page');
            loadPagination(pageno);
            $('#hlmn').val(pageno);
        });

        // Event listener untuk pencarian ketika tombol Enter ditekan
        var cari = document.getElementById("cari");
        cari.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                $("#tombol-tampil").click();
            }
        });
    });
</script>