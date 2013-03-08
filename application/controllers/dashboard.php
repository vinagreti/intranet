<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$this->dash();
	}

	public function dash()
	{
		$data->serverInfo = $_SERVER;
		$content = $this->load->view('dashboard/estatisticas', $data, true);

		$data = array(
			'page_title' => 'Dashboard',
			'content' => $content
			);

		$this->parser->parse('template', $data);
	}

	public function apacheInfo()
	{
		$data->serverInfo = $_SERVER;
		$content = $this->load->view('dashboard/serverInfo', $data, true);

		$data = array(
			'page_title' => 'Dash - Apache conf',
			'content' => $content
			);

		$this->parser->parse('template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */