<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StatusPegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("admin/StatusPegawaiModel");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['datapegawai']    = $this->db->get_where('dataPegawai', ['IdPegawai' => $this->session->userdata('idpegawai')])->row_array();
        $data['ruangan']        = $this->db->get_where('ruangan', ['KdRuangan' => $this->session->userdata('ruangan')])->row_array();
        $data['StatusPegawai'] = $this->StatusPegawaiModel->getAll();
        $this->load->view("admin/statuspegawai/list", $data);
    }
    public function add()
    {
        $stspegawai  = $this->StatusPegawaiModel;
        $validation = $this->form_validation;
        $validation->set_rules($stspegawai->rules());

        if ($validation->run()) {
            $stspegawai->save();
            $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
        }

        $this->load->view("admin/statuspegawai/new_form");
    }

    public function edit($KdStatus = null)
    {
        if (!isset($KdStatus)) redirect('admin/statuspegawai');

        $stspegawai = $this->StatusPegawaiModel;
        $validation = $this->form_validation;
        $validation->set_rules($stspegawai->rules());

        if ($validation->run()) {
            $stspegawai->update();
            $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
        }

        $data["StatusPegawai"] = $stspegawai->getById($KdStatus);
        if ($data["StatusPegawai"]) show_404();

        $this->load->view("admin/statuspegawai/edit_form");
    }

    public function delete($kdstatus = null)
    {
        if (!isset($kdstatus)) show_404();

        if ($this->StatusPegawaiModel->delete($kdstatus)) {
            redirect('StatusPegawai');
        }
    }
}
