<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task extends CI_Controller {

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
		$this->load->model('task/task_model');
		$data->taskProjects = $this->task_model->getAllProject();
		$this->load->model('user/user_model');
		$data->users = $this->user_model->getAll();
		echo $this->load->view('task/filter', $data);
	}

	public function search()
	{
		$post = $this->input->post();
		$firstRow = $post['firstRow'];
		$numRows = $post['numRows'];

		if(isset($post['filterID'])) {
			$filterID = $post['filterID'];
			$this->load->model('task/task_model');
			$this->task_model->getFilterSearchPattern();
			$data->tasks = $this->task_model->getAllByFilterID($firstRow, $filterID);
			$data->total = $this->task_model->getAllByFilterIDCount();
			echo json_encode($data);
		}
		else if(isset($post['searchPattern'])) {
			$this->load->model('task/task_model');
			$data->tasks = $this->task_model->getAll($firstRow);
			$data->total = $this->task_model->getAllCount();
			echo json_encode($data);
		}
		else {
			$this->load->model('task/task_model');
			$data->tasks = $this->task_model->getAll($firstRow, $numRows);
			$data->total = $this->task_model->getAllCount();
			echo json_encode($data);
		}
	}

	public function saveFilter()
	{
		$searchPattern = $this->input->post("searchPattern");

		if($this->input->post("form")){
			$this->load->view('task/saveFilter');
		} else {
			$this->load->model('task/task_model');
			$filter["filterTitle"] = $this->input->post("filterTitle");
			$filter["userID"] = $this->session->userdata('userID');
			$filter["searchPattern"] = serialize($searchPattern);

			if($this->input->post("filterDefault") == true){
				$filter["default"] = 'true';
				$data->task = $this->task_model->saveFilterDeafult($filter);
			} else {
				$data->task = $this->task_model->saveFilter($filter);
			}
		}
	}

	public function filterSetDefault()
	{
		$this->load->model('task/task_model');
		$filter["filterID"] = $this->input->post("filterID");
		$data->task = $this->task_model->filterSetDefault($filter);

	}

	public function ajaxSearch(){

		$this->load->model('task/task_model');

		if($this->input->post()){
			$whereParameters = array();
			$statuses = array();

			$searchPattern = $this->input->post();

			if(isset($searchPattern["taskID"])) $whereParameters["taskID"] = $searchPattern["taskID"];
			if(isset($searchPattern["taskFather"])) $whereParameters["taskFather"] = $searchPattern["taskFather"];
			if(isset($searchPattern["taskProject"])) $whereParameters["taskProject"] = $searchPattern["taskProject"];
			if(isset($searchPattern["taskResponsableUser"])) $whereParameters["taskResponsableUser"] = $searchPattern["taskResponsableUser"];
			if(isset($searchPattern["taskLink"])) $whereParameters["taskLink"] = $searchPattern["taskLink"];
			if(isset($searchPattern["taskStatus1"])) array_push($statuses , 1);
			if(isset($searchPattern["taskStatus2"])) array_push($statuses , 2);
			if(isset($searchPattern["taskStatus3"])) array_push($statuses , 3);
			if(isset($searchPattern["taskStatus4"])) array_push($statuses , 4);
			if(isset($searchPattern["taskStatus5"])) array_push($statuses , 5);
			if(isset($searchPattern["taskStatus6"])) array_push($statuses , 6);
			if(sizeof($statuses) == 0) $statuses = "";

			$data->tasks = $this->task_model->search($whereParameters, $statuses);
			$this->load->view('task/ajaxSearch', $data);	
		} else {
			$data->tasks = $this->task_model->getAll();
			$this->load->view('task/ajaxSearch', $data);
		}

	}

	public function view($taskID)
	{	$this->load->model('task/task_model');
		$data->task = $this->task_model->getByID($taskID);
		$data->statuses = $this->task_model->getAllStatus();
		$data->kinds = $this->task_model->getAllKind();
		$data->taskComments = $this->task_model->getAllCommentByTask($taskID);	$this->load->model('user/user_model');
		$data->users = $this->user_model->getAll();	$this->loadViewWithTemplate('task/view', $data);
	}

	public function update($taskID)
	{
		$data = $this->input->post();
		if(!$data['taskResponsableUser']) $data['taskResponsableUser'] = $this->session->userdata('userID');
		$this->load->model('task/task_model');
		$response = $this->task_model->update($taskID, $data);
		echo($response);
	}

	public function newTask() {
		if($this->input->post()){
			if($this->input->post("form")){
				$this->load->model('task/task_model');
				$data->tasks = $this->task_model->getAll('taskID');
				$data->taskID = '';
				$data->taskTitle = '';
				$this->load->model('user/user_model');
				$data->taskResponsableUsers = $this->user_model->getAll();
				$data->taskKinds = $this->task_model->getAllKind();
				$data->taskProjects = $this->task_model->getAllProject();
				$data->projectID = '';
				$data->projectTitle = '';
				$data->date = date('d-m-Y', time());
				$data->time = date('H:i', time());
				echo $this->load->view('task/newTask', $data);		
			}
			else {

				$this->load->model('user/user_model');

				$data = $this->input->post();
				$data['taskCreatorUser'] = $this->session->userdata('userID');
				$date = date_create($data['deadLineDate']);
				$data['deadLineDate'] = date_format($date, 'Y-m-d H:i:s');
				$this->load->model('task/task_model');
				$dbResponse = $this->task_model->createTask($data);

				$userID = $this->input->post('taskResponsableUser');
				$responsable = $this->user_model->getByID($userID);
				$to = $responsable->userEmail;
				$subject = 'Task ' . $dbResponse;
				$message = '<p>Uma nova tarefa foi criada por<p>';
				foreach($this->input->post() as $key => $content) $message = $message."<p>".$key.": ".$content."</p>";

				$this->load->library('email', $config);
				$this->email->set_newline("\r\n");
				$this->email->from('task@intranet.tzadi.com');
				$this->email->to($to);
				$this->email->subject(utf8_decode($subject));
				$message = '<html><head><meta charset="utf-8"></head><body>'.$message.'</body></html>';
				$this->email->message(utf8_decode($message));

				if(!$this->email->send()) echo show_error($this->email->print_debugger());

				echo $dbResponse;
			}
		}
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

		$responsable = $this->task_model->getTaskResponsable($data['commentTask']);
		$to = $responsable->userEmail;
		$subject = 'Task ' . $data['commentTask'];
		$message = '<p>Um novo comentário foi efetuado na tarefa <a href="intranet.tzadi.com/task/view/'.$data['commentTask'].'">'.$data['commentTask'].'</a><p>';
		foreach($data as $key => $content) $message = $message."<p>".$key.": ".$content."</p>";
		$this->sendGmail($to, utf8_decode($subject), utf8_decode($message));

		echo $dbResponse;
	}

	public function action()
	{
		if($this->input->post()){
			if($data->taskID = $this->input->post("form")){
				$data->taskID = $this->input->post("taskID");
				$data->action = $this->input->post("action");
				echo $this->load->view('task/action', $data, true);			
			}
			else {
				$data = $this->input->post();
				$data['commentUser'] = $this->session->userdata('userID');
				$this->load->model('task/task_model');
				$dbResponse = $this->task_model->createComment($data);

				$responsable = $this->task_model->getTaskResponsable($data['commentTask']);
				$to = $responsable->userEmail;
				$subject = 'Task ' . $data['commentTask'];
				$message = '<p>Um novo comentário foi efetuado na tarefa <a href="intranet.tzadi.com/task/view/'.$data['commentTask'].'">'.$data['commentTask'].'</a><p>';
				foreach($data as $key => $content) $message = $message."<p>".$key.": ".$content."</p>";
				$this->sendGmail($to, utf8_decode($subject), utf8_decode($message));

				echo $dbResponse;
			}
		} else {
			echo "Fail! None argument passed.";
		}
	}

	public function activity()
	{
		if($this->input->post()){
			if($this->input->post("form")){
				$data->taskID = $this->input->post("taskID");
				$data->date = date('d-m-Y', time());
				$data->time = date('H:i', time());
				echo $this->load->view('task/activity', $data, true);		
			}
			else {
				$data = $this->input->post();
				$data['activityUser'] = $this->session->userdata('userID');
				$data['activityStart'] =  $this->myDatePhpMysql($data['activityStart']);
				$data['activityEnd'] =  $this->myDatePhpMysql($data['activityEnd']);
				$this->load->model('task/task_model');
				$dbResponse = $this->task_model->registerActivity($data);

				$responsable = $this->task_model->getTaskResponsable($data['activityTask']);
				$to = $responsable->userEmail;
				$subject = 'Task ' . $data['activityTask'];
				$message = '<p>Uma nova atividade foi registrada na tarefa <a href="intranet.tzadi.com/task/view/'.$data['activityTask'].'">'.$data['activityTask'].'</a><p>';
				foreach($data as $key => $content) $message = $message."<p>".$key.": ".$content."</p>";
				$this->sendGmail($to, utf8_decode($subject), utf8_decode($message));

				echo $dbResponse;
			}
		}
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
		$this->loadViewWithTemplate("task/userActivities", $data);
	}
}

/* End of file*/