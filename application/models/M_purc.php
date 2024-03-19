<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_purc extends CI_Model
{
	private $database_name = "BKI_2024";
	public function __construct()
	{
		parent::__construct();
	}

	public function laporan_spp($mulai, $hingga, $dept)
	{
		$hanadb = $this->load->database('hana', TRUE);
		if ($dept <= 0) {
			return $hanadb->query('select 
			A."DocNum" AS "No_SPP",
			C."Dept",
			B."OcrCode2",
			A."DocDate" AS "Tanggal_SPP",
			B."Linenum",
			TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
			TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
			TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl",
			B."ItemCode" as "Kode",
			B."Dscription" as "Nama_Barang",
			E."ItmsGrpNam",
			B."Quantity" as "Quantity_PR",
			B."unitMsr" AS "Satuan",
			B."TrgetEntry",
			B."FreeTxt" AS "Keterangan",
			A."Comments" AS "Remarks"
			FROM "' . $this->database_name . '"."OPRQ" A
			Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","OcrCode2" from "' . $this->database_name . '"."PRQ1")B on B."DocEntry" = A."DocEntry"
			Left join(select "Code","Name" as "Dept" from "' . $this->database_name . '"."OUDP")C on C."Code" = A."Department"
			left join(select "ItmsGrpCod", "ItemCode" from "' . $this->database_name . '"."OITM")D on D."ItemCode" = B."ItemCode"
			left join(select "ItmsGrpNam", "ItmsGrpCod" from "' . $this->database_name . '"."OITB")E on E."ItmsGrpCod" = D."ItmsGrpCod"
			WHERE A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND A."CANCELED" = ' . "'N'" . ' order by A."DocDate";')->result_array();
		} else {
			return $hanadb->query('select 
			A."DocNum" AS "No_SPP",
			C."Dept",
			B."OcrCode2",
			A."DocDate" AS "Tanggal_SPP",
			B."Linenum",
			TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
			TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
			TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl",
			B."ItemCode" as "Kode",
			B."Dscription" as "Nama_Barang",
			E."ItmsGrpNam",
			B."Quantity" as "Quantity_PR",
			B."unitMsr" AS "Satuan",
			B."TrgetEntry",
			B."FreeTxt" AS "Keterangan",
			A."Comments" AS "Remarks"
			FROM "' . $this->database_name . '"."OPRQ" A
			Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","OcrCode2" from "' . $this->database_name . '"."PRQ1")B on B."DocEntry" = A."DocEntry"
			Left join(select "Code","Name" as "Dept" from "' . $this->database_name . '"."OUDP")C on C."Code" = A."Department"
			left join(select "ItmsGrpCod", "ItemCode" from "' . $this->database_name . '"."OITM")D on D."ItemCode" = B."ItemCode"
			left join(select "ItmsGrpNam", "ItmsGrpCod" from "' . $this->database_name . '"."OITB")E on E."ItmsGrpCod" = D."ItmsGrpCod"
			WHERE A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND A."Department" = ' . "'$dept'" . ' AND A."CANCELED" = ' . "'N'" . ' order by A."DocDate";')->result_array();
		}
	}

	public function laporan_spp_detail($mulai, $hingga, $dept)
	{
		$hanadb = $this->load->database('hana', TRUE);
		if ($dept <= 0) {
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
			TO_VARCHAR (TO_DATE(D."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
			TO_VARCHAR (left(monthname(TO_DATE(D."DocDate")),3)) || ' . "'.'" . ' ||
			TO_VARCHAR (year(TO_DATE(D."DocDate"))) as "tgl_po",
			D."CardName" as "Supplier",
			C."unitMsr" as "Satuan_PO",
			B."FreeTxt" AS "Keterangan",
			A."Comments" AS "Remarks"
			FROM "' . $this->database_name . '"."OPRQ" A
			Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","OcrCode2" from "' . $this->database_name . '"."PRQ1")B on B."DocEntry" = A."DocEntry"
			Left join(select "BaseRef","BaseLine","LineNum","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "' . $this->database_name . '"."POR1" where "BaseType" = 1470000113)C on C."BaseRef" = TO_VARCHAR(A."DocNum") and C."ItemCode" = B."ItemCode" and C."BaseLine" = B."Linenum"
			Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "' . $this->database_name . '"."OPOR")D on D."DocEntry" = C."DocEntry"
			Left join(select "Code","Name" as "Dept" from "' . $this->database_name . '"."OUDP")E on E."Code" = A."Department"
			WHERE A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND A."CANCELED" = ' . "'N'" . ' AND D."CANCELED" = ' . "'N'" . ' order by A."DocNum";')->result_array();
		} else {
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
			TO_VARCHAR (TO_DATE(D."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
			TO_VARCHAR (left(monthname(TO_DATE(D."DocDate")),3)) || ' . "'.'" . ' ||
			TO_VARCHAR (year(TO_DATE(D."DocDate"))) as "tgl_po",
			D."CardName" as "Supplier",
			C."unitMsr" as "Satuan_PO",
			B."FreeTxt" AS "Keterangan",
			A."Comments" AS "Remarks"
			FROM "' . $this->database_name . '"."OPRQ" A
			Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","OcrCode2" from "' . $this->database_name . '"."PRQ1")B on B."DocEntry" = A."DocEntry"
			Left join(select "BaseRef","BaseLine","LineNum","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "' . $this->database_name . '"."POR1" where "BaseType" = 1470000113)C on C."BaseRef" = TO_VARCHAR(A."DocNum") and C."ItemCode" = B."ItemCode" and C."BaseLine" = B."Linenum"
			Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "' . $this->database_name . '"."OPOR")D on D."DocEntry" = C."DocEntry"
			Left join(select "Code","Name" as "Dept" from "' . $this->database_name . '"."OUDP")E on E."Code" = A."Department"
			WHERE A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND A."Department" = ' . "'$dept'" . ' AND A."CANCELED" = ' . "'N'" . ' AND D."CANCELED" = ' . "'N'" . ' order by A."DocNum";')->result_array();
		}
	}

	public function outstanding_po($mulai, $hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select 
		A."DocNum" as "no_po",
		A."DocDate",
		TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
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
		from "' . $this->database_name . '"."OPOR" A
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
						  from "' . $this->database_name . '"."POR1") B on B."DocEntry" = A."DocEntry"
		Left Join(select "BaseDocNum",
						 "ItemCode","Dscription",Sum("Quantity") as "Quantity_GRPO" 
						 from "' . $this->database_name . '"."PDN1" where "BaseType" = 22 
						 group by "BaseDocNum","ItemCode","Dscription")C on C."ItemCode" = B."ItemCode" and C."BaseDocNum" = A."DocNum" and C."Dscription" = B."Dscription"
		where A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ';')->result_array();
	}

	public function po_head($nopo)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "DocNum","CardCode","CardName","NumAtCard","DocCur","DocRate",
		TO_VARCHAR (TO_DATE("DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (year(TO_DATE("DocDate"))) as "Posting_date",
		"TaxDate" as "Document_date"
		from "' . $this->database_name . '"."OPOR" where "DocNum" = ' . "'$nopo'" . ';')->result_array();
	}

	public function po_detail($nopo)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select B."ItemCode",B."Dscription",B."WhsCode","Quantity","UomCode","FreeTxt"
		from "' . $this->database_name . '"."OPOR" A
		Left Join "' . $this->database_name . '"."POR1" B on B."DocEntry" = A."DocEntry" 
		where A."DocNum" = ' . "'$nopo'" . ';')->result_array();
	}

	public function outs_po_head1($mulai, $hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."DocNum",A."DocDate",A."CardName" as "Supplier",
		TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl_po",B."Linenum",
		B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."FreeTxt",B."Price",B."LineTotal",B."GTotal",B."Currency"
		from "' . $this->database_name . '"."OPOR" A
		Left Join(Select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","UomCode","FreeTxt","Price","LineTotal","GTotal","Currency" from "' . $this->database_name . '"."POR1")B on B."DocEntry" = A."DocEntry" 
		where A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND A."CANCELED" = ' . "'N'" . ' order by A."DocDate" asc;')->result_array();
	}

	public function outs_po_detail($mulai, $hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select 
		A."DocNum" AS "No_PO",
		C."BaseLine",C."LineNum",
		TO_VARCHAR (TO_DATE(D."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE(D."DocDate")),3)) || ' . "'.'" . ' ||
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
		FROM "' . $this->database_name . '"."OPOR" A
		Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType","Price","GTotal" from "' . $this->database_name . '"."POR1")B on B."DocEntry" = A."DocEntry"
		Left join(select "BaseRef","BaseLine","LineNum","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "' . $this->database_name . '"."PDN1" where "BaseType" = 22)C on C."BaseRef" = TO_VARCHAR(A."DocNum") and C."ItemCode" = B."ItemCode" and C."BaseLine" = B."Linenum"
		Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "' . $this->database_name . '"."OPDN")D on D."DocEntry" = C."DocEntry"
		WHERE A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND A."CANCELED" = ' . "'N'" . ' AND D."CANCELED" = ' . "'N'" . ';')->result_array();
	}

	public function outs_grpo_detail($mulai, $hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select 
		A."DocNum" AS "No_SPP",
		D."DocNum" as "No_PO",
        F."DocNum" as "no_grpo",
		TO_VARCHAR (TO_DATE(F."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE(F."DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (year(TO_DATE(F."DocDate"))) as "tgl_grpo",
        E."ItemCode" as "Kode",
        E."BaseLine",
        E."Dscription" as "ItemName",
        E."Quantity" as "Quantity_GRPO"
		FROM "' . $this->database_name . '"."OPRQ" A
		Left join(select "DocEntry","LineNum" as "Linenum","ItemCode","Dscription","Quantity","OpenQty","unitMsr","FreeTxt","TrgetEntry","LineNum","ObjType" from "' . $this->database_name . '"."PRQ1")B on B."DocEntry" = A."DocEntry"
		Left join(select "BaseRef","BaseLine","LineNum","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "' . $this->database_name . '"."POR1" where "BaseType" = 1470000113)C on C."BaseRef" = TO_VARCHAR(A."DocNum") and C."ItemCode" = B."ItemCode" and C."BaseLine" = B."Linenum"
		Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "' . $this->database_name . '"."OPOR")D on D."DocEntry" = C."DocEntry"
		Left join(select "BaseRef","BaseLine","DocEntry","ItemCode","Dscription","Quantity","unitMsr" from "' . $this->database_name . '"."PDN1" where "BaseType" = 22)E on E."BaseRef" = TO_VARCHAR(D."DocNum") and E."ItemCode" = B."ItemCode" and E."BaseLine" = C."LineNum"
		Left join(select "DocEntry","DocNum","CardName","DocDate","CANCELED" from "' . $this->database_name . '"."OPDN")F on F."DocEntry" = E."DocEntry"
		WHERE A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND A."CANCELED" = ' . "'N'" . ' AND D."CANCELED" = ' . "'N'" . ' AND F."CANCELED" = ' . "'N'" . ' 
		order by A."DocNum";')->result_array();
	}

	public function grpo_head($nogrpo)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "DocNum","CardCode","CardName","NumAtCard","DocCur","DocRate",
		TO_VARCHAR (TO_DATE("DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (year(TO_DATE("DocDate"))) as "Posting_date",
		"TaxDate" as "Document_date"
		from "' . $this->database_name . '"."OPDN" where "DocNum" = ' . "'$nogrpo'" . ';')->result_array();
	}

	public function grpo_detail($nogrpo)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select B."ItemCode",B."Dscription",B."WhsCode","Quantity","UomCode","FreeTxt"
		from "' . $this->database_name . '"."OPDN" A
		Left Join "' . $this->database_name . '"."PDN1" B on B."DocEntry" = A."DocEntry" where A."DocNum" = ' . "'$nogrpo'" . ';')->result_array();
	}

	public function Dept()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "Code","Name" as "Dept" from "' . $this->database_name . '"."OUDP";')->result_array();
	}

	public function get_penilaian_supp()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select distinct "CardCode","CardName" from "' . $this->database_name . '"."OPOR" where "CANCELED" = ' . "'N'" . ' order by "CardCode";')->result_array();
	}

	public function get_penilaian_po_list($mulai, $hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select distinct "DocNum",TO_VARCHAR (TO_DATE("DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (year(TO_DATE("DocDate"))) as "Posting_date","DocDate","CardCode","CardName" from "' . $this->database_name . '"."OPOR" where "CANCELED" = ' . "'N'" . ' and "DocType" = ' . "'I'" . ' 
		and "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' order by "DocDate";')->result_array();
	}

	public function get_penilaian_po_list_item($mulai, $hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."DocNum",A."DocEntry",B."ItemCode",B."Dscription",B."Quantity",B."UomCode",E."ItmsGrpNam"
		from "' . $this->database_name . '"."OPOR" A
		Left join(Select "DocEntry","ItemCode","Dscription","Quantity","UomCode" from "' . $this->database_name . '"."POR1")B on B."DocEntry" = A."DocEntry" 
		left join(Select C."ItemCode",C."ItmsGrpCod", D."ItmsGrpNam" from "' . $this->database_name . '"."OITM" C
			left join(Select * from "' . $this->database_name . '"."OITB")D on D."ItmsGrpCod" = C."ItmsGrpCod")E on E."ItemCode" = B."ItemCode"
		where A."CANCELED" = ' . "'N'" . ' and A."DocType" = ' . "'I'" . ' and A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ';')->result_array();
	}

	public function get_nopo($nopo)
	{
		return $this->db->query("SELECT count(rowid) as rowid FROM tb_supp_p_2 where nopo = $nopo;")->result_array();
	}

	public function laporan_penilaian_supp($s, $t, $id_supp)
	{
		return $this->db->query("SELECT 
		rowid,
		id_supp,
		tgl,
		nopo,
		n1,n2,n3,item,
		(n1+n2+n3) AS total,
		case when (n1+n2+n3) >= 8 then 'Terpilih sebagai supplier'
		when (n1+n2+n3) < 8 then 'Tidak terpilih' END AS keputusan,
		keterangan 
		FROM tb_supp_p_2 WHERE semester = $s AND tahun = $t AND id_supp = '$id_supp';")->result_array();
	}

	public function get_sup_db()
	{
		return $this->db->query("SELECT * FROM tb_supp_p_2 WHERE rowid IN ( SELECT MIN(rowid) FROM tb_supp_p_2 GROUP BY id_supp ) ORDER BY `tb_supp_p_2`.`id_supp` ASC")->result_array();
	}

	public function get_supp($id)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."CardName",B."Address",B."Tel1"  
		from "' . $this->database_name . '"."OCRD" A
		Left Join(select "CardCode","Address","Tel1" from "' . $this->database_name . '"."OCPR")B on B."CardCode" = A."CardCode"  
		where A."CardCode"= ' . "'$id'" . ';')->row_array();
	}

	public function get_supp_filter()
	{
		return $this->db->query('SELECT distinct id_supp FROM tb_supp_p_2;')->result_array();
	}

	public function get_year()
	{
		return $this->db->query("SELECT YEAR(NOW()) AS tahun
		UNION ALL
		SELECT YEAR(NOW())-1 AS tahun
		UNION ALL
		SELECT YEAR(NOW())-2 AS tahun
		UNION ALL
		SELECT YEAR(NOW())-3 AS tahun
		UNION ALL
		SELECT YEAR(NOW())-4 AS tahun
		UNION ALL
		SELECT YEAR(NOW())-5 AS tahun;")->result_array();
	}

	public function get_filter_tahun()
	{
		return $this->db->query("SELECT distinct tahun from tb_supp_p_2;")->result_array();
	}

	public function get_ocrd()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "CardCode","CardName","Phone1" from "' . $this->database_name . '"."OCRD" where "CardType" = ' . "'S'" . ' and "frozenFor" = ' . "'N'" . ' order by "CardCode";')->result_array();
	}

	public function get_supp_exists($id, $s, $e)
	{
		return $this->db->query("SELECT COUNT(id_supp) AS id_supp FROM tb_pemilihan_supp WHERE id_supp = '$id' and mulai = '$s' AND hingga = '$e';")->row_array();
	}

	public function get_penilaian_supplier($mulai, $hingga)
	{
		return $this->db->query("SELECT distinct id_supp,supp,alamat,telp
		FROM tb_pemilihan_supp 
		WHERE mulai >= '$mulai' AND hingga <='$hingga';")->result_array();
	}

	public function get_supp_pv($s, $e)
	{
		return $this->db->query("SELECT distinct id_supp FROM tb_pemilihan_supp 
		WHERE mulai <= '$s' AND hingga >= '$e';")->result_array();
	}

	public function get_supp_nilai($s, $e, $id, $rowid)
	{
		return $this->db->query("SELECT id_supp,id_penilaian,nilai FROM tb_pemilihan_supp 
		WHERE mulai <= '$s' AND hingga >= '$e' AND id_supp = '$id' and id_penilaian = $rowid;")->row_array();
	}

	public function get_supp_tnilai($s, $e, $id)
	{
		return $this->db->query("SELECT id_supp,SUM(nilai) tnilai FROM tb_pemilihan_supp 
		WHERE mulai <= '$s' AND hingga >= '$e' AND id_supp = '$id';")->row_array();
	}

	public function get_kriteria_nilai()
	{
		return $this->db->query("SELECT distinct id_supp FROM tb_pemilihan_supp;")->result_array();
	}

	public function get_kriteria_penilaian()
	{
		return $this->db->query("SELECT rowid,penilaian,nilai,fatherid,sts FROM tb_kriteria_penilaian WHERE fatherid = 0;")->result_array();
	}

	public function tampil_nota()
	{
		return $this->db->query('SELECT distinct nama, no_po, tanggal FROM nota_manual;')->result_array();
	}

	public function get_namacus()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select distinct A."CardCode", A."CardName"
        from "' . $this->database_name . '"."OCRD" A
       	left join "' . $this->database_name . '"."OPOR" B ON A."CardCode" = B."CardCode"
        WHERE A."CardCode" IS NOT NULL AND A."frozenFor" = ' . "'N'" . ' and A."CardType" = ' . "'C'" . ' ORDER BY A."CardName";')->result_array();
	}

	public function get_top()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select distinct A."GroupNum", A."PymntGroup" from "' . $this->database_name . '"."OCTG" A;')->result_array();
	}

	public function get_listitem($code)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select distinct A."ItemCode", A."ItemName", B."UgpCode"
		from "' . $this->database_name . '"."OITM" A
		left join (select "UgpEntry","UgpCode","Locked" from "' . $this->database_name . '"."OUGP")B ON A."UgpEntry" = B."UgpEntry"
		where A."ItemCode" = ' . "'$code'" . ' and B."Locked" = ' . "'N'" . ';')->row_array();
	}

	public function nota_manual($no_po)
	{
		return $this->db->query("SELECT distinct nama, no_po, tanggal, kota, alamat, telepon, top, attn FROM nota_manual WHERE no_po = '$no_po';")->result_array();
	}

	public function detail_nota_manual($no_po)
	{
		return $this->db->query("SELECT distinct kode_barang, jenis_barang, jumlah, satuan, keterangan FROM nota_manual WHERE no_po = '$no_po';")->result_array();
	}

	public function tampil_rekap_po($mulai, $hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('SELECT DISTINCT TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
        TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
        TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "DocDate", A."DocNum", A."CardCode", A."CardName", B."Address", A."Address2", TO_VARCHAR (TO_DATE(A."DocDueDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
        TO_VARCHAR (left(monthname(TO_DATE(A."DocDueDate")),3)) || ' . "'.'" . ' ||
        TO_VARCHAR (year(TO_DATE(A."DocDueDate"))) as "DocDueDate", C."PymntGroup", D."ItemCode", D."Dscription", CAST(D."Quantity" AS INT) AS "Quantity", D."UomCode", CAST(D."Price" AS INT) AS "Price", CAST(D."LineTotal" AS INT) AS "LineTotal", D."VatGroup", CAST(D."VatSum" AS INT) AS "VatSum", 
		CAST(A."TotalExpns" AS INT) AS "TotalExpns", CAST(A."DocTotalSy" AS INT) AS "DocTotalSy", D."ItmsGrpNam", A."Comments"
		FROM "' . $this->database_name . '"."OPOR" A
		LEFT JOIN (select "Address","CardCode" from "' . $this->database_name . '"."OCPR")B on B."CardCode" = A."CardCode"
		LEFT JOIN (select "PymntGroup", "GroupNum" from "' . $this->database_name . '"."OCTG")C on C."GroupNum" = A."GroupNum"
		LEFT JOIN (select D."ItemCode", "Dscription", "Quantity", "UomCode", "Price", "LineTotal", "VatGroup", "VatSum", E."ItmsGrpNam", "DocEntry" from "' . $this->database_name . '"."POR1" D
			LEFT JOIN (select "ItemCode", F."ItmsGrpNam", F."ItmsGrpCod" from "' . $this->database_name . '"."OITM" E
				LEFT JOIN (select "ItmsGrpCod", "ItmsGrpNam" from "' . $this->database_name . '"."OITB")F on F."ItmsGrpCod" = E."ItmsGrpCod")E on E."ItemCode" = D."ItemCode") D on D."DocEntry" = A."DocEntry"
		WHERE A."DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ';')->result_array();
	}
}
