<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MY_Controller {

	public function index()
	{
		$this->load->view('error/accessDenyed');
	}

	public function accessDenyed()
	{
		$this->load->view('error/accessDenyed');
	}

	public function pageNotFound()
	{
		$this->load->view('error/pageNotFound');
	}
}

/* End of file*/