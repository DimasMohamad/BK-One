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
        $this->load->model('M_whse');
        $this->load->helper(array('url'));
        $this->load->helper(array('form', 'url'));
    }

    public function update_spek()
    {
        $akses = $this->M_user->get_akses(32);
        $sesi = $this->session->id_user;
        //print_r($sesi);
        $posisi = $this->M_whse->get_position($sesi);
        $data = json_encode($posisi);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('update_spek', ['data' => $data]);
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tampil_me()
    {
        $tipe = "me";
        $sesi = $this->session->id_user;
        $sesip = $this->M_whse->get_position($sesi);
        $posisi = json_encode($sesip); // Mengencode posisi ke JSON
        $dt['data'] = $this->M_lab->tampil_spek();
        $data = json_encode($dt);
        $this->load->view("tb_uspek_me", ["data" => $data, 'posisi' => $posisi, 'tipe' => $tipe]);
    }


    public function tampil_ma()
    {
        $tipe = "ma";
        $sesi = $this->session->id_user;
        $sesip = $this->M_whse->get_position($sesi);
        $posisi = json_encode($sesip); // Mengencode posisi ke JSON
        $dt['data'] = $this->M_lab->tampil_spek();
        $data = json_encode($dt);
        $this->load->view("tb_uspek_ma", ["data" => $data, 'posisi' => $posisi, 'tipe' => $tipe]);
    }

    public function tampil_un()
    {
        $tipe = "un";
        $sesi = $this->session->id_user;
        $sesip = $this->M_whse->get_position($sesi);
        $posisi = json_encode($sesip); // Mengencode posisi ke JSON
        $dt['data'] = $this->M_lab->tampil_spek();
        $data = json_encode($dt);
        $this->load->view("tb_uspek_un", ["data" => $data, 'posisi' => $posisi, 'tipe' => $tipe]);
    }

    public function tampil_po()
    {
        $tipe = "po";
        $sesi = $this->session->id_user;
        $sesip = $this->M_whse->get_position($sesi);
        $posisi = json_encode($sesip); // Mengencode posisi ke JSON
        $dt['data'] = $this->M_lab->tampil_spek();
        $data = json_encode($dt);
        $this->load->view("tb_uspek_po", ["data" => $data, 'posisi' => $posisi, 'tipe' => $tipe]);
    }

    public function tampil_nc()
    {
        $tipe = "nc";
        $sesi = $this->session->id_user;
        $sesip = $this->M_whse->get_position($sesi);
        $posisi = json_encode($sesip); // Mengencode posisi ke JSON
        $dt['data'] = $this->M_lab->tampil_spek();
        $data = json_encode($dt);
        $this->load->view("tb_uspek_nc", ["data" => $data, 'posisi' => $posisi, 'tipe' => $tipe]);
    }

    public function upload_file($type)
    {
        $types = [
            'me' => './uploads/uploads_spek_me/',
            'ma' => './uploads/uploads_spek_ma/',
            'un' => './uploads/uploads_spek_un/',
            'po' => './uploads/uploads_spek_po/',
            'nc' => './uploads/uploads_spek_nc/'
        ];

        if (!array_key_exists($type, $types)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid upload type']);
            return;
        }

        $upload_path = $types[$type];

        $filename = $_FILES['userfile']['name'];
        $filename_parts = pathinfo($filename);
        $file_name_without_ext = $filename_parts['filename'];
        $file_extension = $filename_parts['extension'];
        $file_name_without_ext = str_replace([' ', '.'], '_', $file_name_without_ext);
        $new_filename = $file_name_without_ext . '.' . $file_extension;

        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = 'pdf';
        $config['overwrite'] = TRUE;
        $config['file_name'] = $new_filename;

        $docname = $this->input->post('nama_spek');
        $ket = $this->input->post('keterangan');

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = $this->upload->display_errors('', '');
            echo json_encode(['status' => 'error', 'message' => $error]);
        } else {
            $data = array(
                'nama_dokumen' => $docname,
                'keterangan' => $ket,
                'tipe' => $type,
                'file' => $new_filename,
                //'user_upload' => $this->session->userdata('id_user'),
                //'created_at' => date('Y-m-d H:i:s')
            );

            if ($this->db->insert('tb_lab_spek', $data)) {
                echo json_encode(['status' => 'success', 'message' => 'File berhasil diupload dan disimpan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database']);
            }
        }
    }

    public function hapus_spek()
    {
        $tipe = $this->input->post('tipe');
        $id = $this->input->post('id');
        $namafile = "./uploads/uploads_spek_$tipe/" . $this->input->post('namafile');
        echo $namafile;
        $this->db->delete('tb_lab_spek', array('rowid' => $id));
        unlink("$namafile");
    }

    public function view_update_spek()
    {
        $this->load->view('view_update_spek');
    }
}
