<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function index()
	{
		$data->serverInfo = $_SERVER;
		$this->loadViewWithTemplate('dashboard/index', $data, false);
	}

	public function serverInfo()
	{
		$data->serverInfo = $_SERVER;
		$this->loadViewWithTemplate('dashboard/serverInfo', $data, false);
	}

	public function phpInfo()
	{
		$data->serverInfo = $_SERVER;
		$this->loadViewWithTemplate('dashboard/serverInfo', $data, false);
	}

	public function gitInfo()
	{
		$data->serverInfo = $_SERVER;
		$this->loadViewWithTemplate('dashboard/serverInfo', $data, false);
	}

	public function mysqlInfo()
	{
		$data->serverInfo = $_SERVER;
		$this->loadViewWithTemplate('dashboard/serverInfo', $data, false);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */