<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }

        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
    }

    public function user_list()
    {
        $akses = $this->M_user->get_akses(5);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('user_list');
        } else {
            echo "Access Denied";
        }
        $this->load->view('footer');
    }

    public function tb_user_list()
    {
        $query = $this->db->get('tb_user')->result_array();
        $this->load->view('tb_user_list', array('data' => $query));
    }

    public function aktifkan()
    {
        $id = $this->input->post('id');
        $data = array(
            'sts' => '1'
        );
        $this->db->where('id_user', $id);
        $this->db->update('tb_user', $data);
    }

    public function nonaktifkan()
    {
        $id = $this->input->post('id');
        $data = array(
            'sts' => '0'
        );
        $this->db->where('id_user', $id);
        $this->db->update('tb_user', $data);
    }

    public function simpan_user()
    {
        $nama = $this->input->post('nama');
        $sandi = password_hash($this->input->post('sandi'), PASSWORD_BCRYPT);
        $data = array(
            'nama' => $nama,
            'sandi' => $sandi,
            'sts' => '1'
        );
        $this->db->insert('tb_user', $data);
    }

    public function hapus_user()
    {
        $id = $this->input->post('id');
        $this->db->delete('tb_user', array('id_user' => $id));
    }

    public function tb_menu()
    {
        $iduser = $this->input->get('id');
        $menu = $this->db->get('tb_menu')->result_array();
        $submenu = $this->db->get('tb_sub_menu')->result_array();
        $akses = $this->M_user->tb_akses($iduser);
        $this->load->view('tb_akses', ['menu' => $menu, 'submenu' => $submenu, 'akses' => $akses]);
    }

    public function buka_akses()
    {
        $id_user = $this->input->post('id_user');
        $id_menu = $this->input->post('id_menu');
        $id_sub_menu = $this->input->post('id_sub_menu');
        $data = array(
            'id_user' => $id_user,
            'id_menu' => $id_menu,
            'id_sub_menu' => $id_sub_menu
        );
        $this->db->insert('tb_akses', $data);
    }

    public function tutup_akses()
    {
        $id = $this->input->post('id_akses');
        $this->db->delete('tb_akses', array('id_akses' => $id));
    }

    public function get_access()
    {
        $idsubmenu = $this->input->post('id');
        $akses = $this->M_user->get_akses($idsubmenu);
        echo $akses['akses'];
    }
}
