<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	var $userLevel, $methodLevel;

	function __construct() { // Call the Model constructor

		parent::__construct();

		$this->_checkUserPermission();

	}

	function _checkUserPermission(){ // this function check if the user have the right level to access the content

		$methodLevel = $this->_methodLevel();

		$userLevel = $this->_userLevel();

		if( $methodLevel == 'public');

		elseif( $methodLevel ) {

			if($userLevel == 'public') redirect(base_url() . 'login', 'refresh');

			else {

				if( $userLevel == 'private' && $methodLevel == 'private');

				elseif( $userLevel == 'admin' && $methodLevel == 'private');

				elseif( $userLevel == 'admin' && $methodLevel == 'admin');

				else redirect(base_url() . 'error/accessDenyed', 'refresh');
			}

		}

		else redirect(base_url() . 'error/pageNotFound', 'refresh');

	}

	function _methodLevel(){ // this function returns the method level

		$class = $this->router->class;
		$method = $this->router->method;

		// error class permission
		$methodsPermission['error']['index'] = 'public';
		$methodsPermission['error']['pageNotFound'] = 'public';
		$methodsPermission['error']['accessDenyed'] = 'public';

		// task class permission
		$methodsPermission['task']['index'] = 'private';
		$methodsPermission['task']['finish'] = 'private';
		$methodsPermission['task']['cancel'] = 'private';
		$methodsPermission['task']['view'] = 'private';
		$methodsPermission['task']['update'] = 'private';
		$methodsPermission['task']['newTask'] = 'private';
		$methodsPermission['task']['comment'] = 'private';
		$methodsPermission['task']['commentForm'] = 'private';
		$methodsPermission['task']['listByStatus'] = 'private';
		$methodsPermission['task']['ajaxSearch'] = 'private';
		$methodsPermission['task']['saveFilter'] = 'private';
		$methodsPermission['task']['createProjectForm'] = 'private';
		$methodsPermission['task']['createProject'] = 'private';
		$methodsPermission['task']['newCommentForm'] = 'private';
		$methodsPermission['task']['newComment'] = 'private';
		$methodsPermission['task']['action'] = 'private';
		$methodsPermission['task']['activity'] = 'private';
		$methodsPermission['task']['filter'] = 'private';
		$methodsPermission['task']['filterSetDefault'] = 'private';
		$methodsPermission['task']['getUsersLog'] = 'private';

		// git class permission
		$methodsPermission['git']['index'] = 'admin';
		$methodsPermission['git']['log'] = 'admin';
		$methodsPermission['git']['pull'] = 'admin';
		
		// git class permission
		$methodsPermission['gp']['index'] = 'public';
		$methodsPermission['gp']['git'] = 'public';
		
		// git class permission
		$methodsPermission['dashboard']['index'] = 'admin';
		$methodsPermission['dashboard']['serverInfo'] = 'admin';
		$methodsPermission['dashboard']['phpInfo'] = 'admin';
		$methodsPermission['dashboard']['gitInfo'] = 'admin';
		$methodsPermission['dashboard']['mysqlInfo'] = 'admin';

		// Verifica se o usuário tem permissão para 
		if ($methodsPermission[$class][$method]) $methodLevel = $methodsPermission[$class][$method];

		else $methodLevel = false;

		return $methodLevel;

	}

	function _userLevel(){ // this function detects the userlevel of an user

		if(!$this->session->userdata('userLevel')) $this->session->set_userdata('userLevel', 'public');

		return $this->session->userdata('userLevel');

	}

	public function loadViewWithTemplate($view = 'error/pageNotFound', $data = null) { // this function load the template within the view
		$this->load->view("common/topHTML");
		$this->load->view("common/topMenuStart");
		$this->load->view("common/topMenu");
		$this->load->view("common/topMenuAdmin");
		$this->load->view("common/topMenuEnd");
		$this->_leftMenu($view);
		$this->load->view($view, $data);
		$this->load->view("common/footer");
		$this->load->view("common/bottomHTML");
		$this->load->view("common/tzadiDialogs");
	}

	function _leftMenu($view){
		$view = explode("/", $view);
		$this->load->view($view[0] . "/leftMenu");
	}

	// Esta função pega uma string de data e transforma da data do php
	// depois ela transforma a data do php na data para usar com o mysql
	public function myDatePhpMysql($phpDate){
		$date = date_create($phpDate);
		$mySqlDate = date_format($date, 'Y-m-d H:i:s');

		return $mySqlDate;
	}

	// Esta função pega uma data em mysql e transforma na data do php
	public function myDateMysqlPhp($mySqlDate){
		$date = date_create($mySqlDate);
		$phpDate = date_format($date, 'd-m-Y H:i:s');

		return $phpDate;
	}

	public function myTotalTime($date1, $date2) {
		$date1 = new DateTime($date1);
		$date2 = new DateTime($date2);
		$diff = $date1->diff($date2);
		$totalTime = $diff->format('%y-%m-%d %H:%i:%s');
		return $totalTime;
	}

	public function sendGmail($to, $subject, $message) {
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'ssl://smtp.googlemail.com',
			'smtp_port' => 465,
			'smtp_user' => 'task@tzadi.com',
			'smtp_pass' => 'Task2010ireland',
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('task@intranet.tzadi.com');
		$this->email->to($to);
		$this->email->subject($subject);
		$message = '<html><head><meta charset="utf-8"><head>'.$message.'</html>';
		$this->email->message($message);

		if(!$this->email->send()) echo show_error($this->email->print_debugger());
	}
	
}
/* End of file */