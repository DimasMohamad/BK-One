<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_marketing extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function data(){
        return $this->db->query("Select * FROM recall;")->result_array();
    }

    public function Recall($id)
	{
		return $this->db->query("SELECT * FROM recall WHERE rowid = $id;")->row_array();
    }

}