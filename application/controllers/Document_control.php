<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

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
        $this->load->helper(array('form', 'url'));
    }

    public function signature_dc()
    {
        $akses = $this->M_user->get_akses(18);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('signature_dc');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    //Simpan ke database sql
    public function upload()
    {
        $data['gambar'] = '';
        $gambar = $_FILES['gambar']['name'];

        $config['upload_path']          = './uploads';
        $config['allowed_types']        = 'gif|jpg|png';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('gambar')) {
            echo 'gagal';
        } else {
            $gambar = $this->upload->data('file_name');
            $data['gambar'] = $gambar;
        }
        $this->db->insert('upload', $data);
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

    public function test_session()
    {
        $sesi = $this->session->nama_user;
        //$sesi = $this->input->get('s');
        echo $sesi;
        //$posisi = $this->db->query("SELECT ifnull(position1,'user') as position1 FROM tb_user WHERE id_user = $sesi;")->result_array();
        //echo $posisi;
        //$data = json_encode($posisi);
        //echo $data;
    }

    public function hapus_dokumen()
    {
        $id = $this->input->post('id');
        $namafile = "./uploads/" . $this->input->post('namafile');
        echo $namafile;
        $this->db->delete('signature', array('rowid' => $id));
        unlink("$namafile");
    }

    public function tampil_data()
    {
        $sesi = $this->session->id_user;
        $nama_user = $this->session->nama_user;
        $posisi = $this->db->query("SELECT ifnull(position1,'user') as position1 FROM tb_user WHERE id_user = $sesi;")->row_array();
        //echo $nama_user;
        //echo $posisi['position1'];
        if ($posisi['position1'] == 'DC' || $posisi['position1'] == 'MR' || $posisi['position1'] == 'MO') {
            $dt['user'] = $this->db->query("SELECT DISTINCT s.rowid, s.docnum, username.nama AS user_upload, s.date_upload, udc.position1 AS user_dc, s.date_signdc, umr.position1 AS user_mr, s.date_signmr, ugm.position1 AS user_gm, s.date_signgm, s.file, s.status
            FROM signature s 
            LEFT JOIN tb_user udc ON s.user_dc = udc.position1
            LEFT JOIN tb_user umr ON s.user_mr = umr.position1
            LEFT JOIN tb_user ugm ON s.user_gm = ugm.position1
            LEFT JOIN tb_user username ON s.user_upload = username.id_user
            WHERE udc.position1 = '" . $posisi['position1'] . "' or umr.position1 = '" . $posisi['position1'] . "' or ugm.position1 = '" . $posisi['position1'] . "';")->result_array();
            $dt['position1'] = $posisi['position1'];
            $data = json_encode($dt);
            //echo $data;
            $this->load->view("tb_signature_dc", ["data" => $data]);
        } else {
            $dt['user'] = $this->db->query("SELECT s.rowid, s.docnum, username.nama AS user_upload, s.date_upload, udc.nama AS user_dc, s.date_signdc, umr.nama AS user_mr, s.date_signmr, ugm.nama AS user_gm, s.date_signgm, s.file, s.status
            FROM signature s 
            LEFT JOIN tb_user udc ON s.user_dc = udc.id_user
            LEFT JOIN tb_user umr ON s.user_mr = umr.id_user 
            LEFT JOIN tb_user ugm ON s.user_gm = ugm.id_user
            LEFT JOIN tb_user username ON s.user_upload = username.id_user
            WHERE username.nama = '" . $nama_user . "';")->result_array();
            $dt['position1'] = $posisi['position1'];
            $data = json_encode($dt);
            //echo "User";
            //echo $data;
            $this->load->view("tb_signature_dc", ["data" => $data]);
        }
    }

    public function jam()
    {
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
        $config['overwrite'] = TRUE;

        $docnum = $this->input->post('nomor_dokumen');
        $user_dc = $this->input->post('user_dc');
        $user_mr = $this->input->post('user_mr');
        $user_gm = $this->input->post('user_mo');
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

    public function list_dokumen()
    {
        $dt['user'] = $this->db->query("SELECT * from signature;")->result_array();
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_listdokumen", ["data" => $data]);
    }

    public function sign_approve()
    {
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
            //$this->db->where('rowid', $iddoc);
            //$this->db->update('signature', $data);
            $this->generatePdfWithSignature($iddoc);
        } elseif ($posisi['position1'] == 'MR') {
            $status = "2";
            $data = array(
                'status' => $status,
                'date_signmr' => $tanggal_sign,
            );
            $this->db->where('rowid', $iddoc);
            $this->db->update('signature', $data);
        } elseif ($posisi['position1'] == 'MO') {
            $status = "3";
            $data = array(
                'status' => $status,
                'date_signgm' => $tanggal_sign,
            );
            $this->db->where('rowid', $iddoc);
            $this->db->update('signature', $data);
        }
    }

    public function generatePdfWithSignature($iddoc)
    {
        // Ambil data yang diperlukan untuk PDF dari database atau sumber lainnya
        $documentData = $this->db->get_where('signature', array('rowid' => $iddoc))->row_array();

        $pdfFilePath = FCPATH . 'Uploads/' . $documentData['file']; // Sesuaikan dengan struktur nama file PDF yang sesuai dengan database Anda

        // Path untuk menyimpan file PDF baru dengan tanda tangan
        $outputPdfFilePath = FCPATH . 'Uploads/document_with_signature.pdf';

        // Buat objek PDF (gunakan FPDF atau TCPDF)
        $this->load->library('fpdf');
        $this->load->library('fpdi');

        // Buat objek FPDI
        $pdf = new FPDI();

        // Tambahkan halaman dari PDF yang sudah ada
        $pdf->setSourceFile($pdfFilePath);
        $templateId = $pdf->importPage(1); // Impor halaman pertama
        $pdf->AddPage();
        $pdf->useTemplate($templateId);

        // Tanda tangan di PDF
        $imagePath = FCPATH . './ttd/ttd.png'; // Ganti dengan path gambar Anda
        $pdf->Image($imagePath, $x = 10, $y = 50, $w = 50, $h = 50);

        // Simpan PDF ke server atau kirim ke browser
        $pdf->Output($outputPdfFilePath, 'F');

        // Redirect atau lakukan operasi lain yang Anda butuhkan
        redirect(base_url('Uploads/document_with_signature.pdf'));
    }


    public function sign_reject()
    {
        $iddoc = $this->input->post('id');
        $status = "4";
        $data = array(
            'status' => $status,
        );
        $this->db->where('rowid', $iddoc);
        $this->db->update('signature', $data);
    }

    public function sasaran_mutu()
    {
        $akses = $this->M_user->get_akses(26);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('sasaran_mutu');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tampil_sarmut()
    {
        $divisi = $this->input->get('divisi');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $data['head'] = $this->M_dc->master_sarmut($divisi, $bulan, $tahun);
        $pr['detail'] = $this->M_dc->detail_sarmut($divisi, $tahun);
        $row = json_encode($data);
        $datapr = json_encode($pr);
        //print_r($row);
        $this->load->view("tb_sarmut", ["data" => $row,  "datapr" => $datapr]);
    }

    public function tampil_sarmut_detail()
    {
        $divisi_modal = $this->input->get('divisi');
        $filter_bulan1 = $this->input->get('filter_bulan1');
        $filter_tahun1 = $this->input->get('filter_tahun1');
        $knv_bulan = [
            '1' => ['start' => $filter_tahun1 . '-01-01', 'end' => $filter_tahun1 . '-01-30'],
            '2' => ['start' => $filter_tahun1 . '-02-01', 'end' => $filter_tahun1 . '-02-28'],
            '3' => ['start' => $filter_tahun1 . '-03-01', 'end' => $filter_tahun1 . '-03-31'],
            '4' => ['start' => $filter_tahun1 . '-04-01', 'end' => $filter_tahun1 . '-04-30'],
            '5' => ['start' => $filter_tahun1 . '-05-01', 'end' => $filter_tahun1 . '-05-31'],
            '6' => ['start' => $filter_tahun1 . '-06-01', 'end' => $filter_tahun1 . '-06-30'],
            '7' => ['start' => $filter_tahun1 . '-07-01', 'end' => $filter_tahun1 . '-07-31'],
            '8' => ['start' => $filter_tahun1 . '-08-01', 'end' => $filter_tahun1 . '-08-31'],
            '9' => ['start' => $filter_tahun1 . '-09-01', 'end' => $filter_tahun1 . '-09-30'],
            '10' => ['start' => $filter_tahun1 . '-10-01', 'end' => $filter_tahun1 . '-10-31'],
            '11' => ['start' => $filter_tahun1 . '-11-01', 'end' => $filter_tahun1 . '-11-30'],
            '12' => ['start' => $filter_tahun1 . '-12-01', 'end' => $filter_tahun1 . '-12-31'],
        ];

        if ($divisi_modal == "IT") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "PURCHASING") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            $pr5['pur5'] = $this->M_dc->PUR5($start, $end);
            //echo $pur5;
            $data['detail'] = $this->M_dc->detail_sarmutmodal($divisi_modal);
            $row = json_encode($data);
            $datapr5 = json_encode($pr5);
            $this->load->view("tb_sarmut_input", ["data" => $row,  "datapr5" => $datapr5]);
            //print_r($datapr5);
        } elseif ($divisi_modal == "FINANCE ACCOUNTING") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "GUDANG") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "HRD - GA") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "LEGAL") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "MARKETING") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "PPIC") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "PRODUKSI") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "QC") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "RND") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } elseif ($divisi_modal == "TEKNISI") {
            $start = $knv_bulan[$filter_bulan1]['start'];
            $end = $knv_bulan[$filter_bulan1]['end'];
            echo "Start Date: " . $start . "<br>";
            echo "End Date: " . $end;
        } else {
            echo "Not Work";
        }
    }

    public function simpan_sarmut()
    {
        $id_sarmut = $this->input->post('id_sarmut');
        $nilai = $this->input->post('nilai');
        $filter_bulan1 = $this->input->post('filter_bulan1');
        $filter_tahun1 = $this->input->post('filter_tahun1');
        $analisa = $this->input->post('analisa_penyebab');
        $tindakan = $this->input->post('tindakan_dilakukan');
        $rencana = $this->input->post('rencana_berikutnya');

        $total = count($id_sarmut);

        for ($i = 0; $i < count($id_sarmut); $i++) {
            $data = array(
                'id_sarmut' => $id_sarmut[$i],
                'nilai' => $nilai[$i],
                'bulan' => $filter_bulan1,
                'tahun' => $filter_tahun1,
                'analisa_penyebab' => $analisa[$i],
                'tindakan' => $tindakan[$i],
                'rencana_selanjutnya' => $rencana[$i],
            );
            print_r($data);
            $this->db->insert('sarmut', $data);
        }
    }

    public function get_filter_dc()
    {
        $filterposisi = $this->M_dc->get_filter_dc();
        echo "<option value='0'>-- Pilih --</option>";
        foreach ($filterposisi as $ft) {
            echo "<option value='" . $ft['position1'] . "'>" . $ft['nama'] . "</option>";
        }
    }

    public function get_filter_mr()
    {
        $filterposisi = $this->M_dc->get_filter_mr();
        echo "<option value='0'>-- Pilih --</option>";
        foreach ($filterposisi as $ft) {
            echo "<option value='" . $ft['position1'] . "'>" . $ft['nama'] . "</option>";
        }
    }

    public function get_filter_mo()
    {
        $filterposisi = $this->M_dc->get_filter_mo();
        echo "<option value='0'>-- Pilih --</option>";
        foreach ($filterposisi as $ft) {
            echo "<option value='" . $ft['position1'] . "'>" . $ft['nama'] . "</option>";
        }
    }
}
