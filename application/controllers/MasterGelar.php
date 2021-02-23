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
            $row[] = '
            <a href ="#" class="btn btn-success btn-sm fa fa-edit" onclick="byid(' . "'" . $result->KdTitle . "','ubah'" . ')"> Ubah</a>
            <a href ="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->KdTitle . "','hapus'" . ')"><i class="fa fa-trash"> Hapus </i> </a>
            ';
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


    public function add()
    {
        $this->_validation();
        $query = $this->db->query("SELECT MAX(KdTitle) as max_id FROM Title");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 = (int) $max_id;
        $kdtitle = $max_id1 + 1;

        $stsaktif   =  $this->input->post('statusaktif');

        if ($stsaktif  != '1') {
            $stsaktif   = '0';
        }

        $data = [
            'KdTitle' => substr(('00' . $kdtitle), -2),
            'NamaTitle' => htmlspecialchars($this->input->post('namatitle')),
            'KodeExternal' => htmlspecialchars($this->input->post('kodeexternal')),
            'NamaExternal' => htmlspecialchars($this->input->post('namaexternal')),
            'StatusEnabled' => $stsaktif
        ];

        if ($this->GelarModel->create($data) > 0) {
            $message['namatitle'] = 'success';
        } else {
            $message['namatitle'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }


    public function byid($kdtitle)
    {
        $data   = $this->GelarModel->getdataById($kdtitle);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function update()
    {
        $this->_validation();
        $stsaktif   =  $this->input->post('statusaktif');

        if ($stsaktif  != '1') {
            $stsaktif   = '0';
        }

        $data = [
            'NamaTitle' => htmlspecialchars($this->input->post('namatitle')),
            'KodeExternal' => htmlspecialchars($this->input->post('kodeexternal')),
            'NamaExternal' => htmlspecialchars($this->input->post('namaexternal')),
            'StatusEnabled' => $stsaktif
        ];

        if ($this->GelarModel->update(array('KdTitle' => $this->input->post('kdtitle')), $data) >= 0) {
            $message['namatitle'] = 'success';
        } else {
            $message['namatitle'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    public function delete($kode)
    {
        if ($this->GelarModel->delete($kode) > 0) {
            $message['namatitle'] = 'success';
        } else {
            $message['namatitle'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }


    private function _validation()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['namatitle'] = true;

        if ($this->input->post('namatitle') == '') {
            $data['error_string'][] = 'Status wajib diisi';
            $data['inputerror'][] = 'namatitle';
            $data['namatitle'] = false;
        }

        if ($data['namatitle'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}
