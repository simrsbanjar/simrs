<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BukuRegister extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rekammedis/BukuRegisterModel");
    }

    public function index()
    {
        $data['title'] = 'Buku Register Pasien';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/BukuRegister', $data);
        $this->load->view('templates/footer');
    }

    public function getData()
    {
        $results = $this->StatusPegawaiModel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            if ($result->StatusEnabled == '1') {
                $stsaktif   = 'Aktif';
            } else {
                $stsaktif   = 'Tidak Aktif';
            }

            $row = array();
            $row[] = $result->KdStatus;
            $row[] = $result->Status;
            $row[] = $result->QStatus;
            $row[] = $result->KodeExternal;
            $row[] = $result->NamaExternal;
            $row[] = $stsaktif;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->BukuRegisterModel->count_all_data(),
            "recordsFiltered" => $this->BukuRegisterModel->count_filtered_data(),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function cetak()
    {
        $this->load->view('rekammedis/laporan/LapBukuRegister');
    }
}
