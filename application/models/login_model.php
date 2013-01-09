<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_Model extends CI_Model {

    function __construct() 
    { // Call the Model constructor

        parent::__construct();

    }
    
    function checkCredential($email, $password) {

        $password = md5($password);

        $this->db->where('userEmail', $email);
        $this->db->where('userPassword', $password);

        $query = $this->db->get('tzadiUser')->result();

        if(isset($query[0]))
        {
            $this->session->set_userdata('userID', $query[0]->userID);
            $this->session->set_userdata('userName', $query[0]->userName);
            $this->session->set_userdata('userEmail', $query[0]->userEmail);
            $this->session->set_userdata('userLevel', $query[0]->userLevel);
            return true;
        }
        
        else return false;
    }

}
