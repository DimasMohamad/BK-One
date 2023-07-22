<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ppic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        $this->load->helper(array('form','url'));
        $this->load->model('M_ppic');
        $this->load->model('M_user');        
    }

    public function tb_list_module()
    {
        $s = $this->input->get('s');
        $e = $this->input->get('e');
        $dataspk = $this->M_ppic->tb_list_module($s,$e);        
        $this->load->view('tb_list_module',["dataspk" => $dataspk]);
    }

    public function spk()
    {
        $akses = $this->M_user->get_akses(18);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
                $this->load->view('spk');
            }else{
                $this->load->view('denied');
            }
        $this->load->view('footer');
    }

    public function tb_spk()
    {
        $id = $this->input->get('spk');
        $dataspk = $this->M_ppic->tb_spk_head($id);
        $dataspkheaditem = $this->M_ppic->tb_spk_head_item($id);
        $dataspkdetail = $this->M_ppic->tb_spk_detail($id);
        $dataspkitem = $this->M_ppic->tb_spk_detail_item($id);
        $this->load->view('tb_spk',[
            "data" => $dataspk,
            "itemhead" => $dataspkheaditem,
            "spkdetail" => $dataspkdetail,
            "spkitem" => $dataspkitem
        ]);
    }

    public function tb_spk_xls()
    {
        $id = $this->input->get('spk');
        $dataspk = $this->M_ppic->tb_spk_head($id);
        $dataspkheaditem = $this->M_ppic->tb_spk_head_item($id);
        $dataspkdetail = $this->M_ppic->tb_spk_detail($id);
        $dataspkitem = $this->M_ppic->tb_spk_detail_item($id);
        $this->load->view('tb_spk_xls',[
            "data" => $dataspk,
            "itemhead" => $dataspkheaditem,
            "spkdetail" => $dataspkdetail,
            "spkitem" => $dataspkitem
        ]);
    }

    public function tb_spk_list()
    {
        $s = $this->input->get('s');
        $e = $this->input->get('e');
        $spklist = $this->M_ppic->tb_spk_list($s,$e);
        $spk = json_encode($spklist);
        echo $spk;
    }

}