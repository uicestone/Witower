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
			'comment_witower'=>'',//智塔评语
			'comment_company'=>'',//企业评语
			'deleted'=>false,//隐藏（用于处理不良）
			'user'=>$this->user->id,//用户
			'time'=>time(),//时间
		);
	}

	/**
	 * 获得一个版本的评论
	 * @param int $version
	 * @return array
	 */
	function getComments($version=NULL){
		
		is_null($version) && $version=$this->id;
		
		$this->db->select('version_comment.*, user.name username')
			->from('version_comment')
			->join('user','user.id = version_comment.user','inner')
			->where('version',$version);

		return $this->db->get()->result_array();
		
	}
	
	function getComment($comment_id){
		$this->db->from('version_comment')
			->where('id',$comment_id);
		
		return $this->db->get()->row_array();
	}
	
	function addComment($version=NULL, $content){
		
		is_null($version) && $version=$this->id;
		
		$this->db->insert('version_comment',array(
			'version'=>$version,
			'content'=>$content,
			'user'=>$this->user->id,
			'time'=>time()
		));
		
		return $this->db->insert_id();
	}
	
	/**
	 * 
	 * @param array $args
	 *	wit
	 *	in_project
	 *	in_product
	 *	company
	 *	user
	 *	deleted	false (default), null, true
	 *	score witower,company
	 *	comment witower,company
	 * @return array
	 */
	function getList($args = array()) {
		
		$this->db->join('user','user.id = version.user','inner')
			->select('version.*, user.name username');
		
		if(array_key_exists('wit',$args)){
			$this->db->where('version.wit',$args['wit']);
		}
		
		if(array_key_exists('num',$args)){
			$this->db->where('version.num',$args['num']);
		}
		
		if(array_key_exists('in_project',$args)){
			$this->db->where("version.wit IN (SELECT id FROM wit WHERE project{$this->db->escape_int_array($args['in_project'])})");
		}
		
		if(array_key_exists('in_product',$args)){
			$this->db->where("version.wit IN (SELECT id FROM wit WHERE project IN (SELECT id FROM project WHERE product{$this->db->escape_int_array($args['in_product'])}))");
		}
		
		if(array_key_exists('company',$args)){
			$this->db->where("version.wit IN (SELECT id FROM wit WHERE project IN (SELECT id FROM project WHERE company{$this->db->escape_int_array($args['company'])}))");
		}
		
		if(array_key_exists('user', $args)){
			$this->db->where('version.user',$args['user']);
		}
		
		if(!array_key_exists('deleted', $args) || $args['deleted']===false){
			$this->db->where('version.deleted = FALSE');
		}elseif($args===true){
			$this->db->where('version.deleted = TRUE');
		}
		
		if(array_key_exists('score', $args)){
			$this->db->select('score_'.$args['score'].' score');
		}
		
		if(array_key_exists('comment', $args)){
			$this->db->select('comment_'.$args['comment'].' comment');
		}
		
		return parent::getList($args);
	}
	
	/**
	 * 给一组版本打分
	 * 将写入version表
	 * @param array $version_score
	 *	array(
	 *		version_id => score
	 *	)
	 * @throws Exception 'invalid_score'
	 */
	function score($version_score){
		foreach($version_score as $version_id => $score){
			$version=$this->fetch($version_id);
			if($score>10 || $score<0){
				throw new Exception('invalid_score');
			}
			$score_field=$this->user->isLogged('witower')?'score_witower':'score_company';
			$this->update(array($score_field=>$score), $version_id);
			
			$this->db->where('candidate',$version['user'])
				->where('project',$version['project'])
				->set($score_field,"`$score_field` - {$version[$score_field]} + {$this->db->escape($score)}",false)
				->update('project_candidate');
		}
	}
	
	/**
	 * 给一组版本写入评语（非评论）
	 * @param array $version_comments
	 *	array(
	 *		version_id => comment_content
	 *	)
	 */
	function comment($version_comments){
		foreach($version_comments as $version_id => $comment){
			$score_field=$this->user->isLogged('witower')?'comment_witower':'comment_company';
			$this->update(array($score_field=>$comment), $version_id);
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
