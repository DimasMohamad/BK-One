<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        
        $this->load->model('M_sql');
        $this->load->model('M_user');
        $this->load->model('M_produksi');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
    }

    public function fg()
    {
        $akses = $this->M_user->get_akses(7);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
                $this->load->view('fg');
            }else{
                $this->load->view('denied');
            }
        $this->load->view('footer');
    }

    public function tb_bj()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $databj = $this->M_produksi->laporan_produksi($mulai,$hingga);
        echo"<table id='tabel-data' class='table table-sm table-hover' style='font-size:12px;'>";
        echo"<thead>";
        echo"<th>#</th>";
        echo"<th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
        echo"<th>Doc Num</th>";
        echo"<th>Item Code</th>";
        echo"<th>Item Name</th>";
        echo"<th>Remark</th>";
        echo"<th>Whse</th>";
        echo"<th>Qty</th>";
        echo"<th>Uom</th>";
        echo"</thead>";
        echo"<tbody>";
        $i = 1;
        foreach($databj as $dt){
            echo"<tr>";
            echo"<td>".$i."</td>";
            echo"<td>".$dt['tgl']."</td>";
            echo"<td>".$dt['DocNum']."</td>";
            echo"<td>".$dt['ItemCode']."</td>";
            echo"<td>".$dt['Dscription']."</td>";
            echo"<td>".$dt['Comments']."</td>";
            echo"<td>".$dt['WhsCode']."</td>";
            echo"<td style='text-align:right;'>".number_format($dt['Quantity'], 4, '.', ',')."</td>";
            echo"<td>".$dt['UomCode']."</td>";
            echo"</tr>";
            $i++;
        }
        echo"</tbody>";
        echo"</table>";
        echo"<script>$('#tabel-data').DataTable({scrollX: true,});</script>";
    }

    public function tb_bj_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $databj = $this->M_produksi->laporan_produksi($mulai,$hingga);
        include('export_laporan_bj.php');
        echo"<table width='100%' border='1' rules='all'>";
        echo"<thead>";
        echo"<th>#</th>";
        echo"<th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
        echo"<th>Doc Num</th>";
        echo"<th>Item Code</th>";
        echo"<th>Item Name</th>";
        echo"<th>Remark</th>";
        echo"<th>Whse</th>";
        echo"<th>Qty</th>";
        echo"<th>Uom</th>";
        echo"</thead>";
        echo"<tbody>";
        $i = 1;
        foreach($databj as $dt){
            echo"<tr>";
            echo"<td>".$i."</td>";
            echo"<td>".$dt['tgl']."</td>";
            echo"<td>".$dt['DocNum']."</td>";
            echo"<td>".$dt['ItemCode']."</td>";
            echo"<td>".$dt['Dscription']."</td>";
            echo"<td>".$dt['Comments']."</td>";
            echo"<td>".$dt['WhsCode']."</td>";
            echo"<td style='text-align:right;'>".number_format($dt['Quantity'], 4, '.', ',')."</td>";
            echo"<td>".$dt['UomCode']."</td>";
            echo"</tr>";
            $i++;
        }
        echo"</tbody>";
        echo"</table>";
        echo"<script>$('#tabel-data').DataTable({scrollX: true,});</script>";
    }

    public function get_date()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $tgl = $this->M_produksi->get_date($mulai,$hingga);
        $data = json_encode($tgl);
        echo $data;
    }

    public function outstanding_order()
    {
        $akses = $this->M_user->get_akses(7);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
                $this->load->view('outstanding_order');
            }else{
                $this->load->view('denied');
            }
        $this->load->view('footer');
    }

    public function tb_outstanding_order()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $this->db->query("SET lc_time_names = 'id_ID'");
		$periode = new DatePeriod(
			new DateTime($mulai),
			new DateInterval('P1D'),
			new DateTime(date('Y-m-d', strtotime('+1 day', strtotime($hingga))))
		);
		$list_tanggal = [];
		foreach ($periode as $key => $value) {
			array_push($list_tanggal, $value->format('Y-m-d'));
		}
        $list_item = $this->M_produksi->get_item($mulai,$hingga);
        
        $item = [];
        foreach ($list_item as $it) {
            $data = [];
            $data['ItemCode'] = $it['ItemCode'];
            foreach ($list_tanggal as $tgl) {
                $str = $it['ItemCode'];
                $row = explode("|", $str);
                $row = $this->M_produksi->get_item_date($row['0'],$tgl);
                if (count($row) > 0) {
					$data[$tgl] = $row[0]['Quantity'];
				} else {
					$data[$tgl] = '0|0|0|0';
				}
            }
            array_push($item, $data);
        };
        $data = json_encode($item);
        //echo $data;
        $this->load->view('tb_outstanding_order',['item' => $item]);
    }

    public function tb_outstanding_order_xls()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $this->db->query("SET lc_time_names = 'id_ID'");
		$periode = new DatePeriod(
			new DateTime($mulai),
			new DateInterval('P1D'),
			new DateTime(date('Y-m-d', strtotime('+1 day', strtotime($hingga))))
		);
		$list_tanggal = [];
		foreach ($periode as $key => $value) {
			array_push($list_tanggal, $value->format('Y-m-d'));
		}
        $list_item = $this->M_produksi->get_item($mulai,$hingga);
        
        $item = [];
        foreach ($list_item as $it) {
            $data = [];
            $data['ItemCode'] = $it['ItemCode'];
            foreach ($list_tanggal as $tgl) {
                $str = $it['ItemCode'];
                $row = explode("|", $str);
                $row = $this->M_produksi->get_item_date($row['0'],$tgl);
                if (count($row) > 0) {
					$data[$tgl] = $row[0]['Quantity'];
				} else {
					$data[$tgl] = '0|0|0|0';
				}
            }
            array_push($item, $data);
        };
        $data = json_encode($item);
        $this->load->view('tb_outstanding_order_xls',['item' => $item]);
    }

    public function tb_outstanding_order_page()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga');
        $this->db->query("SET lc_time_names = 'id_ID'");
		$periode = new DatePeriod(
			new DateTime($mulai),
			new DateInterval('P1D'),
			new DateTime(date('Y-m-d', strtotime('+1 day', strtotime($hingga))))
		);
		$list_tanggal = [];
		foreach ($periode as $key => $value) {
			array_push($list_tanggal, $value->format('Y-m-d'));
		}
        $list_item = $this->M_produksi->get_item($mulai,$hingga);
        
        $item = [];
        foreach ($list_item as $it) {
            $data = [];
            $data['ItemCode'] = $it['ItemCode'];
            foreach ($list_tanggal as $tgl) {
                $str = $it['ItemCode'];
                $row = explode("|", $str);
                $row = $this->M_produksi->get_item_date($row['0'],$tgl);
                if (count($row) > 0) {
					$data[$tgl] = $row[0]['Quantity'];
				} else {
					$data[$tgl] = '0|0|0|0';
				}
            }
            array_push($item, $data);
        };
        //echo json_encode($item);
        $this->load->view('tb_outstanding_order_page',['item' => $item]);
    }

    public function trace_bj()
    {
        $item = $this->input->get('item');
        $tgl = $this->input->get('tgl');
        $row = $this->M_produksi->trace_bj($item,$tgl);
        $data = json_encode($row);
        echo $data;
    }
}