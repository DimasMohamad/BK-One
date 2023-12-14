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
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_ppic');
        $this->load->model('M_user');
    }

    public function tb_list_module()
    {
        $s = $this->input->get('s');
        $e = $this->input->get('e');
        $dataspk = $this->M_ppic->tb_list_module($s, $e);
        $this->load->view('tb_list_module', ["dataspk" => $dataspk]);
    }

    public function spk()
    {
        $akses = $this->M_user->get_akses(17);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('spk');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function test_database()
    {
        $akses = $this->M_user->get_akses(17);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('test_database');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function test()
    {
        $addondb = $this->load->database('addon', TRUE);
        $posisi = $addondb->query("SELECT distinct
        A.id AS id_spk,
        A.voucher_no AS spk,
        A.parent_id,
        B.id_spk_detail,
        ifnull(B.spk_detail,'-') AS spk_detail,
        ifnull(A.production,'-') AS production,
        E.mesin,
        A.our_bom_id,
        D.item_no,
        D.DESCRIPTION,
        A.qty_order,
        A.qty_buffer,
        A.qty_prod,
        D.uom,
        A.STATUS,
        A.ORDER,
        DATE_FORMAT(A.start_date, '%d %b %Y') AS start_date,
        DATE_FORMAT(A.end_date, '%d %b %Y') AS end_date
        from our_productions A
        LEFT Join(SELECT id AS id_spk_detail,voucher_no AS spk_detail,parent_id from our_productions)B ON B.parent_id = A.id        
        LEFT JOIN(SELECT id,item_no,group_name,DESCRIPTION,uom FROM our_items)D ON D.id = A.our_item_id
        LEFT JOIN(SELECT id,NAME AS mesin,speed FROM our_lines)E ON E.id = A.our_line_id
        WHERE A.our_line_id IS NOT NULL AND A.voucher_no = 'BKI/PO/2311/00095' order BY A.voucher_no DESC;")->row_array();
        print_r($posisi);
    }

    public function tb_spk()
    {
        $id = $this->input->get('spk');
        $dataspk = $this->M_ppic->tb_spk_head($id);
        $dataspkheaditem = $this->M_ppic->tb_spk_head_item($id);
        $this->load->view('tb_spk', [
            "data" => $dataspk,
            "itemhead" => $dataspkheaditem
        ]);
    }

    public function tb_spk_xls()
    {
        $id = $this->input->get('spk');
        $dataspk = $this->M_ppic->tb_spk_head($id);
        $dataspkheaditem = $this->M_ppic->tb_spk_head_item($id);
        $this->load->view('tb_spk_xls', [
            "data" => $dataspk,
            "itemhead" => $dataspkheaditem
        ]);
    }

    public function tb_spk_list()
    {
        $s = $this->input->get('s');
        $e = $this->input->get('e');
        $spklist = $this->M_ppic->tb_spk_list($s, $e);
        $spk = json_encode($spklist);
        echo $spk;
    }

    public function pass()
    {
        $password_from_form = $this->input->get('p');
        $salt = password_hash($password_from_form, PASSWORD_BCRYPT);
        echo $salt;
    }

    public function validasi()
    {
        // Mendapatkan password dari form
        $password_from_form = $_POST['password'];

        // Mendapatkan hash (salt dan password terenkripsi) dari database (contoh: hash disimpan di kolom "password_hash" di tabel "users")
        $stored_hash_from_database = $row['password_hash'];

        // Memvalidasi password
        if (password_verify($password_from_form, $stored_hash_from_database)) {
            echo "Password cocok! Pengguna berhasil diautentikasi.";
        } else {
            echo "Password tidak cocok. Pengguna tidak berhasil diautentikasi.";
        }
    }

    public function spk_list()
    {
        $this->load->view('tb_spk_ui');
    }

    public function tb_spk_list_ui()
    {
        $s = $this->input->get('s');
        $e = $this->input->get('e');
        $spklist = $this->M_ppic->tb_spk_list_2($s, $e);
        $data = json_encode($spklist);
        echo $data;
    }

    public function tb_spk_list_dtl()
    {
        $idspk = $this->input->get('nospk');
        $spklistdtl = $this->M_ppic->tb_spk_head_item_2($idspk);
        $datadtl = json_encode($spklistdtl);
        echo $datadtl;
    }
}
