<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPasienRajal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rekammedis/DaftarPasienRajalModel");
    }

    public function index()
    {
        $data['title'] = 'Daftar Pasien Rawat Jalan';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/DaftarPasienRajal', $data);
        $this->load->view('templates/footer');
    }

    public function getData()
    {
        $results = $this->DaftarPasienRajalModel->getDataTable();

        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->NoCM;
            $row[] = $result->NamaPasien;
            $row[] = $result->Umur;
            $row[] = $result->JK;
            $row[] = $result->JenisPasien;
            $row[] = $result->NamaRuangan;
            $row[] = $result->NamaDiagnosa;
            $row[] = date('d-m-Y m:s', strtotime($result->TglMasuk));
            $row[] = date('d-m-Y', strtotime($result->TglLahir));
            $row[] = $result->Telepon;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->DaftarPasienRajalModel->getDataTable(),
            "data" => $data,
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function AmbilData()
    {
        $awal   = $this->input->post('awal');
        $akhir   = $this->input->post('akhir');
        $jenispasien   = $this->input->post('jenispasien');
        $ruangan   = $this->input->post('ruangan');
        $caritext   = strtoupper($this->input->post('caritext'));

        if ($caritext == '') {
            $caritext = '%';
        }

        $results    = $this->DaftarPasienRajalModel->getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $caritext);

        $data = [];
        $no = 0;
        foreach ($results as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->NoCM;
            $row[] = $result->NamaPasien;
            $row[] = $result->Umur;
            $row[] = $result->JK;
            $row[] = $result->JenisPasien;
            $row[] = $result->NamaRuangan;
            $row[] = $result->NamaDiagnosa;
            $row[] = date('d-m-Y m:s', strtotime($result->TglMasuk));
            $row[] = date('d-m-Y', strtotime($result->TglLahir));
            $row[] = $result->Telepon;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->DaftarPasienRajalModel->getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $caritext),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }


    public function cetak()
    {
        $this->load->view('rekammedis/LapBukuRegister');
    }
}
