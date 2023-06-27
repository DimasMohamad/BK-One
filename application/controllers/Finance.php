<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Finance extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            if (isset($this->session->id_user) == false) {
            redirect(base_url('Welcome'));
        }
        
        $this->load->model('M_sql');
        $this->load->model('M_user');
        $this->load->model('M_finance');
        $this->load->helper(array('url'));
        $this->load->library('pagination');
    }

    public function inv_cost()
    {
        $akses = $this->M_user->get_akses(6);
        $this->load->view('header');
        if(!$akses['akses'] == 0){
            $this->load->view('inv_cost');
        }else{
            $this->load->view('denied');
        }
        $this->load->view('footer');
    }

    public function tb_inv_costing()
    {
        $bln = substr($this->input->get('periode'),0,2);
        $tahun = substr($this->input->get('periode'),3);
        $periode = $tahun."-".$bln."-01";
        
        $dataaudithead = $this->M_sql->rekap_item_audit_head($periode);
        $dataaudit = $this->M_sql->rekap_item_audit($periode);
        $row['head'] = [];
        $row['item'] = [];
        foreach($dataaudithead as $h){
            array_push($row['head'],$h);
        }
        foreach($dataaudit as $dt){
            array_push($row['item'],$dt);
        }
        $data = json_encode($row);
        //echo $data;
        $this->load->view('tb_inv_costing',['data'=>$data]);
    }

    public function tb_inv_costing_xls()
    {
        $bln = substr($this->input->get('periode'),0,2);
        $tahun = substr($this->input->get('periode'),3);
        $periode = $tahun."-".$bln."-01";
        
        $dataaudithead = $this->M_sql->rekap_item_audit_head($periode);
        $dataaudit = $this->M_sql->rekap_item_audit($periode);
        $row['head'] = [];
        $row['item'] = [];
        foreach($dataaudithead as $h){
            array_push($row['head'],$h);
        }
        foreach($dataaudit as $dt){
            array_push($row['item'],$dt);
        }
        $data = json_encode($row);
        $this->load->view('tb_inv_costing_xls',['data'=>$data]);
    }

    
    public function trace_item()
    {
        $mulai = $this->input->get('mulai');
        $hingga = $this->input->get('hingga'); 
        $itemcode = $this->input->get('item');
        $hanadb = $this->load->database('hana', TRUE);
        $datawhse = $this->M_sql->trace_item_whse($itemcode);
        $datatrace = $this->M_sql->trace_item_audit($itemcode);
        echo"<table class='table table-sm table-bordered' style='font-size:13px;'>";
        echo"<thead>";
        echo"<tr>";
        echo"<th width='100px'>Item Code</th>";
        echo"<th colspan='4'>".$itemcode."</th>";
        echo"</tr>";
        echo"</thead>";
        echo"<tbody>";
        foreach ($datawhse as $w) {
            echo"<tr>";
            echo"<td colspan='5'><b>".$w['Warehouse']."</b></td>";
            echo"</tr>";
            echo"<td colspan='2'>";
            echo"<table class='table table-sm' style='font-size:13px;'>";
            foreach ($datatrace as $d) {
                if($d['Warehouse']==$w['Warehouse']){
                    echo"<tr>";
                    echo "<td width='100px'>".$d['tgl']."</td>";
                    echo "<td width='500px'>".$d['Comments']."</td>";
                    echo "<td width='150px'>".$d['Transdescription']." / ".$d['BASE_REF']."</td>";
                    echo "<td width='150px' style='text-align:right;' onclick='konversi(\"".$itemcode."\",".$d['stok'].")'>".number_format($d['stok'], 4, '.', ',')."</td>";
                    echo "<td width='150px' style='text-align:right;'>".number_format($d['Total'], 4, '.', ',')."</td>";
                    echo"</tr>";
                }
            }
            echo"</table>";
            echo"</td>";
        }
        echo"</tbody>";
        echo"</table>";
    }
}