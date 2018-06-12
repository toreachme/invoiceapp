<?php
class Admin_model extends CI_Model {

	function validateAdminCredentials($email, $password)// Checks only for id/pass match in DB
	{	
		$string="SELECT count('id') as count FROM Admin WHERE email = '$email' AND password = '$password'";
		$query = $this->db->query($string);

		if($query->num_rows() == 1){
			$record = $query->row();
			return $record->count;
		}
		else{
			return FALSE;
		}
	}


}