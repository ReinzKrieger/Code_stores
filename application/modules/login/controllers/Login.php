<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MX_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('login_m');
		$this->load->library(array('form_validation', 'session'));
		$this->load->helper('url');
	}


	function index()
	{
		if ($this->login_m->cek_session()) {
			redirect(base_url("admin/dashboard"));
		} else {
			$this->load->view('login_v');
			$this->load->helper('url');
		}
	}

	function verif_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$where = array(
			'username' => $username,
			'password' => md5($password)
		);
		$cek = $this->login_m->cek_login("users", $where)->num_rows();
		if ($cek > 0) {
			$this->session->set_userdata('username', $username);

			redirect(base_url("admin/dashboard"));
			$this->session->set_flashdata('success', 'Login sukses');
		} else {
			$this->session->set_flashdata('login_failed', '<div class = "alert alert-danger"> Username atau Password salah !</div>');
			redirect(base_url('login'));
		}
	}

	public function register()
	{
		$data['title'] = 'Sign Up';
		$this->form_validation->set_rules('nama', 'Nama', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('register_v', $data);
			$this->load->helper('url');
		} else {
			$enc_password = md5($this->input->post('password'));

			$this->login_m->register($enc_password);

			$this->session->set_flashdata('user_registered', 'Selamat kamu sudah terdaftar');

			redirect(base_url('login'));
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	public function cekLogin()
	{
		if (isset($_SESSION['username'])) {
			return true;
		}
	}
}
