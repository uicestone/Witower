<?php
class Version_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='version';
		$this->fields=array(
			'wit'=>'所属创意',
			'content'=>'内容',
			'score_wit'=>'智塔打分',
			'score_company'=>'企业打分',
			'user'=>'用户',
			'time'=>'时间'
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
}
?>
