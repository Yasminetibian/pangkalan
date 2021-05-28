<?php
class Petugas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_petugas', 'petugas');
        $this->load->model('M_desa', 'desa');
        $this->load->model('M_akun', 'akun');
    }

    public function index()
    {
        $data['title'] = 'Data petugas';
        $data['data'] = $this->petugas->lihat_petugas();
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/petugas/index');
        $this->load->view('komponen/footer');
    }

    public function tambah_petugas()
    {
        $data['desa'] = $this->desa->lihat_desa();
        $data['akun'] = $this->akun->lihat_akun();
        $data['title'] = 'Form Data petugas';
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/petugas/tambah_petugas');
        $this->load->view('komponen/footer');
    }

    public function proses_tambah_petugas()
    {
        // $kode = $this->akun->ambil_kode();
        // $max = $kode->no_urut + 1;
        $data = array(            
            'id_akun' => '',
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
            'level' => 'Admin',
            'status' => 'Aktif',
        );
        $petugas = array(
            'id_petugas' => $_POST[''],     
            'nama_petugas' => $_POST['nama_petugas'],
            'id_desa' => $_POST['id_desa'],
        );

        if ($this->petugas->proses_tambah_petugas($data,$petugas)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('petugas/');
    }


    public function edit_petugas($id_petugas)
    {
        $data['desa'] = $this->desa->lihat_desa();
        $data['akun'] = $this->akun->lihat_akun();
        $data['title'] = 'Form Data petugas';
        $data['data'] = $this->petugas->lihat_petugas(decrypt_url($id_petugas));
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/petugas/edit_petugas');
        $this->load->view('komponen/footer');
    }

    public function proses_edit_petugas()
    {
          $data = array(            
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
            'level' => 'Admin',
            'status' => 'Aktif',
        );
        $petugas = array(
            'id_petugas' => $_POST['id_petugas'],     
            'nama_petugas' => $_POST['nama_petugas'],
            'id_desa' => $_POST['id_desa'],
        );
        $id_akun = $_POST['id_akun'];
        $id_petugas = $_POST['id_petugas'];
        if ($this->petugas->proses_edit_petugas($data, $id_akun,$petugas,$id_petugas)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('petugas/');
    }

    public function hapus_petugas()
    {
        $id_petugas = $_GET['id'];
        $data = $this->petugas->lihat_petugas($id_petugas);
        $id_akun = $data->id_akun;
        if ($this->petugas->hapus_petugas($id_akun,$id_petugas)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Dihapus']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Dihapus']);
        }
        redirect('petugas/');
    }
 }