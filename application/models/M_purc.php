<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_purc extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function laporan_spp($mulai,$hingga,$dept)
	{
		$hanadb = $this->load->database('hana', TRUE);
		if($dept <= 0){
			return $hanadb->query('select 
			A."DocNum" AS "No_SPP",
			C."Dept",
			B."OcrCode2",
			A."DocDate" AS "Tanggal_SPP",
			B."Linenum",
			TO_VARCHAR (TO_DATE(A."DocDate"), '."'DD'".') || '."'.'".' ||
			TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || '."'.'".' ||
			TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl",
			B."ItemCode" as "Kode",
			B."Dscription" as "Nama_Barang",
			B."Quantity" as "Quantity_PR",
			B."unitMsr" AS "Satuan",
			B."TrgetEntry",
			B."FreeTxt" AS "Keterangan"
			FROM "BKI_LIVE"."OPRQ" A
			Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","OcrCode2" from "BKI_LIVE"."PRQ1")B on B."DocEntry" = A."DocEntry"
			Left join(select "Code","Name" as "Dept" from "BKI_LIVE"."OUDP")C on C."Code" = A."Department"
			WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".' AND A."CANCELED" = '."'N'".' order by A."DocDate";')->result_array();
		}else{
			return $hanadb->query('select 
			A."DocNum" AS "No_SPP",
			C."Dept",
			B."OcrCode2",
			A."DocDate" AS "Tanggal_SPP",
			B."Linenum",
			TO_VARCHAR (TO_DATE(A."DocDate"), '."'DD'".') || '."'.'".' ||
			TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || '."'.'".' ||
			TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl",
			B."ItemCode" as "Kode",
			B."Dscription" as "Nama_Barang",
			B."Quantity" as "Quantity_PR",
			B."unitMsr" AS "Satuan",
			B."TrgetEntry",
			B."FreeTxt" AS "Keterangan"
			FROM "BKI_LIVE"."OPRQ" A
			Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","OcrCode2" from "BKI_LIVE"."PRQ1")B on B."DocEntry" = A."DocEntry"
			Left join(select "Code","Name" as "Dept" from "BKI_LIVE"."OUDP")C on C."Code" = A."Department"
			WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".' AND A."Department" = '."'$dept'".' AND A."CANCELED" = '."'N'".' order by A."DocDate";')->result_array();
		}
	}

	public function laporan_spp_detail($mulai,$hingga,$dept)
	{
		$hanadb = $this->load->database('hana', TRUE);
		if($dept <= 0){
			return $hanadb->query('select 
			A."DocNum" AS "No_SPP",
			E."Dept",
			B."OcrCode2",
			C."BaseLine",
			C."LineNum",
			B."ItemCode" as "Kode",
			C."Quantity" as "Quantity_PO",
			(ifnull(B."Quantity",0) - ifnull(C."Quantity",0)) AS "Sisa",
			B."unitMsr" AS "Satuan",
			B."TrgetEntry",
			D."DocNum" as "no_po",
			TO_VARCHAR (TO_DATE(D."DocDate"), '."'DD'".') || '."'.'".' ||
			TO_VARCHAR (left(monthname(TO_DATE(D."DocDate")),3)) || '."'.'".' ||
			TO_VARCHAR (year(TO_DATE(D."DocDate"))) as "tgl_po",
			D."CardName" as "Supplier",
			C."unitMsr" as "Satuan_PO",
			B."FreeTxt" AS "Keterangan"
			FROM "BKI_LIVE"."OPRQ" A
			Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","OcrCode2" from "BKI_LIVE"."PRQ1")B on B."DocEntry" = A."DocEntry"
			Left join(select "BaseRef","BaseLine","LineNum","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "BKI_LIVE"."POR1" where "BaseType" = 1470000113)C on C."BaseRef" = TO_VARCHAR(A."DocNum") and C."ItemCode" = B."ItemCode" and C."BaseLine" = B."Linenum"
			Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "BKI_LIVE"."OPOR")D on D."DocEntry" = C."DocEntry"
			Left join(select "Code","Name" as "Dept" from "BKI_LIVE"."OUDP")E on E."Code" = A."Department"
			WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".' AND A."CANCELED" = '."'N'".' AND D."CANCELED" = '."'N'".' order by A."DocNum";')->result_array();
		}else{
			return $hanadb->query('select 
			A."DocNum" AS "No_SPP",
			E."Dept",
			B."OcrCode2",
			C."BaseLine",
			C."LineNum",
			B."ItemCode" as "Kode",
			C."Quantity" as "Quantity_PO",
			(ifnull(B."Quantity",0) - ifnull(C."Quantity",0)) AS "Sisa",
			B."unitMsr" AS "Satuan",
			B."TrgetEntry",
			D."DocNum" as "no_po",
			TO_VARCHAR (TO_DATE(D."DocDate"), '."'DD'".') || '."'.'".' ||
			TO_VARCHAR (left(monthname(TO_DATE(D."DocDate")),3)) || '."'.'".' ||
			TO_VARCHAR (year(TO_DATE(D."DocDate"))) as "tgl_po",
			D."CardName" as "Supplier",
			C."unitMsr" as "Satuan_PO",
			B."FreeTxt" AS "Keterangan"
			FROM "BKI_LIVE"."OPRQ" A
			Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","OcrCode2" from "BKI_LIVE"."PRQ1")B on B."DocEntry" = A."DocEntry"
			Left join(select "BaseRef","BaseLine","LineNum","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "BKI_LIVE"."POR1" where "BaseType" = 1470000113)C on C."BaseRef" = TO_VARCHAR(A."DocNum") and C."ItemCode" = B."ItemCode" and C."BaseLine" = B."Linenum"
			Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "BKI_LIVE"."OPOR")D on D."DocEntry" = C."DocEntry"
			Left join(select "Code","Name" as "Dept" from "BKI_LIVE"."OUDP")E on E."Code" = A."Department"
			WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".' AND A."Department" = '."'$dept'".' AND A."CANCELED" = '."'N'".' AND D."CANCELED" = '."'N'".' order by A."DocNum";')->result_array();
		}
	}

	public function outstanding_po($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select 
		A."DocNum" as "no_po",
		A."DocDate",
		TO_VARCHAR (TO_DATE(A."DocDate"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || '."'.'".' ||
		TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl",
		A."CardName",
		B."ItemCode",
		B."Dscription",
		B."Quantity" as "Quantity_PO",
		ifnull(C."Quantity_GRPO",0) as "Quantity_GRPO",
		(B."Quantity" - ifnull(C."Quantity_GRPO",0)) as "Sisa",
		B."UomCode",
		B."Currency",
		B."PriceBefDi",
		B."VatPrcnt",
		B."GTotalSC",
		B."FreeTxt"
		from "BKI_LIVE"."OPOR" A
		Left join (select "DocEntry",
						  "LineNum",
						  "ItemCode",
						  "Dscription",
						  "Quantity",
						  "UomCode",
						  "Currency",
						  "PriceBefDi",
						  "VatPrcnt",
						  "GTotalSC",
						  "FreeTxt" 
						  from "BKI_LIVE"."POR1") B on B."DocEntry" = A."DocEntry"
		Left Join(select "BaseDocNum",
						 "ItemCode","Dscription",Sum("Quantity") as "Quantity_GRPO" 
						 from "BKI_LIVE"."PDN1" where "BaseType" = 22 
						 group by "BaseDocNum","ItemCode","Dscription")C on C."ItemCode" = B."ItemCode" and C."BaseDocNum" = A."DocNum" and C."Dscription" = B."Dscription"
		where A."DocDate" between '."'$mulai'".' and '."'$hingga'".';')->result_array();
	}

	public function po_head($nopo)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "DocNum","CardCode","CardName","NumAtCard","DocCur","DocRate",
		TO_VARCHAR (TO_DATE("DocDate"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || '."'.'".' ||
		TO_VARCHAR (year(TO_DATE("DocDate"))) as "Posting_date",
		"TaxDate" as "Document_date"
		from "BKI_LIVE"."OPOR" where "DocNum" = '."'$nopo'".';')->result_array();
	}

	public function po_detail($nopo)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select B."ItemCode",B."Dscription",B."WhsCode","Quantity","UomCode","FreeTxt"
		from "BKI_LIVE"."OPOR" A
		Left Join "BKI_LIVE"."POR1" B on B."DocEntry" = A."DocEntry" 
		where A."DocNum" = '."'$nopo'".';')->result_array();
	}

	public function outs_po_head1($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."DocNum",A."DocDate",A."CardName" as "Supplier",
		TO_VARCHAR (TO_DATE(A."DocDate"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || '."'.'".' ||
		TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl_po",B."Linenum",
		B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."FreeTxt",B."Price",B."LineTotal",B."GTotal",B."Currency"
		from "BKI_LIVE"."OPOR" A
		Left Join(Select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","UomCode","FreeTxt","Price","LineTotal","GTotal","Currency" from "BKI_LIVE"."POR1")B on B."DocEntry" = A."DocEntry" 
		where A."DocDate" between '."'$mulai'".' and '."'$hingga'".' AND A."CANCELED" = '."'N'".' order by A."DocDate" asc;')->result_array();
	}

	public function outs_po_detail($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select 
		A."DocNum" AS "No_PO",
		C."BaseLine",C."LineNum",
		TO_VARCHAR (TO_DATE(D."DocDate"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE(D."DocDate")),3)) || '."'.'".' ||
		TO_VARCHAR (year(TO_DATE(D."DocDate"))) as "tgl_grpo",
		B."ItemCode" as "Kode",
		C."Quantity" as "Quantity_GRPO",
		(ifnull(B."Quantity",0) - ifnull(C."Quantity",0)) AS "Sisa",
		B."unitMsr" AS "Satuan",
		B."TrgetEntry",
		D."DocNum" as "no_grpo",
		D."CardName" as "Supplier",
		C."unitMsr" as "satuan_grpo",
		B."FreeTxt" AS "Keterangan"
		FROM "BKI_LIVE"."OPOR" A
		Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","Price","GTotal" from "BKI_LIVE"."POR1")B on B."DocEntry" = A."DocEntry"
		Left join(select "BaseRef","BaseLine","LineNum","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "BKI_LIVE"."PDN1" where "BaseType" = 22)C on C."BaseRef" = TO_VARCHAR(A."DocNum") and C."ItemCode" = B."ItemCode" and C."BaseLine" = B."Linenum"
		Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "BKI_LIVE"."OPDN")D on D."DocEntry" = C."DocEntry"
		WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".' AND A."CANCELED" = '."'N'".' AND D."CANCELED" = '."'N'".';')->result_array();
	}

	public function outs_grpo_detail($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select 
		A."DocNum" AS "No_SPP",
		D."DocNum" as "No_PO",
        F."DocNum" as "no_grpo",
		TO_VARCHAR (TO_DATE(F."DocDate"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE(F."DocDate")),3)) || '."'.'".' ||
		TO_VARCHAR (year(TO_DATE(F."DocDate"))) as "tgl_grpo",
        E."ItemCode" as "Kode",
        E."BaseLine",
        E."Dscription" as "ItemName",
        E."Quantity" as "Quantity_GRPO"
		FROM "BKI_LIVE"."OPRQ" A
		Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType" from "BKI_LIVE"."PRQ1")B on B."DocEntry" = A."DocEntry"
		Left join(select "BaseRef","BaseLine","LineNum","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "BKI_LIVE"."POR1" where "BaseType" = 1470000113)C on C."BaseRef" = TO_VARCHAR(A."DocNum") and C."ItemCode" = B."ItemCode" and C."BaseLine" = B."Linenum"
		Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "BKI_LIVE"."OPOR")D on D."DocEntry" = C."DocEntry"
		Left join(select "BaseRef","BaseLine","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "BKI_LIVE"."PDN1" where "BaseType" = 22)E on E."BaseRef" = TO_VARCHAR(D."DocNum") and E."ItemCode" = B."ItemCode" and E."BaseLine" = C."LineNum"
		Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "BKI_LIVE"."OPDN")F on F."DocEntry" = E."DocEntry"
		WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".' AND A."CANCELED" = '."'N'".' AND D."CANCELED" = '."'N'".' AND F."CANCELED" = '."'N'".' 
		order by A."DocNum";')->result_array();
	}

	public function grpo_head($nogrpo)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "DocNum","CardCode","CardName","NumAtCard","DocCur","DocRate",
		TO_VARCHAR (TO_DATE("DocDate"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || '."'.'".' ||
		TO_VARCHAR (year(TO_DATE("DocDate"))) as "Posting_date",
		"TaxDate" as "Document_date"
		from "BKI_LIVE"."OPDN" where "DocNum" = '."'$nogrpo'".';')->result_array();
	}

	public function grpo_detail($nogrpo)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select B."ItemCode",B."Dscription",B."WhsCode","Quantity","UomCode","FreeTxt"
		from "BKI_LIVE"."OPDN" A
		Left Join "BKI_LIVE"."PDN1" B on B."DocEntry" = A."DocEntry" where A."DocNum" = '."'$nogrpo'".';')->result_array();
	}

	public function Dept()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "Code","Name" as "Dept" from "BKI_LIVE"."OUDP";')->result_array();
	}

	public function get_penilaian_supp()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select distinct "CardCode","CardName" from "BKI_LIVE"."OPOR" where "CANCELED" = '."'N'".' order by "CardCode";')->result_array();
	}

	public function get_penilaian_po_list()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select distinct "DocNum",TO_VARCHAR (TO_DATE("DocDate"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || '."'.'".' ||
		TO_VARCHAR (year(TO_DATE("DocDate"))) as "Posting_date","DocDate","CardCode","CardName" from "BKI_LIVE"."OPOR" where "CANCELED" = '."'N'".' order by "DocDate";')->result_array();
	}

	public function get_penilaian_po_list_item()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."DocNum",A."DocEntry",B."ItemCode",B."Dscription",B."Quantity",B."UomCode" 
		from "BKI_LIVE"."OPOR" A
		Left join(Select "DocEntry","ItemCode","Dscription","Quantity","UomCode" from "BKI_LIVE"."POR1")B on B."DocEntry" = A."DocEntry" 
		where A."CANCELED" = '."'N'".';')->result_array();
	}

	public function get_nopo($nopo)
	{
		return $this->db->query("SELECT count(rowid) as rowid FROM tb_supp_p_2 where nopo = $nopo;")->result_array();
	}
}