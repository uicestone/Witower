<?php
class Version_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='version';
		$this->fields=array(
			'wit'=>NULL,//所属创意
			'content'=>'',//内容
			'score_wit'=>0,//智塔打分
			'score_company'=>0,//企业打分
			'user'=>NULL,//用户
			'time'=>$this->date->now,//时间
		);
	}

	/**
	 * 获得一个版本的评论
	 * @param int $version
	 * @return array
	 */
	function getComments($version=NULL){
		$this->db->select('version_comment.*')
			->from('version_comment')
			->where('version',$version);

		return $this->db->get()->result_array();
		
	}
	
	function getList($args = array()) {
		
		if(isset($args['wit'])){
			$this->db->where('wit',$args['wit']);
		}
		
		return parent::getList($args);
	}
	
	/**
	 * 给一个版本打分，并将版本作者列为候选人
	 * 将写入version表
	 * 并累加project_candidate表
	 * 根据打分人是企业还是管理员，判断打在score_company还是score_wit上
	 * @param int $version_id
	 * @todo
	 */
	function score($version_id){
		
	}
}
?>
