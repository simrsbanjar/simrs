<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapBesarKematianTen extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rekammedis/M_RekapBesarKematianTen");
    }

    public function index()
    {
        $data['title'] = 'Rekapitulasi 10 Besar Kematian';
        $data['laporan'] = 'Rekapitulasi 10 Besar Kematian';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/RekapBesarKematianTen', $data);
        $this->load->view('templates/footer');
    }

    function GetRuanganInst()
    {
        $instalasi = $this->input->post('instalasi');
        $data = $this->M_RekapBesarKematianTen->GetRuanganInst($instalasi);
        echo json_encode($data);
    }

    public function Grafik()
    {
        $awal   = $this->input->post('awal');
        $akhir   = $this->input->post('akhir');
        $jenispasien   = $this->input->post('jenispasien');
        $ruangan   = $this->input->post('ruangan');
        $jumlahbaris   = strtoupper($this->input->post('jumlahdata'));
        $instalasi   = strtoupper($this->input->post('instalasi'));
        $kriteria   = strtoupper($this->input->post('kriteria'));

        $results    = $this->M_RekapBesarKematianTen->getGrafik($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria);

        foreach ($results as $row) {

            $data[] = array(
                'hasil' => $row->hasil,
                'total' => $row->total
            );
        }
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

        $results    = $this->M_RekapBesarKematianTen->getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria);

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
            "recordsTotal" => $this->M_RekapBesarKematianTen->getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria),
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
        $kliktombol   = $this->input->post('kliktombol');

        if ($kriteria == '1') {
            $kriteriatext   = 'BERDASARKAN DIAGNOSA';
        } else {
            $kriteriatext   = 'BERDASARKAN JUMLAH PASIEN';
        }

        $result['datahasil']    = $this->M_RekapBesarKematianTen->getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria);
        $result['datafilter']    = [
            'TglAwal' => $awal,
            'TglAkhir' => $akhir,
            'JenisPasien' => $jenispasien,
            'Ruangan' => $ruangan,
            'Instalasi' => $instalasi,
            'Kriteria' => $kriteriatext,
            'JumlahData' => $jumlahbaris,
            'kliktombol' => $kliktombol
        ];

        $resultgrafik    = $this->M_RekapBesarKematianTen->getGrafik($awal, $akhir, $jenispasien, $ruangan, $jumlahbaris,  $instalasi, $kriteria);

        foreach ($resultgrafik as $row) {

            $data[] = array(
                'hasil' => $row->hasil,
                'total' => $row->total
            );
        }
        $result['datagrafik'] =  $data;

        if ($result['datahasil']) {
            $this->load->view('rekammedis/laporan/LapRekapBesarKematianTen', $result);
        }
    }
}
