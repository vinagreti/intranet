<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permission {
  public function __construct() {
    $this->CI =& get_instance();
  }

  public function allow( $data ) {
    $userLevel = $this->_userLevel();
    if ( is_array($data['methodLevel']) && in_array($userLevel, $data['methodLevel']) );
    elseif($userLevel != 'public') {
      $this->CI->session->set_flashdata('methodName', $data['methodName']);
      redirect(base_url() . 'error/permission', 'refresh');
    }
    else {
      $this->CI->session->set_flashdata('HTTP_REFERER', uri_string());
      redirect(base_url() . 'user/login', 'refresh');
    } 
  }

  function _userLevel(){ // this function detects the userlevel of an user
    if(!$this->CI->session->userdata('userLevel')) $this->CI->session->set_userdata('userLevel', 'public');
    return $this->CI->session->userdata('userLevel');
  }
}
/* End of file Permission.php */