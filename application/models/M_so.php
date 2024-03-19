<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_so extends CI_Model
{
    private $database_name = "BKI_2024";
    public function __construct()
    {
        parent::__construct();
    }

    public function so_head($mulai, $hingga)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('SELECT 
        "t0"."DocNum" AS "No_SO",
        "t0"."NumAtCard" AS "Reff_No_PO",
        "t0"."U_IDU_TglPO" AS "Tanggal_PO",
        "t0"."U_BKI_TglTerimaPO" AS "Tanggal_Terima_PO",
        TO_VARCHAR (TO_DATE("t0"."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE("t0"."DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (right(year(TO_DATE("t0"."DocDate")),2)) AS "Tanggal_SO",
        "t0"."CardName" AS "Nama_Customer",
        "t1"."ItemCode" AS "Kode",
        "t1"."LineNum",
        "t1"."Dscription" AS "Nama_Barang",
        "t1"."Quantity" AS "QTY_SO",
        "t1"."OpenQty" AS "Sisa",
        "t1"."UomCode" AS "Satuan",
        "t1"."PriceBefDi" AS "Harga_Satuan",	
        "t1"."VatSum" AS "PPN",
        "t1"."GTotal" AS "Total",
        "t1"."FreeTxt" AS "Keterangan",
        "t1"."PriceBefDi" AS "Harga_sebelum_diskon",
        "t1"."Price" AS "DPP",
        ("t1"."Quantity"- COALESCE((SELECT SUM ("Quantity") FROM "' . $this->database_name . '".DLN1 WHERE "BaseEntry"  = "t1"."DocEntry" AND "BaseLine"  = "t1"."LineNum" AND "BaseType"  = "t1"."ObjType" ),0)) AS "Sisa_SO",
        SUBSTR_BEFORE("t1"."U_IDU_DiscDesc2",' . "'+'" . ') AS "Diskon_1",
        CASE WHEN LENGTH("t1"."U_IDU_DiscDesc") > 19 
        THEN 
        SUBSTR_BEFORE((SUBSTR_AFTER("t1"."U_IDU_DiscDesc2",' . "'+'" . ')),' . "'+'" . ')
        ELSE 
        SUBSTR_AFTER("t1"."U_IDU_DiscDesc2",' . "'+'" . ') 
        END AS "Diskon_2",
        SUBSTR_AFTER(SUBSTR_AFTER("t1"."U_IDU_DiscDesc2",' . "'+'" . '),' . "'+'" . ') AS "Diskon_3"
      FROM "' . $this->database_name . '"."ORDR" AS "t0" 
      Left JOIN "' . $this->database_name . '"."RDR1" AS "t1" ON "t0"."DocEntry"  = "t1"."DocEntry"
      WHERE "t0"."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND "t0"."CANCELED" = ' . "'N'" . ' order by "t0"."DocDate";')->result_array();
    }

    public function sj_item($mulai, $hingga)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('SELECT 
        "t0"."DocNum" AS "No_SO",
        "t1"."ItemCode" AS "Kode",
        "t2"."BaseLine",
        TO_VARCHAR (TO_DATE("t3"."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE("t3"."DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (right(year(TO_DATE("t3"."DocDate")),2)) AS "TGL_Kirim",
        "t3"."DocNum" AS "No_SJ",
        "t2"."Quantity" AS "Jumlah_Kirim"
    FROM "' . $this->database_name . '"."ORDR" AS "t0" 
    Left JOIN "' . $this->database_name . '"."RDR1" AS "t1" ON "t0"."DocEntry"  = "t1"."DocEntry"
    Left JOIN "' . $this->database_name . '"."DLN1" AS "t2" ON "t2"."BaseEntry"  = "t1"."DocEntry" AND "t2"."BaseLine"  = "t1"."LineNum" AND "t2"."BaseType"  = "t1"."ObjType"
    Left JOIN(SELECT "DocEntry","DocDate","DocNum","CANCELED" FROM "' . $this->database_name . '"."ODLN")"t3" on "t2"."DocEntry" = "t3"."DocEntry"
    WHERE "t0"."DocDate" >= ' . "'$mulai'" . ' AND "t0"."DocDate" <= ' . "'$hingga'" . ' AND "t0"."CANCELED" = ' . "'N'" . ' AND "t3"."CANCELED" = ' . "'N'" . ';')->result_array();
    }

    public function trace_sj_head($id)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select "DocNum","DocEntry",
        TO_VARCHAR (TO_DATE("DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (right(year(TO_DATE("DocDate")),2)) as "DocDate",
        "CardCode","CardName","NumAtCard" from "' . $this->database_name . '"."ODLN" where "DocNum" = ' . $id . ';')->result_array();
    }

    public function trace_sj_detail($id)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."FreeTxt" 
        from "' . $this->database_name . '"."ODLN" A
        Left Join "' . $this->database_name . '"."DLN1" B on B."DocEntry" = A."DocEntry"
        where A."DocNum" = ' . "'$id'" . ';')->result_array();
    }

    public function lhkb_head($mulai, $hingga)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select A."DocNum" as "nosj",A."DocEntry",
        TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (right(year(TO_DATE(A."DocDate")),2)) as "DocDate",A."CardCode",A."CardName" as "Customer",
        B."DocEntry",B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."FreeTxt"
        from "' . $this->database_name . '"."ODLN" A 
        Left Join "' . $this->database_name . '"."DLN1" B on B."DocEntry" = A."DocEntry"
        where A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' and A."CANCELED" = ' . "'N'" . ' order by A."DocDate";')->result_array();
    }

    public function lhmb($mulai, $hingga)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select A."DocNum" as "nosj",A."DocEntry",
        TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (right(year(TO_DATE(A."DocDate")),2)) as "DocDate",A."CardCode",A."CardName" as "Customer",
        B."DocEntry",B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."FreeTxt"
        from "' . $this->database_name . '"."OWTR" A 
        Left Join "' . $this->database_name . '"."WTR1" B on B."DocEntry" = A."DocEntry"
        where A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' and B."WhsCode" = ' . "'LA.SHR.P'" . ' and A."CANCELED" = ' . "'N'" . ' order by A."DocDate";')->result_array();
    }

    public function hitung_so($mulai, $hingga, $cari)
    {
        $hanadb = $this->load->database('hana', TRUE);
        $query = $hanadb->query('select count("DocEntry") as "row" 
		from "' . $this->database_name . '"."ORDR" where "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' and "CardName" like ' . "'%$cari%'" . ';')->row_array();
        return $query['row'];
    }

    public function get_so($no_page, $mulai, $hingga, $cari)
    {
        $hanadb = $this->load->database('hana', TRUE);
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if ($no_page == 1) {
            $first = 1;
            $last  = $perpage;
        } else {
            $first = ($no_page - 1) * $perpage + 1;
            $last  = $first + ($perpage - 1);
        }
        return $hanadb->query('select * from (
		select row_number() over (order by "DocDate") as "nmr",
		TO_VARCHAR (TO_DATE("DocDate"), ' . "'DD'" . ') || ' . "'-'" . ' ||
        TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || ' . "'-'" . ' ||
        TO_VARCHAR (year(TO_DATE("DocDate"))) as "tgl",
		"DocEntry",
		"DocNum",
		"DocDate",
		"NumAtCard",
		"DocStatus",
		"CardName",
		"DocCur",
		"DocTotal"
		from "' . $this->database_name . '"."ORDR" where "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' and "CardName" like ' . "'%$cari%'" . '
	    ) as "tb_so" where "nmr" between ' . $first . ' and ' . $last . ';')->result_array();
    }

    public function detail_so($no_page, $mulai, $hingga, $cari)
    {
        $hanadb = $this->load->database('hana', TRUE);
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if ($no_page == 1) {
            $first = 1;
            $last  = $perpage;
        } else {
            $first = ($no_page - 1) * $perpage + 1;
            $last  = $first + ($perpage - 1);
        }
        return $hanadb->query('select "tb_so"."nmr","tb_so"."DocEntry","tb_so"."DocNum","tb_so"."DocCur",
		B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."Currency",B."Price",B."GTotal"
		from (
				select 
				row_number() over (order by "DocDate") as "nmr",
				"DocEntry",
				"DocNum",
				"DocCur",
				"DocTotal"
				from "' . $this->database_name . '"."ORDR" where "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' and "CardName" like ' . "'%$cari%'" . '
		) as "tb_so"
		Left join(select "DocEntry","ItemCode","Dscription","Quantity","UomCode","Currency","Price","GTotal" from "' . $this->database_name . '"."RDR1")B on B."DocEntry" = "tb_so"."DocEntry"
		where "tb_so"."nmr" between ' . $first . ' and ' . $last . ';')->result_array();
    }

    public function total_so($mulai, $hingga, $cari)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select sum("DocTotal") as "total_so" 
		from "' . $this->database_name . '"."ORDR" where "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' and "CardName" like ' . "'%$cari%'" . ';')->row_array();
    }
}
