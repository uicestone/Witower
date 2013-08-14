<?php
class Version_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='version';
		$this->fields=array(
			'num'=>0,//创意下的版本号
			'project'=>NULL,//所属项目
			'wit'=>NULL,//所属创意
			'name'=>'',//标题
			'content'=>'',//内容
			'score_witower'=>0,//智塔打分
			'score_company'=>0,//企业打分
			'deleted'=>0,//隐藏（用于处理不良）
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
	
	/**
	 * 
	 * @param array $args
	 *	wit
	 *	in_project
	 *	in_product
	 *	company
	 *	deleted	false (default), null, true
	 * @return array
	 */
	function getList($args = array()) {
		
		$this->db->join('user','user.id = version.user','inner')
			->select('version.*, user.name username');
		
		if(isset($args['wit'])){
			$this->db->where('version.wit',$args['wit']);
		}
		
		if(isset($args['num'])){
			$this->db->where('version.num',$args['num']);
		}
		
		if(isset($args['in_project'])){
			$this->db->where("version.wit IN (SELECT id FROM wit WHERE project{$this->db->escape_int_array($args['in_project'])})");
		}
		
		if(isset($args['in_product'])){
			$this->db->where("version.wit IN (SELECT id FROM wit WHERE project IN (SELECT id FROM project WHERE product{$this->db->escape_int_array($args['in_product'])}))");
		}
		
		if(isset($args['company'])){
			$this->db->where("version.wit IN (SELECT id FROM wit WHERE project IN (SELECT id FROM project WHERE company{$this->db->escape_int_array($args['company'])}))");
		}
		
		if(!array_key_exists('deleted', $args) || $args['deleted']===false){
			$this->db->where('version.deleted = FALSE');
		}elseif($args===true){
			$this->db->where('version.deleted = TRUE');
		}
		
		return parent::getList($args);
	}
	
	/**
	 * 给一组版本打分，并将版本作者列为候选人
	 * 将写入version表
	 * @param array $version_score
	 *	array(
	 *		version_id => score
	 *	)
	 */
	function score($version_score){
		foreach($version_score as $version_id => $score){
			$score_field=$this->user->isLogged('witower')?'score_witower':'score_company';
			$this->update(array($score_field=>$score), $version_id);
		}
	}
	
	function getPrevious($version_id){
		$this->db->from('version')
			->where('id <',$version_id)
			->where('deleted',false)
			->where("wit = (SELECT wit FROM version WHERE id = $version_id)",NULL,false)
			->order_by('id', 'desc')
			->limit(1);
		
		return $this->db->get()->row_array();
	}
	
	function getNext($version_id){
		$this->db->from('version')
			->where('id >',$version_id)
			->where("wit = (SELECT wit FROM version WHERE id = $version_id)",NULL,false)
			->where('deleted',false)
			->limit(1);
		
		return $this->db->get()->row_array();
	}
}
?>
