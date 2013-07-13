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
		
		if($this->input->post('score')!==false){
			$this->version->score($this->input->post('score'));
		}
		
		if($this->input->post('select')!==false){
			$this->wit->select();
		}
		
		if($this->input->post('remove')!==false){
			$this->wit->update(array('deleted'=>true));
			$this->version->update(array('deleted'=>true),array('wit'=>$this->wit->id));
		}
		
		if($this->input->post('removeversion')!==false){
			$this->version->remove($this->input->post('removeversion'));
		}
		
		$wit=$this->wit->fetch();
		$witters=$this->user->getList(array('in_wit'=>$this->wit->id));
		$project=$this->project->fetch($wit['project']);
		$versions=$this->wit->countVersions();
		
		if($this->input->get('version')){
			$result=$this->version->getList(array('num'=>$this->input->get('version'),'wit'=>$wit['id']));
			if(isset($result[0])){
				$version=$result[0];
			}else{
				$version=$this->version->fetch($wit['latest_version']);
			}
		}else{
			$version=$this->version->fetch($wit['latest_version']);
		}
		
		$first_version=$this->version->getList(array('orderby'=>'num desc','limit'=>1))[0];
		
		$previous_version=$this->version->getPrevious($version['id']);
		$next_version=$this->version->getNext($version['id']);
		
		$score_field=$this->user->isLogged('witadmin')?'score_witower':'score_company';
		
		$this->load->view('wit/view',compact('wit','witters','project','version','versions','first_version','previous_version','next_version','score_field'));
	}
	
	/**
	 * 单条创意的版本查看页面
	 */
	function versions($id){
		
		$this->wit->id=$id;
		
		$args=array('wit'=>$this->wit->id);
		
		if($this->user->isLogged('witeditor')){
			$args['deleted']=NULL;
		}
		
		$versions=$this->version->getList($args);
		
		$wit=$this->wit->fetch();
		$project=$this->project->fetch($wit['project']);
		
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
			$wit=$this->wit->fields;
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
					'user'=>$this->user->id,
					'time'=>$this->date->now
				));
			}
			else{
				//已有创意，更新一下创意信息
				$this->wit->update(array(
					'name'=>$this->input->post('name'),
					'content'=>$this->input->post('content')
				));
			}
			
			//添加一个版本
			if($wit['user']===$this->user->id){
				//如果创意的最后修改人就是本人，那么执行热修改，不创建新版本
				$this->version->update(array(
					'name'=>$this->input->post('name'),
					'content'=>$this->input->post('content'),
					'time'=>$this->date->now
				),$wit['latest_version']);
			}else{
				$versions=$this->version->getList(array('wit'=>$this->wit->id));
				if(!in_array($this->user->id,array_sub($versions,'user'))){
					$this->project->addCount('witters',$project['id']);
				}
				
				$wit['latest_version']=$this->version->add(array(
					'num'=>$this->wit->countVersions()+1,
					'project'=>$project['id'],
					'wit'=>$this->wit->id,
					'name'=>$this->input->post('name'),
					'content'=>$this->input->post('content'),
					'user'=>$this->user->id,
					'time'=>$this->date->now
				));
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
		}
		
		$this->load->view('wit/edit', compact('wit','project'));
	}
	
	function removeVersion($version_id){
		$version=$this->version->fetch($version_id);
		$project=$this->project->fetch($version['project']);
		
		if($this->user->id != $project['company'] && !$this->user->isLogged('witeditor')){
			return;
		}
		
		$this->version->remove($version_id);
		
		redirect($this->input->server('HTTP_REFERER'));
	}
	
}
?>
