<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_bp extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function bp_head()
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct C."CardCode",A."CardName",A."Address",B."Name" as "Country",A."Phone1",A."CntctPrsn",A."Notes",A."E_Mail"
        from "BKI_LIVE"."OCRD" A
        left join "BKI_LIVE"."OCRY" B on B."Code" = A."Country"
        Left join(select "DocEntry","CardCode" from "BKI_LIVE"."OPOR")C on C."CardCode" = A."CardCode"
        where C."CardCode" is not null and A."CardType" = ' . "'S'" . ' order by A."CardName";')->result_array();
    }

    public function bp_detail()
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct C."CardCode",D."ItmsGrpNam"
        from "BKI_LIVE"."OCRD" A
        left join "BKI_LIVE"."OCRY" B on B."Code" = A."Country"
        Left join(select "DocEntry","CardCode" from "BKI_LIVE"."OPOR")C on C."CardCode" = A."CardCode"
        Left join(select A."DocEntry",A."ItemCode",C."ItmsGrpNam"
                  from "BKI_LIVE"."POR1" A
                  Left Join "BKI_LIVE"."OITM" B on B."ItemCode" = A."ItemCode"
                  Left Join "BKI_LIVE"."OITB" C on C."ItmsGrpCod" = B."ItmsGrpCod"
        )D on D."DocEntry" = C."DocEntry"
        where C."CardCode" is not null;')->result_array();
    }

    public function bp_terpilih($mulai, $hingga)
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct C."CardCode", 
        TO_VARCHAR (TO_DATE(C."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
        TO_VARCHAR (left(monthname(TO_DATE(C."DocDate")),3)) || ' . "'.'" . ' ||
        TO_VARCHAR (year(TO_DATE(C."DocDate"))) as "DocDate", A."CardName", D."Address", B."Name" as "Country", A."Phone1", A."CntctPrsn", A."Notes", A."E_Mail"
        from "BKI_LIVE"."OCRD" A
        left join "BKI_LIVE"."OCRY" B on B."Code" = A."Country"
        left join (
            SELECT "DocEntry", "CardCode", "DocDate"
            FROM "BKI_LIVE"."OPOR") C ON C."CardCode" = A."CardCode"
        left join (
	        select "Address", "CardCode" 
	        from "BKI_LIVE"."OCPR") D ON D."CardCode" = A."CardCode" 
        WHERE "DocDate" between ' . "'$mulai'" . ' and ' . "'$hingga'" . ' AND C."CardCode" IS NOT NULL AND "frozenFor" = ' . "'N'" . ' and A."CardType" = ' . "'S'" . '
        ORDER BY A."CardName";')->result_array();
    }

    public function bp_detail_terpilih()
    {
        $hanadb = $this->load->database('hana', TRUE);
        return $hanadb->query('select distinct A."CardCode",
        TO_VARCHAR (TO_DATE(A."DocDate"), ' . "'DD'" . ') || ' . "'.'" . ' ||
        TO_VARCHAR (left(monthname(TO_DATE(A."DocDate")),3)) || ' . "'.'" . ' ||
        TO_VARCHAR (year(TO_DATE(A."DocDate"))) as "DocDate", D."ItmsGrpNam", A."CardName"
        from "BKI_LIVE"."OPOR" A
        left join (select "DocEntry", "ItemCode" from "BKI_LIVE"."POR1") B on B."DocEntry" = A."DocEntry"
        left join (select "ItemCode", "ItmsGrpCod" from "BKI_LIVE"."OITM") C on C."ItemCode" = B."ItemCode"
        left join (select "ItmsGrpCod", "ItmsGrpNam" from "BKI_LIVE"."OITB") D on D."ItmsGrpCod" = C."ItmsGrpCod"
        where A."CardCode" is not null')->result_array();
    }
}
