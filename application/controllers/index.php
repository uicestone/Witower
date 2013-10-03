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
		
		$projects=$this->project->getList(array('order_by'=>'id desc'));
		
		foreach($projects as &$project){
			$project['tags']=$this->project->getTags($project['id']);
			$project['comments']=$this->project->getComments($project['id'],array('limit'=>3,'order_by'=>'id desc'));
			$project['comments_count']=count($project['comments']);
		}
		
		$this->load->view('index',compact('projects'));
	}
	
}
?>
