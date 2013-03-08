<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gp extends CI_Controller {

	public function index()
	{
		$this->git();
	}

	public function git()
	{
    $data = '';
    $content = $this->load->view('gp/git', $data, true);

    $data = array(
      'page_title' => 'Boas práticas - GIT',
      'content' => $content
      );

    $this->parser->parse('common/template', $data);
	}

}