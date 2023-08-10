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

    Public function print_daftar_pelanggan(){
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct A."CardCode", A."U_Joindate", A."CardName", A."Address", A."Phone1", A."CntctPrsn"
        from "BKI_LIVE"."OCRD" A 
        WHERE A."CardCode" IS NOT NULL AND A."frozenFor" = '."'N'".' and A."CardType" = '."'C'".' ORDER BY A."CardName";')->result_array();
    }

    //Print berdasarkan cardcode
    public function print_daftar_pelanggan2($CardCode){
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct A."CardCode", A."U_Joindate", A."CardName", A."Address", A."Phone1", A."CntctPrsn"
        from "BKI_LIVE"."OCRD" A 
        WHERE A."CardCode" IS NOT NULL AND A."frozenFor" = '."'N'".' and A."CardType" = '."'C'".' and A."CardCode" = '."'$CardCode'".' ORDER BY A."CardName";')->result_array();
    }
}