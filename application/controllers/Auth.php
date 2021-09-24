<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library('session');
        $this->load->model('Member_model');
        $this->load->model('User_model');
		$this->session->set_userdata('previous_url', current_url());
	}

	public function index()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->session->userdata('masuk') != TRUE) {
			if ($this->form_validation->run() == false) {
				$data['title'] = 'Login Page';
				$this->load->view('auth/login', $data);
			} else {
				//validasi success
				$this->_login();
			}
		} else {
			redirect('member');
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$admin = $this->db->where('username', $email)->get('users')->row_array();
		$member = $this->db->where('email', $email)->get('members')->row_array();

		if ($admin) {
			//usernya ada
			if (password_verify($password, $admin['password'])) {
				$data = [
					'id' => $admin['user_id'],
					'username' => $admin['username'],
				];
				
				$this->session->set_userdata($data);
				$this->session->set_userdata('masuk', TRUE);
				$this->session->set_userdata('akses', '1');
				redirect('member');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
				redirect(base_url());
			}
		} else if($member){
			//usernya ada
			if (password_verify($password, $member['password'])) {
				$data = [
					'id' => $member['member_id'],
					'nama' => $member['nama'],
					'tanggal_lahir' => $member['tanggal_lahir'],
					'jenis_kelamin' => $member['jenis_kelamin'],
					'no_hp' => $member['no_hp'],
					'no_ktp' => $member['no_ktp'],
					'foto' => $member['foto'],
					'email' => $member['email'],
					'password' => $member['password'],
				];
				
				$this->session->set_userdata($data);
				$this->session->set_userdata('masuk', TRUE);
				$this->session->set_userdata('akses', '2');
				redirect('member');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
				redirect(base_url());
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User tidak terdaftar!</div>');
			redirect(base_url());
		}
	}

	public function register_member()
	{
        $this->form_validation->set_rules('nama', 'Nama', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[members.email]', [
			'is_unique' => 'This email has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
	
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/register_member');
		} else {
            $config['upload_path']      = './uploads/foto_profil/';
            $config['allowed_types']    = 'jpg|jpeg|png';
            $config['max_size']         = 1024;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('foto')) {
                $this->session->set_flashdata('error_message', $this->upload->display_errors());
                redirect(base_url('auth/register'));
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
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];

            $this->Member_model->add_data($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun anda telah berhasil dibuat. Silahkan login terlebih dahulu!</div>');
			redirect('auth');
		}
	}

	public function register_user()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]', [
			'is_unique' => 'This username has already registered!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
			'matches' => 'Password dont match!',
			'min_length' => 'Password too short'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
	
		if ($this->form_validation->run() == false) {
			$this->load->view('auth/register_user');
		} else {
            $data = [
                'username' => $this->input->post('username'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            ];

            $this->User_model->add_data($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Akun anda telah berhasil dibuat. Silahkan login terlebih dahulu!</div>');
			redirect('auth');
		}
	}

	public function logout()
	{
		$user_data = $this->session->all_userdata();
        foreach ($user_data as $key) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
    	$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah berhasil logout!</div>');
		redirect(base_url());
	}
}
