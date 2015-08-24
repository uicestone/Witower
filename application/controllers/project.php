<?php
class Project extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('project_model','project');
		$this->load->page_path[]=array('text'=>lang('project'),'href'=>'/project');
	}
	
	function match($term){
		$term=urldecode($term);
		$project=$this->project->getList(array('name'=>$term));
		$this->output->set_output(json_encode($project));
	}

	/**
	 * 项目列表页
	 */
	function index(){		
		$this->load->model('tag_model','tag');
		
		if($this->config->user_item('recommended_project')){
			$recommended_project=$this->project->fetch($this->config->user_item('recommended_project'));
			$recommended_project['tags']=$this->project->getTags($recommended_project['id']);
			//$recommended_project['comments']=$this->project->getComments($recommended_project['id']);
			$recommended_project['commenters']=$this->user->getList(array('has_commented_project'=>$recommended_project['id']));
		}
		
		$active_projects=$this->project->count(array('status'=>'witting'));
		$witters=$this->project->sum('witters',array('status'=>'witting'));
		
		$hot_tags = array_column($this->tag->getList(array('order_by'=>'hits desc','limit'=>20)),'name');

		$bonus_ranges = array('100-1000','1000-5000','5000-10000','10000-15000');
		
		$date = array('今日发布','昨日发布','三日内发布','48小时内发布','24小时内发布');
	
		$people = array('七嘴八舌(1-50)','高朋满座(51-500)' ,'人多势众(501-2000)','熙来攘往(2001-5000)','人山人海(5000以上)');
		
		$projects = $this->project->getList(array_merge($this->input->get() ? $this->input->get() : array(), array('order_by'=>'id desc', 'status'=>'witting')));
		if($this->config->user_item('is_audit') === 0){
			$conditions['is_audit'] = 0;
		}else{
			$conditions['is_audit'] = 1;	
		}

		foreach($projects as &$project){
			$project['tags']=$this->project->getTags($project['id']);
			$project['comments']=$this->project->getComments($project['id'],$conditions);
			$project['comments_count']=count($project['comments']);
		}
		
		$this->load->page_name='project-list';
		
		$this->load->view('project/list',compact('recommended_project','active_projects','witters','hot_tags','bonus_ranges','date','people','projects'));
	}
	
	/**
	 * 项目详情页
	 */
	function view($id){
		
		$this->load->model('company_model','company');
		$this->load->model('product_model','product');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');
		$this->load->model('tag_model','tag');
		
		$this->project->id=$id;
		
		$project=$this->project->fetch();
		$project['tags']=$this->project->getTags();
		$project['comments']=$this->project->getComments();
		$project['comments_count']=count($project['comments']);
		$project['versions']=$this->version->count(array('in_project'=>$this->project->id));
		$product=$this->product->fetch($project['product']);
		$company=$this->company->fetch($project['company']);
		
		$wits=$this->wit->getList(array('in_project'=>$project['id']));

		
		$conditions['order_by'] = 'id desc';
		//echo $this->config->user_item('is_audit');
		if($this->config->user_item('is_audit') === 0){
			$conditions['is_audit'] = 0;
		}else{
			$conditions['is_audit'] = 1;	
		}
		foreach($wits as &$wit){
			$wit['comments']=$this->wit->getComments($wit['id'],$conditions);
		}
		
		$witters=$this->user->getList(array('in_project'=>$project['id']));
		
		$witters_count=count($witters);
		$hot_tags = array_column($this->tag->getList(array('order_by'=>'hits desc','limit'=>20)),'name');

		$recommended_projects=$this->project->getList(array('order_by'=>'witters','limit'=>10,'status'=>'witting'));
		
		$recommended_votes=$this->project->getList(array('order_by'=>'witters','limit'=>10,'status'=>'voting'));
		
		$this->load->page_name='project-view';
		$this->load->page_path[]=array('text'=>$project['name'],'href'=>'/project/'.$project['id']);
		//print_r(compact('project','wits','hot_tags','witters','witters_count','recommended_projects','recommended_votes','product','company'));
		$this->load->view('project/view',  compact('project','wits','hot_tags','witters','witters_count','recommended_projects','recommended_votes','product','company'));
	}
	
	function end($id){
		
		$this->load->model('finance_model','finance');
		
		$this->project->id=$id;
		$bonuses=$this->project->bonusAllocate();

		$project=$this->project->fetch();
		
		foreach($bonuses as $bonus){
			$this->finance->add(array(
				'project'=>$this->project->id,
				'user'=>$bonus['user'],
				'amount'=>$bonus['amount'],
				'item'=>'积分'
			));
		}
		
		$this->finance->add(array(
			'project'=>$this->project->id,
			'user'=>$project['company'],
			'amount'=>-$project['bonus'],
			'item'=>'已冻结积分'
		));

		if(round(array_sum(array_column($bonuses,'amount'))) !== round($project['bonus'])){
			$this->finance->add(array(
				'project'=>$this->project->id,
				'user'=>$project['company'],
				'amount'=>$project['bonus'],
				'item'=>'积分'
			));
		}
		
		$this->project->update(array('active'=>false),$id);
		
		redirect($this->input->server('HTTP_REFERER'));
	}
	
	function addVersionComment($version_id){
		if(!$this->user->isLogged()){
			$this->output->set_output(json_encode(array('error'=>'user not logged in')));
			return;
		}
		$this->load->model('version_model','version');
		$comment_id=$this->version->addComment($version_id, $this->input->post('commentContent'));
		$comment=$this->version->getComment($comment_id);
		$comment['time']=date('Y-m-d H:i:s',$comment['time']);
		$comment['username']=$this->user->fetch($comment['user'], 'name');
		$this->output->set_output(json_encode($comment));
	}
	
}
?>
