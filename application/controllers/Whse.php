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

    // Method untuk mendapatkan data master stok
    public function get_union_kartu_stok()
    {
        $data['union_kartu_stok'] = $this->M_whse->get_union_kartu_stok();
        echo json_encode($data); // Mengembalikan data dalam format JSON
    }

    public function stok_keluar()
    {
    }

    public function item_code()
    {
        $akses = $this->M_user->get_akses(3);
        $sesi = $this->session->id_user;
        //print_r($sesi);
        $posisi = $this->M_whse->get_position($sesi);
        $data = json_encode($posisi);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('item_master_data', ['data' => $data]);
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function code()
    {
        $stok['head'] = $this->M_whse->get_item_code();
        $data = json_encode($stok);
        $sesi = $this->session->id_user;
        //print_r($sesi);
        $sesip = $this->M_whse->get_position($sesi);
        $posisi = json_encode($sesip);
        //print_r($data);
        $this->load->view('tb_item_code', ['data' => $data, 'posisi' => $posisi]);
    }

    public function do_upload()
    {
        $item_code = $this->input->post('item_code');
        $item_name = $this->input->post('item_name');
        $data = array(
            'item_code' => $item_code,
            'item_name' => $item_name,
        );
        //print_r($data);
        $this->db->insert('tb_item_code', $data);
    }

    public function hapus_item()
    {
        $id = $this->input->post('id');
        $this->db->delete('tb_item_code', array('rowid' => $id));
    }
}
