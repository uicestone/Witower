<?php
class Index extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 首页
	 */
	function index(){
		
		$this->load->model('project_model','project');
		
		$projects=$this->project->getList();
		
		foreach($projects as &$project){
			$project['tags']=$this->project->getTags($project['id']);
			$project['comments']=$this->project->getComments($project['id']);
			$project['comments_count']=count($project['comments']);
		}
		
		$this->load->view('index',compact('projects'));
	}
	
}
?>
