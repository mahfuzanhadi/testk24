<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Json extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Member_model');

        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $this->load->view('templates/header');
        $this->load->view('json/index');
        $this->load->view('templates/footer');
    }

    public function fetch_data()
    {
        $data = $this->Member_model->get_all();

        header('Content-type: application/json');
        echo json_encode($data);
    }
}
