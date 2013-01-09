<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kind_Model extends CI_Model {

    function __construct() 
    { // Call the Model constructor

        parent::__construct();

    }
    
    function getAll() {

    	$this->db->order_by('projectKindName');
        $query = $this->db->get('tzadiProjectKind');
        return $query->result();

    }

}
