<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_legal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data_legalitas()
    {
        return $this->db->query("Select * FROM tb_legalitas;")->result_array();
    }

    public function data_administrasi()
    {
        return $this->db->query("Select * FROM tb_administrasi_legal;")->result_array();
    }
}
