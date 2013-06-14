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
			
			$project=$this->project->fetch($this->input->get('project'));
			
			$wit=$this->wit->fields;
			
		}
		else{
			
			$wit=$this->wit->fetch($this->wit->id);
			
			$project=$this->project->fetch($wit['project']);
		}
		
		if($this->input->post('submit')!==false){
			if(is_null($this->wit->id)){
				//新创意
				$this->wit->id=$this->wit->add(array(
					'name'=>$this->input->post('name'),
					'content'=>$this->input->post('content'),
					'project'=>$project['id'],
					'user'=>$this->user->id,
					'time'=>$this->date->now
				));
				
			}
			else{
				//已有创意，添加版本
				$this->wit->update(array(
					'content'=>$this->input->post('content'),
					'user'=>$this->user->id,
					'time'=>$this->date->now
				));
			}

			$this->version->add(array(
				'project'=>$project['id'],
				'wit'=>$this->wit->id,
				'content'=>$this->input->post('content'),
				'user'=>$this->user->id,
				'time'=>$this->date->now
			));
			
			redirect('project/'.$project['id']);
		}
		
		$this->load->view('wit/edit', compact('wit','project'));
	}
	
}
?>
