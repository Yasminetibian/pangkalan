<?php
class Desa extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_desa', 'desa');
		// $this->load->model('M_pengguna', 'pengguna');
		// $this->load->model('M_menu', 'menu');
	}

	public function index()
	{
		$data['title'] = 'Data desa';
		$data['data'] = $this->desa->lihat_desa();
		$this->load->view('komponen/head', $data);
		$this->load->view('komponen/menu');
		$this->load->view('admin/desa/index');
		$this->load->view('komponen/footer');
	}

	public function tambah_desa()
    {
        $data['title'] = 'Form Data desa';
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/desa/tambah_desa');
        $this->load->view('komponen/footer');
    }

    public function proses_tambah_desa()
    {
        $desa = array(
            'id_desa' => '',
            'desa' => $_POST['desa'],
        );
        

        if ($this->desa->proses_tambah_desa($desa)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('desa/');
    }


    public function edit_desa($id_desa)
    {
        $data['title'] = 'Form Data desa';
        $data['data'] = $this->desa->lihat_desa(decrypt_url($id_desa));
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/desa/edit_desa');
        $this->load->view('komponen/footer');
    }

    public function proses_edit_desa()
    {
        $data = array(        
            'desa' => $_POST['desa'],
        );
        $id_desa = $_POST['id_desa'];
        if ($this->desa->proses_edit_desa($data, $id_desa)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('desa/');
    }

    public function hapus_desa()
    {
        $id_desa = $_GET['id'];
        if ($this->desa->hapus_desa($id_desa)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Dihapus']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Dihapus']);
        }
        redirect('desa/');
    }
 }