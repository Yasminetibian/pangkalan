<?php
class Ppat extends CI_Controller
{
    function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
        $this->load->model('M_admin','adm');
        $this->load->model('M_pembayaran','bayar');
        $this->load->model('M_ppat','ppat');
		$this->load->model('Kode', 'kd');
        $this->load->helper('nominal_helper');

    }

    public function index()
    {
        
		$data['pengumuman'] = $this->adm->lihat_pengumuman();
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/V_home');
        $this->load->view('footer');
    }


    public function lihat_pendaftaran()
    {
        $data['data'] = $this->ppat->lihat_pendaftaran();
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/Pendaftaran/V_pendaftaran');
        $this->load->view('footer');
    }

    public function detail_pendaftaran($no_pendaftaran)
    {
        $data['data'] = $this->adm->get_pendaftaran($no_pendaftaran);
		$data['periksa'] = $this->adm->pemeriksa($no_pendaftaran);
        $data['dt'] = $this->adm->lihat_penolakan($no_pendaftaran);
        $data['sppt'] = $this->adm->ambil_data($no_pendaftaran);
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/Pendaftaran/V_detail_pendaftaran');
        $this->load->view('footer');
    }

    public function tambah_pendaftaran()
    {
        $id_ppat = $this->session->userdata('id_ppat');
        $length = 10;
		$str = "";
	    $characters = array_merge( range('0','9'));
	    $max = count($characters) - 1;
	    for ($i = 0; $i < $length; $i++) {
	        $rand = mt_rand(0, $max);
	        $str  .= $characters[$rand];
	    }

	    $kode =$str;
        $data['no'] = $kode;
        $data['ppat'] = $this->adm->lihat_ppat($id_ppat);
        $data['provinsi'] = $this->adm->lihat_provinsi();
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/Pendaftaran/V_tambah_pendaftaran');
        $this->load->view('footer');
    }

    public function proses_tambah_pendaftaran()
    {
        $no_pendaftaran = $_POST['no_pendaftaran']; 
		$no_kk = $_POST['no_kk_pembeli'];
		$NIK = $_POST['nik_pembeli'];
		$nama_wp = $_POST['nama_pembeli'];

		$data = $NIK.$nama_wp.$no_kk.$no_pendaftaran.date('Y-m-d h:i:sa');

		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= './file/assets/'; //string, the default is application/cache/
		$config['errorlog']		= './file/assets/'; //string, the default is application/logs/
		$config['imagedir']		= './file/Barcode/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= '1024'; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$ttd=$nama_wp.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $data; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$ttd; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params);



		$data1 = $no_pendaftaran;
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= './file/assets/'; //string, the default is application/cache/
		$config['errorlog']		= './file/assets/'; //string, the default is application/logs/
		$config['imagedir']		= './file/Barcode/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= '1024'; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name=$no_pendaftaran.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $data1; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params);
        
        $con = array(
			'upload_path' => './file/persyaratan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

         );
         

        $this->load->library('upload', $con);
        
        if (!$this->upload->do_upload('ktp_pembeli')) {
           $ktp_pembeli = 'Tidak Ada Data';
        //    var_dump($this->upload->display_errors());

        } else {
            $result = $this->upload->data();
            $ktp_pembeli = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('ktp_penjual')) {
           $ktp_penjual = 'Tidak Ada Data';

        } else {
            $result = $this->upload->data();
            $ktp_penjual = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('sertifikat')) {
           $sertifikat = 'Tidak Ada Data';

        } else {
            $result = $this->upload->data();
            $sertifikat = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('kwitansi')) {
           $kwitansi = 'Tidak Ada Data';

        } else {
            $result = $this->upload->data();
            $kwitansi = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('foto_visual')) {
           $foto_visual = 'Tidak Ada Data';

        } else {
            $result = $this->upload->data();
            $foto_visual = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('foto_sppt')) {
           $foto_sppt = 'Tidak Ada Data';

        } else {
            $result = $this->upload->data();
            $foto_sppt = $result['file_name'];
        }


        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('warisan')) {
           $warisan = 'Tidak Ada Data';

        } else {
            $result = $this->upload->data();
            $warisan = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('kk')) {
           $kk = 'Tidak Ada Data';

        } else {
            $result = $this->upload->data();
            $kk = $result['file_name'];
        }

        $data = array(
            'no_pendaftaran' => $_POST['no_pendaftaran'] ,
            'kode_dokumen' => $image_name,
            'no_kk_pembeli' => $_POST['no_kk_pembeli'],
            'nik_pembeli' => $_POST['nik_pembeli'],
            'nama_pembeli' => $_POST['nama_pembeli'],
            'npwp_pembeli' => $_POST['npwp_pembeli'],
            'kd_kelurahan_pembeli' => $_POST['kd_kelurahan_pembeli'],
            'rw_pembeli' => $_POST['rw_pembeli'],
            'rt_pembeli' => $_POST['rt_pembeli'],
            'kd_pos_pembeli' => $_POST['kd_pos_pembeli'],
            'alamat_pembeli' => $_POST['alamat_pembeli'],
            'ibu_kandung_pembeli' => $_POST['ibu_kandung_pembeli'],
            'no_telpon_pembeli' => str_replace("_","",$_POST['no_telpon_pembeli']),
            'no_kk_penjual' => $_POST['no_kk_penjual'],
            'nik_penjual' => $_POST['nik_penjual'],
            'nama_penjual' => $_POST['nama_penjual'],
            'kd_kelurahan_penjual' => $_POST['kd_kelurahan_penjual'],
            'rw_penjual' => $_POST['rw_penjual'],
            'rt_penjual' => $_POST['rt_penjual'],
            'alamat_penjual' => $_POST['alamat_penjual'],
            'kd_pos_penjual' => $_POST['kd_pos_penjual'],
            'npwp_penjual' => $_POST['npwp_penjual'],
            'ibu_kandung_penjual' => $_POST['ibu_kandung_penjual'],
            'no_telpon_penjual' => str_replace("_","",$_POST['no_telpon_penjual']),
            'nop'  => $_POST['nop'],
            'kd_kelurahan_objek' => $_POST['kd_kelurahan_objek'],
            'rw_objek' => $_POST['rw_objek'],
            'rt_objek' => $_POST['rt_objek'],
            'letak_tanah_objek' => $_POST['letak_objek'],
            'luas_bumi' => str_replace(".","",$_POST['luas_bumi']),
            'luas_bng' => str_replace(".","",$_POST['luas_bng']),
            'njop_bumi' => str_replace(".","",$_POST['njop_bumi']),
            'njop_bng' => str_replace(".","",$_POST['njop_bng']),
            'njop_pbb' => str_replace(".","",$_POST['njop_pbb']),
            'luas_bumi_njop_bumi' => str_replace(".","",$_POST['luas_x_njop_bumi']),
            'luas_bng_njop_bng' => str_replace(".","",$_POST['luas_x_njop_bng']),
            'jenis_perolehan' => $_POST['jenis_perolehan'],
            'nilai_pasar' => str_replace(".","",$_POST['nilai_pasar']),
            'nomor_sertifikat' => $_POST['no_sertifikat'],
            'npop' => str_replace(".","",$_POST['npop']),
            'npoptkp' => str_replace(".","",$_POST['npoptkp']),
            'npopkp' => str_replace(".","",$_POST['npopkp']),
            'bea_terhutang' => str_replace(".","",$_POST['bea_terhutang']),
            'bea_dibayar' => str_replace(".","",$_POST['bea_dibayar']),
            'dengan_angka' => str_replace(".","",$_POST['dengan_angka']),
            'dengan_huruf' => $_POST['dengan_huruf'],
            'pph21' => str_replace(".","",$_POST['pph']),
            'status' => 'Verifikasi Petugas',
            'ttd_pemohon' => $ttd,
            'keterangan' => $_POST['keterangan'],
            'tgl_pendaftaran' => date('Y-m-d'),
            'tahun' => date('Y'),
            'foto_kk_penerima_hak' => $kk,
			'foto_ktp_pembeli' => $ktp_pembeli,
			'foto_ktp_penjual' => $ktp_penjual,
			'foto_surat_tanah' => $sertifikat,
			'foto_visual' => $foto_visual,
			'foto_sppt' => $foto_sppt,
			'file_surat_warisan' => $warisan,
            'kwitansi' => $kwitansi,
            'id_ppat' => $_POST['id_ppat'],
            'ket_pendaftaran' => 'Pendaftaran Baru'

        );
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
		$this->adm->proses_tambah_pendaftaran($data);
		$periksa = array(
			'id_periksa' => date('Y-m-d H:i:s'),
			'id_akun' => $this->session->userdata('akun'),
			'jabatan' => $this->session->userdata('level'),
			'nama' => $this->session->userdata('nama_user'),
			'no_pendaftaran' => $_POST['no_pendaftaran'],
			'tgl_konfirmasi' => date('Y-m-d')
		);
		$this->adm->periksa($periksa);
		echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='".base_url('Ppat/lihat_pendaftaran')."';</script>";
	}
	
	public function konfirmasi_pendaftaran($no_pendaftaran){
		$data = array(
			'status' =>"Verifikasi Petugas"
		);
		$this->adm->proses_konfirmasi_pendaftaran($data,$no_pendaftaran);
		$periksa = array(
			'id_periksa' => date('Y-m-d H:i:s'),
			'id_akun' => $this->session->userdata('akun'),
			'jabatan' => $this->session->userdata('level'),
			'nama' => $this->session->userdata('nama_user'),
			'no_pendaftaran' => $no_pendaftaran,
			'tgl_konfirmasi' => date('Y-m-d')
		);
		$this->adm->periksa($periksa);
		echo "<script language='javascript'>alert('Data Berhasil Dikonfirmasi'); document.location='".base_url('Ppat/lihat_pendaftaran')."';</script>";
	}

    public function edit_pendaftaran($no_pendaftaran)
    {
        $id_ppat = $this->session->userdata('id_ppat');
        $data['dta'] = $this->adm->edit_pendaftaran($no_pendaftaran);
        // echo "<pre>";
        // print_r($data['dta']);
        // echo "</pre>";
        $data['ppat'] = $this->adm->lihat_ppat($id_ppat);
        $data['provinsi'] = $this->adm->lihat_provinsi();
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/Pendaftaran/V_edit_pendaftaran');
        $this->load->view('footer');
    }

    public function proses_edit_pendaftaran()
    {
        $no_pendaftaran = $_POST['no_pendaftaran']; 
		$no_kk = $_POST['no_kk_pembeli'];
		$NIK = $_POST['nik_pembeli'];
		$nama_wp = $_POST['nama_pembeli'];

		$data = $NIK.$nama_wp.$no_kk.$no_pendaftaran.date('Y-m-d h:i:sa');

		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= './file/assets/'; //string, the default is application/cache/
		$config['errorlog']		= './file/assets/'; //string, the default is application/logs/
		$config['imagedir']		= './file/Barcode/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= '1024'; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$ttd=$nama_wp.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $data; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$ttd; //simpan image QR CODE ke folder assets/images/
		$this->ciqrcode->generate($params);
         
        $con = array(
			'upload_path' => './file/persyaratan/',
			'allowed_types' => 'jpg|png|jpeg|pdf'

         );
        $this->load->library('upload', $con);
        
        if (!$this->upload->do_upload('ktp_pembeli')) {
           $ktp_pembeli = $_POST['ktp_pembeli_lama'];
        //    var_dump($this->upload->display_errors());

        } else {
            $result = $this->upload->data();
            $ktp_pembeli = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('ktp_penjual')) {
           $ktp_penjual = $_POST['ktp_penjual_lama'];

        } else {
            $result = $this->upload->data();
            $ktp_penjual = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('sertifikat')) {
           $sertifikat = $_POST['sertifikat_lama'];

        } else {
            $result = $this->upload->data();
            $sertifikat = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('kwitansi')) {
           $kwitansi = $_POST['kwitansi_lama'];

        } else {
            $result = $this->upload->data();
            $kwitansi = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('foto_visual')) {
           $foto_visual = $_POST['foto_visul_lama'];

        } else {
            $result = $this->upload->data();
            $foto_visual = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('foto_sppt')) {
           $foto_sppt = $_POST['foto_sppt_lama'];

        } else {
            $result = $this->upload->data();
            $foto_sppt = $result['file_name'];
        }


        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('warisan')) {
           $warisan = $_POST['waris_lama'];

        } else {
            $result = $this->upload->data();
            $warisan = $result['file_name'];
        }

        $this->load->library('upload', $con);
        if (!$this->upload->do_upload('kk')) {
           $kk = $_POST['kk_lama'];

        } else {
            $result = $this->upload->data();
            $kk = $result['file_name'];
        }

        $data = array(
            'no_kk_pembeli' => $_POST['no_kk_pembeli'],
            'nik_pembeli' => $_POST['nik_pembeli'],
            'nama_pembeli' => $_POST['nama_pembeli'],
            'npwp_pembeli' => $_POST['npwp_pembeli'],
            'kd_kelurahan_pembeli' => $_POST['kd_kelurahan_pembeli'],
            'rw_pembeli' => $_POST['rw_pembeli'],
            'rt_pembeli' => $_POST['rt_pembeli'],
            'kd_pos_pembeli' => $_POST['kd_pos_pembeli'],
            'alamat_pembeli' => $_POST['alamat_pembeli'],
            'ibu_kandung_pembeli' => $_POST['ibu_kandung_pembeli'],
            'no_telpon_pembeli' => str_replace("_","",$_POST['no_telpon_pembeli']),
            'no_kk_penjual' => $_POST['no_kk_penjual'],
            'nik_penjual' => $_POST['nik_penjual'],
            'nama_penjual' => $_POST['nama_penjual'],
            'kd_kelurahan_penjual' => $_POST['kd_kelurahan_penjual'],
            'rw_penjual' => $_POST['rw_penjual'],
            'rt_penjual' => $_POST['rt_penjual'],
            'alamat_penjual' => $_POST['alamat_penjual'],
            'kd_pos_penjual' => $_POST['kd_pos_penjual'],
            'npwp_penjual' => $_POST['npwp_penjual'],
            'ibu_kandung_penjual' => $_POST['ibu_kandung_penjual'],
            'no_telpon_penjual' => str_replace("_","",$_POST['no_telpon_penjual']),
            'nop'  => $_POST['nop'],
            'kd_kelurahan_objek' => $_POST['kd_kelurahan_objek'],
            'rw_objek' => $_POST['rw_objek'],
            'rt_objek' => $_POST['rt_objek'],
            'letak_tanah_objek' => $_POST['letak_objek'],
            'luas_bumi' => str_replace(".","",$_POST['luas_bumi']),
            'luas_bng' => str_replace(".","",$_POST['luas_bng']),
            'njop_bumi' => str_replace(".","",$_POST['njop_bumi']),
            'njop_bng' => str_replace(".","",$_POST['njop_bng']),
            'njop_pbb' => str_replace(".","",$_POST['njop_pbb']),
            'luas_bumi_njop_bumi' => str_replace(".","",$_POST['luas_x_njop_bumi']),
            'luas_bng_njop_bng' => str_replace(".","",$_POST['luas_x_njop_bng']),
            'jenis_perolehan' => $_POST['jenis_perolehan'],
            'nilai_pasar' => str_replace(".","",$_POST['nilai_pasar']),
            'nomor_sertifikat' => $_POST['no_sertifikat'],
            'npop' => str_replace(".","",$_POST['npop']),
            'npoptkp' => str_replace(".","",$_POST['npoptkp']),
            'npopkp' => str_replace(".","",$_POST['npopkp']),
            'bea_terhutang' => str_replace(".","",$_POST['bea_terhutang']),
            'bea_dibayar' => str_replace(".","",$_POST['bea_dibayar']),
            'dengan_angka' => str_replace(".","",$_POST['dengan_angka']),
            'dengan_huruf' => $_POST['dengan_huruf'],
            'pph21' => str_replace(".","",$_POST['pph']),
            'status' => 'Verifikasi Petugas',
            'ttd_pemohon' => $ttd,
            'keterangan' => $_POST['keterangan'],
            'tgl_pendaftaran' => date('Y-m-d'),
            'foto_kk_penerima_hak' => $kk,
			'foto_ktp_pembeli' => $ktp_pembeli,
			'foto_ktp_penjual' => $ktp_penjual,
			'foto_surat_tanah' => $sertifikat,
			'foto_visual' => $foto_visual,
			'foto_sppt' => $foto_sppt,
			'file_surat_warisan' => $warisan,
            'kwitansi' => $kwitansi,
            'id_ppat' => $_POST['id_ppat']

        );
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
		$this->adm->proses_edit_pendaftaran($data,$no_pendaftaran);
		$periksa = array(
			'id_periksa' => date('Y-m-d H:i:s'),
			'id_akun' => $this->session->userdata('akun'),
			'jabatan' => $this->session->userdata('level'),
			'nama' => $this->session->userdata('nama_user'),
			'no_pendaftaran' => $_POST['no_pendaftaran'],
			'tgl_konfirmasi' => date('Y-m-d')
		);
		$this->adm->periksa($periksa);
		
		echo "<script language='javascript'>alert('Data Berhasil Diubah'); document.location='".base_url('Ppat/lihat_pendaftaran')."';</script>";
    }
    public function hapus_pendaftaran($no_pendaftaran)
    {
        $this->adm->hapus_pendaftaran($no_pendaftaran);
		echo "<script language='javascript'>alert('Data Berhasil Dihapus'); document.location='javascript:window.history.go(-1)';</script>";
    }

    public function lihat_histori()
    {
        $data['data'] = $this->ppat->lihat_pendaftaran();
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/Pendaftaran/V_histori');
        $this->load->view('footer');
    }


    public function lihat_bphtb()
    {
        $data['data'] = $this->ppat->lihat_bphtb();
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/BPHTB/V_bphtb');
        $this->load->view('footer');
    }

    public function cetak_sspd($no_pendaftaran)
    {
       // $this->M_petugas->histori_sspd($no_pendaftaran);
        $dt = $this->adm->cetak_pendaftaran($no_pendaftaran);

        $this->load->library('Pdf');
        $pdf = new FPDF('p','mm','Legal');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetTextColor(83,83,83);
        $pdf->SetFont('Arial','B',8);
        // mencetak string 
        $pdf->Image('file/Logo/1.jpg',0,0,217);
        $pdf->Image('file/Barcode/'.$dt['kode_dokumen'],180,5,25);
        $pdf->Image('file/Barcode/'.$dt['ttd_pemohon'],22,280,20);

        $pdf->Ln();
        $pdf->Cell(1,20.5,'',0,1);
        $pdf->Cell(176);
        $pdf->Cell(25,2,$dt['no_sspd'],0,0);
        $pdf->Ln();
        $pdf->Cell(1,2,'',0,1);
        $pdf->Cell(170);
        $pdf->Cell(22,2,'Untuk Wajib Pajak',0,0);
        $pdf->Ln();
        $pdf->Cell(50,19,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(14,8,$dt['nama_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,1,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,9,$dt['npwp_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0.5,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,0,$dt['alamat_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,8.5,$dt['kelurahan_pembeli'],0,0);
        $pdf->Cell(50);
        $pdf->Cell(10,8,$dt['rt_pembeli']." / ".$dt['rw_pembeli'],0,0);
        $pdf->Cell(32);
        $pdf->Cell(10,8.5,$dt['kecamatan_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(32);
        $pdf->Cell(10,2,str_replace("KABUPATEN","",$dt['kabupaten_pembeli']),0,0);
        $pdf->Cell(94);
        $pdf->Cell(10,2,$dt['kd_pos_pembeli'],0,0);

        $pdf->Ln();
        $pdf->Cell(50,2.5,'',0,1);
        $pdf->Cell(45);
        $pdf->Cell(10,8,$dt['nop'],0,0);
        $pdf->Ln();
        $pdf->Cell(50);
        $pdf->Cell(10,1,$dt['letak_tanah_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(30);
        $pdf->Cell(50,7,$dt['kelurahan_objek'],0,0);
        $pdf->Cell(38);
        $pdf->Cell(10,7,$dt['rt_objek']." / ".$dt['rw_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(25);
        $pdf->Cell(50,2,$dt['kecamatan_objek'],0,0);
        $pdf->Cell(55);
        $pdf->Cell(10,1,str_replace("KABUPATEN","",$dt['kabupaten_objek']),0,0);

        $pdf->Ln();
        $pdf->Cell(50,24,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,0.1,number_format($dt['luas_bumi'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,1,number_format($dt['njop_bumi'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,1,number_format($dt['luas_bumi_njop_bumi'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,4.5,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,1,number_format($dt['luas_bng'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,8,number_format($dt['njop_bng'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,8,number_format($dt['luas_bng_njop_bng'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,3.5,'',0,1);
        $pdf->Cell(160);
        $pdf->Cell(10,2,number_format($dt['njop_pbb'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,6,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(50,8,$dt['jenis_perolehan'],0,0);
        $pdf->Cell(60);
        $pdf->Cell(10,8,number_format($dt['nilai_pasar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,2,'',0,1);
        $pdf->Cell(30);
        $pdf->Cell(50,2,$dt['nomor_sertifikat'],0,0);

        $pdf->Ln();
        $pdf->Cell(51,13,'',0,1);
        $pdf->Cell(140);
        $pdf->Cell(50,2,number_format($dt['npop'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,12,number_format($dt['npoptkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['npopkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,11,number_format($dt['bea_terhutang'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['bea_dibayar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,43.5,'',0,1);
        $pdf->Cell(15);
        $pdf->Cell(50,1,number_format($dt['dengan_angka'],0,',','.'),0,0    );
        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,11,'',0,1);
        $pdf->Cell(10);
        $pdf->Cell(50,2,$dt['dengan_huruf'],0,0 );

        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,35,'',0,1);
        $pdf->Cell(55);
        $pdf->Cell(50,2,$dt['nama_ppat'],0,0 );


        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetTextColor(83,83,83);
        $pdf->SetFont('Arial','B',8);
        // mencetak string 
        $pdf->Image('file/Logo/1.jpg',0,0,217);
        $pdf->Image('file/Barcode/'.$dt['kode_dokumen'],180,5,25);
        $pdf->Image('file/Barcode/'.$dt['ttd_pemohon'],22,280,20);

        $pdf->Ln();
        $pdf->Cell(1,19,'',0,1);
        $pdf->Cell(176);
        $pdf->Cell(25,1,$dt['no_sspd'],0,0);
        $pdf->Ln();
        $pdf->Cell(1,2,'',0,1);
        $pdf->Cell(167);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(22,2,'Untuk PPAT/Notaris',0,0);
        $pdf->Ln();
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(50,19,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(14,8,$dt['nama_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,1,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,9,$dt['npwp_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0.5,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,0,$dt['alamat_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,8.5,$dt['kelurahan_pembeli'],0,0);
        $pdf->Cell(50);
        $pdf->Cell(10,8,$dt['rt_pembeli']." / ".$dt['rw_pembeli'],0,0);
        $pdf->Cell(32);
        $pdf->Cell(10,8.5,$dt['kecamatan_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(32);
        $pdf->Cell(10,2,str_replace("KABUPATEN","",$dt['kabupaten_pembeli']),0,0);
        $pdf->Cell(94);
        $pdf->Cell(10,2,$dt['kd_pos_pembeli'],0,0);

        $pdf->Ln();
        $pdf->Cell(50,2.5,'',0,1);
        $pdf->Cell(45);
        $pdf->Cell(10,8,$dt['nop'],0,0);
        $pdf->Ln();
        $pdf->Cell(50);
        $pdf->Cell(10,1,$dt['letak_tanah_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(30);
        $pdf->Cell(50,7,$dt['kelurahan_objek'],0,0);
        $pdf->Cell(38);
        $pdf->Cell(10,7,$dt['rt_objek']." / ".$dt['rw_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(25);
        $pdf->Cell(50,2,$dt['kecamatan_objek'],0,0);
        $pdf->Cell(55);
        $pdf->Cell(10,1,str_replace("KABUPATEN","",$dt['kabupaten_objek']),0,0);

        $pdf->Ln();
        $pdf->Cell(50,24,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,0.1,number_format($dt['luas_bumi'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,1,number_format($dt['njop_bumi'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,1,number_format($dt['luas_bumi_njop_bumi'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,4.5,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,1,number_format($dt['luas_bng'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,8,number_format($dt['njop_bng'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,8,number_format($dt['luas_bng_njop_bng'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,3.5,'',0,1);
        $pdf->Cell(160);
        $pdf->Cell(10,2,number_format($dt['njop_pbb'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,6,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(50,8,$dt['jenis_perolehan'],0,0);
        $pdf->Cell(60);
        $pdf->Cell(10,8,number_format($dt['nilai_pasar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,2,'',0,1);
        $pdf->Cell(30);
        $pdf->Cell(50,2,$dt['nomor_sertifikat'],0,0);

        $pdf->Ln();
        $pdf->Cell(51,13,'',0,1);
        $pdf->Cell(140);
        $pdf->Cell(50,2,number_format($dt['npop'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,12,number_format($dt['npoptkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['npopkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,11,number_format($dt['bea_terhutang'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['bea_dibayar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,43.5,'',0,1);
        $pdf->Cell(15);
        $pdf->Cell(50,1,number_format($dt['dengan_angka'],0,',','.'),0,0    );
        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,11,'',0,1);
        $pdf->Cell(10);
        $pdf->Cell(50,2,$dt['dengan_huruf'],0,0 );

        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,35,'',0,1);
        $pdf->Cell(55);
        $pdf->Cell(50,2,$dt['nama_ppat'],0,0 );


        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetTextColor(83,83,83);
        $pdf->SetFont('Arial','B',8);
        // mencetak string 
        $pdf->Image('file/Logo/1.jpg',0,0,217);
        $pdf->Image('file/Barcode/'.$dt['kode_dokumen'],180,5,25);
        $pdf->Image('file/Barcode/'.$dt['ttd_pemohon'],22,280,20);

        $pdf->Ln();
        $pdf->Cell(1,19,'',0,1);
        $pdf->Cell(176);
        $pdf->Cell(25,1,$dt['no_sspd'],0,0);
        $pdf->Ln();
        $pdf->Cell(1,2,'',0,1);
        $pdf->Cell(167);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(22,2,'Untuk Kepala Kantor',0,0);
        $pdf->Ln();
        $pdf->Cell(1,1,'',0,1);
        $pdf->Cell(167);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(30,1,'Bidang Pertanahan',0,0,'C');

        $pdf->Ln();
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(50,17.5,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(14,8,$dt['nama_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,1,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,9,$dt['npwp_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0.5,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,0,$dt['alamat_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,8.5,$dt['kelurahan_pembeli'],0,0);
        $pdf->Cell(50);
        $pdf->Cell(10,8,$dt['rt_pembeli']." / ".$dt['rw_pembeli'],0,0);
        $pdf->Cell(32);
        $pdf->Cell(10,8.5,$dt['kecamatan_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(32);
        $pdf->Cell(10,2,str_replace("KABUPATEN","",$dt['kabupaten_pembeli']),0,0);
        $pdf->Cell(94);
        $pdf->Cell(10,2,$dt['kd_pos_pembeli'],0,0);

        $pdf->Ln();
        $pdf->Cell(50,2.5,'',0,1);
        $pdf->Cell(45);
        $pdf->Cell(10,8,$dt['nop'],0,0);
        $pdf->Ln();
        $pdf->Cell(50);
        $pdf->Cell(10,1,$dt['letak_tanah_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(30);
        $pdf->Cell(50,7,$dt['kelurahan_objek'],0,0);
        $pdf->Cell(38);
        $pdf->Cell(10,7,$dt['rt_objek']." / ".$dt['rw_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(25);
        $pdf->Cell(50,2,$dt['kecamatan_objek'],0,0);
        $pdf->Cell(55);
        $pdf->Cell(10,1,str_replace("KABUPATEN","",$dt['kabupaten_objek']),0,0);

        $pdf->Ln();
        $pdf->Cell(50,24,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,0.1,number_format($dt['luas_bumi'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,1,number_format($dt['njop_bumi'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,1,number_format($dt['luas_bumi_njop_bumi'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,4.5,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,1,number_format($dt['luas_bng'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,8,number_format($dt['njop_bng'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,8,number_format($dt['luas_bng_njop_bng'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,3.5,'',0,1);
        $pdf->Cell(160);
        $pdf->Cell(10,2,number_format($dt['njop_pbb'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,6,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(50,8,$dt['jenis_perolehan'],0,0);
        $pdf->Cell(60);
        $pdf->Cell(10,8,number_format($dt['nilai_pasar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,2,'',0,1);
        $pdf->Cell(30);
        $pdf->Cell(50,2,$dt['nomor_sertifikat'],0,0);

        $pdf->Ln();
        $pdf->Cell(51,13,'',0,1);
        $pdf->Cell(140);
        $pdf->Cell(50,2,number_format($dt['npop'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,12,number_format($dt['npoptkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['npopkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,11,number_format($dt['bea_terhutang'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['bea_dibayar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,43.5,'',0,1);
        $pdf->Cell(15);
        $pdf->Cell(50,1,number_format($dt['dengan_angka'],0,',','.'),0,0    );
        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,11,'',0,1);
        $pdf->Cell(10);
        $pdf->Cell(50,2,$dt['dengan_huruf'],0,0 );

        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,35,'',0,1);
        $pdf->Cell(55);
        $pdf->Cell(50,2,$dt['nama_ppat'],0,0 );
        
        
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetTextColor(83,83,83);
        $pdf->SetFont('Arial','B',8);
        // mencetak string 
        $pdf->Image('file/Logo/1.jpg',0,0,217);
        $pdf->Image('file/Barcode/'.$dt['kode_dokumen'],180,5,25);
        $pdf->Image('file/Barcode/'.$dt['ttd_pemohon'],22,280,20);

        $pdf->Ln();
        $pdf->Cell(1,19,'',0,1);
        $pdf->Cell(176);
        $pdf->Cell(25,1,$dt['no_sspd'],0,0);
        $pdf->Ln();
        $pdf->Cell(1,2,'',0,1);
        $pdf->Cell(170);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(22,2,'Untuk BAPENDA',0,0);
        $pdf->Ln();
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(50,19,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(14,8,$dt['nama_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,1,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,9,$dt['npwp_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0.5,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,0,$dt['alamat_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,8.5,$dt['kelurahan_pembeli'],0,0);
        $pdf->Cell(50);
        $pdf->Cell(10,8,$dt['rt_pembeli']." / ".$dt['rw_pembeli'],0,0);
        $pdf->Cell(32);
        $pdf->Cell(10,8.5,$dt['kecamatan_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(32);
        $pdf->Cell(10,2,str_replace("KABUPATEN","",$dt['kabupaten_pembeli']),0,0);
        $pdf->Cell(94);
        $pdf->Cell(10,2,$dt['kd_pos_pembeli'],0,0);

        $pdf->Ln();
        $pdf->Cell(50,2.5,'',0,1);
        $pdf->Cell(45);
        $pdf->Cell(10,8,$dt['nop'],0,0);
        $pdf->Ln();
        $pdf->Cell(50);
        $pdf->Cell(10,1,$dt['letak_tanah_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(30);
        $pdf->Cell(50,7,$dt['kelurahan_objek'],0,0);
        $pdf->Cell(38);
        $pdf->Cell(10,7,$dt['rt_objek']." / ".$dt['rw_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(25);
        $pdf->Cell(50,2,$dt['kecamatan_objek'],0,0);
        $pdf->Cell(55);
        $pdf->Cell(10,1,str_replace("KABUPATEN","",$dt['kabupaten_objek']),0,0);

        $pdf->Ln();
        $pdf->Cell(50,24,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,0.1,number_format($dt['luas_bumi'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,1,number_format($dt['njop_bumi'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,1,number_format($dt['luas_bumi_njop_bumi'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,4.5,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,1,number_format($dt['luas_bng'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,8,number_format($dt['njop_bng'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,8,number_format($dt['luas_bng_njop_bng'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,3.5,'',0,1);
        $pdf->Cell(160);
        $pdf->Cell(10,2,number_format($dt['njop_pbb'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,6,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(50,8,$dt['jenis_perolehan'],0,0);
        $pdf->Cell(60);
        $pdf->Cell(10,8,number_format($dt['nilai_pasar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,2,'',0,1);
        $pdf->Cell(30);
        $pdf->Cell(50,2,$dt['nomor_sertifikat'],0,0);

        $pdf->Ln();
        $pdf->Cell(51,13,'',0,1);
        $pdf->Cell(140);
        $pdf->Cell(50,2,number_format($dt['npop'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,12,number_format($dt['npoptkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['npopkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,11,number_format($dt['bea_terhutang'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['bea_dibayar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,43.5,'',0,1);
        $pdf->Cell(15);
        $pdf->Cell(50,1,number_format($dt['dengan_angka'],0,',','.'),0,0    );
        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,11,'',0,1);
        $pdf->Cell(10);
        $pdf->Cell(50,2,$dt['dengan_huruf'],0,0 );

        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,35,'',0,1);
        $pdf->Cell(55);
        $pdf->Cell(50,2,$dt['nama_ppat'],0,0 );

        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetTextColor(83,83,83);
        $pdf->SetFont('Arial','B',8);
        // mencetak string 
        $pdf->Image('file/Logo/1.jpg',0,0,217);
        $pdf->Image('file/Barcode/'.$dt['kode_dokumen'],180,4,24);
        $pdf->Image('file/Barcode/'.$dt['ttd_pemohon'],22,280,20);

        $pdf->Ln();
        $pdf->Cell(1,16,'',0,1);
        $pdf->Cell(176);
        $pdf->Cell(25,2,$dt['no_sspd'],0,0);
        $pdf->Ln();
        $pdf->Cell(1,1,'',0,1);
        $pdf->Cell(170);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(22,1.5,'Untuk Bank yang',0,0);
        $pdf->Ln();
        $pdf->Cell(1,2,'',0,1);
        $pdf->Cell(168);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(22,1.5,'ditujunk/ Bendahara',0,0);

        $pdf->Ln();
        $pdf->Cell(1,1.5,'',0,1);
        $pdf->Cell(174);
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(22,1.5,'Penerimaan',0,0);

        $pdf->Ln();
        $pdf->SetFont('Arial','B',8);
        $pdf->Cell(50,16.5,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(14,8,$dt['nama_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,1,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,9,$dt['npwp_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0.5,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,0,$dt['alamat_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(33);
        $pdf->Cell(10,8.5,$dt['kelurahan_pembeli'],0,0);
        $pdf->Cell(50);
        $pdf->Cell(10,8,$dt['rt_pembeli']." / ".$dt['rw_pembeli'],0,0);
        $pdf->Cell(32);
        $pdf->Cell(10,8.5,$dt['kecamatan_pembeli'],0,0);
        $pdf->Ln();
        $pdf->Cell(50,0,'',0,1);
        $pdf->Cell(32);
        $pdf->Cell(10,2,str_replace("KABUPATEN","",$dt['kabupaten_pembeli']),0,0);
        $pdf->Cell(94);
        $pdf->Cell(10,2,$dt['kd_pos_pembeli'],0,0);

        $pdf->Ln();
        $pdf->Cell(50,2.5,'',0,1);
        $pdf->Cell(45);
        $pdf->Cell(10,8,$dt['nop'],0,0);
        $pdf->Ln();
        $pdf->Cell(50);
        $pdf->Cell(10,1,$dt['letak_tanah_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(30);
        $pdf->Cell(50,7,$dt['kelurahan_objek'],0,0);
        $pdf->Cell(38);
        $pdf->Cell(10,7,$dt['rt_objek']." / ".$dt['rw_objek'],0,0);
        $pdf->Ln();
        $pdf->Cell(25);
        $pdf->Cell(50,2,$dt['kecamatan_objek'],0,0);
        $pdf->Cell(55);
        $pdf->Cell(10,1,str_replace("KABUPATEN","",$dt['kabupaten_objek']),0,0);

        $pdf->Ln();
        $pdf->Cell(50,24,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,0.1,number_format($dt['luas_bumi'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,1,number_format($dt['njop_bumi'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,1,number_format($dt['luas_bumi_njop_bumi'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,4.5,'',0,1);
        $pdf->Cell(60);
        $pdf->Cell(50,1,number_format($dt['luas_bng'],0,',','.'),0,0);
        $pdf->Cell(15);
        $pdf->Cell(10,8,number_format($dt['njop_bng'],0,',','.'),0,0,'R');
        $pdf->Cell(25);
        $pdf->Cell(10,8,number_format($dt['luas_bng_njop_bng'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,3.5,'',0,1);
        $pdf->Cell(160);
        $pdf->Cell(10,2,number_format($dt['njop_pbb'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,6,'',0,1);
        $pdf->Cell(70);
        $pdf->Cell(50,8,$dt['jenis_perolehan'],0,0);
        $pdf->Cell(60);
        $pdf->Cell(10,8,number_format($dt['nilai_pasar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,2,'',0,1);
        $pdf->Cell(30);
        $pdf->Cell(50,2,$dt['nomor_sertifikat'],0,0);

        $pdf->Ln();
        $pdf->Cell(51,13,'',0,1);
        $pdf->Cell(140);
        $pdf->Cell(50,2,number_format($dt['npop'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,12,number_format($dt['npoptkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['npopkp'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,11,number_format($dt['bea_terhutang'],0,',','.'),0,0,'R');
        $pdf->Ln();
        $pdf->Cell(140);
        $pdf->Cell(50,1,number_format($dt['bea_dibayar'],0,',','.'),0,0,'R');

        $pdf->Ln();
        $pdf->Cell(51,43.5,'',0,1);
        $pdf->Cell(15);
        $pdf->Cell(50,1,number_format($dt['dengan_angka'],0,',','.'),0,0    );
        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,11,'',0,1);
        $pdf->Cell(10);
        $pdf->Cell(50,2,$dt['dengan_huruf'],0,0 );

        $pdf->Ln();
        $pdf->SetFont('Arial','BI',8);
        $pdf->Cell(51,35,'',0,1);
        $pdf->Cell(55);
        $pdf->Cell(50,2,$dt['nama_ppat'],0,0 );


        $nama = "SSPD No.".$dt['no_sspd'].".pdf";

        $pdf->Output("$nama","I");
    }


    public function lihat_akun()
	{
        $id_akun = $this->session->userdata('id_akun');
		$data['dt'] = $this->adm->lihat_akun($id_akun);
		$this->load->view('head', $data);
		$this->load->view('Ppat/menu');
		$this->load->view('Ppat/Akun/V_edit_akun');
		$this->load->view('footer');
    }
    public function proses_edit_akun()
	{
		$this->adm->proses_edit_akun();
		echo "<script language='javascript'>alert('Akun Berhasil Diubah'); document.location='" . base_url('Ppat/lihat_akun') . "';</script>";
    }
    


    public function lihat_kurang_bayar()
    {
        $data['data'] = $this->ppat->lihat_pendaftaran_kurang_bayar();
        // echo "<pre>";
        //     print_r($data['data']);
        // echo "</pre>";
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/Kurang/V_pendaftaran_kurang_bayar');
        $this->load->view('footer');
    }


    public function tambah_kurang_bayar()
    {
        $this->load->view('head');
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/Kurang/V_tambah_kurang_bayar');
        $this->load->view('footer');
    }

    public function proses_tambah_kurang_bayar()
    {
        $length = 10;
		$str = "";
	    $characters = array_merge( range('0','9'));
	    $max = count($characters) - 1;
	    for ($i = 0; $i < $length; $i++) {
	        $rand = mt_rand(0, $max);
	        $str  .= $characters[$rand];
	    }

        $kode =$str;
        
        
		$data1 = "KB.".$kode;
		$this->load->library('ciqrcode'); //pemanggilan library QR CODE

		$config['cacheable']	= true; //boolean, the default is true
		$config['cachedir']		= './file/assets/'; //string, the default is application/cache/
		$config['errorlog']		= './file/assets/'; //string, the default is application/logs/
		$config['imagedir']		= './file/Barcode/'; //direktori penyimpanan qr code
		$config['quality']		= true; //boolean, the default is true
		$config['size']			= '1024'; //interger, the default is 1024
		$config['black']		= array(224,255,255); // array, default is array(255,255,255)
		$config['white']		= array(70,130,180); // array, default is array(0,0,0)
		$this->ciqrcode->initialize($config);

		$image_name=$data1.'.png'; //buat name dari qr code sesuai dengan nim

		$params['data'] = $data1; //data yang akan di jadikan QR CODE
		$params['level'] = 'H'; //H=High
		$params['size'] = 10;
		$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
        $this->ciqrcode->generate($params);


        $data = array(
            'id' => $kode ,
            'kode_dokumen' => $image_name,
            'no_sspd' => $_POST['no_sspd'],
            'nop' => $_POST['nop'],
            'alamat_objek' => $_POST['alamat_objek'],
            'nik_pembeli' => $_POST['nik_pembeli'],
            'nama_pembeli' => $_POST['nama_pembeli'],
            'alamat_pembeli' => $_POST['alamat_pembeli'],
            'luas_bumi' => str_replace(".","",$_POST['luas_bumi']),
            'luas_bng' => str_replace(".","",$_POST['luas_bng']),
            'njop_bumi' => str_replace(".","",$_POST['njop_bumi']),
            'njop_bng' => str_replace(".","",$_POST['njop_bng']),
            'luas_x_njop_bumi' =>str_replace(".","", $_POST['luas_x_njop_bumi']),
            'luas_x_njop_bng' => str_replace(".","",$_POST['luas_x_njop_bng']),
            'njop_pbb' => str_replace(".","",$_POST['njop_pbb']),
            'jenis_perolehan' => $_POST['jenis_perolehan'],
            'nilai_pasar' => str_replace(".","",$_POST['nilai_pasar']),
            'no_sertifikat' => $_POST['no_sertifikat'],
            'npop' => str_replace(".","",$_POST['npop']),
            'npoptkp' => str_replace(".","",$_POST['npoptkp']),
            'npopkp' => str_replace(".","",$_POST['npopkp']),
            'bea_terhutang' =>str_replace(".","",$_POST['bea_terhutang']),
            'bea_dibayar' => str_replace(".","",$_POST['bea_dibayar']),
            'dengan_angka' => str_replace(".","",$_POST['dengan_angka']),
            'dengan_huruf' => str_replace(".","",$_POST['dengan_huruf']),
            'nilai_kurang_bayar' => str_replace(".","",$_POST['nilai_kurang_bayar']),
            'npopkp_kurang' => str_replace(".","",$_POST['npopkp_kurang']),
            'dengan_angka_kurang' => str_replace(".","",$_POST['dengan_angka_kurang']),
            'dengan_huruf_kurang' => str_replace(".","",$_POST['dengan_huruf_kurang']),
            'kurang_bayar_tahun' => date('Y'),
            'bphtb_tahun' => $_POST['tahun'],
            'id_ppat' =>$_POST['id_ppat'],
            'tgl_pengajuan' => date('Y-m-d'),
            'status' => 'Proses'
        );

        // echo "<pre>";
        //     print_r($data);
        // echo "</pre>";

        $this->adm->proses_tambah_kurang_bayar($data);
			echo "<script language='javascript'>alert('Data Berhasil Disimpan'); document.location='".base_url('Ppat/lihat_kurang_bayar')."';</script>";
    }

    public function lihat_pembayaran()
    {
        $data['data'] = $this->ppat->lihat_pembayaran();
        // print_r($data['data']);
        $this->load->view('head',$data);
        $this->load->view('Ppat/menu');
        $this->load->view('Ppat/Pembayaran/V_pembayaran');
        $this->load->view('footer');
    }

    public function cetak_hutang_pbb($data)
    {
        echo "<pre>";
            print_r($data);
        echo "</pre>";
    }


}

?>