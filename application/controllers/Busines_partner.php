<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Busines_partner extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        $this->load->model('M_bp');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
    }

    public function daftar_rekanan()
    {
        $akses = $this->M_user->get_akses(11);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('daftar_rekanan');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_daftar_rekanan()
    {
        $dt['head'] = $this->M_bp->bp_head();
        $dt['detail'] = $this->M_bp->bp_detail();
        $data = json_encode($dt);
        $this->load->view("tb_daftar_rekanan",["data"=>$data]);
    }
}