<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function tb_akses($iduser)
    {
        return $this->db->query("SELECT A.id_menu,A.menu,A.sts,ifnull(B.id_sub_menu,0) AS id_sub_menu,ifnull(B.sub_menu,0) AS sub_menu,ifnull(C.id_akses,0) AS id_akses
        FROM tb_menu A
        LEFT JOIN tb_sub_menu B ON B.id_menu = A.id_menu
        LEFT JOIN (select id_akses,id_sub_menu from tb_akses WHERE id_user = $iduser) C ON C.id_sub_menu = B.id_sub_menu
        ORDER BY A.id_menu,B.id_sub_menu,C.id_akses;")->result_array();
    }

    public function get_akses($idsubmenu)
    {
        $id = $this->session->id_user;
        return $this->db->query("SELECT count(id_akses) AS akses FROM tb_akses WHERE id_user = $id and id_sub_menu = $idsubmenu;")->row_array();
    }

    public function get_filter_posisi()
    {
        return $this->db->query('SELECT posisi from posisi;')->result_array();
    }
}
