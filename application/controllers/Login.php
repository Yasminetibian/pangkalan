<?php 
class Login extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_login', 'login');
	}

	public function index()
	{
		$this->load->view('index');
	}

	public function proses_login()
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);
		$sql = $this->login->proses_login($username,$password);
		$cek = $sql->num_rows();
		if($cek > 0){
			$dt = $sql->row();
			if($dt->level =='Admin'){
				$data = array(
					'id_akun' => $dt->id_akun,
					'status' => 'Login',
					'level' => $dt->level
				);
				$this->session->set_userdata($data);
				$this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Anda Berhasil Login']);
				redirect('dashboard/');
			}elseif ($dt->level =='Admin') {
				# code...
			}else{
				$this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Username atau password salah !!']);
				redirect('login');
			}
			
		}else{
			$this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Username atau password salah !!']);
			redirect('login');
		}
	}


	public function forget_password()
	{
		$this->load->view('forget_password');
	}

	public function logout()
	{
		$this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Anda Berhasil Logout']);
		redirect('login');
		$this->session->sess_destroy();
	}
}


?>
