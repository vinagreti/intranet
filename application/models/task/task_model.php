<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Task_Model extends CI_Model {

function __construct() 
{ // Call the Model constructor

parent::__construct();

}

function getAll( $data ) {

    $this->db
        ->select('u.userName  AS taskResponsableName')
        ->select('p.projectTitle  AS taskProjectTitle')
        ->select('taskID')
        ->select('taskFather')
        ->select('taskTitle')
        ->select('taskDesc')
        ->select('taskKind')
        ->select('taskStatus')
        ->select('taskKindName')
        ->select('taskStatusName')
        ->select('taskLabel')
        ->select('deadLineDate')
        ->select('taskLink')
        ->select('taskProject')
        ->from('tzadiTask t')
        ->order_by('taskStatus, taskID desc')
        ->join('tzadiTaskProject p', 'p.projectID = t.taskProject', 'left')
        ->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left')
        ->join('tzadiTaskKind tk', 'tk.taskKindID = t.taskKind', 'left')
        ->join('tzadiTaskStatus ts', 'ts.taskStatusID = t.taskStatus', 'left');

    $userProjectID = $this->session->userdata('userProject');
    if ($userProjectID > 0) $this->db->where('taskProject', $userProjectID);

    $temp = clone $this->db;
    $this->db->limit($data->numRows, $data->firstRow);

    $query->tasks = $this->db->get()->result();
    $query->total = $temp->count_all_results();
    unset($temp);

    return $query;
}

function search( $data ) {

    $this->db
    ->select('u.userName  AS taskResponsableName')
    ->select('p.projectTitle  AS taskProjectTitle')
    ->select('taskID')
    ->select('taskFather')
    ->select('taskTitle')
    ->select('taskDesc')
    ->select('taskKind')
    ->select('taskStatus')
    ->select('taskKindName')
    ->select('taskStatusName')
    ->select('taskLabel')
    ->select('deadLineDate')
    ->select('taskLink')
    ->select('taskProject')
    ->from('tzadiTask t')
    ->order_by('taskStatus, taskID desc')
    ->join('tzadiTaskProject p', 'p.projectID = t.taskProject', 'left')
    ->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left')
    ->join('tzadiTaskKind tk', 'tk.taskKindID = t.taskKind', 'left')
    ->join('tzadiTaskStatus ts', 'ts.taskStatusID = t.taskStatus', 'left');

    $userProjectID = $this->session->userdata('userProject');
    if ($userProjectID > 0) $this->db->where('taskProject', $userProjectID);
    if($data->whereParameters) $this->db->where($data->whereParameters);
    if($data->statuses) $this->db->where_in("taskStatusID", $data->statuses);

    $temp = clone $this->db;
    $this->db->limit($data->numRows, $data->firstRow);

    $query->tasks = $this->db->get()->result();
    $query->total = $temp->count_all_results();
    unset($temp);
    return $query;

}

function getByID($taskID) {
$cols = array(
'u.userName  AS taskResponsableName',
'u2.userName  AS taskCreatorName',
'taskID',
'taskTitle',
'taskDesc',
'taskKindName',
'taskKind',
'taskStatusName',
'taskStatus',
'taskResponsableUser',
'taskCreatorUser',
'deadLineDate',
'projectTitle'
);
$this->db->select($cols);
$this->db->join('tzadiTaskProject tp', 't.taskProject = tp.projectID', 'left');
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
}

function cancel($taskID) {
$this->db->where('taskID', $taskID);
$this->db->set('taskStatus','3');
return $this->db->update('tzadiTask');
}

function update($taskID, $data) {
$this->db->where('taskID', $taskID);
$this->db->set($data);
$query = $this->db->update('tzadiTask');
return $query;
}

function createTask($data) {
$this->db->insert('tzadiTask', $data);
$query = $this->db->insert_id();
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

function registerActivity($data) {
$query = $this->db->insert('tzadiTaskActivity', $data);
return $query;
}

function comment($data) {
$query = $this->db->insert('tzadiTaskComment', $data);
return $query;
}

function getAllProject(){
$query = $this->db->get('tzadiTaskProject');
return $query->result();
}

function getAllKind() {
$this->db->order_by('taskKindName');
$query = $this->db->get('tzadiTaskKind');
return $query->result();
}

function getAllStatus() {
$this->db->order_by('taskStatusName');
$query = $this->db->get('tzadiTaskStatus');
return $query->result();
}

function getAllComment() {
$query = $this->db->get('tzadiTaskStatus');
return $query->result();
}

function getAllCommentByTask($taskID) {
$this->db->join('tzadiUser u', 'u.userID = c.commentUser', 'left');
$this->db->where('commentTask', $taskID);
$query = $this->db->get('tzadiTaskComment c');
return $query->result();
}

function getFilterDefault($userID) {
    $where = array(
        "userID" => $userID,
        "default" => 1
        );
    $this->db->where($where);
    $filterProject = $this->session->userdata('userProject');
    if ($filterProject > 0) $this->db->where('filterProject', $filterProject);
    $query = $this->db->get('tzadiTaskFilter');
    if (  $query->row(0)  ) return $query->row(0);
    else return false;
}

function getAllFilters($userID = false) {
    $this->db->select(array(
    "default",
    "filterID",
    "filterTitle"
    ));
    $filterProject = $this->session->userdata('userProject');
    if ($filterProject > 0) $this->db->where('filterProject', $filterProject);
    $this->db->where("userID", $userID);
    $this->db->order_by("filterTitle");
    $query = $this->db->get('tzadiTaskFilter');
    return $query->result();
}    

function saveFilter($searchPattern) {
$searchPattern["filterProject"] = $this->session->userdata('userProject');
$searchPattern["userID"] = $this->session->userdata('userID');
$this->db->insert('tzadiTaskFilter', $searchPattern);
$query = $this->db->insert_id();

return $query;
}

function saveFilterDeafult($filter) {

$userID = $this->session->userdata('userID');
$this->db->set("default", 0);
$this->db->where("userID", $userID);
$this->db->update('tzadiTaskFilter');

$filter["userID"] = $userID;
$filter["default"] = 1;
$this->db->insert('tzadiTaskFilter', $filter);
$query = $this->db->insert_id();

return $query;
}

function filterSetDefault($filter) {

$userID = $this->session->userdata('userID');

$this->db->set("default", 0);
$this->db->where("userID", $userID);
$this->db->update('tzadiTaskFilter');

$this->db->set("default", 1);
$this->db->where($filter);
$query = $this->db->update('tzadiTaskFilter');

return $query;
}

function getTaskResponsable($taskID) {
$this->db->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left');
$this->db->where('taskID', $taskID);
$query = $this->db->get('tzadiTask t');
$result = $query->result();
return $result[0];
}

public function getUsersLog($taskUserIDs = null)
{

    $userProjectID = $this->session->userdata('userProject');
    if ($userProjectID > 0) $this->db->where('taskProject', $userProjectID);

$this->db->select(array(
'taskID',
'taskStatus',
'taskStatusName',
'taskResponsableUser',
'userName as taskResponsableName'
));
$this->db->join('tzadiUser u', 'u.userID = t.taskResponsableUser', 'left');
$this->db->join('tzadiTaskStatus ts', 'ts.taskStatusID = t.taskStatus', 'left');
if ($taskUserIDs) $this->db->where_in('taskResponsableUser', $taskUserIDs);
$this->db->order_by('taskStatus');
$query = $this->db->get('tzadiTask t');
$result = $query->result();
return $result;
}

public function userActivities($activityUser)
{
$userProjectID = $this->session->userdata('userProject');
if ($userProjectID > 0) $this->db->where('taskProject', $userProjectID);

$this->db->join('tzadiTask t', 't.taskID = ta.activityTask', 'left');
$this->db->where('activityUser', $activityUser);
$this->db->order_by("activityEnd", "desc");
$query = $this->db->get('tzadiTaskActivity ta');
$result = $query->result();
return $result;
}

function getProjectName($project) {
    $this->db->select("projectTitle");
    $this->db->where('projectID', $project);
    $resultado = $this->db->get('tzadiTaskProject')->result();
    return $resultado[0];
}

function getFilterByID($filter) {
    $this->db->select("searchPattern");
    $this->db->where('filterID', $filter);
    $resultado = $this->db->get('tzadiTaskFilter')->result();
    return $resultado[0];
}
}