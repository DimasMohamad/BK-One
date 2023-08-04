<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function index()
	{
		$this->load->view('auth');
	}

	public function auth()
	{
		$nama = $this->input->post('username');
		$pass = $this->input->post('sandi');
		$cari = $this->db->get_where('tb_user', array('nama' => $nama, 'sts' => '1'))->row_array();

		if (password_verify($pass, $cari['sandi'])) {
			if (isset($cari['id_user'])) {
				$sesi = array('id_user' => $cari['id_user'], 'nama_user' => $nama);
				$this->session->set_userdata($sesi);
				echo $cari['id_user'];
			} else {
				echo "0";
			}
		} else {
			echo "0";
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_user');
		redirect('Welcome');
	}
}
