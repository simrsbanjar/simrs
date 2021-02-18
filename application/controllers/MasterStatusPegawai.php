<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterStatusPegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/StatusPegawaiModel");
    }

    public function index()
    {
        $data['title'] = 'Master Status Pegawai';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/MasterStatusPegawai', $data);
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
            $row[] = '
            <a href ="#" class="btn btn-success btn-sm" onclick="byid(' . "'" . $result->KdStatus . "','ubah'" . ')"> Ubah</a>
            <a href ="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->KdStatus . "','hapus'" . ')"> Hapus</a>
            ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->StatusPegawaiModel->count_all_data(),
            "recordsFiltered" => $this->StatusPegawaiModel->count_filtered_data(),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function add()
    {
        $this->_validation();
        $query = $this->db->query("SELECT MAX(KdStatus) as max_id FROM StatusPegawai");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 = (int) $max_id;
        $kdstatus = $max_id1 + 1;

        $stsaktif   =  $this->input->post('statusaktif');

        if ($stsaktif  != '1') {
            $stsaktif   = '0';
        }

        $data = [
            'KdStatus' => substr(('00' . $kdstatus), -2),
            'Status' => htmlspecialchars($this->input->post('status')),
            'KodeExternal' => htmlspecialchars($this->input->post('kodeexternal')),
            'NamaExternal' => htmlspecialchars($this->input->post('namaexternal')),
            'StatusEnabled' => $stsaktif
        ];

        if ($this->StatusPegawaiModel->create($data) > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    public function byid($kdstatus)
    {
        $data   = $this->StatusPegawaiModel->getdataById($kdstatus);
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
            'Status' => htmlspecialchars($this->input->post('status')),
            'KodeExternal' => htmlspecialchars($this->input->post('kodeexternal')),
            'NamaExternal' => htmlspecialchars($this->input->post('namaexternal')),
            'StatusEnabled' => $stsaktif
        ];

        if ($this->StatusPegawaiModel->update(array('KdStatus' => $this->input->post('kdstatus')), $data) >= 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    public function delete($kode)
    {
        if ($this->StatusPegawaiModel->delete($kode) > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    private function _validation()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($this->input->post('status') == '') {
            $data['error_string'][] = 'Status wajib diisi';
            $data['inputerror'][] = 'status';
            $data['status'] = false;
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}
