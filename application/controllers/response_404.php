<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Response_404 extends CI_Controller{

	public function __construct(){
		parent::__construct(); 
	} 

	public function index(){
		$this->output->set_status_header('404');
		$data['response'] = 'Sorry! Page not found.'; 
		$this->load->view('payments/response', $data);
	}

}