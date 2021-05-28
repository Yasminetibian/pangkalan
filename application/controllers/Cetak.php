<?php
class Cetak extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_masyarakat', 'masyarakat');
		// $this->load->model('M_pengguna', 'pengguna');
		// $this->load->model('M_menu', 'menu');
	}

	public function index($no_kk)
	{
		//$data['title'] = 'Data Akun';
		//$data['data'] = $this->akun->lihat_akun();
		//$this->load->view('komponen/head');
		//$this->load->view('komponen/menu');
		$data['key'] = $this->masyarakat->lihat_masyarakat(decrypt_url($no_kk));
		$this->load->view('admin/cetak/cetak', $data);
		//$this->load->view('komponen/footer');
		// print_r($data);
	}

 }