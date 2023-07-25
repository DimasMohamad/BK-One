<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document_control extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        $this->load->model('M_dc');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
        $this->load->helper(array('form','url'));
    }

    public function signature_dc()
    {
        $akses = $this->M_user->get_akses(17);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
        $this->load->view('signature_dc');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    //Simpan ke database sql
    public function upload()
    {
        $data['gambar']='';
        $gambar = $_FILES['gambar']['name'];

        $config['upload_path']          = './uploads';
        $config['allowed_types']        = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if(! $this->upload->do_upload('gambar')){
            echo 'gagal';
        }else{
            $gambar = $this->upload->data('file_name');
            $data['gambar'] = $gambar;
        }
        $this->db->insert('upload',$data);
        redirect('Document_control');   
    }

    public function simpan_dokumen2()
    {
        //copy name sebanyak field database dan sesuaikan
        $docnum = $this->input->post('docnum');
        $user_dc = $this->input->post('user_dc');
        $user_mr = $this->input->post('user_mr');
        $user_gm = $this->input->post('user_gm');
        $data = array(
            //copy name sebanyak field database
            'docnum' => $docnum,
            'user_dc' => $user_dc,
            'user_mr' => $user_mr,
            'user_gm' => $user_gm,
        );
        $this->db->insert('signature', $data);
    }

    public function test_session(){
        $sesi = $this->session->nama_user;
        //$sesi = $this->input->get('s');
        echo $sesi;
        //$posisi = $this->db->query("SELECT ifnull(position1,'user') as position1 FROM tb_user WHERE id_user = $sesi;")->result_array();
        //echo $posisi;
        //$data = json_encode($posisi);
        //echo $data;
    }

    public function hapus_dokumen(){
        $id = $this->input->post('id');
        $namafile = "./uploads/".$this->input->post('namafile');
        echo $namafile;
        $this->db->delete('signature', array('rowid' => $id));
        unlink("$namafile");
    }

    public function tampil_data(){
        $sesi = $this->session->id_user;
        $nama_user = $this->session->nama_user;
        //$sesi = $this->input->get('s');
        $posisi = $this->db->query("SELECT ifnull(position1,'user') as position1 FROM tb_user WHERE id_user = $sesi;")->row_array();
        //$data_posisi = json_encode($posisi);
        //echo $posisi['position1'];
        if ($posisi['position1']=='DC' || $posisi['position1']=='MR' || $posisi['position1']=='GM') {
            $dt['user'] = $this->db->query("SELECT s.rowid, s.docnum, username.nama AS user_upload, s.date_upload, udc.position1 AS user_dc, s.date_signdc, umr.position1 AS user_mr, s.date_signmr, ugm.position1 AS user_gm, s.date_signgm, s.file, s.status
            FROM signature s 
            LEFT JOIN tb_user udc ON s.user_dc = udc.id_user
            LEFT JOIN tb_user umr ON s.user_mr = umr.id_user 
            LEFT JOIN tb_user ugm ON s.user_gm = ugm.id_user
            LEFT JOIN tb_user username ON s.user_upload = username.id_user
            WHERE udc.position1 = '".$posisi['position1']."' or umr.position1 = '".$posisi['position1']."' or ugm.position1 = '".$posisi['position1']."';")->result_array();
            $data = json_encode($dt);
            //echo "DC, MR, GM";
            //echo $data;
            $this->load->view("tb_signature_dc",["data"=>$data]);
        }else{
            $dt['user'] = $this->db->query("SELECT s.rowid, s.docnum, username.nama AS user_upload, s.date_upload, udc.nama AS user_dc, s.date_signdc, umr.nama AS user_mr, s.date_signmr, ugm.nama AS user_gm, s.date_signgm, s.file, s.status
            FROM signature s 
            LEFT JOIN tb_user udc ON s.user_dc = udc.id_user
            LEFT JOIN tb_user umr ON s.user_mr = umr.id_user 
            LEFT JOIN tb_user ugm ON s.user_gm = ugm.id_user
            LEFT JOIN tb_user username ON s.user_upload = username.id_user
            WHERE username.nama = '".$nama_user."';")->result_array();
            $data = json_encode($dt);
            //echo "User";
            //echo $data;
            $this->load->view("tb_signature_dc",["data"=>$data]);
        }
        
    }

        public function jam(){
            echo form_open_multipart('Document_control/do_upload');
            //echo time();
        }

        public function do_upload()
        {
            $filename = $_FILES['userfile']['name'];
            $filename_parts = pathinfo($filename);
            $file_name_without_ext = $filename_parts['filename'];
            $file_extension = $filename_parts['extension'];
            $file_name_without_ext = str_replace('.', '_', $file_name_without_ext);
            $new_filename = $file_name_without_ext . '.' . $file_extension;
            $user_upload = $this->session->id_user;
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'pdf';

            $docnum = $this->input->post('nomor_dokumen');
            $user_dc = $this->input->post('user_dc');
            $user_mr = $this->input->post('user_mr');
            $user_gm = $this->input->post('user_gm');
            $statusawal = "0";
            
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload()) {
                $error = array('error' => $this->upload->display_errors());
                print_r($error); // Hanya untuk debugging, bisa diubah menjadi pesan yang lebih informatif
            } else {
                $data = array(
                    //Nomor dokumen diganti dengan nama file yg diupload
                    'docnum' => $docnum,
                    'user_upload' => $user_upload,
                    'user_dc' => $user_dc,
                    'user_mr' => $user_mr,
                    'user_gm' => $user_gm,
                    'file' => $new_filename,
                    'status' => $statusawal,
                );
                $this->db->insert('signature', $data);
            }
        }

        public function list_dokumen(){
            $dt['user'] = $this->db->query("SELECT * from signature;")->result_array();
            $data = json_encode($dt);
            //echo $data;
            $this->load->view("tb_listdokumen",["data"=>$data]);
        }

        public function sign_approve(){
            $iddoc = $this->input->post('id');
            $tanggal_sign = date('Y-m-d');
            $sesi = $this->session->id_user;
            $nama_user = $this->session->nama_user;
            $posisi = $this->db->query("SELECT ifnull(position1,'user') as position1 FROM tb_user WHERE id_user = $sesi;")->row_array();
            if ($posisi['position1'] == 'DC') {
                $status = "1";
                $data = array(
                    'status' => $status,
                    'date_signdc' => $tanggal_sign,
                );
                $this->db->where('rowid', $iddoc);
                $this->db->update('signature', $data);
            }elseif ($posisi['position1'] == 'MR') {
                $status = "2";
                $data = array(
                    'status' => $status,
                    'date_signmr' => $tanggal_sign,
                );
                $this->db->where('rowid', $iddoc);
                $this->db->update('signature', $data);
            }elseif ($posisi['position1'] == 'GM') {
                $status = "3";
                $data = array(
                    'status' => $status,
                    'date_signgm' => $tanggal_sign,
                );
                $this->db->where('rowid', $iddoc);
                $this->db->update('signature', $data);
            }
        }

        public function sign_reject(){
            $iddoc = $this->input->post('id');
            $status = "4";
            $data = array(
                'status' => $status,
            );
            $this->db->where('rowid', $iddoc);
            $this->db->update('signature', $data);
        }
}