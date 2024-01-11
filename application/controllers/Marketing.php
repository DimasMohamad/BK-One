<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marketing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        $this->load->model('M_marketing');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
        $this->load->helper(array('form', 'url'));
    }

    public function produk_palsu()
    {
        $akses = $this->M_user->get_akses(19);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('produk_palsu');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function recall()
    {
        $akses = $this->M_user->get_akses(20);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('recall');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function pelanggan()
    {
        $akses = $this->M_user->get_akses(21);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('daftar_pelanggan');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function laporan_klaim()
    {
        $akses = $this->M_user->get_akses(22);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('laporan_klaim');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function kepuasan_pelanggan()
    {
        $akses = $this->M_user->get_akses(23);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('kepuasan_pelanggan');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tampil_data()
    {
        $dt['data'] = $this->db->query("SELECT * FROM produk_palsu;")->result_array();
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_produk_palsu", ["data" => $data]);
    }

    public function do_upload()
    {
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

    public function print_produk_palsu()
    {
        $id = $this->input->get('id');
        //echo $id;
        $dt['data'] = $this->db->query("SELECT * FROM produk_palsu WHERE rowid = $id;")->row_array();
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("print_produk_palsu", ["data" => $data]);
    }

    public function hapus_formulir()
    {
        $id = $this->input->post('id');
        $this->db->delete('produk_palsu', array('rowid' => $id));
    }

    public function tampil_data_recall()
    {
        $dt['data'] = $this->M_marketing->data();
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_recall", ["data" => $data]);
    }

    public function hapus_recall()
    {
        $id = $this->input->post('id');
        $this->db->delete('recall', array('rowid' => $id));
    }

    public function print_recall()
    {
        $id = $this->input->get('id');
        //echo $id;
        //$dt['data'] = $this->M_marketing->recall();
        $data = $this->M_marketing->recall($id);
        //$data = json_encode($dt);
        //echo $data;
        $this->load->view("print_recall", ["data" => $data]);
    }

    public function daftar_pelanggan()
    {
        $hingga = $this->input->get('hingga');
        $dt['data'] = $this->M_marketing->pelanggan($mulai, $hingga);
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_daftar_pelanggan", ["data" => $data]);
    }

    public function print_pelanggan()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $dt['data'] = $this->M_marketing->pelanggan($mulai, $hingga);
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("print_daftar_pelanggan", ["data" => $data]);
    }

    //public function laporan_klaim(){
    //$dt['data'] = $this->M_marketing->klaim();
    //}
    public function do_upload_recall()
    {
        $nomor_form = $this->input->post('nomor_form');
        $nama_produk = $this->input->post('nama_produk');
        $nie = $this->input->post('nie');
        $batch_lot = $this->input->post('batch_lot');
        $total_recall = $this->input->post('total_recall');
        $alasan = $this->input->post('alasan');
        $hasil_inspeksi = $this->input->post('hasil_inspeksi');
        $tindakan = $this->input->post('tindakan');
        $status = $this->input->post('status');
        $ketua_tim = $this->input->post('ketua_tim');
        $anggota = $this->input->post('anggota');
        $otorisasi = $this->input->post('otorisasi');
        $data = array(
            //Nomor dokumen diganti dengan nama file yg diupload
            'nomor_form' => $nomor_form,
            'nama_produk' => $nama_produk,
            'nie' => $nie,
            'batch_lot' => $batch_lot,
            'total_recall' => $total_recall,
            'alasan' => $alasan,
            'hasil_inspeksi' => $hasil_inspeksi,
            'tindakan' => $tindakan,
            'status' => $status,
            'ketua_tim' => $ketua_tim,
            'anggota' => $anggota,
            'otorisasi' => $otorisasi,
        );
        //echo $data;
        $this->db->insert('recall', $data);
    }

    public function tampil_data_klaim()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $dt['data'] = $this->M_marketing->klaim($mulai, $hingga);
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_laporan_klaim", ["data" => $data]);
    }

    //Batas data klaim
    public function tampil_data_survey()
    {
        $t = $this->input->get('t');
        $s = $this->input->get('s');
        //$pl['datapl'] = $this->M_marketing->pelanggan2();
        $dt['data'] = $this->M_marketing->survey($t, $s);
        //$data1 = json_encode($pl);
        $data = json_encode($dt);
        //echo $data1;
        $this->load->view("tb_survey", ["data" => $data]);
    }

    public function get_nama_pel()
    {
        $namapel = $this->M_marketing->pelanggan2();
        echo "<option value='0'>--Pilih--</option>";
        foreach ($namapel as $np) {
            echo "<option value='" . $np['CardName'] . "'>" . $np['CardName'] . "</option>";
        }
    }

    public function get_filter_tahun()
    {
        $filtertahun = $this->M_marketing->get_filter_tahun();
        echo "<option value='0'>--Tahun--</option>";
        foreach ($filtertahun as $ft) {
            echo "<option value='" . $ft['tahun'] . "'>" . $ft['tahun'] . "</option>";
        }
    }

    public function simpan_nilai()
    {
        $nama = $this->input->post('nama');
        $semester = $this->input->post('semester');
        $tahun = $this->input->post('tahun');
        $p1 = $this->input->post('p1');
        $p2 = $this->input->post('p2');
        $p3 = $this->input->post('p3');
        $p4 = $this->input->post('p4');
        $p5 = $this->input->post('p5');
        $k1 = $this->input->post('k1');
        $k2 = $this->input->post('k2');
        $k3 = $this->input->post('k3');
        $k4 = $this->input->post('k4');
        $k5 = $this->input->post('k5');
        $r1 = $this->input->post('r1');
        $r2 = $this->input->post('r2');
        $r3 = $this->input->post('r3');
        $r4 = $this->input->post('r4');
        $r5 = $this->input->post('r5');
        $masukan = $this->input->post('masukan');
        $dt['data'] = $this->M_marketing->get_alamat_from_nama($nama);
        //print_r($dt['data']);
        $address = isset($dt['data'][0]['Address']) ? $dt['data'][0]['Address'] : '';
        //echo "Alamat: " . $address;

        $data = array(
            'nama' => $nama,
            'alamat' => $address,
            'semester' => $semester,
            'tahun' => $tahun,
            'p1' => $p1,
            'p2' => $p2,
            'p3' => $p3,
            'p4' => $p4,
            'p5' => $p5,
            'k1' => $k1,
            'k2' => $k2,
            'k3' => $k3,
            'k4' => $k4,
            'k5' => $k5,
            'r1' => $r1,
            'r2' => $r2,
            'r3' => $r3,
            'r4' => $r4,
            'r5' => $r5,
            'masukan' => $masukan
        );
        //echo $data;
        $this->db->insert('survey', $data);
    }

    public function print_kepuasan_pelanggan()
    {
        $s = $this->input->get('s');
        $t = $this->input->get('t');
        $dt['data'] = $this->M_marketing->print_survey($s, $t);
        $pr['perhitungan'] = $this->M_marketing->print_perhitungan($s, $t);
        $data = json_encode($dt);
        $datapr = json_encode($pr);
        $this->load->view("print_kepuasan_pelanggan", ["data" => $data, "datapr" => $datapr]);
        //echo "Semester: " . $s . "<br>";
        //echo "Tahun: " . $t . "<br>";
        //echo $datapr;
        //echo $data;
    }
}
