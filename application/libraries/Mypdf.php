<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');
use Dompdf\Dompdf;


class Mypdf
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        
    }

    public function generate($view, $data = array(), $filename = 'Laporan', $paper = 'A4-L', $orientation = 'portrait')
    {
        $dompdf = new Dompdf();
        $html = $this->ci->load->view($view, $data, TRUE);
        $dompdf->loadHtml($html);
    	$dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $dompdf->render();
        ob_clean();
        $dompdf->stream($filename . ".pdf", array("Attachment" => FALSE));

    }

    public function cetak($view, $data = array(), $filename = 'Cetak', $paper = 'A4', $orientation = 'landscape')
    {
        $dompdf = new Dompdf();
        $html = $this->ci->load->view($view, $data, TRUE);
        $dompdf->loadHtml($html);
    	$dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $dompdf->render();
        ob_clean();
        $dompdf->stream($filename . ".pdf", array("Attachment" => FALSE));

    }
}
?>