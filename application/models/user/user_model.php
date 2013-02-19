<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model {

    function __construct() 
    { // Call the Model constructor

        parent::__construct();

    }
    
    function getAll() {

        $query = $this->db->get('tzadiUser');
        return $query->result();

    }

    function getByID($userID) {
    	$this->db->where('userID', $userID);
        $query = $this->db->get('tzadiUser');
        $result = $query->result();
        return $result[0];
    }
}
