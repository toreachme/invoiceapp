<?php
class Sessions_model extends CI_Model {

	function setAdminSessionData($id)// Sets the session Data
	{
		$this->session->set_userdata('admin', $id);
		$this->session->set_userdata('loggedin', TRUE);

	}

	function adminNotLoggedIn(){
		if(!$this->session->userdata('admin')){
			redirect('./');
		}
	}

	function loggedIn(){
		if ($this->session->userdata('admin')) {
			redirect('dashboard/');
		}
	}

	function adminLogout(){
		$this->session->sess_destroy();
		
		redirect('auth');
	}

}