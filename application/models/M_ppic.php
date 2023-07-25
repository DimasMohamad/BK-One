<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_ppic extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tb_list_module($s,$e)
    {
        $addondb = $this->load->database('addon', TRUE);
        return $addondb->query("select 
        a.id, 
        f.voucher_no, 
        f.reference_no, 
        DATE_FORMAT(f.order_date, '%d %b %Y') AS order_date,
        g.code, 
        g.name, 
        DATE_FORMAT(f.due_date, '%d %b %Y') AS due_date, 
        b.item_no, 
        b.description, 
        a.qty_order as qty, 
        a.qty_buffer, 
        a.our_bom_id, 
        a.our_line_id, 
        c.name as our_bom_name, 
        d.name as our_line_name, 
        f.id as orders_id, 
        a.voucher_no as production_order_no, 
        a.production as po_no, 
        d.speed,
        H.uom 
        from our_productions as a 
        inner join our_items as b on a.our_item_id = b.id 
        left join our_bom as c on a.our_bom_id = c.id 
        left join our_lines as d on a.our_line_id = d.id 
        left join our_order_productions as h on h.our_productions_id = IFNULL(a.source_id, a.id) 
        left join our_orders_detail as e on e.id = h.our_orders_detail_id 
        left join our_orders as f on e.our_order_id = f.id 
        left join our_customers as g on f.customer_id = g.id 
        LEFT JOIN(SELECT item_no,uom FROM our_items)H ON H.item_no = B.item_no
        where a.trans_date BETWEEN '$s' AND '$e' 
        and a.our_line_id is null and a.status not IN ('Finished', 'Cancelled') order by a.trans_date asc;")->result_array();
    }

    public function tb_spk_head($idspk)
    {
        $addondb = $this->load->database('addon', TRUE);
        return $addondb->query("SELECT 
        tb_spk.id_spk,
        B.voucher_no AS spk,
        B.production,
        B.qty_order,
        B.qty_buffer,
        B.qty_prod,
        B.our_bom_id,
        C.group_name,
        C.item_no,
        C.DESCRIPTION,
        C.uom,
        D.name AS mesin,
        D.speed AS speed_mesin,
        B.STATUS,
        DATE_FORMAT(B.start_date, '%d %b %Y') AS start_date,
        DATE_FORMAT(B.end_date, '%d %b %Y') AS end_date
        FROM (
        WITH RECURSIVE spk AS (
          SELECT id, parent_id
          FROM our_productions
          WHERE parent_id = $idspk
          UNION ALL
          SELECT a.id, a.parent_id
          FROM our_productions a
          INNER JOIN spk ah ON a.parent_id = ah.id
        )
        SELECT parent_id AS id_spk,id AS id_anggota
        FROM spk
        UNION All
        SELECT max(id) AS id_spk, 0 as id_anggota FROM spk
        ) AS tb_spk
        LEFT JOIN our_productions B ON B.id = tb_spk.id_spk
        LEFT JOIN our_items C ON C.id = B.our_item_id
        LEFT JOIN our_lines D ON D.id = B.our_line_id;")->result_array();
    }

    public function tb_spk_head_item($idspk)
    {
        $addondb = $this->load->database('addon', TRUE);
        return $addondb->query("SELECT 
        tb_spk.id_spk,
        B.our_bom_id,
        D.item_no,
        D.DESCRIPTION,
        C.qty,
        D.uom
        FROM (
        WITH RECURSIVE spk AS (
          SELECT id, parent_id
          FROM our_productions
          WHERE parent_id = $idspk
          UNION ALL
          SELECT a.id, a.parent_id
          FROM our_productions a
          INNER JOIN spk ah ON a.parent_id = ah.id
        )
        SELECT parent_id AS id_spk 
        FROM spk
        UNION All
        SELECT max(id) AS id_spk FROM spk
        ) AS tb_spk
        LEFT JOIN our_productions B ON B.id = tb_spk.id_spk
        LEFT JOIN(SELECT our_bom_id,our_item_id,qty FROM our_bom_raw)C ON C.our_bom_id = B.our_bom_id
        LEFT JOIN(SELECT id,item_no,group_name,DESCRIPTION,uom FROM our_items)D ON D.id = C.our_item_id;")->result_array();
    }

    public function tb_spk_list($s,$e)
    {
        $addondb = $this->load->database('addon', TRUE);
        return $addondb->query("SELECT distinct
        A.id AS id_spk,
        A.voucher_no AS spk,
        A.parent_id,
        B.id_spk_detail,
        ifnull(B.spk_detail,'-') AS spk_detail,
        ifnull(A.production,'-') AS production,
        E.mesin,        
        A.our_bom_id,
        D.item_no,
        D.DESCRIPTION,
        A.qty_order,
        A.qty_buffer,
        A.qty_prod,
        D.uom,
        A.STATUS,
        DATE_FORMAT(A.start_date, '%d %b %Y') AS start_date,
        DATE_FORMAT(A.end_date, '%d %b %Y') AS end_date
        from our_productions A
        LEFT Join(SELECT id AS id_spk_detail,voucher_no AS spk_detail,parent_id from our_productions)B ON B.parent_id = A.id        
        LEFT JOIN(SELECT id,item_no,group_name,DESCRIPTION,uom FROM our_items)D ON D.id = A.our_item_id
        LEFT JOIN(SELECT id,NAME AS mesin,speed FROM our_lines)E ON E.id = A.our_line_id
        WHERE A.our_line_id IS NOT NULL AND date(A.created_at) BETWEEN '$s' AND '$e' 
        order BY A.voucher_no DESC;")->result_array();
    }

    public function tb_spk_list_2($s,$e)
    {
        $addondb = $this->load->database('addon', TRUE);
        return $addondb->query("SELECT row_number() over (order by A.voucher_no DESC) as rowid,
        A.id AS id_spk,
        A.voucher_no AS spk,
        DATE_FORMAT(A.created_at, '%d %b %Y') AS created_date,
        A.parent_id,
        B.id_spk_detail,
        ifnull(B.spk_detail,'-') AS spk_detail,
        ifnull(A.production,'-') AS production,
        E.mesin,        
        A.our_bom_id,
        D.item_no,
        D.DESCRIPTION,
        A.qty_order,
        A.qty_buffer,
        A.qty_prod,
        D.uom,
        A.STATUS,
        DATE_FORMAT(A.start_date, '%d %b %Y') AS start_date,
        DATE_FORMAT(A.end_date, '%d %b %Y') AS end_date
        from our_productions A
        LEFT Join(SELECT id AS id_spk_detail,voucher_no AS spk_detail,parent_id from our_productions)B ON B.parent_id = A.id        
        LEFT JOIN(SELECT id,item_no,group_name,DESCRIPTION,uom FROM our_items)D ON D.id = A.our_item_id
        LEFT JOIN(SELECT id,NAME AS mesin,speed FROM our_lines)E ON E.id = A.our_line_id
        WHERE A.our_line_id IS NOT NULL AND date(A.created_at) BETWEEN '$s' AND '$e' AND D.uom = 'Carton'
        order BY A.voucher_no DESC;")->result_array();
    }

    public function tb_spk_head_item_2($idspk)
    {
        $addondb = $this->load->database('addon', TRUE);
        return $addondb->query("SELECT 
        tb_spk.id_spk,
        B.voucher_no AS spk,
        DATE_FORMAT(B.created_at, '%d %b %Y') AS created_date,
        B.production,
        B.qty_order,
        B.qty_buffer,
        B.qty_prod,
        B.our_bom_id,
        C.group_name,
        C.item_no,
        C.DESCRIPTION,
        C.uom,
        D.name AS mesin,
        D.speed AS speed_mesin,
        B.STATUS,
        DATE_FORMAT(B.start_date, '%d %b %Y') AS start_date,
        DATE_FORMAT(B.end_date, '%d %b %Y') AS end_date
        FROM (
        WITH RECURSIVE spk AS (
          SELECT id, parent_id
          FROM our_productions
          WHERE parent_id = $idspk
          UNION ALL
          SELECT a.id, a.parent_id
          FROM our_productions a
          INNER JOIN spk ah ON a.parent_id = ah.id
        )
        SELECT parent_id AS id_spk,id AS id_anggota
        FROM spk
        UNION All
        SELECT max(id) AS id_spk, 0 as id_anggota FROM spk
        ) AS tb_spk
        LEFT JOIN our_productions B ON B.id = tb_spk.id_spk
        LEFT JOIN our_items C ON C.id = B.our_item_id
        LEFT JOIN our_lines D ON D.id = B.our_line_id
		  WHERE C.uom <> 'Carton';")->result_array();
    }
}