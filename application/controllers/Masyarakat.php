<?php
class Masyarakat extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_masyarakat', 'masyarakat');
		$this->load->model('M_desa', 'desa');
		$this->load->model('M_akun', 'akun');
        $this->load->model('M_cek', 'cek');
	}

	public function index()
	{
		$data['title'] = 'Data masyarakat';
		$data['data'] = $this->masyarakat->lihat_masyarakat();
		$this->load->view('komponen/head', $data);
		$this->load->view('komponen/menu');
		$this->load->view('admin/masyarakat/index');
		$this->load->view('komponen/footer');
	}

   

	public function tambah_masyarakat()
    {
        $data['desa'] = $this->desa->lihat_desa();
        $data['akun'] = $this->akun->lihat_akun();
        $data['title'] = 'Form Data masyarakat';
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/masyarakat/tambah_masyarakat');
        $this->load->view('komponen/footer');
    }


    public function proses_tambah_masyarakat()
    {
        $karakter = 'abcdefghijklmnopqrst1234567890';
        $data1 = substr(str_shuffle($karakter), 0, 10);

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './file/assets/'; //string, the default is application/cache/
        $config['errorlog']     = './file/assets/'; //string, the default is application/logs/
        $config['imagedir']     = './file/barcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $no_kk=$_POST['no_kk'].'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $data1; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$no_kk; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params);

        // $kode = $this->akun->ambil_kode();
        // $max = $kode->no_urut + 1;
        $data = array(            
            'id_akun' => '',
            'username' => $_POST['no_kk'],
            'password' => md5($_POST['no_kk']),
            'level' => 'Masyarakat',
            'status' => 'Aktif',
        );
        $masyarakat = array(
            'no_kk' => $_POST['no_kk'],     
            'nama_kepala' => $_POST['nama_kepala'],
            'id_barcode' => $data1,
            'file_barcode' => $no_kk,
            'alamat' => $_POST['alamat'],
            'id_desa' => $_POST['id_desa'],
            'rt' => $_POST['rt']
        );
        $sql = $this->cek->cek_data_masyarakat($_POST['no_kk']);
        $cek = $sql->num_rows();
        if($cek > 0)
        {
            $this->session->set_flashdata('status', ['type' => 'warning', 'message' => 'Data Sudah Ada']);redirect('masyarakat/tambah_masyarakat');
        } else {
            if ($this->masyarakat->proses_tambah_masyarakat($data, $masyarakat)) {
                $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
            } else {
                $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
            }
            redirect('masyarakat/');
            }
       
    }


    public function edit_masyarakat($no_kk)
    {
        $data['desa'] = $this->desa->lihat_desa();
        $data['akun'] = $this->akun->lihat_akun();
        $data['title'] = 'Form Data masyarakat';
        $data['data'] = $this->masyarakat->lihat_masyarakat(decrypt_url($no_kk));
        $this->load->view('komponen/head', $data);
        $this->load->view('komponen/menu');
        $this->load->view('admin/masyarakat/edit_masyarakat');
        $this->load->view('komponen/footer');
    }

    public function proses_edit_masyarakat()
    {
        $karakter = 'abcdefghijklmnopqrst1234567890';
        $data1 = substr(str_shuffle($karakter), 0, 5);

        $this->load->library('ciqrcode'); //pemanggilan library QR CODE

        $config['cacheable']    = true; //boolean, the default is true
        $config['cachedir']     = './file/assets/'; //string, the default is application/cache/
        $config['errorlog']     = './file/assets/'; //string, the default is application/logs/
        $config['imagedir']     = './file/barcode/'; //direktori penyimpanan qr code
        $config['quality']      = true; //boolean, the default is true
        $config['size']         = '1024'; //interger, the default is 1024
        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);

        $no_kk=$_POST['no_kk'].'.png'; //buat name dari qr code sesuai dengan nim

        $params['data'] = $data1; //data yang akan di jadikan QR CODE
        $params['level'] = 'H'; //H=High
        $params['size'] = 10;
        $params['savename'] = FCPATH.$config['imagedir'].$no_kk; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params);


         $data = array(            
            'id_akun' => '',
            'username' => $_POST['no_kk'],
            'password' => md5($_POST['no_kk']),
            'level' => 'Admin',
            'status' => 'Aktif',
        );
        $masyarakat = array(
            'no_kk' => $_POST['no_kk'],     
            'nama_kepala' => $_POST['nama_kepala'],
            'alamat' => $_POST['alamat'],
            'id_desa' => $_POST['id_desa'],
            'rt' => $_POST['rt'],
            'id_barcode' => $data1,
            'alamat' => $_POST['alamat'],
        );
        $id_akun = $_POST['id_akun'];
        $no_kk = $_POST['no_kk_lama'];

        if ($this->masyarakat->proses_edit_masyarakat($data, $id_akun,$masyarakat,$no_kk)) {
            $this->session->set_flashdata('status', ['type' => 'success', 'message' => 'Data Berhasil Disimpan']);
        } else {
            $this->session->set_flashdata('status', ['type' => 'error', 'message' => 'Data Gagal Disimpan']);
        }
        redirect('masyarakat/');
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