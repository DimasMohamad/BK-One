<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_whse extends CI_Model
{
    private $database_name = "BKI_2024";
    public function __construct()
    {
        parent::__construct();
    }

    #################################AFTERSTORM#################################

    public function get_master_stok()
    {
        return $this->db->query("SELECT * FROM tb_kartu_stok_bb UNION ALL SELECT * FROM tb_kartu_stok_bp;")->result_array();
    }

    public function get_union_kartu_stok()
    {
        // Query database untuk mengambil data dari kedua tabel
        $query = $this->db->query("SELECT * FROM tb_kartu_stok_bb UNION ALL SELECT * FROM tb_kartu_stok_bp");
        return $query->result(); // Mengembalikan hasil query
    }

    public function get_item_code()
    {
        return $this->db->query("SELECT * FROM tb_item_code;")->result_array();
    }

    public function get_position($sesi)
    {
        return $this->db->query("SELECT position1 FROM tb_user WHERE id_user = $sesi;")->result_array();
    }
}
