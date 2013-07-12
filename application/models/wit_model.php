<?php
class Wit_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='wit';
		$this->fields=array(
			'project'=>NULL,//所属项目
			'name'=>'',//创意标题
			'content'=>'',//最新内容
			'user'=>NULL,//用户
			'time'=>$this->date->now,//时间
			'selected'=>false,//选中
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
		if(isset($args['in_project'])){
			$this->db->where('project',$args['in_project']);
		}
		
		if(isset($args['in_product'])){
			$this->db->where("project IN (SELECT id FROM project WHERE product{$this->db->escape_int_array($args['in_product'])})");
		}
		
		return parent::getList($args);
	}
	
	function countVersions($wit_id=NULL){
		is_null($wit_id) && $wit_id=$this->id;
		return $this->db->from('version')->where('wit',$wit_id)->count_all_results();
	}
}
?>
