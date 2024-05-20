<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dc extends CI_Model
{
    private $database_name = "BKI_2024";
    public function __construct()
    {
        parent::__construct();
    }

    public function getDocumentData($iddoc)
    {
        $query = $this->db->query('SELECT * FROM signature WHERE rowid = ?', array($iddoc));
        return $query->result_array();
    }

    public function get_filter_dc()
    {
        return $this->db->query('SELECT nama, position1 from tb_user where position1 = "DC";')->result_array();
    }

    public function get_filter_mr()
    {
        return $this->db->query('SELECT nama, position1 from tb_user where position1 = "MR";')->result_array();
    }

    public function get_filter_mo()
    {
        return $this->db->query('SELECT nama, position1 from tb_user where position1 = "MO";')->result_array();
    }

    //LOKASI DOKUMEN

    public function list_dok($divisi)
    {
        return $this->db->query("SELECT * from tb_lokasi_dokumen WHERE divisi = '$divisi';")->result_array();
    }

    public function get_filter_lokasi($divisi)
    {
        return $this->db->query("SELECT lokasi FROM tb_lokasi_dokumen WHERE divisi = ?", array($divisi))->result_array();
    }

    public function get_filter_divisi()
    {
        return $this->db->query('SELECT distinct divisi from tb_lokasi_dokumen;')->result_array();
    }

    //SASARAN MUTU
    public function grafik_sarmut($divisi, $bulan, $tahun)
    {
        return $this->db->query("SELECT bulan,
            COALESCE(SUM(CASE WHEN bulan = 1 THEN nilai ELSE 0 END), 0) AS JAN,
            COALESCE(SUM(CASE WHEN bulan = 2 THEN nilai ELSE 0 END), 0) AS FEB,
            COALESCE(SUM(CASE WHEN bulan = 3 THEN nilai ELSE 0 END), 0) AS MAR,
            COALESCE(SUM(CASE WHEN bulan = 4 THEN nilai ELSE 0 END), 0) AS APR,
            COALESCE(SUM(CASE WHEN bulan = 5 THEN nilai ELSE 0 END), 0) AS MEI,
            COALESCE(SUM(CASE WHEN bulan = 6 THEN nilai ELSE 0 END), 0) AS JUN,
            COALESCE(SUM(CASE WHEN bulan = 7 THEN nilai ELSE 0 END), 0) AS JUL,
            COALESCE(SUM(CASE WHEN bulan = 8 THEN nilai ELSE 0 END), 0) AS AGS,
            COALESCE(SUM(CASE WHEN bulan = 9 THEN nilai ELSE 0 END), 0) AS SEP,
            COALESCE(SUM(CASE WHEN bulan = 10 THEN nilai ELSE 0 END), 0) AS OKT,
            COALESCE(SUM(CASE WHEN bulan = 11 THEN nilai ELSE 0 END), 0) AS NOV,
            COALESCE(SUM(CASE WHEN bulan = 12 THEN nilai ELSE 0 END), 0) AS DESS
        FROM sarmut
        GROUP BY bulan;")->result_array();
    }

    public function cek_sarmut($divisi_modal)
    {
        return $this->db->query("SELECT A.id_sarmut, A.bulan, A.tahun, B.divisi FROM sarmut A
        LEFT JOIN master_sarmut B ON A.id_sarmut = B.id_sarmut
         WHERE B.Divisi = '$divisi_modal';")->result_array();
    }

    public function master_sarmut($divisi, $bulan, $tahun)
    {
        //echo $bulan;
        return $this->db->query("Select * FROM master_sarmut WHERE divisi = '$divisi';")->result_array();
    }

    public function detail_sarmut($divisi, $tahun)
    {
        //echo $tahun;
        return $this->db->query("Select A.rowid, A.id_sarmut, A.nilai, A.bulan, A.tahun, A.analisa_penyebab, A.tindakan, A.rencana_selanjutnya, B.divisi
        FROM sarmut A
        left join master_sarmut B ON A.id_sarmut = B.id_sarmut
        where divisi = '$divisi' AND tahun = '$tahun';")->result_array();
    }

    public function detail_sarmutmodal($divisi_modal)
    {
        //echo $divisi_modal;
        return $this->db->query("Select * FROM master_sarmut WHERE divisi = '$divisi_modal' AND sap = '0';")->result_array();
    }

    public function PUR5($start, $end)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('SELECT CAST((COUNT(B."DocEntry") / COUNT(A."DocEntry")) * 100 AS INTEGER) AS "Persentase_pur5"
        FROM "' . $this->database_name . '"."PRQ1" A
        LEFT JOIN "' . $this->database_name . '"."OPOR" B ON A."DocEntry" = B."DocEntry"
        WHERE B."CANCELED" = ' . "'N'" . ' AND A."TargetType" = ' . "'22'" . ' AND A."DocDate" between ' . "'$start'" . ' and ' . "'$end'" . ';')->row_array();
    }

    public function PUR2($start, $end)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('SELECT
        (COUNT(CASE WHEN subquery."CardCode" IS NOT NULL THEN 1 END) / COUNT(*)) * 100 AS "Persentase_pur2"
    FROM
        (SELECT A."ItemCode", A."Dscription", B."CardCode", B."CardName", B."DocDate", B."Comments" 
         FROM "' . $this->database_name . '".POR1 A
         LEFT JOIN (SELECT "DocEntry", "CardCode", "CardName", "Comments", "DocDate" FROM "' . $this->database_name . '".OPDN) B 
         ON A."TrgetEntry" = B."DocEntry"
         WHERE B."DocDate" BETWEEN ' . "'$start'" . ' AND ' . "'$end'" . ' AND A."ItemCode" LIKE ' . "'BB%'" . ') AS subquery;')->row_array();
    }

    public function PUR3($start, $end)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('SELECT
        (COUNT(CASE WHEN subquery."CardCode" IS NOT NULL THEN 1 END) / COUNT(*)) * 100 AS "Persentase_pur3"
    FROM
        (SELECT A."ItemCode", A."Dscription", B."CardCode", B."CardName", B."DocDate", B."Comments" 
         FROM "' . $this->database_name . '".POR1 A
         LEFT JOIN (SELECT "DocEntry", "CardCode", "CardName", "Comments", "DocDate" FROM "' . $this->database_name . '".OPDN) 
         B ON A."TrgetEntry" = B."DocEntry"
         WHERE B."DocDate" BETWEEN ' . "'$start'" . ' AND ' . "'$end'" . ' AND A."ItemCode" LIKE ' . "'BP%'" . ') AS subquery;')->row_array();
    }

    public function PUR4($start, $end)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('SELECT
        (COUNT(CASE WHEN subquery."CardCode" IS NOT NULL THEN 1 END) / COUNT(*)) * 100 AS "Persentase_pur4"
    FROM
        (SELECT A."ItemCode", A."Dscription", B."CardCode", B."CardName", B."DocDate", B."Comments" 
        FROM "' . $this->database_name . '".PRQ1 A
        LEFT JOIN (SELECT "DocEntry", "CardCode", "CardName", "Comments", "DocDate", "CANCELED" FROM "' . $this->database_name . '".OPDN)
        B ON A."TrgetEntry" = B."DocEntry"
        WHERE B."DocDate" BETWEEN ' . "'$start'" . ' AND ' . "'$end'" . ') AS subquery;')->row_array();
    }

    public function master_data_sarmut($divisi)
    {
        return $this->db->query("SELECT *  from master_sarmut WHERE divisi = '$divisi';")->result_array();
    }
}
