<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project_Model extends CI_Model {

    function __construct() 
    { // Call the Model constructor

        parent::__construct();

    }
    
    function getAll() {

        $cols = array(
            'u.userName  AS projectResponsableName',
            'projectID',
            'projectTitle',
            'projectDesc',
            'projectKindName',
            'projectStatusName',
            );
        $this->db->select($cols);
        $this->db->join('tzadiUser u', 'u.userID = p.projectResponsableUser', 'inner');
        $this->db->join('tzadiProjectKind pk', 'pk.projectKindID = p.projectKind', 'inner');
        $this->db->join('tzadiProjectStatus ps', 'ps.projectStatusID = p.projectStatus', 'inner');
        $query = $this->db->get('tzadiProject p');

        return $query->result();

    }

    function getByID($projectID) {
        $cols = array(
            'u.userName  AS projectResponsableName',
            'u2.userName AS projectCreatorName',
            'projectID',
            'projectTitle',
            'projectDesc',
            'projectKindName',
            'projectStatusName',
            'projectResponsableUser',
            'projectCreatorUser',
            'projectKindID',
            'projectStatusID',
            );
        $this->db->select($cols);
        $this->db->join('tzadiUser u', 'u.userID = d.projectResponsableUser', 'inner');
        $this->db->join('tzadiUser u2', 'u2.userID = d.projectCreatorUser', 'inner');
        $this->db->join('tzadiProjectKind dk', 'dk.projectKindID = d.projectKind', 'inner');
        $this->db->join('tzadiProjectStatus ds', 'ds.projectStatusID = d.projectStatus', 'inner');
        $this->db->where('projectID', $projectID);
        $query = $this->db->get('tzadiProject d');
        $result = $query->result();

        if($result) return $result[0];
        else return false;
    }

    function finish($projectID) {

        $this->db->where('projectID', $projectID);
        $this->db->set('projectStatus','4');

        return $this->db->update('tzadiProject');

        ; 
    }

    function cancel($projectID) {

        $this->db->where('projectID', $projectID);
        $this->db->set('projectStatus','3');
        
        return $this->db->update('tzadiProject');

        ; 
    }

    function update($projectID, $data) {

        $this->db->where('projectID', $projectID);
        $this->db->set($data);
        $this->db->update('tzadiProject');

    }

    function getTotalWithStatus($status){
        $this->db->where('projectStatus', $status);
        $query = $this->db->get('tzadiProject');
        return $query->num_rows();
    }

    function create($data) {
        $query = $this->db->insert('tzadiProject', $data);
        return $query;
    }

}
