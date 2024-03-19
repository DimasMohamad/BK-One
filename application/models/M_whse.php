<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_whse extends CI_Model
{
    private $database_name = "BKI_2024";
    public function __construct()
    {
        parent::__construct();
    }

    public function lhkb_head($mulai, $hingga, $tipe)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select row_number() over (order by "DocDate") as "num","DocNum","DocEntry",
            TO_VARCHAR (TO_DATE("DocDate"), ' . "'DD'" . ') || ' . "'-'" . ' ||
            TO_VARCHAR (left(monthname(TO_DATE("DocDate")),3)) || ' . "'-'" . ' ||
            TO_VARCHAR (TO_DATE("DocDate"), ' . "'YY'" . ') as "TglBPB","DocDate","NumAtCard","CardName","tipe","Comments","item" from (
            select "DocNum","DocEntry","DocDueDate" as "DocDate","NumAtCard","CardName",' . "'DO'" . ' as "tipe","Comments",1 as "item"
            from "' . $this->database_name . '"."ODLN" -- delivery
            where "CANCELED" = ' . "'N'" . ' and "DocDueDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' 
            Union All
            select "DocNum","DocEntry","DocDueDate" as "DocDate","NumAtCard","CardName",' . "'Return'" . ' as "tipe","Comments",2 as "item"
            from "' . $this->database_name . '"."ORPD" -- goods return
            where "CANCELED" = ' . "'N'" . ' and "DocDueDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . '
            Union All
            select "DocNum","DocEntry","DocDueDate" as "DocDate","NumAtCard","CardName",' . "'GI'" . ' as "tipe","Comments",3 as "item"
            from "' . $this->database_name . '"."OIGE" -- goods issue
            where "CANCELED" = ' . "'N'" . ' and "DocDueDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . '
            Union All
            select "DocNum","DocEntry","DocDate","NumAtCard","CardName",' . "'IT'" . ' as "tipe","Comments",4 as "item"
            from "' . $this->database_name . '"."OWTR" -- inv transfer
            where "CANCELED" = ' . "'N'" . ' and "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . '
            ) as "tb_head" where "item" in(' . "$tipe" . ');')->result_array();
    }

    public function lhkb_detail($mulai, $hingga, $tipe)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select "DocNum","DocEntry","ItemCode","Dscription","Quantity","UomCode","FromWhsCod","WhsCode","tipe","item" from (
            select A."DocNum",A."DocEntry",B."ItemCode",B."Dscription",B."Quantity",B."UomCode",null as "FromWhsCod",B."WhsCode",B."FreeTxt",' . "'DO'" . ' as "tipe",1 as "item"
            from "' . $this->database_name . '"."ODLN" A -- delivery
            Left Join(select "DocEntry","ItemCode","Dscription","Quantity","UomCode","WhsCode","FreeTxt" from "' . $this->database_name . '"."DLN1")B on B."DocEntry" = A."DocEntry"
            where A."CANCELED" = ' . "'N'" . ' and A."DocDueDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . '
            Union All
            select A."DocNum",A."DocEntry",B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."FromWhsCod",B."WhsCode",B."FreeTxt",' . "'Return'" . ' as "tipe",2 as "item"
            from "' . $this->database_name . '"."ORPD" A -- goods return
            Left Join(select "DocEntry","ItemCode","Dscription","Quantity","UomCode","FromWhsCod","WhsCode","FreeTxt" from "' . $this->database_name . '"."RPD1")B on B."DocEntry" = A."DocEntry"
            where "CANCELED" = ' . "'N'" . ' and "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . '
            Union All
            select A."DocNum",A."DocEntry",B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."FromWhsCod",B."WhsCode",B."FreeTxt",' . "'GI'" . ' as "tipe",3 as "item"
            from "' . $this->database_name . '"."OIGE" A -- goods issue
            Left Join(select "DocEntry","ItemCode","Dscription","Quantity","UomCode","FromWhsCod","WhsCode","FreeTxt" from "' . $this->database_name . '"."IGE1")B on B."DocEntry" = A."DocEntry"
            where "CANCELED" = ' . "'N'" . ' and "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . '
            Union All
            select A."DocNum",A."DocEntry",B."ItemCode",B."Dscription",B."Quantity",B."UomCode",B."FromWhsCod",B."WhsCode",B."FreeTxt",' . "'IT'" . ' as "tipe",4 as "item"
            from "' . $this->database_name . '"."OWTR" A -- inv transfer
            Left Join(select "DocEntry","ItemCode","Dscription","Quantity","UomCode","FromWhsCod","WhsCode","FreeTxt" from "' . $this->database_name . '"."WTR1")B on B."DocEntry" = A."DocEntry"
            where "CANCELED" = ' . "'N'" . ' and "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . '
            ) as "tb_detail" where "item" in(' . "$tipe" . ');')->result_array();
    }

    public function trace_item_whse($itemcode)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct "Warehouse"
		from "' . $this->database_name . '"."OINM" where "ItemCode" = ' . "'$itemcode'" . '  
		order by "Warehouse";')->result_array();
    }

    public function trace_item_audit($itemcode, $whse)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select A."TransNum",A."DocDate",A."CardCode",A."ItemCode",A."Warehouse",A."BASE_REF",A."Comments",A."TransType",
		TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
		TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
		TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "tgl",
		case 
		when A."TransType" = 18 then ' . "'A/P Invoice'" . '
		when A."TransType" = 20 then ' . "'DP_(GRPO)'" . '
        when A."TransType" = 15 then ' . "'DN_(DO)'" . '
		when A."TransType" = 59 and A."CardCode" <> ' . "'399901-01'" . ' then ' . "'SI_(GR)'" . '
		when A."TransType" = 60 then ' . "'SO_(GI)'" . '
		when A."TransType" = 67 then ' . "'IM_(IT)'" . '
		when A."TransType" = 69 then ' . "'Landed Costs'" . '
		when A."CardCode" = ' . "'399901-01'" . ' then ' . "'Saldo awal'" . '
		end "Transdescription"
		,A."InQty",A."OutQty",("InQty" - "OutQty") as "stok",
		SUM((A."InQty" - A."OutQty")) OVER(PARTITION BY A."Warehouse" order by A."TransNum") AS "Total"
		,A."Currency",A."Price",A."TransValue"
		from "' . $this->database_name . '"."OINM" A
		where A."ItemCode" = ' . "'$itemcode'" . ' and A."Warehouse" = ' . "'$whse'" . ' order by A."TransNum";')->result_array();
    }

    public function rekap_item_audit_head($periode)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct A."ItemCode",B."ItemName",B."InvntryUom",
		case when C."UgpCode" in(' . "'BOX'" . ',' . "'PCS'" . ',' . "'PACK'" . ',' . "'BUKU'" . ',' . "'RIM'" . ',' . "'DUS'" . ',' . "'BTL'" . ',' . "'L'" . ',' . "'SET'" . ',' . "'Manual'" . ',' . "'KG'" . ',' . "'M'" . ') 
        THEN ' . "'-'" . ' else C."UgpCode" end "konversi" 
		from "' . $this->database_name . '"."OINM" A 
		Left Join(select "ItemCode","ItemName","InvntryUom","UgpEntry" from "' . $this->database_name . '"."OITM")B on B."ItemCode" = A."ItemCode"
		Left Join(select "UgpEntry","UgpCode" from "' . $this->database_name . '"."OUGP")C on C."UgpEntry" = B."UgpEntry"
		where A."DocDate" <= LAST_DAY(' . "'$periode'" . ')
		order by A."ItemCode";')->result_array();
    }

    public function rekap_item_audit($periode)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('CALL "' . $this->database_name . '"."BKI_REKAP_MUTASI_STOK"(' . "'$periode'" . ');')->result_array();
    }
}
