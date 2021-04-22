<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapBesarPenyakitTen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rekammedis/M_RekapBesarPenyakitTen");
        $this->load->library('session');
        //$this->load->library('mypdf');
        //$this->mypdf->generate('rekammedis/laporan/LapDaftarPasienRajal');
    }

    public function index()
    {
        if ($this->session->userdata('idpegawai')) {
            $data['title'] = 'Rekapitulasi 10 Besar Penyakit';
            $data['laporan'] = 'Rekapitulasi 10 Besar Penyakit';
            $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
            $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('rekammedis/RekapBesarPenyakitTen', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }

    function GetRuanganInst()
    {
        $instalasi = $this->input->post('instalasi');
        $data = $this->M_RekapBesarPenyakitTen->GetRuanganInst($instalasi);
        echo json_encode($data);
    }

    public function AmbilData()
    {
        $awal   = $this->input->post('awal');
        $akhir   = $this->input->post('akhir');
        $jenispasien   = $this->input->post('jenispasien');
        $ruangan   = $this->input->post('ruangan');
        $jumlahbaris   = strtoupper($this->input->post('jumlahdata'));
        $instalasi   = strtoupper($this->input->post('instalasi'));
        $kriteria   = strtoupper($this->input->post('kriteria'));

        $results    = $this->M_RekapBesarPenyakitTen->getDataTable($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria, '1');

        $data = [];
        $no = 0;
        foreach ($results as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->Diagnosa;
            $row[] = $result->JumlahPasien;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_RekapBesarPenyakitTen->count_all_data($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria, '1'),
            "recordsFiltered" => $this->M_RekapBesarPenyakitTen->count_filtered_data($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria, '1'),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }


    public function Cetak()
    {
        $awal   = $this->input->post('awal');
        $akhir   = $this->input->post('akhir');
        $jenispasien   = $this->input->post('jenispasien');
        $ruangan   = $this->input->post('ruangan');
        $jumlahbaris   = strtoupper($this->input->post('jumlahdata'));
        $instalasi   = strtoupper($this->input->post('instalasi'));
        $kriteria   = strtoupper($this->input->post('radiokriteria'));

        if ($kriteria == '1') {
            $kriteriatext   = 'BERDASARKAN DIAGNOSA';
        } else {
            $kriteriatext   = 'BERDASARKAN JUMLAH PASIEN';
        }

        $result['datahasil']    = $this->M_RekapBesarPenyakitTen->getDataTable($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria, '2');
        $result['datafilter']    = [
            'TglAwal' => $awal,
            'TglAkhir' => $akhir,
            'JenisPasien' => $jenispasien,
            'Ruangan' => $ruangan,
            'Instalasi' => $instalasi,
            'Kriteria' => $kriteriatext,
            'JumlahData' => $jumlahbaris
        ];

        if ($result['datahasil']) {
            $this->load->view('rekammedis/laporan/LapRekapBesarPenyakitTen', $result);
        }
    }
}
