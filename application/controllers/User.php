<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('User_model');

        if ($this->session->userdata('masuk') != TRUE) {
            $url = base_url();
            redirect($url);
        }
    }

    public function index()
    {
        $data['title'] = 'user';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '2') {
            $this->load->view('templates/header', $data);
            $this->load->view('user/readonly', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $list = $this->User_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $user) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $user->username;
            $row[] = '<a href="user/edit/' . $user->user_id . ' " style="color: green; margin-left: 0.5rem"><i class="fas fa-pen"></i></a>&nbsp<a name="delete" onclick="delete_data(' . $user->user_id . ')"><i class="fas fa-trash" style="cursor: pointer; margin-left: 0.5rem; color: #d9232d"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->User_model->get_all_data(),
            "recordsFiltered" => $this->User_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data User';

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        
        if ($this->form_validation->run() == FALSE)
        {     
            if ($this->session->userdata('akses') == '1') {
                $this->load->view('templates/header', $data);
                $this->load->view('user/add_data', $data);
                $this->load->view('templates/footer');
            } else {
                $previous_url = $this->session->userdata('previous_url');
                redirect($previous_url);
            }
            $this->session->set_userdata('previous_url', current_url());
        }
        else
        { 
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];

            $this->User_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('user');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data User';
        $data['user'] = $this->User_model->getById($id);

        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
        
        if ($this->form_validation->run() == FALSE)
        {     
            if ($this->session->userdata('akses') == '1') {
                $this->load->view('templates/header', $data);
                $this->load->view('user/edit_data', $data);
                $this->load->view('templates/footer');
            } else {
                $previous_url = $this->session->userdata('previous_url');
                redirect($previous_url);
            }
            $this->session->set_userdata('previous_url', current_url());
        }
        else
        {
            $password = $this->input->post('password');
            if ($password == '') {
                $password = $this->input->post('password2');
            } else {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $data = [
                'username' => $this->input->post('username'),
                'password' => $password,
            ];

            $this->User_model->edit_data(array('user_id' => $this->input->post('id')), $data);
            $this->session->set_flashdata('flash', 'diubah');
            redirect('user');
        }
    }

    public function delete($id)
    {
        $this->User_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
