<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	public function index()
	{
		$this->permission();
	}

	public function permission()
	{
		$conteudo = $this->load->view('error/permission', "", true);
		$data = array(
			'page_title' => 'Permissão negada',
			'content' => $conteudo);
		$this->parser->parse('template', $data);
	}
}

/* End of file Error.php */