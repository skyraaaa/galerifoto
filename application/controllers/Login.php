<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('MLogin');
	}

	public function index()
	{
		// if (isset($_POST['btn_login']))
		// {
		// 	$username = $this->input->post('username', TRUE);
		// 	$password = $this->input->post('password', TRUE);

		// 	$this->load->model('MLogin');
		// 	$notif = $this->MLogin->GoLogin($username,$password);
				
		// 	if($notif)
		// 	{
		// 		$this->load->library('session');
		// 		$this->session->set_userdata('Login',$notif);
		// 		redirect(site_url('Welcome'));
		// 	}			
		// 	else
		// 	{
		// 		$this->load->library('session');
		// 		$this->session->unset_userdata('Login');
		// 		redirect(site_url('Login'));
		// 	}
		// }
		$this->load->view('VLogin');
		
	}
	public function login() {
		// Validasi form
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('VLogin');
		} else {
			// Load the MLogin model
			$this->load->model('MLogin');
	
			$username = $this->input->post('username');
			$password = $this->input->post('password');
	
			// Use the GoLogin method from MLogin model
			$user = $this->MLogin->GoLogin($username, $password);
	
			if ($user) {
				// Login successful, store user data in session or set user as logged in
				$this->session->set_userdata('username', $user);
				$this->session->set_userdata('Login', 'Aktif');
	
				// Redirect to a secured area or any other page
				redirect('Welcome/');  // Use redirect instead of $this->load->view
			} else {
				// Login failed
				echo "Login gagal!";
			}
		}
	}
	
}
?>