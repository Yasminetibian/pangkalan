<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Cetak extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('M_masyarakat', 'masyarakat');
		// $this->load->model('M_pengguna', 'pengguna');
		// $this->load->model('M_menu', 'menu');
	}

	public function index($no_kk)
	{
		//$data['title'] = 'Data Akun';
		//$data['data'] = $this->akun->lihat_akun();
		//$this->load->view('komponen/head');
		//$this->load->view('komponen/menu');
		$data['key'] = $this->masyarakat->lihat_masyarakat(decrypt_url($no_kk));
		$this->load->view('admin/cetak/cetak', $data);
		//$this->load->view('komponen/footer');
		// print_r($data);
	}

	public function pdf($no_kk) 
    {
        $this->load->library('pdf');
        $dt = $this->masyarakat->lihat_masyarakat(decrypt_url($no_kk));
        // $this->mypdf->generate('admin/cetak/cetak', $data);
        
        // $paper_size = 'A4';
        // $orientation = 'portrait';
        // $html = $this->output->get_output();
        // $this->dompdf->set_paper($paper_size, $orientation);

        // $this->dompdf->load_html($html);
        // $this->dompdf->render();
        // $this->dompdf->stream("Laporan Pangkalan .pdf", array('Attachment' => 0));

		$this->load->library('Pdf');
			$pdf = new FPDF('P','mm',array(210,330));
			// membuat halaman baru
			$pdf->AddPage();
			// setting jenis font yang akan digunakan
			$pdf->SetFont('Arial','B',10);
			// mencetak string 
			
			$pdf->Image('file/bingkai.png',10,0,120);
			$pdf->Ln(10);
			$pdf->Cell(10);
			$pdf->Cell(100,6,'KARTU KENDALI GAS ELPIJI 3 KG',0,1,'C');
			$pdf->Cell(10);
			$pdf->Cell(100,6,'KECAMATAN KINTAP',0,1,'C');
			$pdf->Image('file/barcode/'.$dt->file_barcode,18,35,30);
			$pdf->Ln(3);
			$pdf->Cell(40);
			$pdf->Cell(25,6,'ID',0,0,'L');
			$pdf->Cell(5,6,' : ',0,0,'C');
			$pdf->Cell(15,6,$dt->id_barcode,0,1,'L');
			$pdf->Ln(0.5);
			
			$pdf->Cell(40);
			$pdf->Cell(25,6,'No. KK',0,0,'L');
			$pdf->Cell(5,6,' : ',0,0,'C');
			$pdf->Cell(15,6,$dt->no_kk,0,1,'L');
			$pdf->Ln(0.5);
			
			$pdf->Cell(40);
			$pdf->Cell(25,6,'Nama Kepala',0,0,'L');
			$pdf->Cell(5,6,' : ',0,0,'C');
			$pdf->MultiCell(15,6,$dt->nama_kepala,0,'L');
			$pdf->Ln(0.5);

			
			$pdf->Cell(40);
			$pdf->Cell(25,6,'Desa',0,0,'L');
			$pdf->Cell(5,6,' : ',0,0,'C');
			$pdf->Cell(15,6,$dt->desa,0,1,'L');
			$pdf->Ln(0.5);


			$nama = "Kartu Kendali.pdf";

			$pdf->Output("$nama","I");

    }

 }