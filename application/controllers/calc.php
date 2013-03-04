<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Calc extends CI_Controller {

	public function index()
	{
		$this->load->view('calc/calc');
	}
}

/* End of file*/