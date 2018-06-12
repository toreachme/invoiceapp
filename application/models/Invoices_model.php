<?php
class Invoices_model extends CI_Model {


	/*
	* Main Create method
	*/

	function createInvoice($fields){
		$string=$this->db->insert_string('Invoices', $fields);
		$this->db->query($string);
		$invoiceId = $this->db->insert_id();
		
		return $invoiceId;
	}


	function updateInvoice($invoiceId,$fields){
		$this->db->where('invoice_id', $invoiceId);
		$this->db->update('Invoices', $fields);
		$updated = $this->db->affected_rows();

		return $updated;
	}

	function getInvoices($offSet = null){
		if ($offSet !== null){ $sortOrder = "LIMIT 10 OFFSET ".$offSet; }
		else{ $sortOrder = "ORDER BY cust_id ASC"; }
		$string = "SELECT * FROM Invoices $sortOrder";
		$response = $this->db->query($string);

		return $response->result();
	}

	function getInvoicesCount(){
		$string = "SELECT * FROM Invoices";
		$response = $this->db->query($string);

		return $response->num_rows();
	}

	function getInvoiceById($invoiceId){
		$string = "SELECT * FROM Invoices WHERE invoice_id = '$invoiceId'";
		$response = $this->db->query($string);

		if($response->num_rows() == 1){

			return $response->row();
		}
		else
		{
			return FALSE;
		}
	}

	function getInvoiceByhash($hash){
		$string = "SELECT * FROM Invoices WHERE link = '$hash'";
		$response = $this->db->query($string);

		if($response->num_rows() == 1){

			return $response->row();
		}
		else
		{
			return FALSE;
		}
	}

	function getInvoiceByCustomer($custId){
		$string = "SELECT * FROM Invoices WHERE cust_id = '$custId'";
		$response = $this->db->query($string);

		if($response->num_rows() == 1){

			return $response->row();
		}
		else
		{
			return FALSE;
		}
	}


	function getRecentInvoices(){
		$string = "SELECT * FROM Invoices ORDER BY created_at DESC LIMIT 3";
		$response = $this->db->query($string);

		return $response->result();

	}

	function generateHash($length=8, $strength=0) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength & 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength & 2) {
			$vowels .= "AEUY";
		}
		if ($strength & 4) {
			$consonants .= '23456789';
		}
		if ($strength & 8) {
			$consonants .= '@#$%';
		}

		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(mt_rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(mt_rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return  $password.rand(1,99);
	}

	function getStripePubKey(){
		$string = "SELECT publishable_key FROM Stripe WHERE credential_id = 1";
		$response = $this->db->query($string);

		return $response->row();

	}



}