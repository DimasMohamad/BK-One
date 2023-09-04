<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_marketing extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data(){
        return $this->db->query("Select * FROM recall;")->result_array();
    }

    public function Recall($id)
	{
		return $this->db->query("SELECT * FROM recall WHERE rowid = $id;")->row_array();
    }

    public function pelanggan($mulai, $hingga){
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct A."CardCode", A."DocDate", B."U_Joindate", B."CardName", A."Address", B."Phone1", B."CntctPrsn"
        from "BKI_LIVE"."ORDR" A
       	left join "BKI_LIVE"."OCRD" B ON A."CardCode" = B."CardCode"
        WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".' AND B."CardCode" IS NOT NULL AND B."frozenFor" = '."'N'".' and B."CardType" = '."'C'".' ORDER BY B."CardName";')->result_array();
    }

    public function pelanggan2(){
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct A."CardCode", B."CardName", A."Address", B."Phone1", B."CntctPrsn"
        from "BKI_LIVE"."ORDR" A
       	left join "BKI_LIVE"."OCRD" B ON A."CardCode" = B."CardCode"
        WHERE B."CardCode" IS NOT NULL AND B."frozenFor" = '."'N'".' and B."CardType" = '."'C'".' ORDER BY B."CardName";')->result_array();
    }
    
    public function get_alamat_from_nama($nama){
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct A."CardCode", B."CardName", A."Address", B."Phone1", B."CntctPrsn"
        from "BKI_LIVE"."ORDR" A
       	left join "BKI_LIVE"."OCRD" B ON A."CardCode" = B."CardCode"
        WHERE B."CardName" ='."'$nama'".' and B."CardCode" IS NOT NULL AND B."frozenFor" = '."'N'".' and B."CardType" = '."'C'".' ORDER BY B."CardName";')->result_array();
    }

    Public function print_daftar_pelanggan(){
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct A."CardCode", A."U_Joindate", A."CardName", A."Address", A."Phone1", A."CntctPrsn"
        from "BKI_LIVE"."OCRD" A 
        WHERE A."CardCode" IS NOT NULL AND A."frozenFor" = '."'N'".' and A."CardType" = '."'C'".' ORDER BY A."CardName";')->result_array();
    }

    Public function klaim($mulai, $hingga){
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('Select A."DocNum", A."DocDate" 
        from "BKI_LIVE"."ORDN" A
        where A."DocDate" between '."'$mulai'".' and '."'$hingga'".';')->result_array();
    }

    Public function survey($t, $s){
        return $this->db->query("Select * From survey where tahun = $t and semester = $s;")->result_array();
    }

    public function get_filter_tahun()
	{
		return $this->db->query('SELECT distinct tahun from survey;')->result_array();
	}

    public function print_survey($s, $t){
        return $this->db->query('Select
        nama,
        alamat,
        semester,
        tahun,
        asal,
        p1,
        p2,
        p3,
        p4,
        p5,
        k1,
        k2,
        k3,
        k4,
        k5,
        r1,
        r2,
        r3,
        r4,
        r5,
        masukan
        from survey where semester = '."'$s'".' and tahun = '."'$t'".';')->result_array();
    }

    public function print_perhitungan($s, $t){
        return $this->db->query('Select
        AVG(p1) AS rata_p1,
        AVG(p2) AS rata_p2,
        AVG(p3) AS rata_p3,
        AVG(p4) AS rata_p4,
        AVG(p5) AS rata_p5,
        AVG(k1) AS rata_k1,
        AVG(k2) AS rata_k2,
        AVG(k3) AS rata_k3,
        AVG(k4) AS rata_k4,
        AVG(k5) AS rata_k5,
        AVG(r1) AS rata_r1,
        AVG(r2) AS rata_r2,
        AVG(r3) AS rata_r3,
        AVG(r4) AS rata_r4,
        AVG(r5) AS rata_r5,
        (AVG(p1)+AVG(p2)+AVG(p3)+AVG(p4)+AVG(p5))/5 as rata_dimensiP,
        (AVG(k1)+AVG(k2)+AVG(k3)+AVG(k4)+AVG(k5))/5 as rata_dimensiK,
        (AVG(r1)+AVG(r2)+AVG(r3)+AVG(r4)+AVG(r5))/5 as rata_dimensiR
        from survey where semester = '."'$s'".' and tahun = '."'$t'".';')->result_array();
    }

    public function tampil_nota(){
        return $this->db->query('SELECT * FROM nota_manual;')->result_array();
    }
}