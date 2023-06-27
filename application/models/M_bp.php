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
        where C."CardCode" is not null and A."CardType" = '."'S'".' order by A."CardName";')->result_array();
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
}