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

            $data['title'] = "Laporan Penjualan By Tanggal";
            $data['subtitle'] = "Dari tanggal : " . $tanggalawal . ' Sampai tanggal : ' . $tanggalakhir;
            $data['datafilter'] = $this->KunjunganStatusJenisPasienModel->filterbytanggal($tanggalawal, $tanggalakhir);

            $this->load->view('page/barang/print_laporan', $data);
        } elseif ($nilaifilter == 2) {

            $data['title'] = "Laporan Penjualan By Bulan";
            $data['subtitle'] = "Dari bulan : " . $bulanawal . ' Sampai tanggal : ' . $bulanakhir . ' Tahun : ' . $tahun1;
            $data['datafilter'] = $this->KunjunganStatusJenisPasienModel->filterbybulan($tahun1, $bulanawal, $bulanakhir);

            $this->load->view('page/barang/print_laporan', $data);
        } elseif ($nilaifilter == 3) {

            $data['title'] = "Laporan Penjualan By Tahun";
            $data['subtitle'] = ' Tahun : ' . $tahun2;
            $data['datafilter'] = $this->KunjunganStatusJenisPasienModel->filterbytahun($tahun2);

            $this->load->view('page/barang/print_laporan', $data);
        }
    }
}
