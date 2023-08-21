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

    public function daftar_rekanan_terpilih()
    {
        $akses = $this->M_user->get_akses(11);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('daftar_rekanan_terpilih');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function daftar_rekanan_tidakterpilih()
    {
        $akses = $this->M_user->get_akses(11);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('daftar_rekanan_tidakterpilih');
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
        //echo $data;
    }

    public function tb_daftar_rekanan_terpilih()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $dt['head'] = $this->M_bp->bp_terpilih($mulai, $hingga);
        $dt['detail'] = $this->M_bp->bp_detail_terpilih($mulai, $hingga);
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_daftar_rekanan_terpilih", ["data" => $data]);
    }
    
    public function tb_daftar_rekanan_terpilih_ui()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data = $this->M_bp->bp_terpilih($mulai, $hingga);
        $row = json_encode($data);
        echo $row;
    }
    

    public function tb_daftar_rekanan_tidakterpilih()
    {
        $dt['head'] = $this->db->query("SELECT * FROM tb_supp_p")->result_array();
        //$dt['detail'] = $this->M_bp->bp_detail();
        $data = json_encode($dt);
        $this->load->view("tb_daftar_rekanan_tidakterpilih",["data"=>$data]);
        //echo $data;
    }

    public function print_rekanan_terpilih()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $dt['head'] = $this->M_bp->bp_terpilih($mulai, $hingga);
        $dt['detail'] = $this->M_bp->bp_detail_terpilih($mulai, $hingga);
        $data = json_encode($dt);
        $this->load->view("print_daftar_rekanan_terpilih", ["data" => $data]);
    }

    public function print_rekanan_tidakterpilih()
    {
        $dt['head'] = $this->db->query("Select * from tb_supp_p")->result_array();
        $data = json_encode($dt);
        $this->load->view("print_daftar_rekanan_tidakterpilih", ["data" => $data]);
        //echo $data;
    }

    
    public function simpan_daftar()
    {
        $name = $this->input->post('name');
        $survey_date = $this->input->post('survey_date');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $contact_person = $this->input->post('contact_person');
        $email = $this->input->post('email');
        $product = $this->input->post('product');        
        $data = array(
            'name' => $name,
            'survey_date' => $survey_date,
            'address' => $address,
            'phone' => $phone,
            'contact_person' => $contact_person,
            'email' => $email,
            'product' => $product,
        );
        $this->db->insert('tb_supp_p', $data);
    }

    public function hapus_tidak_terpilih(){
        $id = $this->input->post('id');
        $this->db->delete('tb_supp_p', array('rowid' => $id));
    }

}