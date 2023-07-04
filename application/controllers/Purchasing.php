<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchasing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        
        $this->load->model('M_purc');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
    }

    public function spp()
    {
        $akses = $this->M_user->get_akses(8);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('spp');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_spp()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $dept = $this->input->get('dept');
        $data['head'] = $this->M_purc->laporan_spp($mulai,$hingga,$dept);
        $data['detail'] = $this->M_purc->laporan_spp_detail($mulai,$hingga,$dept);
        $row = json_encode($data);
        //echo $row;
        $this->load->view("tb_spp",["data"=>$row]);
    }

    public function tb_spp_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head'] = $this->M_purc->laporan_spp($mulai,$hingga);
        $data['detail'] = $this->M_purc->laporan_spp_detail($mulai,$hingga);
        $row = json_encode($data);
        $this->load->view("tb_spp_xls",["data"=>$row]);
    }

    public function outstanding_po()
    {
        $akses = $this->M_user->get_akses(9);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('outstanding_po');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_outstanding_po()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head1'] = $this->M_purc->outs_po_head1($mulai,$hingga);
        $data['detail'] = $this->M_purc->outs_po_detail($mulai,$hingga);
        $row = json_encode($data);
        $this->load->view("tb_outstanding_po",["data" => $row]);
    }

    public function tb_outstanding_po_ui()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data = $this->M_purc->outstanding_po($mulai,$hingga);
        $row = json_encode($data);
        echo $row;
    }

    public function trace_po()
    {
        $nopo = $this->input->get('po');
        $dt['head'] = $this->M_purc->po_head($nopo);
        $dt['detail'] = $this->M_purc->po_detail($nopo);
        $data = json_encode($dt);
        echo $data;
    }

    public function outstanding_purchase()
    {
        $akses = $this->M_user->get_akses(10);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('outstanding_purchase');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_outstanding_purchase()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head'] = $this->M_purc->laporan_spp($mulai,$hingga);
        $data['po'] = $this->M_purc->laporan_spp_detail($mulai,$hingga);
        //$data['grpo'] = $this->M_purc->outs_po_detail($mulai,$hingga);
        $data['grpo'] = $this->M_purc->outs_grpo_detail($mulai,$hingga);
        $row = json_encode($data);
        $this->load->view("tb_outstanding_purchase",["data" => $row]);
    }

    public function tb_outstanding_purchase_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head'] = $this->M_purc->laporan_spp($mulai,$hingga);
        $data['po'] = $this->M_purc->laporan_spp_detail($mulai,$hingga);
        $data['grpo'] = $this->M_purc->outs_grpo_detail($mulai,$hingga);
        $row = json_encode($data);
        $this->load->view("tb_outstanding_purchase_xls",["data" => $row]);
    }

    public function trace_grpo()
    {
        $nopo = $this->input->get('grpo');
        $dt['head'] = $this->M_purc->grpo_head($nopo);
        $dt['detail'] = $this->M_purc->grpo_detail($nopo);
        $data = json_encode($dt);
        echo $data;
    }

    public function tb_outstanding_po_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head1'] = $this->M_purc->outs_po_head1($mulai,$hingga);
        $data['detail'] = $this->M_purc->outs_po_detail($mulai,$hingga);
        $row = json_encode($data);
        $this->load->view("tb_outstanding_po_xls",["data" => $row]);
    }

    public function Dept()
	{
        $dept = $this->M_purc->Dept();
        foreach($dept as $d){
            echo"<option value=".$d['Code'].">".$d['Dept']."</option>";
        }
    }

    public function penilaian_supp()
    {
        $row = json_encode($this->M_purc->get_penilaian_supp());
        echo $row;
    }

    public function supplier_appraisal()
    {
        // get filter supplier
        $this->db->select('id_supp');
        $this->db->distinct();
        $filtersupp = $this->db->get('tb_supp_p_2')->result_array();
        $akses = $this->M_user->get_akses(15);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('supplier_appraisal',["filter" => $filtersupp]);
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_po_list()
    {
        $row['head'] = [];
        $head = $this->M_purc->get_penilaian_po_list();
        foreach($head as $h){
            $r = [];
            $nopo = $this->M_purc->get_nopo($h['DocNum']);
            foreach($nopo as $n){
                if($n['rowid']==0){
                    $r['DocNum'] = $h['DocNum'];
                    $r['Posting_date'] = $h['Posting_date'];
                    $r['DocDate'] = $h['DocDate'];
                    $r['CardCode'] = $h['CardCode'];
                    $r['CardName'] = $h['CardName'];
                    array_push($row['head'],$r);
                }
            }
            
        }
        //$row['head'] = $this->M_purc->get_penilaian_po_list();
        $row['item'] = $this->M_purc->get_penilaian_po_list_item();
        $datapo = json_encode($row);
        //echo $datapo;
        $this->load->view('tb_po_list',["data" => $datapo]);
    }

    public function idunik()
    {
        echo $uniqueString = uniqid('', true);
    }

    public function simpan_nilai()
    {
        $nopo = $this->input->post('id_penilaian');
        $id_supp = $this->input->post('id_supp');
        $tgl = $this->input->post('tgl');
        $mutu = $this->input->post('mutu');
        $pelayanan = $this->input->post('pelayanan');
        $kuantiti = $this->input->post('kuantiti');
        $keterangan = $this->input->post('keterangan');
        $data = array(
            'nopo' => $nopo,
            'n1' => $mutu,
            'n2' => $pelayanan,
            'n3' => $kuantiti,
            'keterangan' => $keterangan,
            'tgl' => $tgl,
            'id_supp' => $id_supp
        );
        $this->db->insert('tb_supp_p_2', $data);
    }

    public function laporan_penilaian_supp()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $id_supp = $this->input->get('id_supp');
        $data = json_encode($this->M_purc->laporan_penilaian_supp($mulai,$hingga,$id_supp));
        $supp = $this->M_purc->get_supp($id_supp);
        $this->load->view("laporan_penilaian_supp",["data" => $data,"mulai" => $mulai,"hingga" => $hingga,"supp" => $supp]);
    }

    public function cetak_laporan_penilaian_supp()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $id_supp = $this->input->get('id_supp');
        $data = json_encode($this->M_purc->laporan_penilaian_supp($mulai,$hingga,$id_supp));
        $supp = $this->M_purc->get_supp($id_supp);
        $this->load->view("cetaklaporan_penilaian_supp",["data" => $data,"mulai" => $mulai,"hingga" => $hingga,"supp" => $supp]);
    }
    
}