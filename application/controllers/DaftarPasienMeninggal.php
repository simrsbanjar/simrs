<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarPasienMeninggal extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Daftar Pasien Meninggal';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekammedis/DaftarPasienMeninggal', $data);
        $this->load->view('templates/footer');
    }
}
