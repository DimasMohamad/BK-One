<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_produksi extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function laporan_produksi($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select B."DocNum",
		TO_VARCHAR (TO_DATE(B."DocDate"), '."'DD'".') || '."'-'".' ||
        TO_VARCHAR (left(monthname(TO_DATE(B."DocDate")),3)) || '."'-'".' ||
        TO_VARCHAR (year(TO_DATE(B."DocDate"))) as "tgl",
		A."ItemCode",A."Dscription",B."Comments",A."WhsCode",A."Quantity",A."UomCode"
		from "BKI_LIVE"."IGN1" A
		Left Join(select "DocNum","DocEntry","DocDate","Comments" from "BKI_LIVE"."OIGN")B on B."DocEntry" = A."DocEntry"
		where A."AcctCode" = '."'110930-01'".' and B."DocDate" between '."'$mulai'".' and '."'$hingga'".' order by B."DocNum";')->result_array();
	}

	public function get_date($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select "selected_date" AS "tgl",
		TO_VARCHAR (TO_DATE("selected_date"), '."'DD'".') || '."'.'".' ||
		TO_VARCHAR (left(monthname(TO_DATE("selected_date")),3)) || '."'.'".' ||
		TO_VARCHAR (right(year(TO_DATE("selected_date")),2)) as "tanggal" 
		from
			(select ADD_DAYS('."'1970-01-01'".',"t4".i*10000 + "t3".i*1000 + "t2".i*100 + "t1".i*10 + "t0".i) as "selected_date" 
			from
			(select 0 i FROM DUMMY union select 1  FROM DUMMY union select 2  FROM DUMMY union select 3  FROM DUMMY union select 4  FROM DUMMY union select 5  FROM DUMMY union select 6  FROM DUMMY union select 7  FROM DUMMY union select 8  FROM DUMMY union select 9 FROM DUMMY) as "t0",
			(select 0 i FROM DUMMY union select 1  FROM DUMMY union select 2  FROM DUMMY union select 3  FROM DUMMY union select 4  FROM DUMMY union select 5  FROM DUMMY union select 6  FROM DUMMY union select 7  FROM DUMMY union select 8  FROM DUMMY union select 9 FROM DUMMY) as "t1",
			(select 0 i FROM DUMMY union select 1  FROM DUMMY union select 2  FROM DUMMY union select 3  FROM DUMMY union select 4  FROM DUMMY union select 5  FROM DUMMY union select 6  FROM DUMMY union select 7  FROM DUMMY union select 8  FROM DUMMY union select 9 FROM DUMMY) as "t2",
			(select 0 i FROM DUMMY union select 1  FROM DUMMY union select 2  FROM DUMMY union select 3  FROM DUMMY union select 4  FROM DUMMY union select 5  FROM DUMMY union select 6  FROM DUMMY union select 7  FROM DUMMY union select 8  FROM DUMMY union select 9 FROM DUMMY) as "t3",
			(select 0 i FROM DUMMY union select 1  FROM DUMMY union select 2  FROM DUMMY union select 3  FROM DUMMY union select 4  FROM DUMMY union select 5  FROM DUMMY union select 6  FROM DUMMY union select 7  FROM DUMMY union select 8  FROM DUMMY union select 9 FROM DUMMY) as "t4") 
			as "v"
		where "selected_date" BETWEEN '."'$mulai'".' and '."'$hingga'".';')->result_array();
	}

	public function get_item($mulai,$hingga)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."ItemCode" ||'."'|'".'|| A."Dscription" ||'."'|0|1'".' as "ItemCode" from "BKI_LIVE"."IGN1" A
		Left Join(select "DocNum","DocEntry","DocDate","Comments","CANCELED" from "BKI_LIVE"."OIGN")B on B."DocEntry" = A."DocEntry"
		where A."AcctCode" = '."'110930-01'".' and B."DocDate" between '."'$mulai'".' and '."'$hingga'".' 
		AND B."CANCELED" = '."'N'".' group by A."ItemCode",A."Dscription" order by sum(A."Quantity") desc;')->result_array();
	}

	public function get_item_date($item,$tgl)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select TO_DATE(B."DocDate") as "DocDate",A."ItemCode",A."ItemCode" ||'."'|'".'|| sum(A."Quantity") ||'."'|'".'|| TO_DATE(B."DocDate") ||'."'|2'".' as "Quantity",A."UomCode"
		from "BKI_LIVE"."IGN1" A
		Left Join(select "DocNum","DocEntry","DocDate","Comments","CANCELED" from "BKI_LIVE"."OIGN")B on B."DocEntry" = A."DocEntry"
		where A."AcctCode" = '."'110930-01'".' and B."DocDate" = '."'$tgl'".' and A."ItemCode" = '."'$item'".'
		AND B."CANCELED" = '."'N'".' group by B."DocDate",A."ItemCode",A."Dscription",A."UomCode";')->result_array();
	}

	public function get_item_master()
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select A."ItemCode",A."ItemName",C."ItmsGrpNam",A."InvntryUom",B."UgpCode",A."validFor",A."InvntItem",A."SellItem",A."PrchseItem" 
		from "BKI_LIVE"."OITM" A
		Left join (select "UgpEntry","UgpCode" from "BKI_LIVE"."OUGP") B on B."UgpEntry" = A."UgpEntry"
		Left join (select "ItmsGrpCod","ItmsGrpNam" from "BKI_LIVE"."OITB") C on C."ItmsGrpCod" = A."ItmsGrpCod"
		order by A."ItemCode";')->result_array();
	}

	public function trace_bj($item,$tgl)
	{
		$hanadb = $this->load->database('hana', TRUE);
		return $hanadb->query('select TO_VARCHAR (TO_DATE(B."DocDate"), '."'DD'".') || '."'-'".' ||
        TO_VARCHAR (left(monthname(TO_DATE(B."DocDate")),3)) || '."'-'".' ||
        TO_VARCHAR (year(TO_DATE(B."DocDate"))) as "DocDate",A."ItemCode",A."Dscription",A."WhsCode",A."Quantity",A."UomCode",B."Comments"
		from "BKI_LIVE"."IGN1" A
		Left Join(select "DocNum","DocEntry","DocDate","Comments","CANCELED" from "BKI_LIVE"."OIGN")B on B."DocEntry" = A."DocEntry"
		where A."AcctCode" = '."'110930-01'".' and B."DocDate" = '."'$tgl'".' and A."ItemCode" = '."'$item'".'
		AND B."CANCELED" = '."'N'".';')->result_array();
	}
}