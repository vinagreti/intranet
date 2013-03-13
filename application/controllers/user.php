<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$this->login();
	}

	public function login(){
		$content = $this->load->view('user/login', "", true);
		$data = array(
			'page_title' => 'Login',
			'content' => $content
			);
		$this->parser->parse('template', $data);
	}

	public function submitLogin()
	{

		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->load->model('user/user_model');
		$permission = $this->user_model->checkCredential($email, $password);

echo json_encode('value');

	}

	public function logout()
	{

		$this->session->unset_userdata('userID');
		$this->session->unset_userdata('userName');
		$this->session->unset_userdata('userEmail');
		$this->session->set_userdata('userLevel', 'public');

		redirect(base_url() . 'user', 'refresh');

	}

	public function ChangeProject()
	{

		$this->load->model('task/task_model');
		$userProject = $this->task_model->getProjectName($this->input->post('project'));
		$this->session->set_userdata('userProject', $this->input->post('project'));
		$this->session->set_userdata('userProjectName', $userProject->projectTitle);
	}

}

/* End of file*/