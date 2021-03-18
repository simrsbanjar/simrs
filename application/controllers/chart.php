<?php
class Chart extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //load chart_model from model
        $this->load->model('rekammedis/chart_model');
    }

    function index()
    {
        $data = $this->chart_model->get_data()->result();
        $x['data'] = json_encode($data);
        // $this->load->view('chart_view', $x);
        $this->load->view('chart_cuy');
        // $this->load->view('chart_cuk', $x);
        // var_dump($x);
        // die;
    }
}
