<?php
class Customers_model extends CI_Model {

	function createCustomer($fields){
		$string = $this->db->insert_string('Customers', $fields);
		$this->db->query($string);
		$id = $this->db->insert_id();
		
		return $id;
	}


	function updateCustomer($custId,$fields){
		$this->db->where('cust_id', $custId);
		$this->db->update('Customers', $fields);
		$updated = $this->db->affected_rows();

		return $updated;
	}

	function getCustomers($offSet = null){
		if ($offSet !== null){ $sortOrder = "LIMIT 10 OFFSET ".$offSet; }
		else{ $sortOrder = "ORDER BY cust_id ASC"; }
		$string = "SELECT * FROM Customers $sortOrder";
		$response = $this->db->query($string);

		return $response->result();
	}

	function getCustomerById($custId){
		$string = "SELECT * FROM Customers WHERE cust_id = '$custId'";
		$response = $this->db->query($string);

		if($response->num_rows() == 1){

			return $response->row();
		}
		else
		{
			return FALSE;
		}

	}

	function getCustomerByEmail($email){
		$string = "SELECT * FROM Customers WHERE email = '$email'";
		$response = $this->db->query($string);

		if($response->num_rows() == 1){

			return $response->row();
		}
		else
		{
			return FALSE;
		}

	}

	function getRecentCustomers(){
		$string = "SELECT * FROM Customers ORDER BY created_at DESC LIMIT 3";
		$response = $this->db->query($string);

		return $response->result();

	}

	function getCustomersCount(){
		$string = "SELECT * FROM Customers";
		$response = $this->db->query($string);

		return $response->num_rows();
	}



}