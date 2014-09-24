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
		
		$home_slide_images = explode(',', $this->config->user_item('home-slide-images'));
		
		foreach($projects as &$project){
			$project['tags']=$this->project->getTags($project['id']);
			$project['comments']=$this->project->getComments($project['id'],array('order_by'=>'id desc'));
			$project['comments_count']=count($project['comments']);
			$project['comments']=array_slice($project['comments'], 0, 3);
		}
		
		$this->load->view('index',compact('projects', 'home_slide_images'));
	}
	
}
?>
