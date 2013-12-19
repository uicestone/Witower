<?php
class Vote extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('project_model','project');
		$this->load->model('product_model','product');
		$this->load->page_name='vote';
		$this->load->page_path[]=array('text'=>lang('vote'),'href'=>'/vote');
	}
	
	/**
	 * 投票中的项目列表页
	 */
	function index(){
		if($this->config->user_item('recommended_vote')){
			$recommended_voting_project=$this->project->fetch($this->config->user_item('recommended_vote'));
			$recommended_voting_project['tags']=$this->project->getTags($recommended_voting_project['id']);
			$recommended_voting_project['comments']=$this->project->getComments($recommended_voting_project['id']);
			$recommended_voting_project['voters']=$this->user->getList(array('voted_project'=>$recommended_voting_project['id']));
			$recommended_voting_project['candidates']=$this->project->getCandidates($recommended_voting_project['id']);
			$recommended_voting_project['votes']=$this->project->countVotes($recommended_voting_project['id']);
		}

		$active_projects=$this->project->count(array('status'=>'voting'));
		
		$sum_votes=$this->project->countVotes(false);
		
		$hot_tags=array('设计','包装','LOGO平面','网站','UI','广告','制作');
		
		$money = array('100-1000','1000-5000','5000,10000','10000-15000');
		
		$date = array('今日发布','昨日发布','三日内发布','48小时内发布','24小时内发布');
	
		$people = array('七嘴八舌(1-50)','高朋满座(51-500)' ,'人多势众(501-2000)','熙来攘往(2001-5000)','人山人海(5000以上)');

		$voting_projects['hot']=$this->project->getList(array('status'=>'voting','order_by'=>'voters desc','limit'=>10));
		$voting_projects['latest']=$this->project->getList(array('status'=>'voting','order_by'=>'vote_start desc','limit'=>10));
		
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
	function view($id){
		
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');
		$this->load->model('tag_model','tag');
		
		$this->project->id=$id;
		
		$project=$this->project->fetch();
		
		if($this->input->post('vote')!==false){
			
			if(!$this->user->isLogged()){
				redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
			}
			
			$this->project->vote($this->input->post('candidate'));
			
			//更新项目的投票参与人数
			$this->project->update(array('voters'=>$this->user->count(array('voted_project'=>$this->project->id))));
			
			//若该用户从未参与过投票，那么发布一条状态
			if(!$this->user->config('has_voted')){
				$this->user->addStatus('我参与了 '.$project['company_name'].' 的 “'.$project['name'].'” 的投票', $this->user->id, 'project', '/vote/'.$this->project->id);
				$this->user->set_config('has_voted', true);
			}
		}
		
		$project['tags']=$this->project->getTags();
		
		$product=$this->product->fetch($project['product']);
		$company=$this->company->fetch($product['company']);
		
		$comments=$this->project->getComments();
		$versions=$this->version->count(array('in_project'=>$this->project->id));
		$candidates=$this->project->getCandidates();
		$voters=$this->user->getList(array('voted_project'=>$this->project->id));
		$sum_votes=$this->project->countVotes();
		$voted=$this->project->hasUserVoted();
		
		$hot_tags = array_sub($this->tag->getList(array('order_by'=>'hits desc','limit'=>20)),'name');
		$recommended_projects=$this->project->getList(array('order_by'=>'witters','limit'=>10,'status'=>'witting'));
		$recommended_votes=$this->project->getList(array('order_by'=>'witters','limit'=>10,'status'=>'voting'));
		
		$wit=$this->wit->getRow(array('selected'=>true,'in_project'=>$this->project->id));

		$this->load->page_name='vote-view';
		$this->load->page_path[]=array('text'=>$project['name'],'href'=>'/vote/'.$project['id']);
		
		$this->load->view('vote/view', compact('project','wit','versions','comments','candidates','sum_votes','voters','voted','company','product','hot_tags','recommended_projects','recommended_votes'));
	}
	
}
?>
