<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_sql extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function ocpr()
    {
		$hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select * from "BKI_LIVE"."OCPR";')->result_array();
    }

    public function Item_Groups()
    {
		$hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select "ItmsGrpCod","ItmsGrpNam" from "BKI_LIVE"."OITB" order by "ItmsGrpNam"')->result_array();
    }

    public function bukti_penerimaan_barang($DocKey)
    {
		$hanadb = $this->load->database('hana', TRUE);
        return $this->$hanadb->query('SELECT	
		CAST(t0."DocNum" AS varchar)||'."'/'".'||CAST(t3."SeriesName" AS varchar)||'."'/BKI/'".'||CASE 
		WHEN MONTH(t0."DocDate")= 1 THEN '."'I'".'
		WHEN MONTH(t0."DocDate")= 2 THEN '."'II'".'
		WHEN MONTH(t0."DocDate")= 3 THEN '."'III'".'
		WHEN MONTH(t0."DocDate")= 4 THEN '."'IV'".'
		WHEN MONTH(t0."DocDate")= 5 THEN '."'V'".'
		WHEN MONTH(t0."DocDate")= 6 THEN '."'VI'".'
		WHEN MONTH(t0."DocDate")= 7 THEN '."'VII'".'
		WHEN MONTH(t0."DocDate")= 8 THEN '."'VII'".'
		WHEN MONTH(t0."DocDate")= 9 THEN '."'IX'".'
		WHEN MONTH(t0."DocDate")= 10 THEN '."'X'".'
		WHEN MONTH(t0."DocDate")= 11 THEN '."'XI'".'
		ELSE '."'XII'".'
		END||'."'/'".'||SUBSTRING(CAST(YEAR(t0."DocDate") AS varchar), 3, 2) as "No.",
		t0."DocDate" As "Date",
		t1."ItemCode" As "Kode Barang",
		t1."Dscription" AS "Jenis Barang",
		t1."Quantity" AS "QTY",
		t1."unitMsr" AS "Satuan",
		t1."PriceBefDi" AS "Harga Satuan",
		t1."VatPrcnt" AS "PPN",
		t1."LineTotal" AS "TOTAL",
		t0."Comments" AS "Alasan",
		t0."DocDueDate" AS "Diterima tanggal"
        FROM "BKI_LIVE"."OIGN" AS t0 
        LEFT JOIN (select "DocEntry","ItemCode","Dscription","Quantity","unitMsr","PriceBefDi","VatPrcnt","LineTotal" from "BKI_LIVE"."IGN1") AS t1 ON t0."DocEntry"  = t1."DocEntry"
        LEFT JOIN (select "Series","SeriesName" from "BKI_LIVE"."NNM1") AS t3 ON t0."Series" = t3."Series"
        WHERE t0."DocEntry" = '.$DocKey.';')->result_array();
    }

	public function spk_1($id)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('call "BKI_LIVE"."IDU_SP_SPK1"('.$id.')')->result_array();
	}

	public function laporan_lhmb($mulai,$hingga,$grup,$cari,$sts)
	{
		if($sts == '0'){
			$status = ' AND A."DocStatus" in('."'O'".','."'C'".') ';
		}
		if($sts == 'O'){
			$status = ' AND A."DocStatus" in('."'O'".') ';
		}
		if($sts == 'C'){
			$status = ' AND A."DocStatus" in('."'C'".') ';
		}
		$hanadb = $this->load->database('hana', TRUE);
		if(!$grup == ''){
			return $hanadb->query('select * from (SELECT 
			A."DocNum" AS "NoBPB",
			TO_VARCHAR (TO_DATE(A."DocDate"), '."'DD'".') || '."'-'".' ||
			TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || '."'-'".' ||
			TO_VARCHAR (TO_DATE(A."DocDate"), '."'YY'".') as "TglBPB",A."DocDate",
			A."NumAtCard" AS "NoSJ",
			A."CardName" AS "Supplier",
			D."ItmsGrpNam" AS "Grup",
			B."ItemCode" AS "Kode_brg",
			B."Dscription" AS "Nama_brg",
			B."Quantity",
			B."UomCode",
			B."PriceBefDi" AS "Price",	
			B."VatSum" AS "PPN",
			B."GTotal" AS "Total",
			B."FreeTxt" as "FreeText",
			B."Currency",
			B."VatPrcnt",
			B."Rate",
			B."GTotalFC" AS "Total2",
			A."Comments",
			B."FreeTxt",
			B."WhsCode",
			A."DocStatus"
		  FROM "BKI_LIVE"."OPDN" A
		  Left JOIN (select 
					"DocEntry",
					"ItemCode",
					"Dscription",
					"Quantity",
					"unitMsr",
					"UomCode",
					"PriceBefDi",
					"VatSum",
					"GTotal",
					"FreeTxt",
					"Rate",
					"WhsCode",
					"Currency",
					"VatPrcnt",
					"GTotalFC" 
					from "BKI_LIVE"."PDN1") B ON B."DocEntry" = A."DocEntry"
		  Left Join(select "ItemCode","ItmsGrpCod" from "BKI_LIVE"."OITM")C on C."ItemCode" = B."ItemCode"
		  Left Join(select "ItmsGrpCod","ItmsGrpNam" from "BKI_LIVE"."OITB")D on D."ItmsGrpCod" = C."ItmsGrpCod"
		  WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".$status.'
		  AND C."ItmsGrpCod" in('.$grup.') AND A."CANCELED" = '."'N'".') as "grpo" 
		  where "Supplier" like'."'%$cari%'".' 
		  OR "NoSJ" like'."'%$cari%'".' 
		  OR "Comments" like'."'%$cari%'".' 
		  OR "FreeText" like'."'%$cari%'".' 
		  OR "Kode_brg" like'."'%$cari%'".' 
		  OR "Nama_brg" like'."'%$cari%'".'
		  OR "NoBPB" like'."'%$cari%'".' order by "DocDate";')->result_array();
		}else{
			return $hanadb->query('select * from (SELECT 
			A."DocNum" AS "NoBPB",
			TO_VARCHAR (TO_DATE(A."DocDate"), '."'DD'".') || '."'-'".' ||
			TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || '."'-'".' ||
			TO_VARCHAR (TO_DATE(A."DocDate"), '."'YY'".') as "TglBPB",A."DocDate",
			A."NumAtCard" AS "NoSJ",
			A."CardName" AS "Supplier",
			D."ItmsGrpNam" AS "Grup",
			B."ItemCode" AS "Kode_brg",
			B."Dscription" AS "Nama_brg",
			B."Quantity",
			B."UomCode",
			B."PriceBefDi" AS "Price",	
			B."VatSum" AS "PPN",
			B."GTotal" AS "Total",
			B."FreeTxt" as "FreeText",
			B."Currency",
			B."VatPrcnt",
			B."Rate",
			B."GTotalFC" AS "Total2",
			A."Comments",
			B."FreeTxt",
			B."WhsCode",
			A."DocStatus"
		  FROM "BKI_LIVE"."OPDN" A
		  Left JOIN (select 
					"DocEntry",
					"ItemCode",
					"Dscription",
					"Quantity",
					"unitMsr",
					"UomCode",
					"PriceBefDi",
					"VatSum",
					"GTotal",
					"FreeTxt",
					"Rate",
					"WhsCode",
					"Currency",
					"VatPrcnt",
					"GTotalFC" 
					from "BKI_LIVE"."PDN1") B ON B."DocEntry" = A."DocEntry"
		  Left Join(select "ItemCode","ItmsGrpCod" from "BKI_LIVE"."OITM")C on C."ItemCode" = B."ItemCode"
		  Left Join(select "ItmsGrpCod","ItmsGrpNam" from "BKI_LIVE"."OITB")D on D."ItmsGrpCod" = C."ItmsGrpCod"
		  WHERE A."DocDate" between '."'$mulai'".' and '."'$hingga'".$status.'
		  AND A."CANCELED" = '."'N'".') as "grpo" 
		  where "Supplier" like'."'%$cari%'".' 
		  OR "NoSJ" like'."'%$cari%'".' 
		  OR "Comments" like'."'%$cari%'".' 
		  OR "FreeText" like'."'%$cari%'".' 
		  OR "Kode_brg" like'."'%$cari%'".' 
		  OR "Nama_brg" like'."'%$cari%'".'
		  OR "NoBPB" like'."'%$cari%'".'  order by "DocDate";')->result_array();
		}
	}

	public function so_header($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select 
		"DocEntry",
		"DocNum",
		"DocDate",
		"CardName",
		"DocTotal"
		from "BKI_LIVE"."ORDR"
		WHERE "DocDate" between '."'$mulai'".' and '."'$hingga'".'
		order by "DocEntry","DocDate";')->result_array();
	}

	public function get_so_month()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select '."'1'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 1 and A."CANCELED" = '."'N'".'
		Union ALL
		select '."'2'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 2 and A."CANCELED" = '."'N'".'
		Union ALL
		select '."'3'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 3 and A."CANCELED" = '."'N'".'
		Union All
		select '."'4'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 4 and A."CANCELED" = '."'N'".'
		Union ALL
		select '."'5'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 5 and A."CANCELED" = '."'N'".'
		Union ALL
		select '."'6'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 6 and A."CANCELED" = '."'N'".'
		Union All
		select '."'7'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 7 and A."CANCELED" = '."'N'".'
		Union ALL
		select '."'8'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 8 and A."CANCELED" = '."'N'".'
		Union ALL
		select '."'9'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 9 and A."CANCELED" = '."'N'".'
		Union All
		select '."'10'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 10 and A."CANCELED" = '."'N'".'
		Union ALL
		select '."'11'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 11 and A."CANCELED" = '."'N'".'
		Union ALL
		select '."'12'".' as "bln",ifnull(sum(B."GTotal"),0) as "total_so" from "BKI_LIVE"."ORDR" A
		Left Join(select "DocEntry","GTotal" from "BKI_LIVE"."RDR1")B on B."DocEntry" = A."DocEntry"
		where YEAR(A."DocDate") = (select YEAR(current_date) FROM DUMMY)
		and MONTH(A."DocDate") = 12 and A."CANCELED" = '."'N'".';')->result_array();
	}

	public function open_pr($sts,$mulai,$hingga,$cari)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."DocNum",A."DocDate",
		TO_VARCHAR (TO_DATE(A."DocDate"), '."'DD'".') || '."'-'".' ||
        TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || '."'-'".' ||
        TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl",
		A."DocStatus",A."Ref1",A."ReqName", B."Dept",A."Comments"
		FROM "BKI_LIVE"."OPRQ" A
		Left Join(select "Code","Name" as "Dept" from "BKI_LIVE"."OUDP")B on B."Code" = A."Department"
		where A."DocDate" between '."'$mulai'".' and '."'$hingga'".' 
		and A."DocStatus" like'."'%$sts%'".' and A."Comments" like'."'%$cari%'".';')->result_array();
	}

	public function get_stok($no_page,$cari)
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
		return $hanadb->query('select "row","ItemCode","ItemName","ItmsGrpNam","OnHand","InvntryUom","UgpCode","validFor","InvntItem","SellItem","PrchseItem"
		from(
			select row_number() over (order by A."ItemCode") as "row",A."ItemCode",A."ItemName",C."ItmsGrpNam",A."InvntryUom",B."UgpCode",A."validFor",A."InvntItem",A."SellItem",A."PrchseItem",D."OnHand"
			from "BKI_LIVE"."OITM" A
			Left join "BKI_LIVE"."OUGP" B on B."UgpEntry" = A."UgpEntry"
			Left join "BKI_LIVE"."OITB" C on C."ItmsGrpCod" = A."ItmsGrpCod"
			Left join(
					  select A."ItemCode",sum(A."OnHand") as "OnHand",B."InvntryUom" 
					  from "BKI_LIVE"."OITW" A 
					  Left Join(select "ItemCode","ItemName","InvntryUom" from "BKI_LIVE"."OITM")B on B."ItemCode" = A."ItemCode"
					  where A."OnHand" > 0 
					  group by A."ItemCode",B."ItemName",B."InvntryUom"
					 )D on D."ItemCode" = A."ItemCode"
			where A."ItemCode" like '."'%$cari%'".' OR A."ItemName" like '."'%$cari%'".'
		) as "tb_item"
		where "row" between '.$first.' and '.$last.';')->result_array();
	}

	public function get_stok_whs($no_page,$cari)
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
		return $hanadb->query('select * from(
			select row_number() over (order by "ItemCode") as "row","ItemCode","WhsCode","OnHand","InvntryUom" from (
			select A."ItemCode",A."WhsCode",B."ItemName",A."OnHand",B."InvntryUom" 
			from "BKI_LIVE"."OITW" A 
			Left Join(select "ItemCode","ItemName","InvntryUom" from "BKI_LIVE"."OITM")B on B."ItemCode" = A."ItemCode"
			where A."OnHand" > 0) as "tb" where "ItemCode"like '."'%$cari%'".' OR "ItemName" like '."'%$cari%'".'
			) as "tb_stok"
			where "row" between '.$first.' and '.$last.' order by "ItemCode";')->result_array();
	}

	public function get_stok_dtl($no_page,$cari)
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
		return $hanadb->query('select "tb_temp3"."row","tb_temp3"."ItemCode",B."WhsCode",B."OnHand","tb_temp3"."InvntryUom" 
		from(
			select row_number() over (order by "ItemCode") as "row","ItemCode","ItemName","InvntryUom" 
			from(
				select "ItemCode","ItemName","InvntryUom" 
				from(
					select "ItemCode","ItemName","InvntryUom" from "BKI_LIVE"."OITM"
				) as "tb_temp1" where "ItemCode" like '."'%$cari%'".' or "ItemName" like '."'%$cari%'".'
			) as "tb_temp2"
		) as "tb_temp3"
		Left Join(select "ItemCode","OnHand","WhsCode" from "BKI_LIVE"."OITW" where "OnHand" > 0)B on B."ItemCode" = "tb_temp3"."ItemCode"
		where "row" between '.$first.' and '.$last.';')->result_array();
	}

	public function hitung_row_stok($cari)
	{
		$hanadb = $this->load->database('hana', TRUE);
			$query = $hanadb->query('select count("ItemCode") as "row" from "BKI_LIVE"."OITM"  where "ItemCode" like '."'%$cari%'".' or "ItemName" like '."'%$cari%'".';')->row_array();
		    return $query['row'];
	}

	public function open_pr_hdr($mulai,$hingga,$cari)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "DocNum","DocDate","Comments"
		from "BKI_LIVE"."OPRQ"
		where "InvntSttus" = '."'O'".' and "CANCELED" = '."'N'".' and "DocDate" 
		between '."'$mulai'".' and '."'$hingga'".' 
		and "Comments" like '."'%$cari%'".' order by "DocNum";')->result_array();
	}

	public function open_pr_dtl($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('')->result_array();
	}

	

	

	public function trace_item_audit($itemcode)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."TransNum",A."DocDate",A."CardCode",A."ItemCode",A."Warehouse",A."BASE_REF",A."Comments",A."TransType",
		TO_VARCHAR (TO_DATE(A."DocDate"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || '."'.'".' ||
		TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl",
		case 
		when A."TransType" = 18 then '."'A/P Invoice'".'
		when A."TransType" in(15,20) then '."'DP_(GRPO)'".'
		when A."TransType" = 59 and A."CardCode" <> '."'399901-01'".' then '."'SI_(GR)'".'
		when A."TransType" = 60 then '."'SO_(GI)'".'
		when A."TransType" = 67 then '."'IM_(IT)'".'
		when A."TransType" = 69 then '."'Landed Costs'".'
		when A."CardCode" = '."'399901-01'".' then '."'Saldo awal'".'
		end "Transdescription"
		,A."InQty",A."OutQty",("InQty" - "OutQty") as "stok",
		SUM((A."InQty" - A."OutQty")) OVER(PARTITION BY A."Warehouse" order by A."TransNum") AS "Total"
		,A."Currency",A."Price",A."TransValue"
		from "BKI_LIVE"."OINM" A
		where A."ItemCode" = '."'$itemcode'".' order by A."TransNum";')->result_array();
	}

	public function hitung_konversi($id,$nilai)
	{
		return $this->db->query("SELECT (($nilai/A.qty)*B.qty) AS konversi,'KG' AS uom FROM tb_conv A 
		LEFT JOIN(SELECT id_item,qty FROM tb_conv WHERE uom = 'KG')B ON B.id_item = A.id_item
		WHERE A.uom = 'M' AND A.id_item = '$id'
		UNION ALL
		SELECT (($nilai/A.qty)*B.qty) AS konversi,'ROLL' AS uom FROM tb_conv A 
		LEFT JOIN(SELECT id_item,qty FROM tb_conv WHERE uom = 'ROLL')B ON B.id_item = A.id_item
		WHERE A.uom = 'M' AND A.id_item = '$id';")->result_array();
	}

	public function hitung_konversi_sap($id,$nilai)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('SELECT A."ItemCode",(('.$nilai.' / B."BaseQty")*B."AltQty") as "konversi",'."'KG'".' as "uom"
		FROM "BKI_LIVE"."OITM" A
		Left JoiN(select "UgpEntry","AltQty","BaseQty","UomEntry" from "BKI_LIVE"."UGP1")B on B."UgpEntry" = A."UgpEntry"
		where A."ItemCode" = '."'$id'".' and B."UomEntry" = 1
		Union ALL
		SELECT A."ItemCode",(('.$nilai.' / B."BaseQty")*B."AltQty") as "konversi",'."'ROLL'".' as "uom"
		FROM "BKI_LIVE"."OITM" A
		Left JoiN(select "UgpEntry","AltQty","BaseQty","UomEntry" from "BKI_LIVE"."UGP1")B on B."UgpEntry" = A."UgpEntry"
		where A."ItemCode" = '."'$id'".' and B."UomEntry" = 5;')->result_array();
	}

	public function get_item($no_page,$cari)
	{
		$hanadb = $this->load->database('hana', TRUE);
		$perpage = 10;
        if ($no_page == 1) {
            $first = 1;
            $last  = $perpage;
        } else {
            $first = ($no_page - 1) * $perpage + 1;
            $last  = $first + ($perpage - 1);
        }

		return $hanadb->query('select * from(
			select row_number() over (order by A."ItemCode") as "row",A."ItemCode",A."ItemName",A."ItmsGrpCod",B."ItmsGrpNam",
			case 
			when A."ItemType" = '."'I'".' then '."'Items'".'
			when A."ItemType" = '."'L'".' then '."'Labor'".'
			when A."ItemType" = '."'T'".' then '."'Travel'".'
			when A."ItemType" = '."'F'".' then '."'Fixed Assets'".' 
			end "ItemType",
			A."UgpEntry",C."UgpCode",A."InvntItem",A."SellItem",A."PrchseItem",A."validFor" 
			from "OITM" A
			Left join(select "ItmsGrpCod","ItmsGrpNam" from "OITB")B on B."ItmsGrpCod" = A."ItmsGrpCod"
			Left Join(select "UgpEntry","UgpCode" from "OUGP") C on C."UgpEntry" = A."UgpEntry" 
			where A."ItemCode" like '."'%$cari%'".' or A."ItemName" like '."'%$cari%'".') as "tb" where "row" between '.$first.' and '.$last.';')->result_array();
	}

	public function rekap_item_audit_head($periode)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select distinct A."ItemCode",B."ItemName",B."InvntryUom",
		case when C."UgpCode" in('."'BOX'".','."'PCS'".','."'PACK'".','."'BUKU'".','."'RIM'".','."'DUS'".','."'BTL'".','."'L'".','."'SET'".','."'Manual'".','."'KG'".','."'M'".') 
        THEN '."'-'".' else C."UgpCode" end "konversi" 
		from "BKI_LIVE"."OINM" A 
		Left Join(select "ItemCode","ItemName","InvntryUom","UgpEntry" from "BKI_LIVE"."OITM")B on B."ItemCode" = A."ItemCode"
		Left Join(select "UgpEntry","UgpCode" from "BKI_LIVE"."OUGP")C on C."UgpEntry" = B."UgpEntry"
		where A."DocDate" <= LAST_DAY('."'$periode'".')
		order by A."ItemCode";')->result_array();
	}

	public function rekap_item_audit($periode)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('CALL "BKI_LIVE"."BKI_REKAP_MUTASI_STOK"('."'$periode'".');')->result_array();
	}

}
