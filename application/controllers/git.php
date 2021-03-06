<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Git extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $data['methodLevel'] = array('admin');
    $data['methodName'] = 'GIT - Sistema de versionamento da tzadi';
    $this->permission->allow($data);
  }
  
	public function index()
	{
		$this->listRepositories();
	}
/*
|--------------------------------------------------------------------------
| List all repositories
|--------------------------------------------------------------------------
|
| This method returns all the projects, in the /var/www/ directory, that contain a /.git/ folder inside.
|
*/
public function listRepositories()
{

	$output = array();

	$formated_output = array();

	$repo = array();

		// find the repositories
	exec("find ../ -type d -name \.git",$output);

		// formating the find output
	foreach($output as $repo_full_path){

		$patterns = array('/\.\.\//', '/\/\.git/');

		$repo = preg_replace($patterns, '', $repo_full_path);

		$repository['name'] = $repo;

		$repository['branch'] = $this->detectRepoBranch($repo);

		$repository['remote'] = $this->detectRemoteAddress($repo);

		array_push($formated_output, $repository);

	}

	$data->repos = $formated_output;

	$content = $this->load->view('git/repos', $data, true);

	$data = array(
		'page_title' => 'Git - Repositórios',
		'content' => $content
		);

	$this->parser->parse('template', $data);

}
/*
|--------------------------------------------------------------------------
| Get current git branch
|--------------------------------------------------------------------------
|
| This method return the current git branch inuse in a repository
|
*/
public function detectRepoBranch($repo){

	exec("git --git-dir=../$repo/.git branch",$output);

	foreach($output as $branch){

		if(strpos($branch, " ") == 1) $branch_in_use = $branch;

	}

	$branch_in_use = preg_replace('/\* /', '', $branch_in_use);

	return trim($branch_in_use);

}

/*
|--------------------------------------------------------------------------
| Get remote address
|--------------------------------------------------------------------------
|
| This method return detect the remote address from a repository
|
*/
public function detectRemoteAddress($repo){

	exec("git --git-dir=../$repo/.git remote -v",$output);

	return $output[0];

}
/*
|--------------------------------------------------------------------------
| Get git log from repo
|--------------------------------------------------------------------------
|
| This method return the git log from a repository
|
*/
public function log($repo){

	$output = array();

	exec("git --git-dir=../$repo/.git log",$output);

	$history = array();

	foreach($output as $line){

		if(strpos($line, 'commit')===0){

			if(!empty($commit)){

				array_push($history, $commit);	

				unset($commit);

			}

			$commit['hash'] = substr($line, strlen('commit'));

		}

		else if(strpos($line, 'Author')===0){

			$commit['author'] = substr($line, strlen('Author:'));

		}

		else if(strpos($line, 'Date')===0){

			$commit['date'] = substr($line, strlen('Date:'));

		}

		else{	

			if(isset($commit['message']))

				$commit['message'] .= $line;

			else

				$commit['message'] = $line;

		}

	}

	$data->history = $history;

	$content = $this->load->view('git/log', $data, true);

	$data = array(
		'page_title' => "Git - $repo log",
		'content' => $content
		);

	$this->parser->parse('template', $data);
}
/*
|--------------------------------------------------------------------------
| Repository pull
|--------------------------------------------------------------------------
|
| This method execute a git pull in the repositories.
|
*/
public function pull($repo, $branch)
{

	exec("bash ../cron_jobs/git_pull $repo $branch",$output);

	$this->log($repo);

}

}

/* End of file git.php */
/* Location: ./application/controllers/git.php */