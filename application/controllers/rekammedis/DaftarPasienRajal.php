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
            $row[] = $result->NamaDiagnosa;
            $row[] = $result->TglMasuk;
            $row[] = $result->TglLahir;
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

    public function cetak()
    {
        $this->load->view('rekammedis/LapBukuRegister');
    }
}
