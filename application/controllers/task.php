<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

  public function __construct() {
  	// define os tipos de usuarios que podem acessar a classe Task
    parent::__construct();
    $data['methodLevel'] = array('projectMember', 'admin');
    $data['methodName'] = 'Sistema de tarefas';
    $this->permission->allow($data);
  }

	public function index()
	{
		$this->load->model("task/task_model");
		$data->filters = $this->task_model->getAllFilters($this->session->userdata('userID'));
		$content = $this->load->view('task/search', $data, true);
		$data = array(
			'page_title' => 'Tarefas',
			'content' => $content
			);
		$this->parser->parse('template', $data);
	}

	public function loadFilters() {
		$this->load->model("task/task_model");
		$searchPatterns = $this->task_model->getAllFilters($this->session->userdata('userID'));
		echo json_encode($searchPatterns);
	}

	public function filter()
	{
		$this->load->model('user/user_model');
		$data->users = $this->user_model->getAll();
		echo $this->load->view('task/filter', $data);
	}

	function mountSearchPattern($searchPattern){
		$data->whereParameters = array();
		$data->statuses = array();
		if(isset($searchPattern["taskID"])) $data->whereParameters["taskID"] = $searchPattern["taskID"];
		if(isset($searchPattern["taskFather"])) $data->whereParameters["taskFather"] = $searchPattern["taskFather"];
		if(isset($searchPattern["taskResponsableUser"])) $data->whereParameters["taskResponsableUser"] = $searchPattern["taskResponsableUser"];
		if(isset($searchPattern["taskLink"])) $data->whereParameters["taskLink"] = $searchPattern["taskLink"];
		if(isset($searchPattern["taskStatus1"])) array_push($data->statuses , 1);
		if(isset($searchPattern["taskStatus2"])) array_push($data->statuses , 2);
		if(isset($searchPattern["taskStatus3"])) array_push($data->statuses , 3);
		if(isset($searchPattern["taskStatus4"])) array_push($data->statuses , 4);
		if(isset($searchPattern["taskStatus5"])) array_push($data->statuses , 5);
		if(isset($searchPattern["taskStatus6"])) array_push($data->statuses , 6);
		if(sizeof($data->statuses) == 0) $data->statuses = "";
		return $data;
	}

	public function search()
	{
		$post = $this->input->post();
		$firstRow = $post['firstRow'];
		$numRows = $post['numRows'];
		$filter = $post['filter'];
		$this->load->model('task/task_model');

		if ( $filter == 'first' ) {
			$filter = $this->task_model->getFilterDefault($this->session->userdata('userID'));
			if( $filter ){
				$searchPattern = unserialize($filter->searchPattern);
				$data = $this->mountSearchPattern($searchPattern);
				$data->firstRow = $firstRow;
				$data->numRows = $numRows;
				$data = $this->task_model->search($data);
				
				echo json_encode($data);

			} else {
				$data->firstRow = $firstRow;
				$data->numRows = $numRows;
				$data = $this->task_model->getAll($data);

				echo json_encode($data);

			} 
		}	else if ($filter == 'all') {
			$data->firstRow = $firstRow;
			$data->numRows = $numRows;
			$data = $this->task_model->getAll($data);

			echo json_encode($data);

		} else if ( is_numeric( $filter ) ) {
			$filter = $this->task_model->getFilterByID($filter);
			$searchPattern = unserialize($filter->searchPattern);
			$data = $this->mountSearchPattern($searchPattern);
			$data->firstRow = $firstRow;
			$data->numRows = $numRows;
			$data = $this->task_model->search($data);

			echo json_encode($data);

		}	else if ( is_array( $filter ) ) {
			$data = $this->mountSearchPattern($filter);
			$data->firstRow = $firstRow;
			$data->numRows = $numRows;
			$data = $this->task_model->search($data);

			echo json_encode($data);
		}
	}

	public function saveFilter()
	{
		if($this->input->post("form")){
			$this->load->view('task/saveFilter');
		} else {
			$searchPattern = $this->input->post("searchPattern");
			$this->load->model('task/task_model');
			$filter["filterTitle"] = $this->input->post("filterTitle");
			$filter["userID"] = $this->session->userdata('userID');
			$filter["searchPattern"] = serialize($searchPattern);
			if($this->input->post("filterDefault")){
				$id = $this->task_model->saveFilterDeafult($filter);
				echo json_encode($id); 
			} else {
				$id = $this->task_model->saveFilter($filter);
				echo json_encode($id); 
			}
		}
	}

	public function filterSetDefault()
	{
		$this->load->model('task/task_model');
		$filter["filterID"] = $this->input->post("filterID");
		$data->task = $this->task_model->filterSetDefault($filter);

	}

	public function view($taskID)
	{	$this->load->model('task/task_model');
		$data->task = $this->task_model->getByID($taskID);
		$data->statuses = $this->task_model->getAllStatus();
		$data->kinds = $this->task_model->getAllKind();
		$data->taskComments = $this->task_model->getAllCommentByTask($taskID);	$this->load->model('user/user_model');
		$data->users = $this->user_model->getAll();
		$content = $this->load->view('task/view', $data, true);
		$data = array(
			'page_title' => 'Tarefas',
			'content' => $content
			);
		$this->parser->parse('template', $data);
	}

	public function update($taskID)
	{
		$data = $this->input->post();
		if(!isset($data['taskResponsableUser'])) $data['taskResponsableUser'] = $this->session->userdata('userID');
		$this->load->model('task/task_model');
		$response = $this->task_model->update($taskID, $data);
		echo json_encode($response);
	}

	public function newTask() {
		if($this->input->post()){
			if($this->input->post("form")){
				$this->load->model('task/task_model');
				$temp->firstRow = 0;
				$temp->numRows = "18446744073709551615";
				$tasks = $this->task_model->getAll($temp);
				$data->tasks = $tasks->tasks;
				$this->load->model('user/user_model');
				$data->taskResponsableUsers = $this->user_model->getAll();
				$data->taskKinds = $this->task_model->getAllKind();
				$data->taskProjects = $this->task_model->getAllProject();
				echo $this->load->view('task/taskForm', $data);		
			}
			else {
				$this->load->model('user/user_model');
				$data = $this->input->post();
				$data['taskCreatorUser'] = $this->session->userdata('userID');
				$date = DateTime::createFromFormat('d/m/Y H:i:s', $data['deadLineDate']);
				$data['deadLineDate'] = $date->format('Y-m-d H:i:s');
				$this->load->model('task/task_model');
				$response['db'] = $this->task_model->createTask($data);

				$userID = $this->input->post('taskResponsableUser');
				$responsable = $this->user_model->getByID($userID);
				$to = $responsable->userEmail;
				$subject = 'Task ' . $response['db'];
				$message = '<p>Uma nova tarefa foi criada por<p>';
				foreach($this->input->post() as $key => $content) $message = $message."<p>".$key.": ".$content."</p>";

				$this->load->library('email');
				$this->email->set_newline("\r\n");
				$this->email->from('task@intranet.tzadi.com');
				$this->email->to($to);
				$this->email->subject(utf8_decode($subject));
				$message = '<html><head><meta charset="utf-8"></head><body>'.$message.'</body></html>';
				$this->email->message(utf8_decode($message));

				$this->load->library('gmail');
				$response['mail'] = $this->gmail->send($to, utf8_decode($subject), utf8_decode($message));

				echo $response;
			}
		}
	}

	public function createProjectForm()
	{
		$data = '';
		echo $this->load->view('task/projectForm', $data, true);
	}

	public function createProject()
	{
		$data = $this->input->post();
		$this->load->model('task/task_model');
		$response = $this->task_model->createProject($data);
		echo $response;
	}

	public function rejectTask()
	{
		if($this->input->post()){
			if($this->input->post("form")){
				$data->taskID = $this->input->post("taskID");
				echo $this->load->view('task/rejectForm', $data, true);
			}
		} else { 
			$this->session->set_flashdata('uri', uri_string());
			redirect(base_url() . 'error/denyDirectAccess', 'refresh');
		}
	}

	public function cancelTask()
	{
		if($this->input->post()){
			if($this->input->post("form")){
				$data->taskID = $this->input->post("taskID");
				echo $this->load->view('task/cancelForm', $data, true);
			}
		} else { 
			$this->session->set_flashdata('uri', uri_string());
			redirect(base_url() . 'error/denyDirectAccess', 'refresh');
		}
	}

	public function reopenTask()
	{
		if($this->input->post()){
			if($this->input->post("form")){
				$data->taskID = $this->input->post("taskID");
				echo $this->load->view('task/reopenForm', $data, true);
			}
		} else { 
			$this->session->set_flashdata('uri', uri_string());
			redirect(base_url() . 'error/denyDirectAccess', 'refresh');
		}
	}

	public function saveActivity()
	{
		if($this->input->post()){
			if($this->input->post("form")){
				$data->taskID = $this->input->post("taskID");
				echo $this->load->view('task/activityForm', $data, true);
			} else {

				$data = $this->input->post();

				$date = DateTime::createFromFormat('d/m/Y H:i:s', $data['activityStart']);
				$data['activityStart'] = $date->format('Y-m-d H:i:s');

				$date = DateTime::createFromFormat('d/m/Y H:i:s', $data['activityEnd']);
				$data['activityEnd'] = $date->format('Y-m-d H:i:s');

				$data['activityUser'] = $this->session->userdata('userID');

				$this->load->model('task/task_model');
				$response['db'] = $this->task_model->registerActivity($data);


				echo json_encode($response);				
			}
		} else { 
			$this->session->set_flashdata('uri', uri_string());
			redirect(base_url() . 'error/denyDirectAccess', 'refresh');
		}
	}

	public function finishTask()
	{
		if($this->input->post()){
			if($this->input->post("form")){
				$data->taskID = $this->input->post("taskID");
				echo $this->load->view('task/finishForm', $data, true);
			} else {

				$data = $this->input->post();

				$date = DateTime::createFromFormat('d/m/Y H:i:s', $data['activityStart']);
				$data['activityStart'] = $date->format('Y-m-d H:i:s');

				$date = DateTime::createFromFormat('d/m/Y H:i:s', $data['activityEnd']);
				$data['activityEnd'] = $date->format('Y-m-d H:i:s');

				$data['activityUser'] = $this->session->userdata('userID');

				$this->load->model('task/task_model');
				$response['db'] = $this->task_model->registerActivity($data);


				echo json_encode($response);				
			}
		} else { 
			$this->session->set_flashdata('uri', uri_string());
			redirect(base_url() . 'error/denyDirectAccess', 'refresh');
		}
	}

	public function saveActionComment()
	{
		$data = $this->input->post();
		$data['commentUser'] = $this->session->userdata('userID');
		$this->load->model('task/task_model');
		$response['db'] = $this->task_model->createComment($data);

		$responsable = $this->task_model->getTaskResponsable($data['commentTask']);
		$to = $responsable->userEmail;
		$subject = 'Task ' . $data['commentTask'];
		$message = '<p>Um novo comentário foi efetuado na tarefa <a href="intranet.tzadi.com/task/view/'.$data['commentTask'].'">'.$data['commentTask'].'</a><p>';
		foreach($data as $key => $content) $message = $message."<p>".$key.": ".$content."</p>";
		$this->load->library('gmail');
		$response['mail'] = $this->gmail->send($to, utf8_decode($subject), utf8_decode($message));

		echo json_encode($response);
	}

	public function comment()
	{
		if($this->input->post()) {
			if($this->input->post('form')){
				$data->taskID = $this->input->post("taskID");
				echo $this->load->view('task/commentForm', $data, true);
			}
		} else { 
			$this->session->set_flashdata('uri', uri_string());
			redirect(base_url() . 'error/denyDirectAccess', 'refresh');
		}
	}

	public function getUsersLog()
	{
		$taskUserIDs = $this->input->post("taskUserIDs");
		$this->load->model('task/task_model');
		$usersLog = $this->task_model->getUsersLog($taskUserIDs);
		echo json_encode($usersLog);
	}

	public function userActivities($activityUser = null)
	{
		if( ! $activityUser) $activityUser = $this->session->userdata('userID');
		$this->load->model('task/task_model');
		$data->userLog = $this->task_model->userActivities($activityUser);
		$data->activityUser = $activityUser;
		$content = $this->load->view('task/userActivities', $data, true);
		$data = array(
			'page_title' => 'Tarefas',
			'content' => $content
			);
		$this->parser->parse('template', $data);
	}
}

/* End of file*/