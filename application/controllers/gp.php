<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gp extends MY_Controller {

	public function index()
	{
		$this->git();
	}

	public function git()
	{
		$data = '';
		$this->loadViewWithTemplate('gp/git', $data, false);
	}

}