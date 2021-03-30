<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KunjunganStatusRujukanPasien extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekammedis/M_KunjunganStatusRujukanPasien');
    }

    public function index()
    {
        $data['tahun'] = $this->M_KunjunganStatusRujukanPasien->gettahun();

        $data['title'] = 'Kunjungan Berdasarkan Status dan Rujukan Pasien';
        $data['laporan'] = 'Laporan Berdasarkan Status dan Rujukan Pasien';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/KunjunganStatusRujukanPasien', $data);
        $this->load->view('templates/footer');
    }

    public function Grafik()
    {
        $this->form_validation->set_rules('instalasi', 'Instalasi', 'trim|required');
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $tahun1 = $this->input->post('tahun1');
        $bulanawal = $this->input->post('bulanawal');
        $bulanakhir = $this->input->post('bulanakhir');
        $tahun2 = $this->input->post('tahun2');
        $tahun3 = $this->input->post('tahun3');
        $periode = $this->input->post('periode');
        $instalasi = $this->input->post('instalasi');

        if ($periode == 1) {
            $data['tanggal']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '1');
            $data['hasil']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '2');
            $data['total']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '3');
        } elseif ($periode == 2) {
            $data['tanggal']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '1');
            $data['hasil']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '2');
            $data['total']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '3');
        } else {
            $data['tanggal']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '1');
            $data['hasil']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '2');
            $data['total']    = $this->M_KunjunganStatusRujukanPasien->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '3');
        }

        echo json_encode($data);
    }

    function filter()
    {
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $tahun1 = $this->input->post('tahun1');
        $bulanawal = $this->input->post('bulanawal');
        $bulanakhir = $this->input->post('bulanakhir');
        $tahun2 = $this->input->post('tahun2');
        $nilaifilter = $this->input->post('nilaifilter');
        $tahun3 = $this->input->post('tahun3');
        $format = $this->input->post('flexRadioDefault');

        if ($nilaifilter == 1) {
            $instalasi = $this->input->post('instalasi');

            $data['title'] = "Laporan Kunjungan Status dan Rujukan Pasien Berdasarkan Tanggal";
            $data['subtitle'] = date('d-m-Y', strtotime($tanggalawal)) . ' s.d : ' . date('d-m-Y', strtotime($tanggalakhir));
            $data['instalasi'] = $instalasi;
            if ($format == '1') {
                $data['datafilter'] = $this->M_KunjunganStatusRujukanPasien->filterbytanggal($tanggalawal, $tanggalakhir, $instalasi);
                $data['asalpasien'] = $this->M_KunjunganStatusRujukanPasien->GetAsalPasienTgl($tanggalawal, $tanggalakhir, $instalasi);
                $data['statuspasien'] = $this->M_KunjunganStatusRujukanPasien->GetStatusPasienTgl($tanggalawal, $tanggalakhir, $instalasi);
                $data['ruangan'] = $this->M_KunjunganStatusRujukanPasien->GetRuanganTgl($tanggalawal, $tanggalakhir, $instalasi);
            };
            $data['datafilter'] = [
                'tanggalawal'   => $tanggalawal,
                'tanggalakhir'   => $tanggalakhir,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter,
                'format' => $format,
                'tahun' => $tahun1,
                'tahun1' => $tahun1,
                'tahun2' => $tahun2,
                'tahun3' => $tahun3,
                'bulanawal'   => $bulanawal,
                'bulanakhir'   => $bulanakhir,
                'tahunakhir' => $tahun3
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganStatusRujukanPasien', $data);
        } elseif ($nilaifilter == 2) {
            $instalasi = $this->input->post('instalasi1');

            $data['title'] = "Laporan Kunjungan Status dan Rujukan Pasien Berdasarkan Bulan";
            $data['subtitle'] =  $bulanawal . ' s.d ' . $bulanakhir . ' Tahun : ' . $tahun1;
            $data['instalasi'] = $instalasi;

            if ($format == '1') {
                $data['datafilter'] = $this->M_KunjunganStatusRujukanPasien->filterbybulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
                $data['asalpasien'] = $this->M_KunjunganStatusRujukanPasien->GetAsalPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
                $data['statuspasien'] = $this->M_KunjunganStatusRujukanPasien->GetStatusPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
                $data['ruangan'] = $this->M_KunjunganStatusRujukanPasien->GetRuanganBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            }
            $data['datafilter'] = [
                'tanggalawal'   => $tanggalawal,
                'tanggalakhir'   => $tanggalakhir,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter,
                'format' => $format,
                'tahun' => $tahun1,
                'tahun1' => $tahun1,
                'tahun2' => $tahun2,
                'tahun3' => $tahun3,
                'bulanawal'   => $bulanawal,
                'bulanakhir'   => $bulanakhir,
                'tahunakhir' => $tahun3
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganStatusRujukanPasien', $data);
        } elseif ($nilaifilter == 3) {
            $instalasi = $this->input->post('instalasi2');

            $data['title'] = "Laporan Kunjungan Status dan Rujukan Pasien Berdasarkan Tahun";
            $data['subtitle'] =  $tahun2 . ' s.d ' . $tahun3;
            $data['instalasi'] = $instalasi;

            if ($format == '1') {
                $data['datafilter'] = $this->M_KunjunganStatusRujukanPasien->filterbytahun($tahun2, $instalasi, $tahun3);
                $data['asalpasien'] = $this->M_KunjunganStatusRujukanPasien->GetAsalPasienTahun($tahun2, $instalasi, $tahun3);
                $data['statuspasien'] = $this->M_KunjunganStatusRujukanPasien->GetStatusPasienTahun($tahun2, $instalasi, $tahun3);
                $data['ruangan'] = $this->M_KunjunganStatusRujukanPasien->GetRuanganTahun($tahun2, $instalasi, $tahun3);
            }
            $data['datafilter'] = [
                'tanggalawal'   => $tanggalawal,
                'tanggalakhir'   => $tanggalakhir,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter,
                'format' => $format,
                'tahun' => $tahun1,
                'tahun1' => $tahun1,
                'tahun2' => $tahun2,
                'tahun3' => $tahun3,
                'bulanawal'   => $bulanawal,
                'bulanakhir'   => $bulanakhir,
                'tahunakhir' => $tahun3
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganStatusRujukanPasien', $data);
        }
    }
}
