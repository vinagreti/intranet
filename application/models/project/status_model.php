<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Status_Model extends CI_Model {

    function __construct() 
    { // Call the Model constructor

        parent::__construct();

    }
    
    function getAll() {
    	$this->db->order_by('projectStatusName');
        $query = $this->db->get('tzadiProjectStatus');
        return $query->result();

    }

}
