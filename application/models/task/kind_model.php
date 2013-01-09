<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kind_Model extends CI_Model {

    function __construct() 
    { // Call the Model constructor

        parent::__construct();

    }
    
    function getAll() {

    	$this->db->order_by('taskKindName');
        $query = $this->db->get('tzadiTaskKind');
        return $query->result();

    }

}
