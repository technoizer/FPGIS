<?php
	
class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function index()
	{
		if($this->session->userdata('login') == TRUE)
		{
			redirect('home');
		}
		else
		{
			$this->load->view('login');
		}
	}
	
	function doLogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
			
		$this->load->model('akun');
			
		$auth = $this->akun->login($username, $password);
			
		if($auth)
		{
			$data = array('username' => $username, 'login' => TRUE);
			$this->session->set_userdata($data);
			if($username == 'admin'){
				redirect('admin');
			}
		}
		else
		{
			$this->session->set_flashdata('pesan', 'Username atau password salah!');
		}
		redirect('home');
	}
	
	function doLogout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}

	function register()
	{
		$this->load->view('register');
	}

	function doRegister()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$job = 'user'; 
			
		$this->load->model('akun');
			
		$auth = $this->akun->register($username,$password,$name,$job,$email);
			
		if($auth)
		{	
			
		}
		else
		{
			$auth = $this->akun->login($username, $password);
			$data = array('username' => $username, 'login' => TRUE);
			$this->session->set_userdata($data);
		}
		redirect('home');
	}
}

/* End of file auth.php */