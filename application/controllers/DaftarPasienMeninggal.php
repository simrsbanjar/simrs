<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPasienMeninggal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("rekammedis/M_DaftarPasienMeninggal");
        $this->load->library('session');
    }
    public function index()
    {
        if ($this->session->userdata('idpegawai')) {
            $data['title'] = 'Daftar Pasien Meninggal';
            $data['laporan'] = 'Laporan Daftar Pasien Meninggal';
            $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
            $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('rekammedis/DaftarPasienMeninggal', $data);
            $this->load->view('templates/footer');
        } else {
            redirect('auth');
        }
    }


    public function AmbilData()
    {
        $awal   = $this->input->post('awal');
        $akhir   = $this->input->post('akhir');
        $caritext   = strtoupper($this->input->post('caritext'));

        if ($caritext == '') {
            $caritext = '%';
        }
        $results    = $this->M_DaftarPasienMeninggal->getDataTable($awal, $akhir, $caritext, '1');

        $data = [];
        $no = 0;
        foreach ($results as $result) {
            $no++;
            $row = array();
            $row[] = '
            <a href ="DaftarPasienMeninggal/CetakSurat/' . $result->NoPendaftaran . '" value="2" name="tombolcetak" target="_blank" 
            class="btn btn-success btn-sm">Cetak Surat Meninggal</a>
            ';
            $row[] = $no;
            $row[] = $result->NoPendaftaran;
            $row[] = $result->NoCM;
            $row[] = $result->NamaPasien;
            $row[] = $result->JK;
            $row[] = $result->Umur;
            $row[] = $result->Alamat;
            $row[] = date('d-m-Y h:m', strtotime($result->TglPendaftaran));
            $row[] = date('d-m-Y h:m', strtotime($result->TglMeninggal));
            $row[] = $result->Penyebab;
            $row[] = $result->TempatMeninggal;
            $row[] = $result->DokterPemeriksa;
            $row[] = $result->KdRuangan;
            $row[] = $result->NamaSubInstalasi;
            $row[] = $result->UmurTahun;
            $row[] = $result->Pekerjaan;
            $row[] = $result->KdKelasAkhir;
            $row[] = $result->DeskKelas;
            $row[] = $result->KdKelompokPasien;
            $row[] = $result->JenisPasien;
            $row[] = $result->Kota;
            $row[] = $result->Kelurahan;
            $row[] = $result->Kecamatan;
            $row[] = $result->RTRW;
            $row[] = date('d-m-Y', strtotime($result->TglLahir));
            $row[] = $result->IdPegawai;
            $row[] = $result->NamaJabatan;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->M_DaftarPasienMeninggal->count_filtered_data($awal, $akhir, $caritext, '1'),
            "recordsFiltered" => $this->M_DaftarPasienMeninggal->count_all_data($awal, $akhir, $caritext, '1'),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function CetakSurat($nopendaftaran)
    {
        $result['pasien']    = $this->M_DaftarPasienMeninggal->getDataTableFilterSurat($nopendaftaran);

        $this->load->view('rekammedis/laporan/LapSuratMeninggal', $result);
    }

    public function Cetak()
    {
        $awal   = $this->input->post('awal');
        $akhir   = $this->input->post('akhir');
        $caritext   = strtoupper($this->input->post('caritext'));
        $tombolcetak = $this->input->post('tombolcetak');

        if ($caritext == '') {
            $caritext = '%';
        }


        $result['datahasil']    = $this->M_DaftarPasienMeninggal->getDataTable($awal, $akhir, $caritext, '2');
        $result['datafilter']    = [
            'TglAwal' => $awal,
            'TglAkhir' => $akhir,
            'CariText' => $caritext
        ];

        $this->load->view('rekammedis/laporan/LapDaftarPasienMeninggal', $result);
    }
}
