<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KunjunganStatusJenisPasien extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekammedis/KunjunganStatusJenisPasienModel');
    }

    public function index()
    {
        $data['tahun'] = $this->KunjunganStatusJenisPasienModel->gettahun();

        $data['title'] = 'Kunjungan Berdasarkan Status Dan Jenis Pasien';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/KunjunganStatusJenisPasien', $data);
        $this->load->view('templates/footer');
    }

    public function Grafik()
    {
        $tanggalawal = $this->input->post('tanggalawal');
        $tanggalakhir = $this->input->post('tanggalakhir');
        $tahun1 = $this->input->post('tahun1');
        $bulanawal = $this->input->post('bulanawal');
        $bulanakhir = $this->input->post('bulanakhir');
        $tahun2 = $this->input->post('tahun2');
        $tahun3 = $this->input->post('tahun3');
        $periode = $this->input->post('periode');
        $instalasi = $this->input->post('instalasi');

        if ($periode == 'tanggal') {
            $data['tanggal']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '1');
            $data['hasil']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '2');
            $data['total']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun1, $tanggalawal, $tanggalakhir, $instalasi, $periode, '3');
        } elseif ($periode == 'bulan') {
            $data['tanggal']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '1');
            $data['hasil']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '2');
            $data['total']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun1, $bulanawal, $bulanakhir, $instalasi, $periode, '3');
        } else {
            $data['tanggal']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '1');
            $data['hasil']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '2');
            $data['total']    = $this->KunjunganStatusJenisPasienModel->getGrafik($tahun2, $tahun2, $tahun3, $instalasi, $periode, '3');
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

        if ($nilaifilter == 1) {
            $instalasi = $this->input->post('instalasi');

            $data['title'] = "Laporan Kunjungan Status dan Jenis Pasien Berdasarkan Tanggal";
            $data['subtitle'] = date('d-m-Y', strtotime($tanggalawal)) . ' s.d : ' . date('d-m-Y', strtotime($tanggalakhir));
            $data['instalasi'] = $instalasi;
            $data['datafilter'] = $this->KunjunganStatusJenisPasienModel->filterbytanggal($tanggalawal, $tanggalakhir, $instalasi);
            $data['jenispasien'] = $this->KunjunganStatusJenisPasienModel->GetJenisPasienTgl($tanggalawal, $tanggalakhir, $instalasi);
            $data['statuspasien'] = $this->KunjunganStatusJenisPasienModel->GetStatusPasienTgl($tanggalawal, $tanggalakhir, $instalasi);
            $data['ruangan'] = $this->KunjunganStatusJenisPasienModel->GetRuanganTgl($tanggalawal, $tanggalakhir, $instalasi);
            $data['datafilter'] = [
                'tanggalawal'   => $tanggalawal,
                'tanggalakhir'   => $tanggalakhir,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter
            ];
            $this->load->view('rekammedis/LapKunjunganStatusJenisPas', $data);
        } elseif ($nilaifilter == 2) {
            $instalasi = $this->input->post('instalasi1');

            $data['title'] = "Laporan Kunjungan Status dan Jenis Pasien Berdasarkan Bulan";
            $data['subtitle'] =  $bulanawal . ' s.d ' . $bulanakhir . ' Tahun : ' . $tahun1;
            $data['instalasi'] = $instalasi;
            $data['datafilter'] = $this->KunjunganStatusJenisPasienModel->filterbybulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            $data['jenispasien'] = $this->KunjunganStatusJenisPasienModel->GetJenisPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            $data['statuspasien'] = $this->KunjunganStatusJenisPasienModel->GetStatusPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            $data['ruangan'] = $this->KunjunganStatusJenisPasienModel->GetRuanganBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            $data['datafilter'] = [
                'tahun'   => $tahun1,
                'bulanawal'   => $bulanawal,
                'bulanakhir'   => $bulanakhir,
                'nilaifilter' => $nilaifilter
            ];
            $this->load->view('rekammedis/LapKunjunganStatusJenisPas', $data);
        } elseif ($nilaifilter == 3) {
            $instalasi = $this->input->post('instalasi2');

            $data['title'] = "Laporan Kunjungan Status dan Jenis Pasien Berdasarkan Tahun";
            $data['subtitle'] =  $tahun2;
            $data['instalasi'] = $instalasi;
            $data['datafilter'] = $this->KunjunganStatusJenisPasienModel->filterbytahun($tahun2, $instalasi);
            $data['jenispasien'] = $this->KunjunganStatusJenisPasienModel->GetJenisPasienTahun($tahun2, $instalasi);
            $data['statuspasien'] = $this->KunjunganStatusJenisPasienModel->GetStatusPasienTahun($tahun2, $instalasi);
            $data['ruangan'] = $this->KunjunganStatusJenisPasienModel->GetRuanganTahun($tahun2, $instalasi);
            $data['datafilter'] = [
                'tahun'   => $tahun2,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter
            ];
            $this->load->view('rekammedis/LapKunjunganStatusJenisPas', $data);
        }
    }
}
