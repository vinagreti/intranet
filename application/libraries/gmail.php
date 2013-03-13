<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gmail {
  public function __construct() {
    $this->CI =& get_instance();
  }

  public function send($to, $subject, $message) {
    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'task@tzadi.com',
      'smtp_pass' => 'Task2010ireland',
      'mailtype' => 'html',
      'charset' => 'iso-8859-1',
      'wordwrap' => TRUE
    );

    $this->CI->load->library('email', $config);
    $this->CI->email->set_newline("\r\n");
    $this->CI->email->from('task@intranet.tzadi.com');
    $this->CI->email->to($to);
    $this->CI->email->subject($subject);
    $message = '<html><head><meta charset="utf-8"></head><body>'.$message.'</body></html>';
    $this->CI->email->message($message);

    if($this->CI->email->send()) return true;
    else return show_error($this->CI->email->print_debugger());
  }
}
/* End of file Permission.php */