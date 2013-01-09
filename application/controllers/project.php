<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends MY_Controller {

	public function index()
	{
		$this->listAll();
	}

	public function listAll()
	{
		$this->load->model('project/project_model');
		$data->projects = $this->project_model->getAll();
		$this->loadViewWithTemplate('project/list', $data);
	}

	public function view($projectID = 0)
	{
		$this->load->model('project/project_model');

		if($data->project = $this->project_model->getByID($projectID)){

			$this->load->model('user/user_model');
			$data->users = $this->user_model->getAll();

			$this->load->model('project/status_model');
			$data->statuses = $this->status_model->getAll();

			$this->load->model('project/kind_model');
			$data->kinds = $this->kind_model->getAll();

			$this->load->model('demand/demand_model');
			$data->demands = $this->demand_model->getAllByProjectID($projectID);

			$this->loadViewWithTemplate('project/view', $data);
		}
		else $this->loadViewWithTemplate('project/projectNotFound');


	}

	public function update($projectID)
	{
		$data = $this->input->post();
		$this->load->model('project/project_model');
		$this->project_model->update($projectID, $data);

		redirect(base_url() . 'project/view/'.$projectID, 'refresh');
	}	

	public function finish($projectID)
	{
		$this->load->model('project/project_model');
		$this->project_model->finish($projectID);
		redirect(base_url() . 'project/view/'.$projectID, 'refresh');
	}

	public function cancel($projectID)
	{
		$this->load->model('project/project_model');
		$this->project_model->cancel($projectID);
		redirect(base_url() . 'project/view/'.$projectID, 'refresh');
	}

	public function create()
	{
		$data = $this->input->post();
		$this->load->model('project/project_model');
		$query = $this->project_model->create($data);
		echo $query;
	}

	public function createForm()
	{
		echo $this->loadViewWithJS('project/newProjectDialogForm', false, true);
	}	

}

/* End of file*/