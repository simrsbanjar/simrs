<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('idpegawai')) {
            $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
            $data['title']          = 'Profile';
            $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
            $data['menu']           = $this->db->query("SELECT * FROM ListMenuWeb WHERE StatusEnabled = '1' ORDER BY NoUrut")->result();

            $this->load->view('menu/index', $data);
        } else {
            redirect('auth');
        }
    }
}
