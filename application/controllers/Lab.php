<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lab extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        $this->load->model('M_lab');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->helper(array('form', 'url'));
    }

    public function update_spek()
    {
        $akses = $this->M_user->get_akses(32);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('update_spek');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public  function tampil_data_spek()
    {
        $dt['data'] = $this->M_lab->tampil_spek();
        $data = json_encode($dt);
        $this->load->view("tb_update_spek", ["data" => $data]);
    }

    public function do_upload()
    {
        $filename = $_FILES['userfile']['name'];
        $filename_parts = pathinfo($filename);
        $file_name_without_ext = $filename_parts['filename'];
        $file_extension = $filename_parts['extension'];
        $file_name_without_ext = str_replace([' ', '.'], '_', $file_name_without_ext);
        $new_filename = $file_name_without_ext . '.' . $file_extension;
        $user_upload = $this->session->id_user;
        $config['upload_path'] = './uploads_spek/';
        $config['allowed_types'] = 'pdf';
        $config['overwrite'] = TRUE;

        $docname = $this->input->post('nama_spek');
        $ket = $this->input->post('keterangan');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error); // Hanya untuk debugging, bisa diubah menjadi pesan yang lebih informatif
        } else {
            $data = array(
                'nama_dokumen' => $docname,
                'keterangan' => $ket,
                'file' => $new_filename,
            );
            print_r($data);
            $this->db->insert('tb_lab_spek', $data);
        }
    }

    public function hapus_spek()
    {
        $id = $this->input->post('id');
        $namafile = "./uploads_spek/" . $this->input->post('namafile');
        echo $namafile;
        $this->db->delete('tb_lab_spek', array('rowid' => $id));
        unlink("$namafile");
    }
}
