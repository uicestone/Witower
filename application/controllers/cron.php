<?php
class Cron extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');
	}
	
	function index(){
		$this->witSelect();
		$this->projectEnd();
	}
	
	/**
	 * 找出到投票期但没有选定创意的项目，自动选择版本，并添加候选人
	 */
	function witSelect(){
		
		$voting_projects=$this->project->getList(array(
			'status'=>'voting'
		));
		
		$projects_without_selected_wit=array();
		
		foreach($voting_projects as $voting_project){
			$wit_selected=$this->wit->getList(array(
				'in_project'=>$voting_project['id'],
				'selected'=>true
			));
			if(!$wit_selected){
				$projects_without_selected_wit[]=$voting_project;
			}
		}
		
		foreach($projects_without_selected_wit as $project_without_selected_wit){
			$this->wit->autoSelect($project_without_selected_wit['id']);
		}
		
	}
	
	/**
	 * 找出时间上已结束但状态为活动的项目，自动结束并分配
	 */
	function projectEnd(){

		$this->load->model('finance_model','finance');
		
		$projects_to_be_end=$this->project->getlist(array(
			'active'=>true,
			'status'=>'end'
		));
		
		foreach($projects_to_be_end as $project_to_be_end){

			$this->project->id=$project_to_be_end['id'];
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

			if(round(array_sum(array_sub($bonuses,'amount'))) !== round($project['bonus'])){
				$this->finance->add(array(
					'project'=>$this->project->id,
					'user'=>$project['company'],
					'amount'=>$project['bonus'],
					'item'=>'积分'
				));
			}

			$this->project->update(array('active'=>false),$this->project->id);
		}
		
	}
}
?>
