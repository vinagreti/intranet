<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_Model extends CI_Model {

    function __construct() 
    { // Call the Model constructor

        parent::__construct();

    }

    function getAll() {

        $cols = array(
            'u.userName  AS taskResponsableName',
            'taskID',
            'taskFather',
            'taskTitle',
            'taskDesc',
            'taskKind',
            'taskStatus',
            'taskKindName',
            'taskStatusName',
            'taskResponsableUser'
            );
        $this->db->select($cols);
        $this->db->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left');
        $this->db->join('tzadiTaskKind tk', 'tk.taskKindID = t.taskKind', 'left');
        $this->db->join('tzadiTaskStatus ts', 'ts.taskStatusID = t.taskStatus', 'left');
        $query = $this->db->get('tzadiTask t');

        return $query->result();

    }

    function getAllFilters() {

        $query = $this->db->get('tzadiTaskFilter');

        return $query->result();

    }    

    function saveFilter($searchPattern) {

        $data->searchPattern = $searchPattern;
        $data->userID = $this->session->userdata('userID');

        $query = $this->db->insert('tzadiTaskFilter', $data);

        return $query;
    }

    function getAllByDemandID($demandID) {

        $cols = array(
            'u.userName  AS taskResponsableName',
            'taskID',
            'taskTitle',
            'taskDesc',
            'taskKind',
            'taskStatus',
            'taskKindName',
            'taskStatusName',
            );
        $this->db->select($cols);
        $this->db->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left');
        $this->db->join('tzadiTaskKind tk', 'tk.taskKindID = t.taskKind', 'left');
        $this->db->join('tzadiTaskStatus ts', 'ts.taskStatusID = t.taskStatus', 'left');
        $this->db->where('taskDemand', $demandID);
        $query = $this->db->get('tzadiTask t');

        return $query->result();

    }

    function search($whereParameters, $statuses = null) {

        $cols = array(
            'u.userName  AS taskResponsableName',
            'taskID',
            'taskFather',
            'taskTitle',
            'taskDesc',
            'taskKind',
            'taskStatus',
            'taskKindName',
            'taskStatusName',
            );
        $this->db->select($cols);
        $this->db->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left');
        $this->db->join('tzadiTaskKind tk', 'tk.taskKindID = t.taskKind', 'left');
        $this->db->join('tzadiTaskStatus ts', 'ts.taskStatusID = t.taskStatus', 'left');
        $inParameters = array(1,2,3);
        $this->db->where($whereParameters);
        $this->db->where_in("taskStatusID", $statuses);
        $query = $this->db->get('tzadiTask t');
        return $query->result();

    }

    function getAllByStatus($taskStatus, $startRow, $endRow) {

        $cols = array(
            'u.userName  AS taskResponsableName',
            'taskID',
            'taskTitle',
            'taskDesc',
            'taskKind',
            'taskStatus',
            'taskKindName',
            'taskStatusName',
            'demandTitle'
            );
        $this->db->select($cols);
        $this->db->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left');
        $this->db->join('tzadiTaskKind tk', 'tk.taskKindID = t.taskKind', 'left');
        $this->db->join('tzadiTaskStatus ts', 'ts.taskStatusID = t.taskStatus', 'left');
        $this->db->join('tzadiDemand td', 'td.demandID = t.taskDemand', 'left');
        $this->db->where('taskStatus', $taskStatus);
        $this->db->limit($endRow, $startRow);
        $query = $this->db->get('tzadiTask t');

        return $query->result();

    }


    function getByID($taskID) {
        $cols = array(
            'u.userName  AS taskResponsableName',
            'u.userName  AS taskCreatorName',
            'taskID',
            'taskTitle',
            'taskDesc',
            'taskKindName',
            'taskKind',
            'taskStatusName',
            'taskStatus',
            'taskResponsableUser',
            'taskCreatorUser',
            );
        $this->db->select($cols);
        $this->db->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left');
        $this->db->join('tzadiUser u2', 'u2.userID = t.taskCreatorUser', 'left');
        $this->db->join('tzadiTaskKind tk', 'tk.taskKindID = t.taskKind', 'left');
        $this->db->join('tzadiTaskStatus ts', 'ts.taskStatusID = t.taskStatus', 'left');
        $this->db->where('taskID', $taskID);
        $query = $this->db->get('tzadiTask t');
        
        $result = $query->result();

        return $result[0];
    }

    function finish($taskID) {

        $this->db->where('taskID', $taskID);
        $this->db->set('taskStatus','4');

        return $this->db->update('tzadiTask');

        ; 
    }

    function cancel($taskID) {

        $this->db->where('taskID', $taskID);
        $this->db->set('taskStatus','3');
        
        return $this->db->update('tzadiTask');

        ; 
    }

    function update($taskID, $data) {

        $this->db->where('taskID', $taskID);
        $this->db->set($data);
        $this->db->update('tzadiTask');

    }

    function createTask($data) {

        $query = $this->db->insert('tzadiTask', $data);

        return $query;

    }

    function createProject($data) {

        $query = $this->db->insert('tzadiTaskProject', $data);

        return $query;

    }

    function createComment($data) {

        $query = $this->db->insert('tzadiTaskComment', $data);

        return $query;

    }

    function comment($data) {

        $query = $this->db->insert('tzadiTaskComment', $data);

        return $query;

    }

    function getTotalWithStatus($status){
        $this->db->where('taskStatus', $status);
        $query = $this->db->get('tzadiTask');
        return $query->num_rows();
    }

    function getTotalByStatusAndDemand($status, $demand){
        $this->db->where('taskStatus', $status);
        $this->db->where('taskDemand', $demand);
        $query = $this->db->get('tzadiTask');
        return $query->num_rows();
    }

    function getTotal(){
        $query = $this->db->get('tzadiTask');
        return $query->num_rows();
    }

}