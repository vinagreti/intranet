<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{

		$this->session->unset_userdata('userID');
		$this->session->unset_userdata('userName');
		$this->session->unset_userdata('userEmail');
		$this->session->set_userdata('userLevel', 'public');

		redirect(base_url() . 'login', 'refresh');

	}

}

/* End of file*/