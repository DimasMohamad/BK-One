<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whse extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }

        $this->load->model('M_sql');
        $this->load->model('M_whse');
        $this->load->model('M_produksi');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
    }

    public function index()
    {
        $this->load->model('M_sql');
        $dataso = $this->M_sql->get_so_month();
        $row['so'] = [];
        foreach ($dataso as $so) {
            array_push($row['so'], $so);
        }
        $data = json_encode($row);
        $this->load->view('header');
        $this->load->view('dashboard', ['data' => $data]);
        $this->load->view('footer');
    }

    public function lhmb()
    {
        //$data = file_get_contents('http://103.141.181.230:8080/bki_api/Data/oitb');
        $akses = $this->M_user->get_akses(1);
        $datagrup = $this->M_sql->Item_Groups();
        $row['grup'] = [];
        foreach ($datagrup as $g) {
            array_push($row['grup'], $g);
        }
        $data = json_encode($row);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('lhmb', ['data' => $data]);
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_lhmb()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $grup = $this->input->get('grup');
        $cari = $this->input->get('cari');
        $sts = $this->input->get('sts');
        $data = $this->M_sql->laporan_lhmb($mulai, $hingga, $grup, $cari, $sts);
        $row['lhmb'] = [];
        foreach ($data as $dt) {
            array_push($row['lhmb'], $dt);
        }
        $result = json_encode($row);
        $this->load->view('tb_lhmb', ['data' => $result]);
    }

    public function tb_lhmb_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $grup = $this->input->get('grup');
        $cari = $this->input->get('cari');
        $sts = $this->input->get('sts');
        $data = $this->M_sql->laporan_lhmb($mulai, $hingga, $grup, $cari, $sts);
        $row['lhmb'] = [];
        foreach ($data as $dt) {
            array_push($row['lhmb'], $dt);
        }
        $result = json_encode($row);
        $this->load->view('tb_lhmb_xls', ['data' => $result]);
    }

    public function tb_lhmb_cetak()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $grup = $this->input->get('grup');
        $cari = $this->input->get('cari');
        $sts = $this->input->get('sts');
        $data = $this->M_sql->laporan_lhmb($mulai, $hingga, $grup, $cari, $sts);
        $row['lhmb'] = [];
        foreach ($data as $dt) {
            array_push($row['lhmb'], $dt);
        }
        $result = json_encode($row);
        $this->load->view('tb_lhmb_cetak', ['data' => $result]);
    }

    public function lhmbp()
    {
        //$data = file_get_contents('http://103.141.181.230:8080/bki_api/Data/oitb');
        $datagrup = $this->M_sql->Item_Groups();
        $akses = $this->M_user->get_akses(2);
        $row['grup'] = [];
        foreach ($datagrup as $g) {
            array_push($row['grup'], $g);
        }
        $data = json_encode($row);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('lhmbp', ['data' => $data]);
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_lhmbp()
    {
        /*
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $grup = $this->input->get('grup');
        $result = file_get_contents('http://103.141.181.230:8080/bki_api/Data/tb_lhmb?mulai='.$mulai.'&hingga='.$hingga.'&grup='.$grup);
        $this->load->view('tb_lhmbp',['data'=>$result]);
        */
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $grup = $this->input->get('grup');
        $cari = $this->input->get('cari');
        $sts = $this->input->get('sts');
        $data = $this->M_sql->laporan_lhmb($mulai, $hingga, $grup, $cari, $sts);
        $row['lhmb'] = [];
        foreach ($data as $dt) {
            array_push($row['lhmb'], $dt);
        }
        $result = json_encode($row);
        $this->load->view('tb_lhmbp', ['data' => $result]);
    }

    public function tb_lhmbp_xls()
    {
        /*
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $grup = $this->input->get('grup');
        //$result = file_get_contents('http://103.141.181.230:8080/bki_api/Data/tb_lhmb?mulai='.$mulai.'&hingga='.$hingga.'&grup='.$grup);
        $this->load->view('tb_lhmbp_xls',['data'=>$result]);
        */
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $grup = $this->input->get('grup');
        $cari = $this->input->get('cari');
        $sts = $this->input->get('sts');
        $data = $this->M_sql->laporan_lhmb($mulai, $hingga, $grup, $cari, $sts);
        $row['lhmb'] = [];
        foreach ($data as $dt) {
            array_push($row['lhmb'], $dt);
        }
        $result = json_encode($row);
        //echo $result;
        $this->load->view('tb_lhmbp_xls', ['data' => $result]);
    }

    function data_pagination($url, $rows = 10, $uri = 10)
    {
        $this->load->library('pagination');
        $config['per_page']   = 10;
        $config['base_url']   = site_url($url);
        $config['total_rows']   = $rows;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']   = $uri;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        /*
        $config['num_links']   = 3;
        $config['next_link']   = '>';
        $config['prev_link']   = '<';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
        */
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function open_pr()
    {
        $sts = $this->input->get('sts');
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $cari = $this->input->get('cari');
        $pr_head = $this->M_sql->open_pr($sts, $mulai, $hingga, $cari);
        $row['pr_head'] = [];
        $row['pr_dtl'] = [];
        foreach ($pr_head as $h) {
            array_push($row['pr_head'], $h);
        }
        $result = json_encode($row);
        $this->load->view('tb_open_pr', ["data" => $result]);
    }

    public function stok()
    {
        $akses = $this->M_user->get_akses(3);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('stok');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_stok($no_page = 1)
    {
        $cari = $this->input->get('cari');
        $page = $this->data_pagination("Whse/tb_stok", $this->M_sql->hitung_row_stok($cari), 3);
        $datastok = $this->M_sql->get_stok($no_page, $cari);
        //print_r($datastok);
        $datadtl = $this->M_sql->get_stok_dtl($no_page, $cari);
        $no_halaman = $no_page;
        $row['stok'] = [];
        $row['dtl'] = [];
        foreach ($datastok as $dt) {
            array_push($row['stok'], $dt);
        }
        foreach ($datadtl as $dtl) {
            array_push($row['dtl'], $dtl);
        }
        $data = json_encode($row);
        //echo "<br>-------------------------DATA ROW Sebelum di Encode-------------------------<br>";
        //echo '<pre>';
        //print_r($row);
        //echo '</pre>';
        //echo "<br><br>-------------------------DATA ROW Setelah di Encode-------------------------<br><br>";
        //echo '<pre>';
        //print_r($data);
        //echo '</pre>';
        //echo "<br>--------------------------------------------------------------------<br>";
        $this->load->view('tb_stok', ["data" => $data, 'page' => $page,]);
    }

    public function item_audit()
    {
        $akses = $this->M_user->get_akses(4);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('item_audit');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_item_audit()
    {
        $bln = substr($this->input->get('periode'), 0, 2);
        $tahun = substr($this->input->get('periode'), 3);
        $periode = $tahun . "-" . $bln . "-01";

        $dataaudithead = $this->M_whse->rekap_item_audit_head($periode);
        $dataaudit = $this->M_whse->rekap_item_audit($periode);
        $row['head'] = [];
        $row['item'] = [];
        foreach ($dataaudithead as $h) {
            array_push($row['head'], $h);
        }
        foreach ($dataaudit as $dt) {
            array_push($row['item'], $dt);
        }
        $data = json_encode($row);
        //echo $data;
        $this->load->view('tb_item_audit', ['data' => $data]);
    }

    public function tb_item_audit_xls()
    {
        $bln = substr($this->input->get('periode'), 0, 2);
        $tahun = substr($this->input->get('periode'), 3);
        $periode = $tahun . "-" . $bln . "-01";

        $dataaudithead = $this->M_whse->rekap_item_audit_head($periode);
        $dataaudit = $this->M_whse->rekap_item_audit($periode);
        $row['head'] = [];
        $row['item'] = [];
        foreach ($dataaudithead as $h) {
            array_push($row['head'], $h);
        }
        foreach ($dataaudit as $dt) {
            array_push($row['item'], $dt);
        }
        $data = json_encode($row);
        $this->load->view('tb_item_audit_xls', ['data' => $data]);
    }


    public function trace_item()
    {
        $itemcode = $this->input->get('item');
        $datawhse = $this->M_whse->trace_item_whse($itemcode);
        $datatrace = $this->M_sql->trace_item_audit($itemcode);
        $this->load->view('tb_trace_item', ['datawhse' => $datawhse, 'datatrace' => $datatrace, 'itemcode' => $itemcode]);
    }

    public function cari_konversi()
    {
        $id = $this->input->get('id');
        $konversi = $this->db->get_where('tb_conv', array('id_item' => $id))->row_array();
        if (isset($konversi['id_item'])) {
            echo "1";
        } else {
            echo "0";
        }
    }

    public function hitung_konversi()
    {
        $id = $this->input->get('id');
        $nilai = $this->input->get('qty');
        $data = $this->M_sql->hitung_konversi_sap($id, $nilai);
        echo "<table class='table table-sm'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th colspan='2'>" . number_format($nilai, 4, '.', ',') . "&nbsp;M</th>";
        echo "</tr>";
        echo "<tr>";
        echo "<th>Konversi</th>";
        echo "<th>Uom</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        foreach ($data as $dt) {
            echo "<tr>";
            echo "<td style='text-align:right;'>&nbsp;" . number_format($dt['konversi'], 4, '.', ',') . "</td>";
            echo "<td>&nbsp;" . $dt['uom'] . "&nbsp;</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }

    public function add_konversi()
    {
        $id = $this->input->POST('id');
        $str = str_replace(",", ".", $this->input->POST('konv'));
        $konv = explode("x", $str);
        foreach ($konv as $dt) {
            $data = array(
                'id_item' => $id,
                'conv' => $str,
                'qty' => filter_var($dt, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
                'uom' => preg_replace('/[^a-zA-Z]/', '', $dt)
            );
            $this->db->insert('tb_conv', $data);
        }
    }

    public function access_denied()
    {
        $this->load->view('header');
        $this->load->view('denied');
        $this->load->view('footer');
    }

    public function tb_item_audit_ui()
    {
        $bln = substr($this->input->get('periode'), 0, 2);
        $tahun = substr($this->input->get('periode'), 3);
        $periode = $tahun . "-" . $bln . "-01";

        $dataaudithead = $this->M_sql->rekap_item_audit_head($periode);
        $dataaudit = $this->M_sql->rekap_item_audit($periode);
        $row['head'] = [];
        $row['item'] = [];
        foreach ($dataaudithead as $h) {
            array_push($row['head'], $h);
        }
        foreach ($dataaudit as $dt) {
            array_push($row['item'], $dt);
        }
        $data = json_encode($row);
        //echo $data;
        $this->load->view('tb_item_audit_ui', ['data' => $data]);
    }

    public function tb_item($no_page = 1)
    {
        $cari = $this->input->get('cari');
        $page = $this->data_pagination("Whse/tb_item", $this->M_sql->hitung_item($cari), 3);
        $data = $this->M_sql->get_item($no_page, $cari);
        $no_halaman = $no_page;
    }

    public function item_master()
    {
        $akses = $this->M_user->get_akses(7);
        $data = json_encode($this->M_produksi->get_item_master());
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('item_master', ["data" => $data]);
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function lhkb()
    {
        $akses = $this->M_user->get_akses(3);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('lhkb2');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_lhkb()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $tipe = $this->input->get('item');
        $row['head'] = $this->M_whse->lhkb_head($mulai, $hingga, $tipe);
        $row['detail'] = $this->M_whse->lhkb_detail($mulai, $hingga, $tipe);
        $data = json_encode($row);
        $this->load->view('tb_lhkb', ['data' => $data]);
    }

    public function trc_whse()
    {
        $itemcode = $this->input->get('item');
        $whse = json_encode($this->M_whse->trace_item_whse($itemcode));
        echo $whse;
    }

    public function trc_whse_det()
    {
        $itemcode = $this->input->get('item');
        $whse = $this->input->get('whse');
        $trace = json_encode($this->M_whse->trace_item_audit($itemcode, $whse));
        echo $trace;
    }

    public function inv_audit_report()
    {

        $this->load->view('inv_audit_report');
    }
}
