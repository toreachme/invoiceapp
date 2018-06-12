<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoices extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Sessions_model');
		$this->load->model('Invoices_model');
		$this->load->model('Customers_model');
		$this->load->library('pagination');
		$this->Sessions_model->adminNotLoggedIn();
	}


	public function index(){

		return $this->viewAllInvoices();
	}


    //List all Invoices
	public function viewAllInvoices(){
		//Pagination Configuration
		$num_of_rows = $this->Invoices_model->getInvoicesCount();
		$total_num_rows = 10;
		if ($num_of_rows > 10) {
			$total_num_rows = $num_of_rows;
		}

		$config['base_url'] = base_url('/invoices/index/');
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


		$data['Invoices'] = $this->Invoices_model->getInvoices($offSet);
		$this->load->view('invoices/all',$data);
	}

    //Preview created Invoice using Invoice ID
	public function preview($invoiceId){
		$data['stripePubKey'] = $this->Invoices_model->getStripePubKey();

		$invoiceObj = $this->Invoices_model->getInvoiceById($invoiceId);
		$customerObj = $this->Customers_model->getCustomerById($invoiceObj->cust_id);
		$data['Invoice'] = $invoiceObj;
		$data['Customer'] = $customerObj;

		$this->load->view('invoices/preview', $data);
	}

    //View Invoice create form
	public function createform($cust_id = null){
		$data['cust_id'] = $cust_id;
		$this->load->view('invoices/create', $data);
	}



	public function create(){
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		

		$this->form_validation->set_rules('cust_id', 'Customer Number', 'required|numeric');
		$this->form_validation->set_rules('amount', 'Amount', 'required');
		$this->form_validation->set_rules('description', 'Description', 'required|max_length[140]');
		
		

		if ($this->form_validation->run() == FALSE)
		{
			$data['cust_id'] = $this->input->post('cust_id'); //
			$this->load->view('invoices/create', $data);		
		}
		else
		{
			$cust_id = $this->input->post('cust_id');
			$validCustId = $this->Customers_model->getCustomerById($cust_id);

			if ($validCustId->cust_id) {
				$random = $this->Invoices_model->generateHash();
				$link = $random;

				$fields = array(
					'cust_id' => $cust_id,
					'amount' => $this->input->post('amount'),
					'description' => $this->input->post('description'),
					'link' => $link
					);
				# code...
				$invoiceId = $this->Invoices_model->createInvoice($fields);
				if ($invoiceId) {
					redirect('invoices/preview/'.$invoiceId);
				}
				
			}
			else{
				$this->session->set_flashdata('msg', 'There is no customer with that customer number!');
				redirect('customers');
			}

		}


	}



	public function void($invoiceId){
		echo "Void Invoice";
	}







}