<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Sessions_model');
		$this->load->model('Admin_model');
		
	}


	public function index(){

		$this->Sessions_model->loggedIn();
		$this->load->view('login');
	}


	function validate_admin($email, $password)
	{

		if ($this->Admin_model->validateAdminCredentials($email,$password)==FALSE)
		{
			$this->form_validation->set_message('validate_admin', 'The current email/password combination is invalid');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	public function login()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$password = sha1($password);
		
		$this->form_validation->set_rules('email', 'Email', 'valid_email|trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'E-Mail Address', 'callback_validate_admin['.$password.']');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('login');		
		}
		else
		{
			$id=$this->Admin_model->validateAdminCredentials($email,$password);
			$this->Sessions_model->setAdminSessionData($id);

			redirect('dashboard/');

		}

	}

	public function logout(){
		$this->Sessions_model->adminLogout();

	}



}

