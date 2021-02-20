<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterDiklat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/JenisDiklatModel");
        $this->load->model("admin/DiklatModel");
    }

    public function index()
    {
        $data['title'] = 'Master Diklat';
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/MasterDiklat', $data);
        $this->load->view('templates/footer');
    }

    public function getData()
    {
        $results = $this->JenisDiklatModel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            if ($result->StatusEnabled == '1') {
                $stsaktif   = 'Aktif';
            } else {
                $stsaktif   = 'Tidak Aktif';
            }

            $row = array();
            $row[] = $result->KdJenisDiklat;
            $row[] = $result->JenisDiklat;
            $row[] = $result->KodeExternal;
            $row[] = $result->NamaExternal;
            $row[] = $stsaktif;
            $row[] = '
            <a href ="#" class="btn btn-success btn-sm" onclick="byid(' . "'" . $result->KdJenisDiklat . "','ubah'" . ')"> Ubah</a>
            <a href ="#" class="btn btn-danger btn-sm" onclick="byid(' . "'" . $result->KdJenisDiklat . "','hapus'" . ')"> Hapus</a>
            ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->JenisDiklatModel->count_all_data(),
            "recordsFiltered" => $this->JenisDiklatModel->count_filtered_data(),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function getData1()
    {
        $results = $this->DiklatModel->getDataTable();
        $data = [];
        $no = $_POST['start'];
        foreach ($results as $result) {
            if ($result->StatusEnabled == '1') {
                $stsaktif   = 'Aktif';
            } else {
                $stsaktif   = 'Tidak Aktif';
            }

            $jenisdiklat        = $this->db->query("SELECT JenisDiklat FROM JenisDiklat where KdJenisDiklat = '" . $result->KdJenisDiklat . "'")->row();

            $row = array();
            $row[] = $result->KdDiklat;
            $row[] = $result->NamaDiklat;
            $row[] = $jenisdiklat->JenisDiklat;
            $row[] = $result->KodeExternal;
            $row[] = $result->NamaExternal;
            $row[] = $stsaktif;
            $row[] = '
            <a href ="#" class="btn btn-success btn-sm" onclick="byid1(' . "'" . $result->KdDiklat . "','ubah'" . ')"> Ubah</a>
            <a href ="#" class="btn btn-danger btn-sm" onclick="byid1(' . "'" . $result->KdDiklat . "','hapus'" . ')"> Hapus</a>
            ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->DiklatModel->count_all_data(),
            "recordsFiltered" => $this->DiklatModel->count_filtered_data(),
            "data" => $data,
        );

        $this->output->set_content_type('application/json')->set_output(json_encode($output));
    }

    public function add()
    {
        $this->_validation('tab1');
        $query = $this->db->query("SELECT MAX(KdJenisDiklat) as max_id FROM JenisDiklat");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 = (int) $max_id;
        $kode = $max_id1 + 1;

        $stsaktif   =  $this->input->post('statusaktif');

        if ($stsaktif  != '1') {
            $stsaktif   = '0';
        }

        $data = [
            'KdJenisDiklat' => substr(('00' . $kode), -2),
            'JenisDiklat' => htmlspecialchars($this->input->post('jenisdiklat')),
            'KodeExternal' => htmlspecialchars($this->input->post('kodeexternal')),
            'NamaExternal' => htmlspecialchars($this->input->post('namaexternal')),
            'StatusEnabled' => $stsaktif
        ];

        if ($this->JenisDiklatModel->create($data) > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    public function add1()
    {
        $this->_validation('tab2');
        $query = $this->db->query("SELECT MAX(KdDiklat) as max_id FROM Diklat");
        $row = $query->row_array();
        $max_id = $row['max_id'];
        $max_id1 = (int) $max_id;
        $kode = $max_id1 + 1;

        $stsaktif   =  $this->input->post('statusaktif');

        if ($stsaktif  != '1') {
            $stsaktif   = '0';
        }

        $data = [
            'KdDiklat' => substr(('00000' . $kode), -5),
            'NamaDiklat' => htmlspecialchars($this->input->post('diklat')),
            'KdJenisDiklat' => htmlspecialchars($this->input->post('jenisdiklat')),
            'KodeExternal' => htmlspecialchars($this->input->post('kodeexternal')),
            'NamaExternal' => htmlspecialchars($this->input->post('namaexternal')),
            'StatusEnabled' => $stsaktif
        ];

        if ($this->DiklatModel->create($data) > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    public function byid($kode)
    {
        $data   = $this->JenisDiklatModel->getdataById($kode);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function byid1($kode)
    {
        $data   = $this->DiklatModel->getdataById($kode);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function update()
    {
        $this->_validation('tab1');
        $stsaktif   =  $this->input->post('statusaktif');

        if ($stsaktif  != '1') {
            $stsaktif   = '0';
        }

        $data = [
            'JenisDiklat' => htmlspecialchars($this->input->post('jenisdiklat')),
            'KodeExternal' => htmlspecialchars($this->input->post('kodeexternal')),
            'NamaExternal' => htmlspecialchars($this->input->post('namaexternal')),
            'StatusEnabled' => $stsaktif
        ];

        if ($this->JenisDiklatModel->update(array('KdJenisDiklat' => $this->input->post('kdjenisdiklat')), $data) >= 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    public function update1()
    {
        $this->_validation('tab2');
        $stsaktif   =  $this->input->post('statusaktif');

        if ($stsaktif  != '1') {
            $stsaktif   = '0';
        }

        $data = [
            'NamaDiklat' => htmlspecialchars($this->input->post('diklat')),
            'KdJenisDiklat' => htmlspecialchars($this->input->post('jenisdiklat')),
            'KodeExternal' => htmlspecialchars($this->input->post('kodeexternal')),
            'NamaExternal' => htmlspecialchars($this->input->post('namaexternal')),
            'StatusEnabled' => $stsaktif
        ];

        if ($this->DiklatModel->update(array('KdDiklat' => $this->input->post('kddiklat')), $data) >= 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    public function delete($kode)
    {
        if ($this->JenisDiklatModel->delete($kode) > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }

    public function delete1($kode)
    {
        if ($this->DiklatModel->delete($kode) > 0) {
            $message['status'] = 'success';
        } else {
            $message['status'] = 'failed';
        };

        $this->output->set_content_type('aplication/json')->set_output(json_encode(($message)));
    }
    private function _validation($status)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = true;

        if ($status == 'tab1') {
            if ($this->input->post('jenisdiklat') == '') {
                $data['error_string'][] = 'Jenis Diklat wajib diisi';
                $data['inputerror'][] = 'jenisdiklat';
                $data['status'] = false;
            }
        } else {
            if ($this->input->post('diklat') == '') {
                $data['error_string'][] = 'Diklat wajib diisi';
                $data['inputerror'][] = 'diklat';
                $data['status'] = false;
            }
        }

        if ($data['status'] === false) {
            echo json_encode($data);
            exit();
        }
    }
}
