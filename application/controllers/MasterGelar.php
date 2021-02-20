<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterGelar extends CI_Controller
{
    //constructor
    public function __construct()
    {
        parent::__construct();
        // Load Model
        $this->load->model('admin/GelarModel');
    }

    public function index()
    {
        $data['title'] = 'Master Gelar';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/MasterGelar', $data);
        $this->load->view('templates/footer');
    }

    public function getData()
    {
        $results = $this->GelarModel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            if ($result->StatusEnabled == '1') {
                $stsaktif = 'Aktif';
            } else {
                $stsaktif = 'Tidak Aktif';
            }

            $row = array();
            $row[] = $result->KdTitle;
            $row[] = $result->NamaTitle;
            $row[] = $result->KodeExternal;
            $row[] = $result->NamaExternal;
            $row[] = $stsaktif;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->GelarModel->count_all_data(),
            "recordsFiltered" => $this->GelarModel->count_filtered_data(),
            "data" => $data,

        );
        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }


    // public function index()
    // {
    //     $data['title'] = 'Master Gelar';
    //     //var_dump($this->session->userdata('username'));
    //     $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
    //     $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();

    //     $data['gelar'] = $this->db->get('Title')->result_array();

    //     $array = array(
    //         'KdTitle'   => 'KdTitle',
    //         'NamaTitle' => 'judul',
    //         'KodeExternal' => 'kodeexternal',
    //         'NamaExternal' => 'namaexternal',
    //         'StatusEnabled' => '1'
    //     );

    //     $this->form_validation->set_rules('judul', 'NamaTitle', 'trim|required');
    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('admin/MasterGelar', $data);
    //         $this->load->view('templates/footer');
    //     } else {
    //         $stsaktif   =  $this->input->post('statusaktif');

    //         if ($stsaktif  != '1') {
    //             $stsaktif   = '0';
    //         }

    //         $query = $this->db->query("SELECT MAX(KdTitle) as max_id FROM Title");
    //         $row = $query->row_array();
    //         $max_id = $row['max_id'];
    //         //$max_id1 = (int) substr($max_id, 1, 2);
    //         //$max_id1 = (int) substr($max_id, 1, 2);
    //         $max_id1 = (int) $max_id;
    //         $kdtitle = $max_id1 + 1;

    //         $data = array(
    //             'NamaTitle' => $this->input->post('judul'),
    //             'StatusEnabled' => $stsaktif,
    //             'KdTitle' =>  $kdtitle,
    //             'KodeExternal' => '',
    //             'NamaExternal' => ''
    //         );

    //         $this->db->insert('Title', $data);

    //         redirect('MasterGelar');
    //     }
    // }

    public function update()
    {
        $id['KdTitle'] = $this->input->post("e_title");
        $data = array(

            'NamaTitle'         => $this->input->post("e_namatitle"),
            'KodeExternal'      => $this->input->post("e_kodeexternal"),
            'NamaExternal'      => $this->input->post("e_namaexternal"),

        );
    }
    public function edit($editkdtitle)
    {
        $data1['title'] = 'Edit Title';
        $editkdtitle = $this->uri->segment(3);
        $data = array(
            'gelar' => $this->m_title->edit($editkdtitle),

        );
        $this->load->view('templates/header', $data1);
        // $this->load->view('admin/edit_title', $data);
        $this->load->view('admin/MasterGelar', $data);
        $this->load->view('templates/footer');
    }

    public function hapus($kdtitle)
    {
        $kodetitle['KdTitle'] = $this->uri->segment(3);
        $this->m_title->hapus($kodetitle);
        redirect('MasterGelar');
    }
}
