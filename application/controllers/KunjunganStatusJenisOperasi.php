<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class KunjunganStatusJenisOperasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('rekammedis/M_KunjunganStatusJenisOperasi');
    }
    function index()
    {
        $data['tahun'] = $this->M_KunjunganStatusJenisOperasi->gettahun();

        $data['title'] = 'Kunjungan Berdasarkan Status dan Jenis Operasi';
        $data['laporan'] = 'Laporan Berdasarkan Status dan Jenis Operasi';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/KunjunganStatusJenisOperasi', $data);
        $this->load->view('templates/footer');
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

        if ($nilaifilter == 1) {
            $instalasi = $this->input->post('instalasi');

            $data['title'] = "Laporan Kunjungan Status dan Jenis Operasi Berdasarkan Tanggal";
            $data['subtitle'] = date('d-m-Y', strtotime($tanggalawal)) . ' s.d : ' . date('d-m-Y', strtotime($tanggalakhir));
            $data['instalasi'] = $instalasi;
            $data['datafilter'] = $this->M_KunjunganStatusJenisOperasi->filterbytanggal($tanggalawal, $tanggalakhir, $instalasi);
            $data['jenisoperasi'] = $this->M_KunjunganStatusJenisOperasi->GetJenisOperasiTgl($tanggalawal, $tanggalakhir, $instalasi);
            $data['statuspasien'] = $this->M_KunjunganStatusJenisOperasi->GetStatusPasienTgl($tanggalawal, $tanggalakhir, $instalasi);
            $data['ruangan'] = $this->M_KunjunganStatusJenisOperasi->GetRuanganTgl($tanggalawal, $tanggalakhir, $instalasi);
            $data['datafilter'] = [
                'tanggalawal'   => $tanggalawal,
                'tanggalakhir'   => $tanggalakhir,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganStatusJenisOperasi', $data);
        } elseif ($nilaifilter == 2) {
            $instalasi = $this->input->post('instalasi1');

            $data['title'] = "Laporan Kunjungan Status dan Jenis Operasi Berdasarkan Bulan";;
            $data['subtitle'] =  $bulanawal . ' s.d ' . $bulanakhir . ' Tahun : ' . $tahun1;
            $data['instalasi'] = $instalasi;
            $data['datafilter'] = $this->M_KunjunganStatusJenisOperasi->filterbybulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            $data['jenisoperasi'] = $this->M_KunjunganStatusJenisOperasi->GetJenisOperasiBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            $data['statuspasien'] = $this->M_KunjunganStatusJenisOperasi->GetStatusPasienBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            $data['ruangan'] = $this->M_KunjunganStatusJenisOperasi->GetRuanganBulan($tahun1, $bulanawal, $bulanakhir, $instalasi);
            $data['datafilter'] = [
                'tahun'   => $tahun1,
                'bulanawal'   => $bulanawal,
                'bulanakhir'   => $bulanakhir,
                'nilaifilter' => $nilaifilter
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganStatusJenisOperasi', $data);
        } elseif ($nilaifilter == 3) {
            $instalasi = $this->input->post('instalasi2');

            $data['title'] = "Laporan Kunjungan Status dan Jenis Operasi Berdasarkan Tahun";;
            $data['subtitle'] =  $tahun2 . ' s.d ' . $tahun3;
            $data['instalasi'] = $instalasi;
            $data['datafilter'] = $this->M_KunjunganStatusJenisOperasi->filterbytahun($tahun2, $instalasi, $tahun3);
            $data['jenisoperasi'] = $this->M_KunjunganStatusJenisOperasi->GetJenisOperasiTahun($tahun2, $instalasi, $tahun3);
            $data['statuspasien'] = $this->M_KunjunganStatusJenisOperasi->GetStatusPasienTahun($tahun2, $instalasi, $tahun3);
            $data['ruangan'] = $this->M_KunjunganStatusJenisOperasi->GetRuanganTahun($tahun2, $instalasi, $tahun3);
            $data['datafilter'] = [
                'tahun'   => $tahun2,
                'instalasi'   => $instalasi,
                'nilaifilter' => $nilaifilter,
                'tahunakhir' => $tahun3
            ];
            $this->load->view('rekammedis/laporan/LapKunjunganStatusJenisOperasi', $data);
        }
    }
}
