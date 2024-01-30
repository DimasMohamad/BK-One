<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Legal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        $this->load->model('M_legal');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
    }

    public function legalitas_bki()
    {
        $akses = $this->M_user->get_akses(27);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('legalitas');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function administrasi_legal()
    {
        $akses = $this->M_user->get_akses(28);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('administrasi_legal');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tampil_data()
    {
        $dt['data'] = $this->M_legal->data_legalitas();
        $data = json_encode($dt);
        $this->load->view("tb_legalitas", ["data" => $data]);
    }

    public function do_upload()
    {
        $filename = $_FILES['userfile']['name'];
        $filename_parts = pathinfo($filename);
        $file_name_without_ext = $filename_parts['filename'];
        $file_extension = $filename_parts['extension'];
        $file_name_without_ext = str_replace('.', '_', $file_name_without_ext);

        // Tambahkan tanggal upload ke nama file
        //$timestamp = date('YmdHis');
        $new_filename = $file_name_without_ext . '.' . $file_extension;
        //echo $timestamp;

        $config['upload_path'] = './uploads/legalitas/';
        $config['allowed_types'] = 'pdf';
        $config['overwrite'] = TRUE;

        $nomor = $this->input->post('nomor_dokumen');
        $nama = $this->input->post('nama_dokumen');
        $tgl_terbit = $this->input->post('tgl_terbit');
        $tgl_expired = $this->input->post('tgl_expired');
        $instansi = $this->input->post('instansi');
        $keterangan = $this->input->post('keterangan');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error); // Hanya untuk debugging
        } else {
            $data = array(
                'nomor_dokumen' => $nomor,
                'nama_dokumen' => $nama,
                'tgl_terbit' => $tgl_terbit,
                'tgl_expired' => $tgl_expired,
                'instansi' => $instansi,
                'keterangan' => $keterangan,
                'file' => $new_filename,
                'tanggal_upload' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tb_legalitas', $data);
        }
    }

    public function hapus_dokumen()
    {
        $id = $this->input->post('id');
        $namafile = "./uploads/legalitas/" . $this->input->post('namafile');
        echo $namafile;
        $this->db->delete('tb_legalitas', array('rowid' => $id));
        unlink("$namafile");
    }

    //Administrasi Legal
    public function tampil_data_administrasi()
    {
        $dt['data'] = $this->M_legal->data_administrasi();
        $data = json_encode($dt);
        $this->load->view("tb_administrasi_legal", ["data" => $data]);
    }

    public function do_upload_administrasi()
    {
        $filename = $_FILES['userfile']['name'];
        $filename_parts = pathinfo($filename);
        $file_name_without_ext = $filename_parts['filename'];
        $file_extension = $filename_parts['extension'];
        $file_name_without_ext = str_replace('.', '_', $file_name_without_ext);

        // Tambahkan tanggal upload ke nama file
        //$timestamp = date('YmdHis');
        $new_filename = $file_name_without_ext . '.' . $file_extension;
        //echo $timestamp;

        $config['upload_path'] = './uploads/administrasiBki/';
        $config['allowed_types'] = 'pdf';
        $config['overwrite'] = TRUE;

        $nomor = $this->input->post('nomor_dokumen');
        $nama = $this->input->post('nama_dokumen');
        $tgl_terbit = $this->input->post('tgl_terbit');
        $tgl_expired = $this->input->post('tgl_expired');
        $instansi = $this->input->post('instansi');
        $keterangan = $this->input->post('keterangan');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            print_r($error); // Hanya untuk debugging
        } else {
            $data = array(
                'nomor_dokumen' => $nomor,
                'nama_dokumen' => $nama,
                'tgl_terbit' => $tgl_terbit,
                'tgl_expired' => $tgl_expired,
                'instansi' => $instansi,
                'keterangan' => $keterangan,
                'file' => $new_filename,
                'tanggal_upload' => date('Y-m-d H:i:s'),
            );
            $this->db->insert('tb_administrasi_legal', $data);
        }
    }

    public function hapus_dokumen_administrasi()
    {
        $id = $this->input->post('id');
        $namafile = "./uploads/administrasiBki/" . $this->input->post('namafile');
        echo $namafile;
        $this->db->delete('tb_administrasi_legal', array('rowid' => $id));
        unlink("$namafile");
    }
}
