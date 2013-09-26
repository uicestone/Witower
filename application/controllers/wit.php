<?php
class Wit extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');
	}
	
	function view($id){
		$this->wit->id=$id;
		
		try{
			if($this->input->post('score')!==false){
				$this->version->score($this->input->post('score'));
			}
		}catch(Exception $e){
			$alert[]=array('message'=>lang($e->getMessage()));
		}
		
		if($this->input->post('comment')!==false){
			$this->version->comment($this->input->post('comment'));
		}
		
		$wit=$this->wit->fetch();
		$witters=$this->user->getList(array('in_wit'=>$this->wit->id));
		$project=$this->project->fetch($wit['project']);
		$versions=$this->version->count(array('wit'=>$this->wit->id));
		
		if($this->input->get('version')){
			$result=$this->version->getList(array('num'=>$this->input->get('version'),'wit'=>$wit['id']));
			if(isset($result[0])){
				$version=$result[0];
			}else{
				redirect('wit/'.$wit['id']);
			}
		}else{
			$version=$this->version->fetch($wit['latest_version']);
		}
		
		$version['score']=$this->user->isLogged('witower')?$version['score_witower']:$version['score_company'];
		$version['comment']=$this->user->isLogged('witower')?$version['comment_witower']:$version['comment_company'];
		
		$previous_version=$this->version->getPrevious($version['id']);
		$next_version=$this->version->getNext($version['id']);
		
		$this->load->view('wit/view',compact('wit','witters','project','version','versions','previous_version','next_version','alert'));
	}
	
	/**
	 * 单条创意的版本查看页面
	 */
	function versions($id){
		
		$this->wit->id=$id;
		
		$args=array('wit'=>$this->wit->id,'order_by'=>'id desc');
		
		$wit=$this->wit->fetch();
		$project=$this->project->fetch($wit['project']);
		
		if($this->user->isLogged(array('witower','wit')) || $project['company']==$this->user->id){
			$args['deleted']=NULL;
		}
		
		$versions=$this->version->getList($args);
		
		foreach($versions as &$version){
			$version['author_name']=$this->user->fetch($version['user'],'name');
		}
		
		$this->load->view('wit/versions', compact('versions','wit','project'));
	}
	
	/**
	 * 单个版本的编辑页面
	 */
	function edit($id=NULL){
		
		if(!$this->user->isLogged()){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}

		$this->wit->id=$id;
		
		if(is_null($this->wit->id)){
			//对于新建创意，项目信息从url获取
			$project=$this->project->fetch($this->input->get('project'));
		}
		else{
			//对于已有创意，项目信息从创意信息中获取
			$wit=$this->wit->fetch($this->wit->id);
			$project=$this->project->fetch($wit['project']);
		}
		
		if($this->input->post('submit')!==false){
			if(is_null($this->wit->id)){

				//新创意，那么添加创意信息
				$this->wit->id=$this->wit->add(array(
					'name'=>$this->input->post('name'),
					'content'=>$this->input->post('content'),
					'project'=>$project['id'],
				));
			}
			else{
				//已有创意，更新一下创意信息
				$this->wit->update(array(
					'name'=>$this->input->post('name'),
					'content'=>$this->input->post('content')
				));
			}
			
			isset($wit['latest_version']) && $latest_version=$this->version->fetch($wit['latest_version']);
			
			//添加一个版本
			if((isset($latest_version) && $latest_version['user']===$this->user->id)
				//如果创意的最后修改人就是本人，那么执行热修改，不创建新版本
				|| strip_tags($latest_version['content']==strip_tags($this->input->post('content')))
				//去格式以后无更改，那也不创建新版本，用户也不保存——帮别人改格式是义务劳动
			){
				$this->version->update(array(
					'name'=>$this->input->post('name'),
					'content'=>$this->input->post('content'),
					'time'=>$this->date->now//TODO $this->date->now全部换成time()
				),$wit['latest_version']);
			}else{
				
				$wit['latest_version']=$this->version->add(array(
					'num'=>$this->version->count(array('wit'=>$this->wit->id,'deleted'=>NULL))+1,
					'project'=>$project['id'],
					'wit'=>$this->wit->id,
					'name'=>$this->input->post('name'),
					'content'=>$this->input->post('content'),
				));
				
				//更新项目下的创意参与人数
				$this->project->update(array('witters'=>$this->user->count(array('in_project'=>$project['id']))), $project['id']);
			}
			
			$this->wit->update(array('latest_version'=>$wit['latest_version']));
			
			redirect('project/'.$project['id']);
		}
		
		if(is_null($this->wit->id)){
			
			$project=$this->project->fetch($this->input->get('project'));
			
			$wit=$this->wit->fields;
			
		}
		else{
			
			$wit=$this->wit->fetch($this->wit->id);
			
			$project=$this->project->fetch($wit['project']);
			
			$witters=$this->user->getList(array('in_wit'=>$this->wit->id));
			$versions=$this->version->count(array('wit'=>$this->wit->id));
			$version=$this->version->fetch($wit['latest_version']);
			$score_field=$this->user->isLogged('witower')?'score_witower':'score_company';

		}
		
		$this->load->view('wit/edit', compact('wit','witters','project','version','versions','score_field'));
	}
	
	function remove($wit_id){
		$wit=$this->wit->fetch($wit_id);
		$project=$this->project->fetch($wit['project']);
		
		if($this->user->id != $project['company'] && !$this->user->isLogged(array('witower','wit'))){
			return;
		}
		
		$this->wit->remove();
		
		redirect($this->input->server('HTTP_REFERER'),'php','');
	}
	
	function removeVersion($version_id){
		$version=$this->version->fetch($version_id);
		$project=$this->project->fetch($version['project']);
		
		if($this->user->id != $project['company'] && !$this->user->isLogged(array('witower','wit'))){
			return;
		}
		
		$this->version->update(array('deleted'=>true),$version_id);
		$this->wit->refresh($version['wit']);
		
		redirect($this->input->server('HTTP_REFERER'),'php','');
	}
	
	function recoverVersion($version_id){
		$version=$this->version->fetch($version_id);
		$project=$this->project->fetch($version['project']);
		
		if($this->user->id != $project['company'] && !$this->user->isLogged(array('witower','wit'))){
			return;
		}
		
		$this->version->update(array('deleted'=>false),$version_id);
		$this->wit->refresh($version['wit']);
		
		redirect($this->input->server('HTTP_REFERER'),'php','');
	}
	
	function select($wit_id){
		$this->wit->select($wit_id);
		redirect($this->input->server('HTTP_REFERER'),'php','');
	}
	
	function unselect($wit_id){
		$this->wit->unselect($wit_id);
		redirect($this->input->server('HTTP_REFERER'),'php','');
	}
	
}
?>
