<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_dc extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
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
        return $hanadb->query('SELECT CAST((COUNT(B."DocEntry") / COUNT(A."DocEntry")) * 100 AS INTEGER) AS "Persentase"
        FROM "BKI_LIVE"."PRQ1" A
        LEFT JOIN "BKI_LIVE"."OPOR" B ON A."DocEntry" = B."DocEntry"
        WHERE B."CANCELED" = ' . "'N'" . ' AND A."TargetType" = ' . "'22'" . ' AND A."DocDate" between ' . "'$start'" . ' and ' . "'$end'" . ';')->result_array();
    }

    public function PUR2($start, $end)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('')->result_array();
    }

    public function PUR3($start, $end)
    {
    }

    public function PUR4($start, $end)
    {
    }
}
