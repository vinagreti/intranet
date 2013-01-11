<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends MY_Controller {

	public function index()
	{
		$this->listAll();
	}

	public function listAll()
	{

		$this->load->model('task/task_model');
		$data->tasks = $this->task_model->getAll();
		$data->taskFilters = $this->task_model->getAllFilters();
		$data->taskProjects = $this->task_model->getAllProject();

		$this->load->model('user/user_model');
		$data->users = $this->user_model->getAll();

		$this->loadViewWithTemplate('task/list', $data, true);
	}

	public function ajaxSearch(){

		$whereParameters = array();

		$statuses = null;

		$searchPattern = $this->input->post();

		if(isset($searchPattern["taskID"])) $whereParameters["taskID"] = $searchPattern["taskID"];
		if(isset($searchPattern["taskFather"])) $whereParameters["taskFather"] = $searchPattern["taskFather"];
		if(isset($searchPattern["taskProject"])) $whereParameters["taskProject"] = $searchPattern["taskProject"];
		if(isset($searchPattern["taskResponsableUser"])) $whereParameters["taskResponsableUser"] = $searchPattern["taskResponsableUser"];
		if(isset($searchPattern["taskStatus"])) $statuses = $searchPattern["taskStatus"];

		$this->load->model('task/task_model');

		$data->tasks = $this->task_model->search($whereParameters, $statuses);

		$data->totalTasks = $this->task_model->getTotal();

		$this->load->view('task/ajaxSearch', $data);

	}

	public function saveFilter()
	{
		$searchPattern = serialize($this->input->post());
		$this->load->model('task/task_model');
		$data->task = $this->task_model->saveFilter($searchPattern);
	}

	public function view($taskID)
	{

		$this->load->model('task/task_model');
		$data->task = $this->task_model->getByID($taskID);
		$data->statuses = $this->task_model->getAllStatus();
		$data->kinds = $this->task_model->getAllKind();
		$data->taskComments = $this->task_model->getAllCommentByTask($taskID);

		$this->load->model('user/user_model');
		$data->users = $this->user_model->getAll();

		$this->loadViewWithTemplate('task/view', $data, false);
	}

	public function update($taskID)
	{
		$data = $this->input->post();
		$data['taskResponsableUser'] = $this->session->userdata('userID');
		$this->load->model('task/task_model');
		$this->task_model->update($taskID, $data);

		echo "Alteração realizada com sucesso!";
	}

	public function createTaskForm()
	{
		$this->load->model('task/task_model');

		$data->tasks = $this->task_model->getAll();

		$data->taskID = '';

		$data->taskTitle = '';

		$this->load->model('user/user_model');

		$data->taskResponsableUsers = $this->user_model->getAll();

		$data->taskKinds = $this->task_model->getAllKind();

		$data->taskProjects = $this->task_model->getAllProject();

		$data->projectID = '';

		$data->projectTitle = '';

		echo $this->load->view('task/newTaskDialogForm', $data, true);
	}

	public function createTask()
	{
		$data = $this->input->post();
		$data['taskCreatorUser'] = $this->session->userdata('userID');
		$this->load->model('task/task_model');
		$dbResponse = $this->task_model->createTask($data);

		echo $dbResponse;
	}

	public function createProjectForm()
	{
		$data = '';

		echo $this->load->view('task/newProjectDialogForm', $data, true);
	}

	public function createProject()
	{
		$data = $this->input->post();
		$this->load->model('task/task_model');
		$dbResponse = $this->task_model->createProject($data);

		echo $dbResponse;
	}

	public function newCommentForm()
	{
		$data->taskID = $this->input->post("taskID");

		echo $this->load->view('task/newCommentForm', $data, true);
	}

	public function newComment()
	{
		$data = $this->input->post();
		$data['commentUser'] = $this->session->userdata('userID');
		$this->load->model('task/task_model');
		$dbResponse = $this->task_model->createComment($data);

		echo $dbResponse;
	}

	public function listByStatus($taskStatus){
		$this->load->model('task/task_model');
		$data->tasks = $this->task_model->getAllByStatus($taskStatus);
		$this->loadViewWithTemplate('task/list', $data);
	}

	public function comment()
	{
		$data->comment = $this->input->post('comment', true);
		$data->taskID = $this->input->post('taskID', true);
		$data->commentUserID = $this->session->userdata('userID');
		$this->load->model('task/task_model');
		$dbResponse = $this->task_model->comment($data);

		echo $dbResponse;
	}
}

/* End of file*/