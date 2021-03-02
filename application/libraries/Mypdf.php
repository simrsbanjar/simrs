<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once('assets/dompdf/autoload.inc.php');

use Dompdf\Dompdf;

class Mypdf extends CI_Controller
{
    protected $ci;

    public function __construct()
    {
        $this->ci = &get_instance();
    }

    public function generate($view, $data = array(), $filename = 'Laporan', $paper = 'A4', $orientation = 'potrait')
    {
        $dompdf = new Dompdf();
        $html = $this->ci->load->view($view, $data, true);
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper($paper, $orientation);

        // Render the HTML as PDF
        $dompdf->render();
        ob_clean();
        $dompdf->stream($filename . ".pdf", array("Attachment" => FALSE));
    }
}
