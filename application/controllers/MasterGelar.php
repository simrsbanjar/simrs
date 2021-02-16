<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterGelar extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Master Gelar';
        //var_dump($this->session->userdata('username'));
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();

        $data['gelar'] = $this->db->get('Title')->result_array();

        $array = array(
            'KdTitle'   => 'KdTitle',
            'NamaTitle' => 'judul',
            'KodeExternal' => 'kodeexternal',
            'NamaExternal' => 'namaexternal',
            'StatusEnabled' => '1'
        );

        $this->form_validation->set_rules('judul', 'NamaTitle', 'trim|required');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/MasterGelar', $data);
            $this->load->view('templates/footer');
        } else {
            $stsaktif   =  $this->input->post('statusaktif');

            if ($stsaktif  != '1') {
                $stsaktif   = '0';
            }

            $query = $this->db->query("SELECT MAX(KdTitle) as max_id FROM Title");
            $row = $query->row_array();
            $max_id = $row['max_id'];
            //$max_id1 = (int) substr($max_id, 1, 2);
            $max_id1 = (int) $max_id;
            $kdtitle = $max_id1 + 1;

            $data = array(
                'NamaTitle' => $this->input->post('judul'),
                'StatusEnabled' => $stsaktif,
                'KdTitle' =>  $kdtitle,
                'KodeExternal' => '',
                'NamaExternal' => ''
            );

            $this->db->insert('Title', $data);

            redirect('MasterGelar');
        }
    }
}
