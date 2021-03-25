<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPasienPulangRanap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rekammedis/M_DaftarPasienPulangRanap");
        //$this->load->library('mypdf');
        //$this->mypdf->generate('rekammedis/laporan/LapDaftarPasienRajal');
    }

    public function index()
    {
        $data['title'] = 'Daftar Pasien Pulang Rawat Inap';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/DaftarPasienPulangRanap', $data);
        $this->load->view('templates/footer');
    }

    public function getData()
    {
        $results = $this->M_DaftarPasienPulangRanap->getDataTable();

        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->NoCM;
            $row[] = $result->NamaPasien;
            $row[] = $result->JenisKelamin;
            $row[] = date('d-m-Y', strtotime($result->TglLahir));
            $row[] = $result->Telepon;
            $row[] = $result->Alamat;
            $row[] = date('d-m-Y m:s', strtotime($result->TglPendaftaran));
            $row[] = $result->JenisPasien;
            $row[] = $result->NamaRuangan;
            $row[] = date('d-m-Y m:s', strtotime($result->TglPulang));
            $row[] = $result->LamaDirawat;
            $row[] = $result->JenisDiagnosa;
            $row[] = $result->KodeDiagnosa;
            $row[] = $result->NamaDiagnosa;
            $row[] = $result->Dokter;
            $row[] = $result->StatusPulang;
            $row[] = $result->KondisiPulang;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_DaftarPasienPulangRanap->getDataTable(),
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
        $kondisipulang   = strtoupper($this->input->post('kondisipulang'));

        if ($caritext == '') {
            $caritext = '%';
        }

        $results    = $this->M_DaftarPasienPulangRanap->getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $caritext,  $kondisipulang);

        $data = [];
        $no = 0;
        foreach ($results as $result) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $result->NoCM;
            $row[] = $result->NamaPasien;
            $row[] = $result->JenisKelamin;
            $row[] = date('d-m-Y', strtotime($result->TglLahir));
            $row[] = $result->Telepon;
            $row[] = $result->Alamat;
            $row[] = date('d-m-Y m:s', strtotime($result->TglPendaftaran));
            $row[] = $result->JenisPasien;
            $row[] = $result->NamaRuangan;
            $row[] = date('d-m-Y m:s', strtotime($result->TglPulang));
            $row[] = $result->LamaDirawat;
            $row[] = $result->JenisDiagnosa;
            $row[] = $result->KodeDiagnosa;
            $row[] = $result->NamaDiagnosa;
            $row[] = $result->Dokter;
            $row[] = $result->StatusPulang;
            $row[] = $result->KondisiPulang;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_DaftarPasienPulangRanap->getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang),
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
        $caritext   = strtoupper($this->input->post('caritext'));
        $kondisipulang   = $this->input->post('radiokondisipulang');
        $tombolcetak   = $this->input->post('tombolcetak');

        if ($caritext == '') {
            $caritext = '%';
        }

        $result['datahasil']    = $this->M_DaftarPasienPulangRanap->getDataTableFilter($awal, $akhir, $jenispasien, $ruangan, $caritext, $kondisipulang);
        $result['datafilter']    = [
            'TglAwal' => $awal,
            'TglAkhir' => $akhir,
            'JenisPasien' => $jenispasien,
            'Ruangan' => $ruangan,
            'CariText' => $caritext
        ];
        if ($result['datahasil']) {

            if ($tombolcetak == '1') {
                $this->load->view('rekammedis/laporan/LapDaftarPasienPulang', $result);
            } else {
                $this->load->view('rekammedis/laporan/LapDaftarPasienPulangKonPlg', $result);
            }
        }
    }
}
