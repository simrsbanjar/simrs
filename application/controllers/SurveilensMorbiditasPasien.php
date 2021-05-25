<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class SurveilensMorbiditasPasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekammedis/M_SurveilensMorbiditasPasien');
        $this->load->library('session');
    }
    function index()
    {
        if ($this->session->userdata('idpegawai')) {
            $data['tahun'] = $this->M_SurveilensMorbiditasPasien->gettahun();

            $data['title'] = 'Surveilens Morbiditas Pasien';
            $data['laporan'] = 'Laporan Surveilens Morbiditas Pasien';
            $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
            $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('rekammedis/SurveilensMorbiditasPasien', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }

    function GetRuanganInst()
    {
        $instalasi = $this->input->post('instalasi');
        $data = $this->M_SurveilensMorbiditasPasien->GetRuanganInst($instalasi);
        echo json_encode($data);
    }

    function filter()
    {
        $tahun1 = $this->input->post('tahun1');
        $bulanawal = $this->input->post('bulanawal');
        $tahun2 = $this->input->post('tahun2');
        $nilaifilter = $this->input->post('nilaifilter');
        $hostname   = substr(gethostbyaddr($_SERVER['REMOTE_ADDR']), 0, stripos(gethostbyaddr($_SERVER['REMOTE_ADDR']), ".rsubanjar.local"));

        if ($nilaifilter == 2) {
            $instalasi = $this->input->post('instalasi1');
            $ruangan = $this->input->post('ruangan');

            if ($bulanawal == '1') {
                $bulanawaltext = 'Januari';
            } else if ($bulanawal == '2') {
                $bulanawaltext = 'Februari';
            } else if ($bulanawal == '3') {
                $bulanawaltext = 'Maret';
            } else if ($bulanawal == '4') {
                $bulanawaltext = 'April';
            } else if ($bulanawal == '5') {
                $bulanawaltext = 'Mei';
            } else if ($bulanawal == '6') {
                $bulanawaltext = 'Juni';
            } else if ($bulanawal == '7') {
                $bulanawaltext = 'Juli';
            } else if ($bulanawal == '8') {
                $bulanawaltext = 'Agustus';
            } else if ($bulanawal == '9') {
                $bulanawaltext = 'September';
            } else if ($bulanawal == '10') {
                $bulanawaltext = 'Oktober';
            } else if ($bulanawal == '11') {
                $bulanawaltext = 'November';
            } else {
                $bulanawaltext = 'Desember';
            }

            $data['title'] = "Laporan Surveilens Morbiditas Pasien Per Bulan";
            $data['executesp'] = $this->M_SurveilensMorbiditasPasien->ExecuteSP($tahun1, $bulanawal, $instalasi, $hostname, $ruangan, 'M');
            $data['hasildata'] = $this->M_SurveilensMorbiditasPasien->GetData($hostname);
            $data['datafilter'] = [
                'instalasi'   => $instalasi,
                'tahun' => $tahun1,
                'bulan'   => $bulanawaltext,
                'ruangan' => $ruangan
            ];
            $this->load->view('rekammedis/laporan/LapSurveilensMorbiditasPasien', $data);
        } else {
            $instalasi = $this->input->post('instalasi2');
            $ruangan = $this->input->post('ruangan1');

            $data['title'] = "Laporan Surveilens Morbiditas Pasien Per Tahun";
            $data['executesp'] = $this->M_SurveilensMorbiditasPasien->ExecuteSP($tahun2, $bulanawal, $instalasi, $hostname, $ruangan, 'Y');
            $data['hasildata'] = $this->M_SurveilensMorbiditasPasien->GetData($hostname);
            $data['datafilter'] = [
                'instalasi'   => $instalasi,
                'tahun' => $tahun2,
                'bulan'   => '',
                'ruangan' => $ruangan
            ];

            $this->load->view('rekammedis/laporan/LapSurveilensMorbiditasPasien', $data);
        }
    }
}
