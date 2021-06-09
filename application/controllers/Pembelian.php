<?php
class Pembelian extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_pembelian', 'pembelian');
		$this->load->model('M_pangkalan', 'pangkalan');
		$this->load->model('M_masyarakat', 'masyarakat');
        $this->load->model('M_desa', 'desa');

	}

	public function index()
	{
		$data['title'] = 'Data pembelian';
		$data['data'] = $this->pembelian->lihat_pembelian();
		$this->load->view('komponen/head', $data);
		$this->load->view('komponen/menu');
		$this->load->view('admin/pembelian/index');
		$this->load->view('komponen/footer');
	}

	public function tambah_pembelian()
    {
        $data['desa'] = $this->desa->lihat_desa();
        $data['masyarakat'] = $this->masyarakat->lihat_masyarakat();
        $data['pangkalan'] = $this->pangkalan->lihat_pangkalan();
        $data['title'] = 'Form Data pembelian';
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/pembelian/tambah_pembelian');
        $this->load->view('komponen/footer');
    }

    public function proses_tambah_pembelian()
    {
        $pembelian = array(
            'id_pembelian' => '',
            'tgl_pembelian' => $_POST['tgl_pembelian'],
            'id_pangkalan' => $_POST['id_pangkalan'],
            'no_kk' => $_POST['no_kk'], );
        if ($this->pembelian->proses_tambah_pembelian($pembelian)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('pembelian/');
    }


    public function edit_pembelian($id_pembelian)
    {
        $data['desa'] = $this->desa->lihat_desa();
        $data['masyarakat'] = $this->masyarakat->lihat_masyarakat();
        $data['pangkalan'] = $this->pangkalan->lihat_pangkalan();
        $data['title'] = 'Form Data pembelian';
        $data['data'] = $this->pembelian->lihat_pembelian(decrypt_url($id_pembelian));
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/pembelian/edit_pembelian');
        $this->load->view('komponen/footer');
    }

    public function proses_edit_pembelian()
    {
        $data = array(        
            'id_pembelian' => '',
            'tgl_pembelian' => $_POST['tgl_pembelian'],
            'id_pangkalan' => $_POST['id_pangkalan'],
            'no_kk' => $_POST['no_kk']
        );
        $id_pembelian = $_POST['id_pembelian'];
        if ($this->pembelian->proses_edit_pembelian($data, $id_pembelian)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('pembelian/');
    }

    public function hapus_pembelian()
    {
        $id_pembelian = $_GET['id'];
        if ($this->pembelian->hapus_pembelian($id_pembelian)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Dihapus']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Dihapus']);
        }
        redirect('pembelian/');
    }

 }