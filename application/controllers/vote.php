<?php
class Vote extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('project_model','project');
	}
	
	/**
	 * 投票中的项目列表页
	 */
	function index(){
		$recommended_voting_project=$this->project->fetch($this->config->user_item('recommended_vote'));
		$recommended_voting_project['tags']=$this->project->getTags($recommended_voting_project['id']);
		$recommended_voting_project['comments']=$this->project->getComments($recommended_voting_project['id']);
		$recommended_voting_project['voters']=$this->user->getList(array('voted_project'=>$recommended_voting_project['id']));
		$recommended_voting_project['candidates']=$this->project->getCandidates($recommended_voting_project['id']);
		$recommended_voting_project['votes']=$this->project->countVotes($recommended_voting_project['id']);

		$result_voting_projects=$this->project->getList(array('count'=>true,'is_voting'=>true));
		$active_projects=$result_voting_projects[0]['count'];
		
		$sum_votes=$this->project->countVotes(false);
		
		$hot_tags=array('设计','包装','LOGO平面','网站','UI','广告','制作');
		
		$money = array('100-1000','1000-5000','5000,10000','10000-15000');
		
		$date = array('今日发布','昨日发布','三日内发布','48小时内发布','24小时内发布');
	
		$people = array('七嘴八舌(1-50)','高朋满座(51-500)' ,'人多势众(501-2000)','熙来攘往(2001-5000)','人山人海(5000以上)');

		$voting_projects['hot']=$this->project->getList(array('is_voting'=>true,'orderby'=>'voters desc','limit'=>10));
		$voting_projects['latest']=$this->project->getList(array('is_voting'=>true,'orderby'=>'vote_start desc','limit'=>10));
		
		foreach($voting_projects as &$projects_column){
			foreach($projects_column as &$voting_project){
				$voting_project['tags']=$this->project->getTags($voting_project['id']);
				$voting_project['votes']=$this->project->countVotes($voting_project['id']);
				$voting_project['voters']=$this->project->countVoters($voting_project['id']);
			}
		}
		
		$this->load->view('vote/list', compact('recommended_voting_project','hot_tags','money','date','people','voting_projects','active_projects','sum_votes'));
	}
	
	/**
	 * 项目投票详情查看页
	 */
	function view(){
		$this->load->view('vote/view');
	}
	
}
?>
