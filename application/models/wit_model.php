<?php
class Wit_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='wit';
		$this->fields=array(
			'project'=>'所属项目',
			'content'=>'最新内容',
			'user'=>'用户',
			'time'=>'时间',
			'selected'=>'选中'
		);
	}
	
	/**
	 * 获得一个创意下所有版本的评论
	 * @param type $wit_id
	 * @return type
	 */
	function getComments($wit_id){
		$this->db->select('version_comment.*, wit.id AS wit')
			->from('version_comment')
			->join('version','version.id = version_comment.version','inner')
			->where('version.wit',$wit_id);
		
		return $this->db->get()->result_array();
	}
}
?>
