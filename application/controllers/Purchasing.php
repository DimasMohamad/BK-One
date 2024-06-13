<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Purchasing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }

        $this->load->model('M_purc');
        $this->load->model('M_user');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
    }
    /*
    public function spp()
    {
        $akses = $this->M_user->get_akses(8);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('spp');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_spp()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $dept = $this->input->get('dept');
        $data['head'] = $this->M_purc->laporan_spp($mulai, $hingga, $dept);
        $data['detail'] = $this->M_purc->laporan_spp_detail($mulai, $hingga, $dept);
        $row = json_encode($data);
        //echo $row;
        $this->load->view("tb_spp", ["data" => $row]);
    }

    public function tb_spp_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head'] = $this->M_purc->laporan_spp($mulai, $hingga, $dept);
        $data['detail'] = $this->M_purc->laporan_spp_detail($mulai, $hingga, $dept);
        $row = json_encode($data);
        $this->load->view("tb_spp_xls", ["data" => $row]);
    }

    public function outstanding_po()
    {
        $akses = $this->M_user->get_akses(9);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('outstanding_po');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_outstanding_po()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head1'] = $this->M_purc->outs_po_head1($mulai, $hingga);
        $data['detail'] = $this->M_purc->outs_po_detail($mulai, $hingga);
        $row = json_encode($data);
        $this->load->view("tb_outstanding_po", ["data" => $row]);
    }

    public function tb_outstanding_po_ui()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data = $this->M_purc->outstanding_po($mulai, $hingga);
        $row = json_encode($data);
        echo $row;
    }

    public function trace_po()
    {
        $nopo = $this->input->get('po');
        $dt['head'] = $this->M_purc->po_head($nopo);
        $dt['detail'] = $this->M_purc->po_detail($nopo);
        $data = json_encode($dt);
        echo $data;
    }

    public function outstanding_purchase()
    {
        $akses = $this->M_user->get_akses(10);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('outstanding_purchase');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_outstanding_purchase()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $dept = $this->input->get('dept');
        $data['head'] = $this->M_purc->laporan_spp($mulai, $hingga, $dept);
        $data['po'] = $this->M_purc->laporan_spp_detail($mulai, $hingga, $dept);
        //$data['grpo'] = $this->M_purc->outs_po_detail($mulai,$hingga);
        $data['grpo'] = $this->M_purc->outs_grpo_detail($mulai, $hingga);
        $row = json_encode($data);
        $this->load->view("tb_outstanding_purchase", ["data" => $row]);
    }

    public function tb_outstanding_purchase_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head'] = $this->M_purc->laporan_spp($mulai, $hingga);
        $data['po'] = $this->M_purc->laporan_spp_detail($mulai, $hingga);
        $data['grpo'] = $this->M_purc->outs_grpo_detail($mulai, $hingga);
        $row = json_encode($data);
        $this->load->view("tb_outstanding_purchase_xls", ["data" => $row]);
    }

    public function trace_grpo()
    {
        $nopo = $this->input->get('grpo');
        $dt['head'] = $this->M_purc->grpo_head($nopo);
        $dt['detail'] = $this->M_purc->grpo_detail($nopo);
        $data = json_encode($dt);
        echo $data;
    }

    public function tb_outstanding_po_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data['head1'] = $this->M_purc->outs_po_head1($mulai, $hingga);
        $data['detail'] = $this->M_purc->outs_po_detail($mulai, $hingga);
        $row = json_encode($data);
        $this->load->view("tb_outstanding_po_xls", ["data" => $row]);
    }

    public function Dept()
    {
        $dept = $this->M_purc->Dept();
        foreach ($dept as $d) {
            echo "<option value=" . $d['Code'] . ">" . $d['Dept'] . "</option>";
        }
    }

    public function penilaian_supp()
    {
        $row = json_encode($this->M_purc->get_penilaian_supp());
        echo $row;
    }

    public function get_filter_supp()
    {
        $filtersupp = $this->M_purc->get_sup_db();
        echo "<option value='0'>--Pilih Supplier--</option>";
        foreach ($filtersupp as $fs) {
            $supp = $this->M_purc->get_supp($fs['id_supp']);
            echo "<option value='" . $fs['id_supp'] . "'>" . $supp['CardName'] . "</option>";
        }
    }

    public function get_filter_tahun()
    {
        $filtertahun = $this->M_purc->get_filter_tahun();
        echo "<option value='0'>--Tahun--</option>";
        foreach ($filtertahun as $ft) {
            echo "<option value='" . $ft['tahun'] . "'>" . $ft['tahun'] . "</option>";
        }
    }

    public function supplier_appraisal()
    {
        $this->db->select('id_supp');
        $this->db->distinct();
        $akses = $this->M_user->get_akses(15);
        $tahun = $this->M_purc->get_year();
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('supplier_appraisal', ["tahun" => $tahun]);
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_po_list()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $row['head'] = [];
        $head = $this->M_purc->get_penilaian_po_list($mulai, $hingga);
        foreach ($head as $h) {
            $r = [];
            $nopo = $this->M_purc->get_nopo($h['DocNum']);
            foreach ($nopo as $n) {
                if ($n['rowid'] == 0) {
                    $r['DocNum'] = $h['DocNum'];
                    $r['Posting_date'] = $h['Posting_date'];
                    $r['DocDate'] = $h['DocDate'];
                    $r['CardCode'] = $h['CardCode'];
                    $r['CardName'] = $h['CardName'];
                    array_push($row['head'], $r);
                }
            }
        }
        $row['item'] = $this->M_purc->get_penilaian_po_list_item($mulai, $hingga);
        $datapo = json_encode($row);
        $this->load->view('tb_po_list', ["data" => $datapo]);
    }

    public function idunik()
    {
        echo $uniqueString = uniqid('', true);
    }

    //simpan nilai versi lama
    public function simpan_nilai()
    {
        $nopo = $this->input->post('id_penilaian');
        $id_supp = $this->input->post('id_supp');
        $mutu = $this->input->post('mutu');
        $pelayanan = $this->input->post('pelayanan');
        $kuantiti = $this->input->post('kuantiti');
        $keterangan = $this->input->post('keterangan');
        $semester = $this->input->post('semester');
        $tahun = $this->input->post('tahun');
        $data = array(
            'nopo' => $nopo,
            'n1' => $mutu,
            'n2' => $pelayanan,
            'n3' => $kuantiti,
            'keterangan' => $keterangan,
            'id_supp' => $id_supp,
            'semester' => $semester,
            'tahun' => $tahun
        );
        $this->db->insert('tb_supp_p_2', $data);
    }

    public function simpan_nilai2()
    {
        $nopo = $this->input->get('id_penilaian');
        $id_supp = $this->input->get('id_supp');
        $mutu = $this->input->get('mutu');
        $pelayanan = $this->input->get('pelayanan');
        $kuantiti = $this->input->get('kuantiti');
        $keterangan = $this->input->get('keterangan');
        $semester = $this->input->get('semester');
        $tahun = $this->input->get('tahun');
        $item = $this->input->get('item');
        $data = array(
            'nopo' => $nopo,
            'n1' => $mutu,
            'n2' => $pelayanan,
            'n3' => $kuantiti,
            'keterangan' => $keterangan,
            'id_supp' => $id_supp,
            'semester' => $semester,
            'tahun' => $tahun,
            'item' => $item
        );
        //print_r($data);
        $this->db->insert('tb_supp_p_2', $data);
    }

    public function laporan_penilaian_supp()
    {
        $s = $this->input->get('s');
        $t = $this->input->get('t');
        $id_supp = $this->input->get('id_supp');
        $data = json_encode($this->M_purc->laporan_penilaian_supp($s, $t, $id_supp));
        $supp = $this->M_purc->get_supp($id_supp);
        $this->load->view("laporan_penilaian_supp", ["data" => $data, "supp" => $supp, "s" => $s]);
    }

    public function cetak_laporan_penilaian_supp()
    {
        $s = $this->input->get('s');
        $t = $this->input->get('t');
        $id_supp = $this->input->get('id_supp');
        $data = json_encode($this->M_purc->laporan_penilaian_supp($s, $t, $id_supp));
        $supp = $this->M_purc->get_supp($id_supp);
        $this->load->view("cetaklaporan_penilaian_supp", ["data" => $data, "supp" => $supp]);
    }

    public function master_kriteria_penilaian() // belum registrasi
    {
        $akses = $this->M_user->get_akses(16);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('master_kriteria_penilaian');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_kriteria_penilaian()
    {
        $head = $this->db->get_where('tb_kriteria_penilaian', ['fatherid' => 0])->result_array();

        $child = $this->db->query("SELECT * FROM tb_kriteria_penilaian WHERE fatherid <> '0';")->result_array();

        $this->load->view('tb_kriteria_penilaian', ["head" => $head, "child" => $child]);
        //print_r($child);
    }

    public function simpan_kriteria_nilai_head()
    {
        $header = $this->input->post('header');
        $data = array(
            'penilaian' => $header,
            'nilai' => 0,
            'fatherid' => 0,
            'sts' => 1
        );
        $this->db->insert('tb_kriteria_penilaian', $data);
    }

    public function simpan_kriteria_nilai_subtitle()
    {
        $idtitle = $this->input->post('idjudul');
        $subtitle = $this->input->post('subtitle');
        $nilai = $this->input->post('nilai');
        $data = array(
            'penilaian' => $subtitle,
            'nilai' => $nilai,
            'fatherid' => $idtitle,
            'sts' => 1
        );
        $this->db->insert('tb_kriteria_penilaian', $data);
    }

    public function get_supp_penilaian()
    {
        $s = $this->input->get('s');
        $e = $this->input->get('e');
        $dataocrd = $this->M_purc->get_ocrd();
        $row['ocrd'] = [];
        foreach ($dataocrd as $d) {
            $r = [];
            $de = $this->M_purc->get_supp_exists($d['CardCode'], $s, $e);
            if ($de['id_supp'] == 0) {
                echo "<option value='" . $d['CardCode'] . "'>" . $d['CardName'] . "</option>";
            }
        }
    }

    public function pemilihan_supplier() // belum registrasi
    {
        $akses = $this->M_user->get_akses(16);
        $tahun = $this->M_purc->get_year();
        $judul = $this->db->get_where('tb_kriteria_penilaian', ['fatherid' => 0])->result_array();
        $subtitle = $this->db->query("SELECT * FROM tb_kriteria_penilaian WHERE fatherid <> '0';")->result_array();
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('pemilihan_supp', ["tahun" => $tahun, "judul" => $judul, "subtitle" => $subtitle]);
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function simpan_pemilihan_supp()
    {
        $s = $this->input->post('tglmulai');
        $e = $this->input->post('tglhingga');
        $supp = $this->input->post('supp');
        $idnilai = $this->input->post('idnilai');
        $nilai = $this->input->post('addnilai');
        $jmlsupp = count($supp);
        $jmlnilai = count($nilai);

        for ($no = 0; $no < $jmlsupp; $no++) {
            $namasupp = $this->M_purc->get_supp($supp[$no]);
            for ($nmr = 0; $nmr < $jmlnilai; $nmr++) {
                $data = array(
                    'id_supp' => $supp[$no],
                    'supp' => $namasupp['CardName'],
                    'alamat' => $namasupp['Address'],
                    'telp' => $namasupp['Tel1'],
                    'id_penilaian' => $idnilai[$nmr],
                    'nilai' => $nilai[$nmr],
                    'mulai' => $s,
                    'hingga' => $e
                );
                $this->db->insert('tb_pemilihan_supp', $data);
            }
        }
    }

    public function tb_penilaian_supplier()
    {
        $s = $this->input->get("s");
        $e = $this->input->get("e");
        $datasupp = $this->M_purc->get_penilaian_supplier($s, $e);
        //------ penilaian
        $list_supp = [];
        $supp = $this->M_purc->get_supp_pv($s, $e);
        foreach ($supp as $sp) {
            array_push($list_supp, $sp['id_supp']);
        }
        $list_kriteria = $this->M_purc->get_kriteria_penilaian();
        $kriteria = [];
        $i = 1;
        foreach ($list_kriteria as $lk) {
            $data = [];
            $data['rowid'] = $lk['penilaian'];
            foreach ($list_supp as $lp) {
                $row = $this->M_purc->get_supp_nilai($s, $e, $lp, $i);
                $data[$lp] = $row['nilai'];
            }
            $i++;
            array_push($kriteria, $data);
        }
        $datakriteria = json_encode($kriteria);

        $datanilai = [];
        foreach ($list_supp as $lp) {
            $tnilai = $this->M_purc->get_supp_tnilai($s, $e, $lp, $i);
            $datanilai[$lp] = $tnilai['tnilai'];
            array_push($datanilai);
        }
        //----------------
        $this->load->view("tb_penilaian_supplier", ["data" => $datasupp, "kriteria" => $kriteria, "datanilai" => $datanilai]);
    }

    public function tb_supp_pv()
    {
        $s = $this->input->get('s');
        $e = $this->input->get('e');
        $list_supp = [];
        $supp = $this->M_purc->get_supp_pv($s, $e);
        foreach ($supp as $sp) {
            array_push($list_supp, $sp['id_supp']);
        }
        $list_kriteria = $this->M_purc->get_kriteria_penilaian();
        $kriteria = [];
        $i = 1;
        foreach ($list_kriteria as $lk) {
            $data = [];
            $data['rowid'] = $lk['penilaian'];
            foreach ($list_supp as $lp) {
                $row = $this->M_purc->get_supp_nilai($s, $e, $lp, $i);
                $data[$lp] = $row['nilai'];
            }
            $i++;
            array_push($kriteria, $data);
        }
        $datakriteria = json_encode($kriteria);
        $this->load->view('tb_penilaian_supp', ["kriteria" => $kriteria]);
    }

    public function print_supp()
    {
        $produk = $this->input->get('produk');
        $kesimpulan = $this->input->get('kesimpulan');
        $catatan = $this->input->get('catatan');
        $s = $this->input->get('mulai');
        $e = $this->input->get('hingga');
        $datasupp = $this->M_purc->get_penilaian_supplier($s, $e);
        //------ penilaian
        $list_supp = [];
        $supp = $this->M_purc->get_supp_pv($s, $e);
        foreach ($supp as $sp) {
            array_push($list_supp, $sp['id_supp']);
        }
        $list_kriteria = $this->M_purc->get_kriteria_penilaian();
        $kriteria = [];
        $i = 1;
        foreach ($list_kriteria as $lk) {
            $data = [];
            $data['rowid'] = $lk['penilaian'];
            foreach ($list_supp as $lp) {
                $row = $this->M_purc->get_supp_nilai($s, $e, $lp, $i);
                $data[$lp] = $row['nilai'];
            }
            $i++;
            array_push($kriteria, $data);
        }
        $datakriteria = json_encode($kriteria);

        $datanilai = [];
        foreach ($list_supp as $lp) {
            $tnilai = $this->M_purc->get_supp_tnilai($s, $e, $lp, $i);
            $datanilai[$lp] = $tnilai['tnilai'];
            array_push($datanilai);
        }
        //----------------
        $this->load->view("print_pemilihan_supplier", ["data" => $datasupp, "kriteria" => $kriteria, "datanilai" => $datanilai, "produk" => $produk, "kesimpulan" => $kesimpulan, "catatan" => $catatan]);
    }

    public function get_supp_nilai()
    {
        $s = $this->input->get('s');
        $e = $this->input->get('e');
        $id = $this->input->get('id');
        $data = $this->M_purc->get_supp_nilai($s, $e, $id);
        print_r($data);
    }*/

    public function nota_manual()
    {
        $akses = $this->M_user->get_akses(24);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('nota_manual');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tampil_nota_manual()
    {
        $dt['data'] = $this->M_purc->tampil_nota();
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_nota_manual", ["data" => $data]);
    }

    public function simpan_nota()
    {
        $no_po = $this->input->post('no_po');
        $tanggal = $this->input->post('tanggal');
        $nama = $this->input->post('get_nama');
        $kota = $this->input->post('kota');
        $alamat = $this->input->post('alamat');
        $attn = $this->input->post('attn');
        $top = $this->input->post('top');
        $telepon = $this->input->post('telepon');
        $kode_barang = $this->input->post('kode_barang');
        $jenis_barang = $this->input->post('jenis_barang');
        $jumlah = $this->input->post('jumlah');
        $satuan = $this->input->post('satuan');
        $keterangan = $this->input->post('keterangan');

        $total = count($kode_barang);

        for ($i = 0; $i < count($kode_barang); $i++) {
            $data = array(
                'no_po' => $no_po,
                'tanggal' => $tanggal,
                'nama' => $nama,
                'kota' => $kota,
                'alamat' => $alamat,
                'attn' => $attn,
                'top' => $top,
                'telepon' => $telepon,
                'kode_barang' => $kode_barang[$i],
                'jenis_barang' => $jenis_barang[$i],
                'jumlah' => $jumlah[$i],
                'satuan' => $satuan[$i],
                'keterangan' => $keterangan[$i],
            );
            $this->db->insert('nota_manual', $data);
        }
    }
    /*
    public function get_nama_cus()
    {
        $namapel = $this->M_purc->get_namacus();
        foreach ($namapel as $np) {
            echo "<option value='" . $np['CardName'] . "'>" . $np['CardName'] . "</option>";
        }
    }

    public function get_top()
    {
        $top = $this->M_purc->get_top();
        echo "<option value='0'>--Payment Terms--</option>";
        foreach ($top as $tp) {
            echo "<option value='" . $tp['PymntGroup'] . "'>" . $tp['PymntGroup'] . "</option>";
        }
    }

    public function get_list_item()
    {
        $code1 = $this->input->get('kode_barang');
        //$code = $this->input->get('kode_barang');
        $dt = $this->M_purc->get_listitem($code1);
        echo json_encode($dt);
    }

    public function hapus_tidak_terpilih()
    {
        $no_po = $this->input->post('no_po');
        echo $no_po;
        $this->db->delete('nota_manual', array('no_po' => $no_po));
    }

    public function print_nota_manual()
    {
        $no_po = $this->input->get('no_po');
        $dt['data'] = $this->M_purc->nota_manual($no_po);
        $dt2['detail'] = $this->M_purc->detail_nota_manual($no_po);
        $data = json_encode($dt);
        $data2 = json_encode($dt2);
        $this->load->view("print_nota_manual", ["data" => $data, "data2" => $data2]);
        //echo $data;
        //echo $data2;
    }

    public function rekap_po()
    {
        $akses = $this->M_user->get_akses(25);
        $this->load->view('header');
        if (!$akses['akses'] == 0) {
            $this->load->view('rekap_po');
        } else {
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tampil_rekap_po()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $dt['data'] = $this->M_purc->tampil_rekap_po($mulai, $hingga);
        $data = json_encode($dt);
        //echo $data;
        $this->load->view("tb_rekap_po", ["data" => $data]);
    }

    public function tb_rekappo_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $data = $this->M_purc->tampil_rekap_po($mulai, $hingga);
        $row['rekappo'] = [];
        foreach ($data as $dt) {
            array_push($row['rekappo'], $dt);
        }
        $result = json_encode($row);
        //echo $result;
        $this->load->view('tb_rekappo_xls', ['data' => $result]);
    }
    */
}
