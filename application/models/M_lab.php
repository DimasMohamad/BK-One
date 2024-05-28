<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_lab extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tampil_spek()
    {
        return $this->db->query("Select * FROM tb_lab_spek;")->result_array();
    }
}
