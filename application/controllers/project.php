<?php
class Project extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('project_model','project');
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
		
		$recommended_project=$this->project->fetch($this->config->user_item('recommended_project'));
		$recommended_project['tags']=$this->project->getTags($recommended_project['id']);
		$recommended_project['comments']=$this->project->getComments($recommended_project['id']);
		
		$active_projects=$this->project->count(array('status'=>'witting'));
		$witters=$this->project->sum('witters',array('status'=>'witting'));
		
		//TODO 热门标签
		$hot_tags=array('设计','包装','LOGO平面','网站','UI','广告','制作');
		
		$money = array('100-1000','1000-5000','5000,10000','10000-15000');
		
		$date = array('今日发布','昨日发布','三日内发布','48小时内发布','24小时内发布');
	
		$people = array('七嘴八舌(1-50)','高朋满座(51-500)' ,'人多势众(501-2000)','熙来攘往(2001-5000)','人山人海(5000以上)');
		
		$projects['latest']=$this->project->getList(array('status'=>'witting','order_by'=>'wit_start desc','limit'=>10));
		
		$projects['hot']=$this->project->getList(array('status'=>'witting','order_by'=>'witters desc','limit'=>10));
		
		$projects['high_bonus']=$this->project->getList(array('status'=>'witting','order_by'=>'bonus desc','limit'=>10));
		
		foreach($projects as &$projects_column){
			foreach($projects_column as &$project){
				$project['tags']=$this->project->getTags($project['id']);
				$project['comments']=$this->project->getComments($project['id']);
				$project['comments_count']=count($project['comments']);
			}
		}
		
		$this->load->view('project/list',compact('recommended_project','active_projects','witters','hot_tags','money','date','people','projects'));
	}
	
	/**
	 * 项目详情页
	 */
	function view($id){
		
		$this->load->model('company_model','company');
		$this->load->model('product_model','product');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');
		
		$this->project->id=$id;
		
		$project=$this->project->fetch();
		$project['tags']=$this->project->getTags();
		$project['comments']=$this->project->getComments();
		$project['comments_count']=count($project['comments']);
		$project['versions']=$this->version->count(array('in_project'=>$this->project->id));
		$product=$this->product->fetch($project['product']);
		$company=$this->company->fetch($project['company']);
		
		$wits=$this->wit->getList(array('in_project'=>$project['id']));
		
		foreach($wits as &$wit){
			$wit['comments']=$this->wit->getComments($wit['id']);
		}
		
		$witters=$this->user->getList(array('in_project'=>$project['id']));
		
		$witters_count=count($witters);
		
		$hot_tags=array('设计','包装','Logo平面','网站');
		
		$recommended_projects=array(
			array('id'=>1,'name'=>'Sony PSV'),
			array('id'=>2,'name'=>'可口可乐广告'),
		);
		
		$recommended_votes=array(
			array('id'=>1,'name'=>'Sony PSV'),
			array('id'=>2,'name'=>'可口可乐广告'),
		);
		
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
			'item'=>'悬赏积分'
		));
		
		$yesterday=date('Y-m-d',time()-86400);
		
		$set=array('vote_end'=>$yesterday);
		
		if($project['vote_start']>$yesterday){
			$set['vote_start']=$yesterday;
		}

		$this->project->update($set,$id);
		
		redirect($this->input->server('HTTP_REFERER'),'php','');
	}
	
}
?>
