<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		$this->estatisticas();
	}

	public function estatisticas()
	{
		$data->serverInfo = $_SERVER;
		$content = $this->load->view('dashboard/estatisticas', $data, true);

		$data = array(
			'page_title' => 'Tarefas',
			'content' => $content
			);

		$this->parser->parse('common/template', $data);
	}

	public function apacheInfo()
	{
		$data->serverInfo = $_SERVER;
		$this->loadViewWithTemplate('dashboard/serverInfo', $data, false);

		$this->load->model("task/task_model");
		$data->filters = $this->task_model->getAllFilters($this->session->userdata('userID'));
		$content = $this->load->view('task/search', $data, true);

		$data = array(
			'page_title' => 'Tarefas',
			'content' => $content
			);

		$this->parser->parse('common/template', $data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */