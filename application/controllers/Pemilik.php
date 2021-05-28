<?php
class Pemilik extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_pemilik', 'pemilik');
		// $this->load->model('M_pengguna', 'pengguna');
		// $this->load->model('M_menu', 'menu');
	}

	public function index()
	{
		$data['title'] = 'Data pemilik';
		$data['data'] = $this->pemilik->lihat_pemilik();
		$this->load->view('komponen/head', $data);
		$this->load->view('komponen/menu');
		$this->load->view('admin/pemilik/index');
		$this->load->view('komponen/footer');
	}

	public function tambah_pemilik()
    {
        $data['title'] = 'Form Data pemilik';
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/pemilik/tambah_pemilik');
        $this->load->view('komponen/footer');
    }

    public function proses_tambah_pemilik()
    {
        $pemilik = array(
            'id_pemilik' => '',
            'nama_pemilik' => $_POST['nama_pemilik'],
            'alamat_pemilik' => $_POST['alamat_pemilik'],
            'no_telp_pemilik' => $_POST['no_telp_pemilik']
        );
        

        if ($this->pemilik->proses_tambah_pemilik($pemilik)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('pemilik/');
    }


    public function edit_pemilik($id_pemilik)
    {
        $data['title'] = 'Form Data pemilik';
        $data['data'] = $this->pemilik->lihat_pemilik(decrypt_url($id_pemilik));
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/pemilik/edit_pemilik');
        $this->load->view('komponen/footer');
    }

    public function proses_edit_pemilik()
    {
        $data = array(        
            'nama_pemilik' => $_POST['nama_pemilik'],
            'alamat_pemilik' =>$_POST['alamat_pemilik'],
            'no_telp_pemilik' => $_POST['no_telp_pemilik']
        );
        $id_pemilik = $_POST['id_pemilik'];
        if ($this->pemilik->proses_edit_pemilik($data, $id_pemilik)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('pemilik/');
    }

    public function hapus_pemilik()
    {
        $id_pemilik = $_GET['id'];
        if ($this->pemilik->hapus_pemilik($id_pemilik)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Dihapus']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Dihapus']);
        }
        redirect('pemilik/');
    }
 }