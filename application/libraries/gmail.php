<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gmail {
  public function __construct() {
    $this->CI =& get_instance();
    if (ENVIRONMENT ==  'production') {
      $this->smtp_user = 'task@tzadi.com';
      $this->smtp_pass = 'Task2010ireland';
    } else {
      $this->smtp_user = 'taskstaging@tzadi.com';
      $this->smtp_pass = 'TaskS2010ireland';      
    }
  }

  public function send($to, $subject, $message) {

    $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => $this->smtp_user,
      'smtp_pass' => $this->smtp_pass,
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

  function readMail($id = 1) {

    $dns = "{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX";
    $email = $this->smtp_user;
    $password = $this->smtp_pass;
    $imap = imap_open($dns,$email,$password ) or die("Cannot Connect ".imap_last_error());

    $message_count = imap_num_msg($imap);
    $header = imap_header($imap, $id);
    $headers = imap_headers($imap);

    $data->emails[0]->id = $header->Msgno;
    $data->emails[0]->date = date("Y-m-d H:i:s", $header->udate);
    $data->emails[0]->from = $header->from[0]->mailbox."@".$header->from[0]->host;
    $data->emails[0]->subject = $header->subject;

    $data->emails[0]->message = quoted_printable_decode(utf8_encode(imap_qprint(imap_fetchbody($imap,$id,2))));

    imap_close($imap);

    return $data;
  }
}
/* End of file Gmail.php */