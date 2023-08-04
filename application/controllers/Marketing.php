<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketing extends CI_Controller
{
    public function __construct(){
        parent::__construct();
            if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        $this->load->model('M_marketing');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
        $this->load->helper(array('form','url'));
    }

    public function produk_palsu(){
        $akses = $this->M_user->get_akses(18);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('produk_palsu');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tampil_data(){
        $dt['data'] = $this->db->query("SELECT * FROM produk_palsu;")->result_array();
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_produk_palsu",["data"=>$data]);
    }

    public function do_upload(){
        $namaproduk = $this->input->post('nama_produk');
        $penjelasan = $this->input->post('penjelasan_masalah');
        $inspeksi = $this->input->post('hasil_inspeksi');
        $tindakan = $this->input->post('tindakan');
        $status = $this->input->post('status');
        $data = array(
            //Nomor dokumen diganti dengan nama file yg diupload
            'nama_produk' => $namaproduk,
            'masalah' => $penjelasan,
            'hasil_inspeksi' => $inspeksi,
            'tindakan' => $tindakan,
            'status' => $status,                    
        );
        //echo $data;
        $this->db->insert('produk_palsu', $data);
    }

    public function print_produk_palsu(){
        $id = $this->input->get('id');
        //echo $id;
        $dt['data'] = $this->db->query("SELECT * FROM produk_palsu WHERE rowid = $id;")->row_array();
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("print_produk_palsu", ["data" => $data]);
    }
    
    public function hapus_formulir(){
        $id = $this->input->post('id');
        $this->db->delete('produk_palsu', array('rowid' => $id));
    }
}