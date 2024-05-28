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
        return $this->db->query("SELECT * FROM tb_master_stok;")->result_array();
    }
}
