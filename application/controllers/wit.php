<?php
class Wit extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');
	}
	
	/**
	 * 单条创意的查看页面，包含多个版本
	 */
	function view($id){
		
		$this->wit->id=$id;
		
		$versions=$this->version->getList(array('wit'=>$this->wit->id));
		
		foreach($versions as &$version){
			$version['author_name']=$this->user->fetch($version['user'],'name');
		}
		
		$this->load->view('wit/view', compact('versions'));
	}
	
	/**
	 * 单个版本的编辑页面
	 */
	function edit($id=NULL){
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
					'content'=>$this->input->post('content'),
					'user'=>$this->user->id,
					'time'=>$this->date->now
				));
			}
			
			//添加一个版本
			if($wit['user']===$this->user->id){
				//如果创意的最后修改人就是本人，那么执行热修改，不创建新版本
				$this->version->update(array(
					'content'=>$this->input->post('content'),
					'time'=>$this->date->now
				),$wit['latest_version']);
			}else{
				$wit['latest_version']=$this->version->add(array(
					'project'=>$project['id'],
					'wit'=>$this->wit->id,
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
	
}
?>
