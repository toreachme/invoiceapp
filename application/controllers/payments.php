<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('third_party/stripe/init.php');

class Payments extends CI_Controller {

	public $stripePublicKey = 'pk_test_JFfnzRst2cg3FXSVonaj0PqV';
	private $stripePrivateKey = 'sk_test_udwGZUblsjzYuqyTI7UyGcx3';


	public function index(){

		$data['response'] = False;
		$this->load->view('payments/response',$data);
	}

	public function page($hash = null){
		if ($hash) {
			$this->load->model('Customers_model');
			$this->load->model('Invoices_model');

			$invoiceObj = $this->Invoices_model->getInvoiceByhash($hash);
			if ($invoiceObj) {
            //get stripe public key
				$data['stripePubKey'] = $this->Invoices_model->getStripePubKey();
            //get Customer Object
				$customerObj = $this->Customers_model->getCustomerById($invoiceObj->cust_id);
				$data['Invoice'] = $invoiceObj;
				$data['Customer'] = $customerObj;

				$this->load->view('invoices/preview', $data);

			}
			else{
				$data['response'] = "Sorry wrong URL parameter!!";
				$this->load->view('payments/response',$data);

			}
		}
		else{
			$data['response'] = False;
			$this->load->view('payments/response',$data);
		}

	}

	public function charge(){
		$this->setPrivateKey();
		$stripToken = $this->input->post('stripeToken'); 
		$stripeEmail = $this->input->post('stripeEmail');

		if($stripToken){
			$this->load->model('Customers_model');
			$this->load->model('Invoices_model');

			$customerObj = $this->Customers_model->getCustomerByEmail($stripeEmail);
			$invoiceObj = $this->Invoices_model->getInvoiceByCustomer($customerObj->cust_id);

			try {
				$charge = \Stripe\Charge::create(array(
					"amount" => (int)round($invoiceObj->amount,0) * 100, //get this from database
					"currency" => "usd",
					"source" => $stripToken, // obtained with Stripe.js
					"description" => $invoiceObj->description //get from database
					));
				
				if ($charge->paid == 1) {
					$fields['status'] = 'paid';
					$updatedInvoice = $this->Invoices_model->updateInvoice($invoiceObj->invoice_id,$fields);

					if ($updatedInvoice) {
						$this->session->set_flashdata('charge_paid_msg', $charge->paid);
						$this->session->set_flashdata('charge_captured_msg', $charge->captured);
					}

				}
				
			} catch (\Stripe\Error\Card $e) {
				$body = $e->getJsonBody();
				$err  = $body['error'];

				$responseErr = $err['message'];
				$this->session->set_flashdata('msg', $responseErr);
				
			}

			redirect('payments/response');

		}
	}

	public function response(){
		$charge_paid = $this->session->flashdata('charge_paid_msg');
		$charge_capture = $this->session->flashdata('charge_captured_msg');

		if ($charge_paid) {
			$data['response'] = 'Thanks! Your payment went through.' ;
			$this->load->view('payments/response', $data);
		}else{
			$data['response'] = 'Sorry Your payment did\'t go through.';
			$this->load->view('payments/response', $data);

		}

	}

     // Set your secret key: remember to change this to your live secret key in production
    // See your keys here: https://dashboard.stripe.com/account/apikeys
	private function setPrivateKey(){
		return \Stripe\Stripe::setApiKey($this->stripePrivateKey);

	} 



}
