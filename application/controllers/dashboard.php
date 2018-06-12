<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Sessions_model');
		$this->load->model('Customers_model');
		$this->load->model('Invoices_model');
		$this->load->model('Admin_model');
		$this->Sessions_model->adminNotLoggedIn();
	}


	public function index(){
		return $this->main();
	}


	public function main(){
		$data['RecentCustomers'] = $this->Customers_model->getRecentCustomers();
		$data['RecentInvoices'] = $this->Invoices_model->getRecentInvoices();
		$this->load->view('main', $data);
	}


}