<?php
class Wit_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='wit';
		$this->fields=array(
			'project'=>NULL,//所属项目
			'name'=>'',//创意标题
			'content'=>'',//最新内容
			'user'=>NULL,//创建者
			'time'=>$this->date->now,//创建时间
			'selected'=>false,//选中
			'deleted'=>false,//已删除
			'latest_version'=>NULL//最新版本
		);
	}
	
	/**
	 * 获得一个创意下所有版本的评论
	 * @param int $wit_id
	 * @return array
	 */
	function getComments($wit_id){
		$this->db->select('version_comment.*, version.wit')
			->from('version_comment')
			->join('version','version.id = version_comment.version','inner')
			->where('version.wit',$wit_id);
		
		return $this->db->get()->result_array();
	}
	
	function getList($args=array()){
		if(array_key_exists('in_project', $args)){
			$this->db->where('wit.project',$args['in_project']);
		}
		
		if(array_key_exists('in_product', $args)){
			$this->db->where("wit.project IN (SELECT id FROM project WHERE product{$this->db->escape_int_array($args['in_product'])})");
		}
		
		if(array_key_exists('selected', $args)){
			$this->db->where('wit.selected', $args['selected']);
		}
		
		if(!array_key_exists('deleted', $args) || !$args['deleted']){
			$this->db->where('wit.deleted',false);
		}
		
		return parent::getList($args);
	}
	
	/**
	 * 将一个创意标记为选中
	 * 将此创意下的版本作者添加到候选人，并计算分数
	 * @param int $wit_id
	 */
	function select($wit_id=NULL){
		is_null($wit_id) && $wit_id=$this->id;
		
		$this->unselect($wit_id);
		
		$this->update(array('selected'=>true), $wit_id);
		
		$scores=$this->db->select('project, user candidate, SUM(score_witower) score_witower, SUM(score_company) score_company')
			->from('version')
			->where('wit',$wit_id)
			->where('deleted',false)
			->group_by('user')
			->get()->result_array();
		
		$this->db->insert_batch('project_candidate',$scores);
		
		return $this;
	}
	
	function unselect($wit_id=NULL){
		is_null($wit_id) && $wit_id=$this->id;
		
		$wit=$this->fetch($wit_id);
		
		//首先将同项目下的创意都标记为未选中
		$this->db->query("
			UPDATE wit INNER JOIN wit t USING (project)
			SET wit.selected = FALSE
			WHERE t.id = ".intval($wit_id)."
		");
		
		//删除同项目所有候选人
		$this->db->delete('project_candidate',array('project'=>$wit['project']));
		
		return $this;
	}
	
	function autoSelect($project_id){
		$this->db->select('wit, SUM(`score_witower` + `score_company`) sum',false)
			->from('version')
			->where('project',$project_id)
			->group_by('wit')
			->order_by('sum desc');
			
		$versions_grouped=$this->db->get()->result_array();
		
		if(!$versions_grouped){
			return false;
		}
		
		$this->select($versions_grouped[0]['wit']);
		
	}
	
	function remove($wit_id=NULL){
		is_null($wit_id) && $wit_id=$this->id;
		
		$this->unselect($wit_id);
		
		$this->wit->update(array('deleted'=>true));
		
		return $this;
	}
	
	/**
	 * 将最新版本的标题、内容和时间同步到创意中
	 * @param int $wit_id
	 */
	function refresh($wit_id=NULL){
		is_null($wit_id) && $wit_id=$this->id;
		
		$latest_version=$this->db->from('version')
			->where(array('wit'=>$wit_id,'deleted'=>false))
			->order_by('time','desc')
			->limit(1)
			->get()
			->row_array();
		
		if($latest_version){
			$this->update(array(
				'latest_version'=>$latest_version['id'],
				'name'=>$latest_version['name'],
				'content'=>$latest_version['content']
			),$wit_id);
		}
		else{
			//没有找到未删除版本，则将整个创意标记为删除
			$this->update(array('deleted'=>true),$wit_id);
		}
		
		return $this;
	}
}
?>
