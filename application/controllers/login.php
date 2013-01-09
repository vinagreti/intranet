<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{

		if($this->session->userdata('userLevel') != 'public') redirect(base_url() . 'task', 'refresh');	
		else $this->load->view('login/userLogin');

	}


	public function submit()
	{

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->load->model('login_model');
		$permission = $this->login_model->checkCredential($email, $password);

		if($permission) {
			redirect(base_url() . 'dashboard', 'refresh');
		}
		else {
			redirect(base_url() . 'login', 'refresh');
		}

	}

}

/* End of file*/