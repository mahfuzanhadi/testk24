<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Member extends CI_Controller
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
        $data['title'] = 'Member';

        if ($this->session->userdata('akses') == '1') {
            $this->load->view('templates/header', $data);
            $this->load->view('member/index', $data);
            $this->load->view('templates/footer');
        } else if ($this->session->userdata('akses') == '2') {
            $this->load->view('templates/member/header', $data);
            $this->load->view('member/profil', $data);
            $this->load->view('templates/footer');
        } else {
            $previous_url = $this->session->userdata('previous_url');
            redirect($previous_url);
        }
        $this->session->set_userdata('previous_url', current_url());
    }

    public function fetch_data()
    {
        $list = $this->Member_model->make_datatables();
        $data = array();
        $no = $_POST['start'];

        foreach ($list as $member) {
            $row = array();
            $no++;
            
            $base = base_url('uploads/foto_profil/' . $member->foto);

            $row[] = $no;
            $row[] = $member->nama;
            $row[] = $member->tanggal_lahir;

            $row[] = $member->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
            $row[] = $member->no_hp != '' ? $member->no_hp : '-';
            $row[] = $member->no_ktp != 0 ? $member->no_ktp : '-';
            $row[] = '<img width="64px" height="64px" src="' . $base . '"/>';
            $row[] = $member->email;
            $row[] = '<a href="member/edit/' . $member->member_id . ' " style="color: green; margin-left: 0.5rem"><i class="fas fa-pen"></i></a>&nbsp<a name="delete" onclick="delete_data(' . $member->member_id . ')"><i class="fas fa-trash" style="cursor: pointer; margin-left: 0.5rem; color: #d9232d"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST["draw"],
            "recordsTotal" => $this->Member_model->get_all_data(),
            "recordsFiltered" => $this->Member_model->get_filtered_data(),
            "data" => $data
        );

        //output to json format
        echo json_encode($output);
    }

    public function add()
    {
        $data['title'] = 'Tambah Data Member';

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[members.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        
        if ($this->form_validation->run() == FALSE)
        {     
            if ($this->session->userdata('akses') == '1') {
                $this->load->view('templates/header', $data);
                $this->load->view('member/add_data', $data);
                $this->load->view('templates/footer');
            } else {
                $previous_url = $this->session->userdata('previous_url');
                redirect($previous_url);
            }
            $this->session->set_userdata('previous_url', current_url());
        }
        else
        { 
            $config['upload_path']      = './uploads/foto_profil/';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 1024;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('error_message', $this->upload->display_errors());
                redirect(base_url('member/add'));
            } else {
                $foto = $this->upload->data('file_name');
            }

            $data = [
                'nama' => $this->input->post('nama'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'no_ktp' => $this->input->post('no_ktp'),            
                'foto' => $foto,
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];

            $this->Member_model->add_data($data);
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('member');
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Member';
        $data['member'] = $this->Member_model->getById($id);

        $this->form_validation->set_rules('nama', 'Nama', 'trim|required'); 
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
        
        if ($this->form_validation->run() == FALSE)
        {     
            if ($this->session->userdata('akses') == '1') {
                $this->load->view('templates/header', $data);
                $this->load->view('member/edit_data', $data);
                $this->load->view('templates/footer');
            } else if ($this->session->userdata('akses') == '2') {
                $this->load->view('templates/member/header', $data);
                $this->load->view('member/edit_data', $data);
                $this->load->view('templates/footer');
            } else {
                $previous_url = $this->session->userdata('previous_url');
                redirect($previous_url);
            }
            $this->session->set_userdata('previous_url', current_url());
        }
        else
        {
            if (!empty($_FILES["foto"])) {
                $config['upload_path']      = './uploads/foto_profil/';
                $config['allowed_types']    = 'jpg|jpeg|png';
                $config['max_size']         = 1024;

                $this->load->library('upload', $config);
                
                if (!$this->upload->do_upload('foto')) {
                    $this->session->set_flashdata('error_message', $this->upload->display_errors());
                    redirect(base_url('member/edit/' . $id));
                } else {
                    $foto = $this->upload->data('file_name');
                }
            } else {
                $foto = $this->input->post('old_image');
            }

            $password = $this->input->post('password');
            if ($password == '') {
                $password = $this->input->post('password2');
            } else {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }

            $data = [
                'nama' => $this->input->post('nama'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'no_hp' => $this->input->post('no_hp'),
                'no_ktp' => $this->input->post('no_ktp'),            
                'foto' => $foto,
                'email' => $this->input->post('email'),
                'password' => $password,
            ];

            $this->Member_model->edit_data(array('member_id' => $this->input->post('id')), $data);
            $this->session->set_flashdata('flash', 'diubah');
            redirect('member');
        }
    }

    public function delete($id)
    {
        $this->Member_model->delete_data($id);
        echo json_encode(array("status" => true));
    }
}
