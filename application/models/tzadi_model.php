<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tzadi_Model extends CI_Model {

    function __construct() 
    { // Call the Model constructor
        parent::__construct();
        $this->load->library("mongo_db");
    }
    
	function getResume()
	{

		$resume->user = $this->mongo_db
		->count('user');
		$resume->product = $this->mongo_db
		->count('product');
		$resume->supplier = $this->mongo_db
		->count('supplier');
		$resume->currency = $this->mongo_db
		->count('currency');
		$resume->mail = $this->mongo_db
		->count('mail');
		$resume->sentMail = $this->mongo_db
		->where("status", "sent")
		->count('mail');
		$resume->queueMail = $this->mongo_db
		->where("status", "waiting")
		->count('mail');
		$resume->budget = $this->mongo_db
		->count('budget');
		$resume->session = $this->mongo_db
		->count('session');

		return $resume;
	}

	function getUsers()
	{

		return $this->mongo_db
		->order_by( array("_id" => "desc") )
		->get('user');

	}

}
