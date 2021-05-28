<?php 
class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$this->load->view('komponen/head',$data);
		$this->load->view('komponen/menu');
		$this->load->view('admin/dashboard/index');
		$this->load->view('komponen/footer');
	}
}


?>