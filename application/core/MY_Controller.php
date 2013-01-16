<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	var $userLevel, $methodLevel;

	function __construct() { // Call the Model constructor

		parent::__construct();

		$this->_checkUserPermission();
		$this->_setGlobalJsVar();

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
		$methodsPermission['task']['createTask'] = 'private';
		$methodsPermission['task']['createTaskForm'] = 'private';
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

	public function loadViewWithTemplate($view = 'error/pageNotFound', $data = null, $loadJSFile ) { // this function load the template within the view

		$this->load->view("common/topHTML");

		$this->_topMenu();

		$this->_leftMenu($view);
		
		$this->load->view($view, $data);

		$this->load->view("common/footer");

		$this->load->view("common/bottomHTML");

		$this->load->view("common/tzadiDialogs");

		$this->load->view("common/topMenuJS");

		if($loadJSFile == true){ 

			$data->view = $view;

			$this->load->view("common/loadCustomJS", $data);

		}

	}

	function loadViewWithJS($view = 'error/pageNotFound', $data = null, $js = false){

		$html = $this->load->view($view, $data, true);

		$javascript = "<script src=".base_url()."assets/js/".$view.".js></script>";

		return $html.$javascript;

	}

	function _topMenu(){

		$this->load->view("common/topMenuStart");

		$this->load->view("common/topMenu");

		$this->load->view("common/topMenuAdmin");

		$this->load->view("common/topMenuEnd");
	}

	function _leftMenu($view){

		$view = explode("/", $view);

		$data->rows = array("um item" => "link dele");

		$this->load->view($view[0] . "/leftMenu", $data);

	}

	function _setGlobalJsVar(){
		echo '<script type="text/javascript">
    			var base_url = "'.base_url().'";
			</script>';
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
	
}
/* End of file */