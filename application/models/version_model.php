<?php
class Version_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='version';
		$this->fields=array(
			'project'=>NULL,//所属项目
			'wit'=>NULL,//所属创意
			'content'=>'',//内容
			'score_witower'=>0,//智塔打分
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
		
		$this->db->join('user','user.id = version.user','inner')
			->select('version.*, user.name username');
		
		if(isset($args['wit'])){
			$this->db->where('version.wit',$args['wit']);
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
		
		return parent::getList($args);
	}
	
	/**
	 * 给一组版本打分，并将版本作者列为候选人
	 * 将写入version表
	 * 并累加project_candidate表
	 * @todo 根据打分人是企业还是管理员，判断打在score_company还是score_wit上
	 * @param array $version_score
	 *	array(
	 *		version_id => score
	 *	)
	 */
	function score($version_score){
		
		$this->load->model('wit_model','wit');
		
		foreach($version_score as $version_id => $score){
			$version=$this->fetch($version_id);
			
			$this->db->update('version',array('score_company'=>$score),array('id'=>$version_id));
			
			$result_candidate=$this->db->from('project_candidate')
				->where('candidate',$version['user'])
				->where('project',$version['project'])
				->get()->result_array();
			
			if(!$result_candidate && $score>0){
				//还木有这个候选人，我们先插入
				$this->db->insert('project_candidate',array(
					'candidate'=>$version['user'],
					'project'=>$version['project'],
					'score_company'=>$score
				));
			}
			else{
				$this->db->set('score_company',"`score_company` - {$version['score_company']} + $score")//TODO score未转义
					->where('candidate',$version['user'])
					->where('project',$version['project'])
					->update('project_candidate');
			}
		}
	}
}
?>
