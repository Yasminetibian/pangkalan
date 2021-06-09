<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {
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
        $this->load->view('admin/laporan/dumpdf');
      
    }

    public function pdf() 
    {
        $this->load->library('mypdf');
        $data['data'] = $this->pangkalan->lihat_pangkalan();
        $this->mypdf->generate('admin/laporan/dumpdf', $data);
        
        $paper_size = 'A4-L';
        $orientation = 'portrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $orientation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream("Tanda Pengenal .pdf", array('Attachment' => 0));

    }
}