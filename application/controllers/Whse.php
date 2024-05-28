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

        //$this->load->model('M_sql');
        $this->load->model('M_whse');
        //$this->load->model('M_produksi');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
    }

    public function index()
    {
        //$this->load->model('M_sql');
        /*$dataso = $this->M_sql->get_so_month();
        $row['so'] = [];
        foreach ($dataso as $so) {
            array_push($row['so'], $so);
        }*/
        //$data = json_encode($row);
        $this->load->view('header');
        $this->load->view('dashboard', [/*'data' => $data*/]);
        $this->load->view('footer');
    }

    #################################AFTERSTORM#################################

    public function kartu_stok()
    {
        $akses = $this->M_user->get_akses(31);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('kartu_stok');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function master_stok()
    {
        $stok['head'] = $this->M_whse->get_master_stok();
        $data = json_encode($stok);
        //print_r($stok);
        $this->load->view('tb_master_stok', ['data' => $data]);
    }

    public function stok_masuk()
    {
    }

    public function stok_keluar()
    {
    }
}
