<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Beauty Kasatama Indonesia</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url(); ?>assets/img/bk.png" rel="icon">
  <link href="<?= base_url(); ?>assets/img/bk.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url(); ?>assets/css/style.css" rel="stylesheet">

  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

  <!-- sweetalert2-->
  <script src="<?= base_url(); ?>assets/js/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/sweetalert2.min.css">

  <!-- daterangepicker -->

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="<?= base_url(); ?>assets/img/bk.png" alt="">
        <span class="d-none d-lg-block">ONE APPS</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">

    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="<?= base_url(); ?>assets/img/1589277879773.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $this->session->nama_user ?></span>
          </a><!-- End Profile Iamge Icon -->
          <?php
          $current_url = "http" . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "s" : "") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          ?>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6><?= $this->session->nama_user ?></h6>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="<?= base_url('Welcome/logout') ?>">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('Whse'); ?>">
          <i class="bi bi-grid-1x2"></i>
          <span>Administration</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-finance" data-bs-toggle="collapse" href="#">
          <i class="bi bi-file-text"></i><span>Financials</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <?php
        if ($current_url == base_url('Finance/inv_cost') || $current_url == base_url('Whse/lhmbp')) {
          echo "<ul id='forms-finance' class='nav-content collapse show' data-bs-parent='#sidebar-nav'>";
        } else {
          echo "<ul id='forms-finance' class='nav-content collapse' data-bs-parent='#sidebar-nav'>";
        };

        if ($current_url == base_url('Finance/inv_cost')) {
          echo "<li><a href='" . base_url('Finance/inv_cost') . "' class='active'><i class='bi bi-circle'></i><span>Inventory Costing</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Finance/inv_cost') . "'><i class='bi bi-circle'></i><span>Inventory Costing</span></a></li>";
        };

        if ($current_url == base_url('Whse/lhmbp')) {
          echo "<li><a href='" . base_url('Whse/lhmbp') . "' class='active'><i class='bi bi-circle'></i><span>LHMB (P)</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Whse/lhmbp') . "'><i class='bi bi-circle'></i><span>LHMB (P)</span></a></li>";
        };
        echo "</ul>";
        ?>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-sales" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cash-coin"></i><span>Sales - A/R</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <?php
        if ($current_url == base_url('So/so') || $current_url == base_url('So/outstanding_so') || $current_url == base_url('So/lhkb') || $current_url == base_url('So/lhmb') || $current_url == base_url('Marketing/produk_palsu') || $current_url == base_url('Marketing/recall') || $current_url == base_url('Marketing/pelanggan') || $current_url == base_url('Marketing/laporan_klaim') || $current_url == base_url('Marketing/kepuasan_pelanggan') || $current_url == base_url('Marketing/nota_manual')) {
          echo "<ul id='forms-sales' class='nav-content collapse show' data-bs-parent='#sidebar-nav'>";
        } else {
          echo "<ul id='forms-sales' class='nav-content collapse' data-bs-parent='#sidebar-nav'>";
        };

        if ($current_url == base_url('So/so')) {
          echo "<li><a href='" . base_url('So/so') . "' class='active'><i class='bi bi-circle'></i><span>Sales Order</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('So/so') . "'><i class='bi bi-circle'></i><span>Sales Order</span></a></li>";
        };

        if ($current_url == base_url('So/outstanding_so')) {
          echo "<li><a href='" . base_url('So/outstanding_so') . "' class='active'><i class='bi bi-circle'></i><span>Outstanding Sales Order</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('So/outstanding_so') . "'><i class='bi bi-circle'></i><span>Outstanding Sales Order</span></a></li>";
        };

        if ($current_url == base_url('So/lhkb')) {
          echo "<li><a href='" . base_url('So/lhkb') . "' class='active'><i class='bi bi-circle'></i><span>Pengiriman Barang</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('So/lhkb') . "'><i class='bi bi-circle'></i><span>Pengiriman Barang</span></a></li>";
        };

        if ($current_url == base_url('So/lhmb')) {
          echo "<li><a href='" . base_url('So/lhmb') . "' class='active'><i class='bi bi-circle'></i><span>Penerimaan Barang</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('So/lhmb') . "'><i class='bi bi-circle'></i><span>Penerimaan Barang</span></a></li>";
        };

        if ($current_url == base_url('Marketing/produk_palsu')) {
          echo "<li><a href='" . base_url('Marketing/produk_palsu') . "' class='active'><i class='bi bi-circle'></i><span>Form Produk Palsu</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Marketing/produk_palsu') . "'><i class='bi bi-circle'></i><span>Form Produk Palsu</span></a></li>";
        };

        if ($current_url == base_url('Marketing/recall')) {
          echo "<li><a href='" . base_url('Marketing/recall') . "' class='active'><i class='bi bi-circle'></i><span>Form Recall</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Marketing/recall') . "'><i class='bi bi-circle'></i><span>Form Recall</span></a></li>";
        };

        if ($current_url == base_url('Marketing/pelanggan')) {
          echo "<li><a href='" . base_url('Marketing/pelanggan') . "' class='active'><i class='bi bi-circle'></i><span>Daftar Pelanggan</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Marketing/pelanggan') . "'><i class='bi bi-circle'></i><span>Daftar Pelanggan</span></a></li>";
        };

        if ($current_url == base_url('Marketing/laporan_klaim')) {
          echo "<li><a href='" . base_url('Marketing/laporan_klaim') . "' class='active'><i class='bi bi-circle'></i><span>Laporan Klaim</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Marketing/laporan_klaim') . "'><i class='bi bi-circle'></i><span>Laporan Klaim</span></a></li>";
        };

        if ($current_url == base_url('Marketing/kepuasan_pelanggan')) {
          echo "<li><a href='" . base_url('Marketing/kepuasan_pelanggan') . "' class='active'><i class='bi bi-circle'></i><span>Kepuasan Pelanggan</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Marketing/kepuasan_pelanggan') . "'><i class='bi bi-circle'></i><span>Kepuasan Pelanggan</span></a></li>";
        };

        if ($current_url == base_url('Marketing/nota_manual')) {
          echo "<li><a href='" . base_url('Marketing/nota_manual') . "' class='active'><i class='bi bi-circle'></i><span>Nota Manual</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Marketing/nota_manual') . "'><i class='bi bi-circle'></i><span>Nota Manual</span></a></li>";
        };


        echo "</ul>";
        ?>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-purchasing" data-bs-toggle="collapse" href="#">
          <i class="bi bi-cart2"></i><span>Purchasing - A/P</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <?php
        if ($current_url == base_url('Purchasing/spp') || $current_url == base_url('Purchasing/outstanding_po') || $current_url == base_url('Purchasing/outstanding_purchase') || $current_url == base_url('Purchasing/supplier_appraisal') || $current_url == base_url('Purchasing/pemilihan_supplier')) {
          echo "<ul id='forms-purchasing' class='nav-content collapse show' data-bs-parent='#sidebar-nav'>";
        } else {
          echo "<ul id='forms-purchasing' class='nav-content collapse' data-bs-parent='#sidebar-nav'>";
        };

        if ($current_url == base_url('Purchasing/spp')) {
          echo "<li><a href='" . base_url('Purchasing/spp') . "' class='active'><i class='bi bi-circle'></i><span>Outstanding PR</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Purchasing/spp') . "'><i class='bi bi-circle'></i><span>Outstanding PR</span></a></li>";
        };

        if ($current_url == base_url('Purchasing/outstanding_po')) {
          echo "<li><a href='" . base_url('Purchasing/outstanding_po') . "' class='active'><i class='bi bi-circle'></i><span>Outstanding PO</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Purchasing/outstanding_po') . "'><i class='bi bi-circle'></i><span>Outstanding PO</span></a></li>";
        };

        if ($current_url == base_url('Purchasing/outstanding_purchase')) {
          echo "<li><a href='" . base_url('Purchasing/outstanding_purchase') . "' class='active'><i class='bi bi-circle'></i><span>Outstanding Purchase</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Purchasing/outstanding_purchase') . "'><i class='bi bi-circle'></i><span>Outstanding Purchase</span></a></li>";
        };

        if ($current_url == base_url('Purchasing/supplier_appraisal')) {
          echo "<li><a href='" . base_url('Purchasing/supplier_appraisal') . "' class='active'><i class='bi bi-circle'></i><span>Penilaian Supplier</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Purchasing/supplier_appraisal') . "'><i class='bi bi-circle'></i><span>Penilaian Supplier</span></a></li>";
        };

        if ($current_url == base_url('Purchasing/pemilihan_supplier')) {
          echo "<li><a href='" . base_url('Purchasing/pemilihan_supplier') . "' class='active'><i class='bi bi-circle'></i><span>Pemilihan Supplier</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Purchasing/pemilihan_supplier') . "'><i class='bi bi-circle'></i><span>Pemilihan Supplier</span></a></li>";
        };
        echo "</ul>";
        ?>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-bp" data-bs-toggle="collapse" href="#">
          <i class="bi bi-people"></i><span>Business Partners</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <?php
        if ($current_url == base_url('Busines_partner/daftar_rekanan') || $current_url == base_url('Busines_partner/daftar_rekanan_terpilih') || $current_url == base_url('Busines_partner/daftar_rekanan_tidakterpilih')) {
          echo "<ul id='forms-bp' class='nav-content collapse show' data-bs-parent='#sidebar-nav'>";
        } else {
          echo "<ul id='forms-bp' class='nav-content collapse' data-bs-parent='#sidebar-nav'>";
        };

        if ($current_url == base_url('Busines_partner/daftar_rekanan')) {
          echo "<li><a href='" . base_url('Busines_partner/daftar_rekanan') . "' class='active'><i class='bi bi-circle'></i><span>Daftar Rekanan</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Busines_partner/daftar_rekanan') . "'><i class='bi bi-circle'></i><span>Daftar Rekanan</span></a></li>";
        };

        if ($current_url == base_url('Busines_partner/daftar_rekanan_terpilih')) {
          echo "<li><a href='" . base_url('Busines_partner/daftar_rekanan_terpilih') . "' class='active'><i class='bi bi-circle'></i><span>Daftar Rekanan Terpilih</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Busines_partner/daftar_rekanan_terpilih') . "'><i class='bi bi-circle'></i><span>Daftar Rekanan Terpilih</span></a></li>";
        };

        if ($current_url == base_url('Busines_partner/daftar_rekanan_tidakterpilih')) {
          echo "<li><a href='" . base_url('Busines_partner/daftar_rekanan_tidakterpilih') . "' class='active'><i class='bi bi-circle'></i><span>Daftar Rekanan Tidak Terpilih</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Busines_partner/daftar_rekanan_tidakterpilih') . "'><i class='bi bi-circle'></i><span>Daftar Rekanan Tidak Terpilih</span></a></li>";
        };

        echo "</ul>";
        ?>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" onclick="pesan()">
          <i class="bi bi-currency-dollar"></i>
          <span>Banking</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-inv" data-bs-toggle="collapse" href="#">
          <i class="bi bi-truck-flatbed"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <?php
        if ($current_url == base_url('Whse/lhmb') || $current_url == base_url('Whse/stok') || $current_url == base_url('Whse/item_audit')) {
          echo "<ul id='forms-inv' class='nav-content collapse show' data-bs-parent='#sidebar-nav'>";
        } else {
          echo "<ul id='forms-inv' class='nav-content collapse' data-bs-parent='#sidebar-nav'>";
        };

        if ($current_url == base_url('Whse/lhmb')) {
          echo "<li><a href='" . base_url('Whse/lhmb') . "' class='active'><i class='bi bi-circle'></i><span>LHMB (GRPO)</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Whse/lhmb') . "'><i class='bi bi-circle'></i><span>LHMB (GRPO)</span></a></li>";
        };

        if ($current_url == base_url('Whse/stok')) {
          echo "<li><a href='" . base_url('Whse/stok') . "' class='active'><i class='bi bi-circle'></i><span>Item Master Data</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Whse/stok') . "'><i class='bi bi-circle'></i><span>Item Master Data</span></a></li>";
        };

        if ($current_url == base_url('Whse/item_audit')) {
          echo "<li><a href='" . base_url('Whse/item_audit') . "' class='active'><i class='bi bi-circle'></i><span>Rekap Mutasi Stok</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Whse/item_audit') . "'><i class='bi bi-circle'></i><span>Rekap Mutasi Stok</span></a></li>";
        };
        echo "</ul>";
        ?>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" onclick="pesan()">
          <i class="bi bi-box"></i>
          <span>Resources</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-fg" data-bs-toggle="collapse" href="#">
          <i class="bi bi-box-seam"></i><span>Production</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <?php
        if ($current_url == base_url('produksi/outstanding_order') || $current_url == base_url('ppic/spk_list')) {
          echo "<ul id='forms-fg' class='nav-content collapse show' data-bs-parent='#sidebar-nav'>";
        } else {
          echo "<ul id='forms-fg' class='nav-content collapse' data-bs-parent='#sidebar-nav'>";
        };

        if ($current_url == base_url('produksi/outstanding_order')) {
          echo "<li><a href='" . base_url('produksi/outstanding_order') . "' class='active'><i class='bi bi-circle'></i><span>Barang Jadi</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('produksi/outstanding_order') . "'><i class='bi bi-circle'></i><span>Barang Jadi</span></a></li>";
        };

        if ($current_url == base_url('ppic/spk_list')) {
          echo "<li><a href='" . base_url('ppic/spk_list') . "' class='active'><i class='bi bi-circle'></i><span>SPK</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('ppic/spk_list') . "'><i class='bi bi-circle'></i><span>SPK</span></a></li>";
        };
        echo "</ul>";
        ?>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-signature" data-bs-toggle="collapse" href="#">
          <i class="bi bi-pen"></i><span>Signature</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <?php
        if ($current_url == base_url('Document_control/signature_dc')) {
          echo "<ul id='forms-signature' class='nav-content collapse show' data-bs-parent='#sidebar-nav'>";
        } else {
          echo "<ul id='forms-signature' class='nav-content collapse' data-bs-parent='#sidebar-nav'>";
        };

        if ($current_url == base_url('Document_control/signature_dc')) {
          echo "<li><a href='" . base_url('Document_control/signature_dc') . "' class='active'><i class='bi bi-circle' ></i><span>Registration Dokumen</span></a></li>";
        } else {
          echo "<li><a href='" . base_url('Document_control/signature_dc') . "'><i class='bi bi-circle'></i><span>Registration Dokumen</span></a></li>";
        };
        echo "</ul>";
        ?>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('User/user_list'); ?>">
          <i class="bi bi-people"></i>
          <span>User</span>
        </a>
      </li>

    </ul>

  </aside><!-- End Sidebar-->

  <script>
    function pesan() {
      Swal.fire(
        'Maaf, menu ini sedang dalam tahap development',
        'By IT Team',
        'info'
      )
    }

    function dilarang() {
      Swal.fire(
        'Access denied',
        'Please contact youre system administrator',
        'info'
      )
    }
  </script>