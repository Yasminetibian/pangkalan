<?php
class Akun extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_akun', 'akun');
		// $this->load->model('M_pengguna', 'pengguna');
		// $this->load->model('M_menu', 'menu');
	}

	public function index()
	{
		$data['title'] = 'Data Akun';
		$data['data'] = $this->akun->lihat_akun();
		$this->load->view('komponen/head', $data);
		$this->load->view('komponen/menu');
		$this->load->view('admin/akun/index');
		$this->load->view('komponen/footer');
	}

	public function tambah_akun()
    {
        $data['title'] = 'Form Data Akun';
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/akun/tambah_akun');
        $this->load->view('komponen/footer');
    }

    public function proses_tambah_akun()
    {
        $akun = array(
            'id_akun' => '',
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
            'level' => $_POST['level'],
            'status' => $_POST['status']
        );
        

        if ($this->akun->proses_tambah_akun($akun)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('akun/');
    }


    public function edit_akun($id_akun)
    {
        $data['title'] = 'Form Data akun';
        $data['data'] = $this->akun->lihat_akun(decrypt_url($id_akun));
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/akun/edit_akun');
        $this->load->view('komponen/footer');
    }

    public function proses_edit_akun()
    {
        $data = array(        
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
            'level' => $_POST['level'],
            'status' => $_POST['status']
        );
        $id_akun = $_POST['id_akun'];
        if ($this->akun->proses_edit_akun($data, $id_akun)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('akun/');
    }

    public function hapus_akun()
    {
        $id_akun = $_GET['id'];
        if ($this->akun->hapus_akun($id_akun)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Dihapus']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Dihapus']);
        }
        redirect('akun/');
    }
 }