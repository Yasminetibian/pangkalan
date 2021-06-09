<?php
class Pangkalan extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_pangkalan', 'pangkalan');
		$this->load->model('M_pemilik', 'pemilik');
		$this->load->model('M_akun', 'akun');
        $this->load->model('M_desa', 'desa');
	}

	public function index()
	{
		$data['title'] = 'Data pangkalan';
		$data['data'] = $this->pangkalan->lihat_pangkalan();
		$this->load->view('komponen/head', $data);
		$this->load->view('komponen/menu');
		$this->load->view('admin/pangkalan/index');
		$this->load->view('komponen/footer');
	}

     public function getpangkalan()
    {
        $data['title'] = 'Data Pangkalan';
        $data['data1'] = $this->pangkalan->getpangkalan();
        //$data['data'] = $this->pangkalan->getpangkalan()->result();
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/pangkalan/indexpangkalan');
        $this->load->view('komponen/footer');
    }

	public function tambah_pangkalan()
    {
        $data['desa'] = $this->desa->lihat_desa();
        $data['akun'] = $this->akun->lihat_akun();
        $data['pemilik'] = $this->pemilik->lihat_pemilik();
        $data['title'] = 'Form Data pangkalan';
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/pangkalan/tambah_pangkalan');
        $this->load->view('komponen/footer');
    }

    public function proses_tambah_pangkalan()
    {
        $pangkalan = array(
            'id_pangkalan' => '',
            'nama_pangkalan' => $_POST['nama_pangkalan'],
            'alamat_pangkalan' => $_POST['alamat_pangkalan'],
            'no_telp_pangkalan' => $_POST['no_telp_pangkalan'],
            'penangung_jawab' => $_POST['penangung_jawab'],
            'id_pemilik' => $_POST['id_pemilik'],
            'id_akun' => $_POST['id_akun'],
            'id_desa' => $_POST['id_desa']
        );
        if ($this->pangkalan->proses_tambah_pangkalan($pangkalan)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('pangkalan/');
    }


    public function edit_pangkalan($id_pangkalan)
    {
        $data['desa'] = $this->desa->lihat_desa();
        $data['akun'] = $this->akun->lihat_akun();
        $data['pemilik'] = $this->pemilik->lihat_pemilik();
        $data['title'] = 'Form Data pangkalan';
        $data['data'] = $this->pangkalan->lihat_pangkalan(decrypt_url($id_pangkalan));
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/pangkalan/edit_pangkalan');
        $this->load->view('komponen/footer');
    }

    public function proses_edit_pangkalan()
    {
        $data = array(        
            //'id_pangkalan' => '',
            'nama_pangkalan' => $_POST['nama_pangkalan'],
            'alamat_pangkalan' => $_POST['alamat_pangkalan'],
            'no_telp_pangkalan' => $_POST['no_telp_pangkalan'],
            'penangung_jawab' => $_POST['penangung_jawab'],
            'id_pemilik' => $_POST['id_pemilik'],
            'id_akun' => $_POST['id_akun'],
            'id_desa' => $_POST['id_desa']
        );
        $id_pangkalan = $_POST['id_pangkalan'];
        if ($this->pangkalan->proses_edit_pangkalan($data, $id_pangkalan)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('pangkalan/');
    }

    public function hapus_pangkalan()
    {
        $id_pangkalan = $_GET['id'];
        if ($this->pangkalan->hapus_pangkalan($id_pangkalan)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Dihapus']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Dihapus']);
        }
        redirect('pangkalan/');
    }
 }