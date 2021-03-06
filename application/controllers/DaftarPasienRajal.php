<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPasienRajal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rekammedis/M_DaftarPasienRajal");
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('idpegawai')) {
            $data['title'] = 'Daftar Pasien Rawat Jalan';
            $data['laporan'] = 'Laporan Daftar Pasien Rawat Jalan';
            $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
            $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('rekammedis/DaftarPasienRajal', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
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

        $results    = $this->M_DaftarPasienRajal->getDataTable($awal, $akhir, $jenispasien, $ruangan, $caritext, '1');
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
            $row[] = $result->Alamat;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_DaftarPasienRajal->count_all_data($awal, $akhir, $jenispasien, $ruangan, '1'),
            "recordsFiltered" => $this->M_DaftarPasienRajal->count_filtered_data($awal, $akhir, $jenispasien, $ruangan, '1'),
            "data" => $data
        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }


    public function Cetak()
    {
        $awal   = $this->input->post('awal');
        $akhir   = $this->input->post('akhir');
        $jenispasien   = $this->input->post('jenispasien');
        $ruangan   = $this->input->post('ruangan');
        $caritext   = strtoupper($this->input->post('caritext'));

        if ($caritext == '') {
            $caritext = '%';
        }


        $result['datahasil']    = $this->M_DaftarPasienRajal->getDataTable($awal, $akhir, $jenispasien, $ruangan, $caritext, '2');
        $result['datafilter']    = [
            'TglAwal' => $awal,
            'TglAkhir' => $akhir,
            'JenisPasien' => $jenispasien,
            'Ruangan' => $ruangan,
            'CariText' => $caritext
        ];

        if ($result['datahasil']) {
            $this->load->view('rekammedis/laporan/LapDaftarPasienRajal', $result);
        }
    }
}
