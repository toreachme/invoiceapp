<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Sessions_model');
		$this->load->model('Customers_model');
		$this->load->library('pagination');
		$this->Sessions_model->adminNotLoggedIn();
	}


	public function index(){
		$flashMsg = $this->session->flashdata('msg');
		return $this->viewAllCustomers($flashMsg);
	}


	public function viewAllCustomers($flashMsg){
		//Pagination Configuration
		$num_of_rows = $this->Customers_model->getCustomersCount();
		$total_num_rows = 10;
		if ($num_of_rows > 10) {
			$total_num_rows = $num_of_rows;
		}

		$config['base_url'] = base_url('/customers/index/');
		$config['total_rows'] = $total_num_rows;
		$config['per_page'] = 10;
		$config['num_links'] = 10;

		$config["full_tag_open"] = '<nav aria-label="Page navigation" class="float-left mt-5"><ul class="pagination">';
		$config["full_tag_close"] = '</ul></nav>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['prev_link'] = 'Previous';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$config['use_page_numbers'] = FALSE;


		$this->pagination->initialize($config);

		$offSet = $this->uri->segment(3,0); // add zero because the intial value returns nothing, so this return 0
		$data['msg'] = $flashMsg;
		$data['Customers'] = $this->allCustomers($offSet);
		$this->load->view('customers/all', $data);
	}



	public function createform(){
		$this->load->view('customers/create');
	}

	public function updateform($custId){
		if ($custId) {
			$data['Customer'] = $this->Customers_model->getCustomerById($custId);
			$this->load->view('customers/update', $data);
		}

	}



	public function create(){
		$this->load->model('Invoices_model');
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		


		
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'E-Mail Address', 'required|valid_email');
		$this->form_validation->set_rules('pay_schedule', 'Pay Schedule', 'required');
		$this->form_validation->set_rules('ticket_price', 'Ticket Price', 'required');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('customers/create');		
		}
		else
		{
			$fields = array(
				'first_name' => $this->input->post('first_name'), 
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'pay_schedule' => $this->input->post('pay_schedule'),
				'ticket_price' => $this->input->post('ticket_price')
				);
			//print_r($fields);
			$invoice_auto_redirect = $this->input->post('invoice_auto_redirect');

			$custId = $this->Customers_model->createCustomer($fields);

			if($invoice_auto_redirect && $custId){
				redirect('invoices/createform/'.$custId);	
			}
			elseif($custId) {
				$this->session->set_flashdata('msg', 'Customer Created!');
				redirect('customers');
			}
			else{
				$this->session->set_flashdata('msg', 'Oops! Customer record was not created. Please contact tech support!');
				redirect('customers/createform');
			}	

		}


	}



	public function update(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		


		
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');
		$this->form_validation->set_rules('email', 'E-Mail Address', 'required|valid_email');
		$this->form_validation->set_rules('pay_schedule', 'Pay Schedule', 'required');
		$this->form_validation->set_rules('ticket_price', 'Ticket Price', 'required');

		$cust_id = $this->input->post('cust_id');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			$data['Customer'] = $this->Customers_model->getCustomerById($cust_id);
			$this->load->view('customers/update',$data);		
		}
		else
		{
			$fields = array(
				'first_name' => $this->input->post('first_name'), 
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'pay_schedule' => $this->input->post('pay_schedule'),
				'ticket_price' => $this->input->post('ticket_price')
				);

			$response = $this->Customers_model->updateCustomer($cust_id,$fields);
			if ($response) {
				$this->session->set_flashdata('msg', 'Customer Updated!');
				redirect('customers');
			}
			else{
				$this->session->set_flashdata('msg', 'There was an error. Please try again');
				redirect('customers');

			}	

		}


	}




	public function allCustomers($off_set = null){
		$customers = $this->Customers_model->getCustomers($off_set);
		return $customers;
	}






}