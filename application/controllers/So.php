<?php
defined('BASEPATH') or exit('No direct script access allowed');

class So extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        $this->load->helper(array('url'));
        $this->load->model('M_so');
        $this->load->model('M_user');
    }

    function data_pagination($url, $rows = 10, $uri = 10)
    {
        $this->load->library('pagination');
        $config['per_page']   = 10;
        $config['base_url']   = site_url($url);
        $config['total_rows']   = $rows;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']   = $uri;
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
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function so()
    {
        $akses = $this->M_user->get_akses(13);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
            $this->load->view('so');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_so($no_page = 1)
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $cari = $this->input->get('cari');
        $page = $this->data_pagination("So/tb_so", $this->M_so->hitung_so($mulai,$hingga,$cari), 3);
        $data = $this->M_so->get_so($no_page,$mulai,$hingga,$cari); // header so
        $detail = $this->M_so->detail_so($no_page,$mulai,$hingga,$cari); // detail so
        $total_so = $this->M_so->total_so($mulai,$hingga,$cari);
        $no_halaman = $no_page;
        $row['so_head'] = [];
        $row['so_detail'] = []; 

        foreach ($data as $dt) {
            array_push($row['so_head'],$dt);
        }

        foreach ($detail as $dtl) {
            array_push($row['so_detail'],$dtl);
        }
        
        $result = json_encode($row);
        
        $this->load->view('tb_so', array(
            'data' => $result,
            'page' => $page,
            'total_so' => $total_so
        ));
    }

    public function outstanding_so()
    {
        $akses = $this->M_user->get_akses(12);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
            $this->load->view('outstanding_so');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_outs_so()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $row['head'] = $this->M_so->so_head($mulai,$hingga);
        $row['item'] = $this->M_so->sj_item($mulai,$hingga);
        $data = json_encode($row);
        $this->load->view("tb_outstanding_so",["data" => $data]);
    }

    public function tb_outs_so_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $row['head'] = $this->M_so->so_head($mulai,$hingga);
        $row['item'] = $this->M_so->sj_item($mulai,$hingga);
        $data = json_encode($row);
        $this->load->view("tb_outstanding_so_xls",["data" => $data]);
    }

    public function trace_sj()
    {
        $id = $this->input->get('docnum');
        $row['head'] = $this->M_so->trace_sj_head($id);
        $row['item'] = $this->M_so->trace_sj_detail($id);
        $data = json_encode($row);
        echo $data;
    }

    public function lhkb()
    {
        $akses = $this->M_user->get_akses(14);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
            $this->load->view('lhkb');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_lhkb()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $row['head'] = $this->M_so->lhkb_head($mulai,$hingga);
        $data = json_encode($row);
        echo $data;
    }

    public function tb_lhkb_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $row['head'] = $this->M_so->lhkb_head($mulai,$hingga);
        $data = json_encode($row);
        $this->load->view('tb_lhkb_xls',["data" => $data]);
    }

    public function lhmb()
    {
        $akses = $this->M_user->get_akses(14);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
            $this->load->view('lhmb2');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_lhmb()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $row['head'] = $this->M_so->lhmb($mulai,$hingga);
        $data = json_encode($row);
        echo $data;
    }

    public function tb_lhmb_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $row['head'] = $this->M_so->lhmb($mulai,$hingga);
        $data = json_encode($row);
        $this->load->view('tb_lhmb2_xls',["data" => $data]);
    }

    public function lhkb3()
    {
        $this->load->view('lhkb3');
    }

    public function tb_lhkb3()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $row = $this->M_so->lhkb_head($mulai,$hingga);
        $data = json_encode($row);
        echo $data;
    }
}