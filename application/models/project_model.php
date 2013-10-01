<?php
class Project_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='project';
		$this->fields=array(
			'product'=>NULL,//所属产品
			'name'=>'',//项目名称
			'summary'=>'',//项目介绍
			'wit_start'=>date('Y-m-d',strtotime('+1 Days')),//创意开始日期
			'wit_end'=>date('Y-m-d',strtotime('+7 Days')),//创意结束日期
			'vote_start'=>date('Y-m-d',strtotime('+9 Days')),//投票开始日期
			'vote_end'=>date('Y-m-d',strtotime('+11 Days')),//投票结束日期
			'active'=>true,//项目活动中，若为false，将覆盖上述时间，影响status
			'bonus'=>NULL,//悬赏奖金
			'company'=>$this->user->id,//公司
			'witters'=>0,//参与人数
			'voters'=>0,//投票人数
			'favorites'=>0//收藏数
		);
	}
	
	function fetch($id=NULL){
		$project=parent::fetch($id);
		$project['company_name']=$this->user->fetch($project['company'],'name');
		$project['status']=$this->getStatus($project);
		return $project;
	}
	
	/**
	 * 
	 * @param array $args
	 *	status (preparing, witting, buffering, voting, end)
	 *	in_product
	 *	get_product_name
	 *	company
	 *	user_witted int | array 过滤出某用户参与创意的项目
	 *	user_voted int | array 过滤出某用户参与投票的项目
	 * @return type
	 */
	function getList($args = array()) {
		
		$this->db->join('user','user.id = project.company','inner')
			->select('project.*, user.name company_name');
		
		if(array_key_exists('status', $args)){
			if($args['status']==='preparing'){
				$this->db->where('CURDATE() < project.wit_start',NULL,false);
			}
			elseif($args['status']==='witting'){
				$this->db->where('CURDATE() >= project.wit_start AND CURDATE() <= project.wit_end',NULL,false);
			}
			elseif($args['status']==='buffering'){
				$this->db->where('CURDATE() > project.wit_end AND CURDATE() < project.vote_start',NULL,false);
			}
			elseif($args['status']==='voting'){
				$this->db->where('CURDATE() >= project.vote_start AND CURDATE() <= project.vote_end',NULL,false);
			}
			elseif($args['status']==='end'){
				if(array_key_exists('active', $args)){
					$this->db->where('CURDATE() > project.vote_end',NULL,false);
				}
				else{
					$this->db->where('( CURDATE() > project.vote_end OR project.active = FALSE )',NULL,false);
				}
			}
		}
		
		if(array_key_exists('active', $args)){
			$this->db->where('project.active',$args['active']);
		}
		
		if(array_key_exists(in_product,$args)){
			$this->db->where('project.product',$args['in_product']);
		}
		
		if(array_key_exists('get_product_name', $args) && $args['get_product_name']){
			$this->db->join('product','product.id = project.product','inner')
				->select('product.name product_name');
		}
		
		if(array_key_exists(company,$args)){
			$this->db->where('project.company',$args['company']);
		}
		
		if(array_key_exists('user_witted', $args)){
			$this->db->where("project.id IN (SELECT project FROM version WHERE user{$this->db->escape_int_array($args['user_witted'])})");
		}
		
		if(array_key_exists('user_voted', $args)){
			$this->db->where("project.id IN (SELECT project FROM project_vote WHERE voter{$this->db->escape_int_array($args['user_voted'])})");
		}
		
		$project_list = parent::getList($args);
		
		//判断是否数组，因为可能指定了count_all_results参数，返回的是整数
		if(is_array($project_list)){
			foreach($project_list as &$project){
				$project['status']=$this->getStatus($project);
			}
		}
		
		return $project_list;
	}
	
	/**
	 * 获得一个项目下所有创意版本的评论
	 * @param int $project_id
	 * @return array
	 */
	function getComments($project_id=NULL){
		
		is_null($project_id) && $project_id=$this->id;
		
		$this->db->select('version_comment.*')
			->from('version_comment')
			->join('version','version.id = version_comment.version','inner')
			->join('wit','wit.id = version.wit','inner')
			->select('wit.id AS wit')
			->join('project','project.id = wit.project','inner')
			->select('project.id AS project, project.name AS project_name')
			->join('user','user.id = version_comment.user','inner')
			->select('user.name AS username')
			->where('project.id',$project_id);
		
		return $this->db->get()->result_array();
	}
	
	/**
	 * 获得一个项目以及所属产品的标签
	 * @param type $project_id
	 * @return type
	 */
	function getTags($project_id=NULL){
		
		$project=$this->fetch($project_id);
		
		is_null($project_id) && $project_id=$this->id;
		
		$this->db->select('tag.*')
			->from('tag')
			->where('id IN (SELECT tag FROM project_tag WHERE project = '.intval($project['id']).')',NULL,false)
			->or_where('id IN (SELECT tag FROM product_tag WHERE product = '.intval($project['product']).')',NULL,false);
		
		$result=$this->db->get()->result_array();
		
		return array_sub($result,'name');
	}
	
	function countWits($project_id=NULL){
		is_null($project_id) && $project_id=$this->id;
		return $this->db->from('wit')->where('project',$project_id)->count_all_results();
	}
	
	/**
	 * 
	 * @param int $project_id
	 * @return array 
	 *	array(
	 *		array(
	 *			'percentage'=>0.5,
	 *			'votes'=>2,
	 *			'candidate'=>5,
	 *			'candidate_name'=>'user_1'
	 *		),
	 *		array(
	 *			'percentage'=>0.5,
	 *			'votes'=>2,
	 *			'candidate'=>6,
	 *			'candidate_name'=>'user_2'
	 *		)
	 *	)
	 */
	function getCandidates($project_id=NULL){
		is_null($project_id) && $project_id=$this->id;
		
		$this->db->from('project_candidate')
			->where('project',$project_id);
		
		$candidates=$this->db->get()->result_array();
		
		foreach($candidates as &$candidate){
			$candidate['id']=$candidate['candidate'];
			$candidate['name']=$this->user->fetch($candidate['id'],'name');
			$candidate['percentage']=$this->countVotes($project_id)>0?round($candidate['votes']/$this->countVotes($project_id),3):0;
		}
		
		return $candidates;
	}
	
	/**
	 * 获得一个项目的投票总数
	 * @param int $project_id
	 * @return int
	 */
	function countVotes($project_id=NULL){
		is_null($project_id) && $project_id=$this->id;
		
		$this->db->select('SUM(votes) AS sum',false)
			->from('project_vote');
		
		if($project_id!==false){
			$this->db->where('project',$project_id);
		}
		
		return $this->db->get()->row()->sum;
	}
	
	/**
	 * 获得一个项目的投票人总数
	 * @param int $project_id
	 * @return int
	 */
	function countVoters($project_id=NULL){
		is_null($project_id) && $project_id=$this->id;
		
		$this->db->select('COUNT(voter) AS count',false)
			->from('project_vote');
		
		if($project_id!==false){
			$this->db->where('project',$project_id);
		}
		
		return $this->db->get()->row()->count;
	}
	
	/**
	 * 用户给一组候选人投票
	 * 将写入project_vote表，并累加project_candidate表
	 * @param array $candidates
	 */
	function vote($candidates_votes, $project_id=NULL){
		is_null($project_id) && $project_id=$this->id;
		
		foreach($candidates_votes as $candidate => $votes){
			
			if(!$votes){
				continue;
			}
			
			$project_vote=array(
				'project'=>$project_id,
				'candidate'=>$candidate,
				'voter'=>$this->user->id,
				'votes'=>$votes
			);
			
			$this->db->insert('project_vote',$project_vote);
			
			$this->db->set('votes', "`votes` + {$this->db->escape($votes)}", false)
				->where('candidate', $candidate)
				->where('project',$project_id)
				->update('project_candidate');
		}
	}
	
	function hasUserVoted($project_id=NULL, $user_id=NULL){
		is_null($user_id) && $user_id=$this->user->id;
		is_null($project_id) && $project_id=$this->id;
		
		$voted_candidates=$this->db
			->where('project',$project_id)
			->where('voter',$user_id)
			->count_all_results('project_vote');
		
		if($voted_candidates>0){
			return true;
		}
		else{
			return false;
		}
	}
	
	function bonusAllocate($project_id=NULL){
		is_null($project_id) && $project_id=$this->id;
		$project=$this->fetch($project_id);
		$sum=$this->db
			->select('SUM(votes) votes, SUM(score_witower) score_witower, SUM(score_company) score_company')
			->from('project_candidate')
			->where('project',$project_id)
			->get()->row_array();
		
		$candidates=$this->getCandidates($project_id);
		
		$bonus=array();
		
		foreach($candidates as &$candidate){
			
			//三项评分均无，那么平分奖金
			if($sum['votes'] + $sum['score_witower'] + $sum['score_company'] == 0){
				$candidate['bonus']=$project['bonus']/count($candidates);
			}
			else{
				//计算比重
				
				$candidate['percentage_votes']=$sum['votes']>0?$candidate['votes']/$sum['votes']:0;
				$candidate['percentage_score_company']=$sum['score_company']>0?$candidate['score_company']/$sum['score_company']:0;
				$candidate['percentage_score_witower']=$sum['score_witower']>0?$candidate['score_witower']/$sum['score_witower']:0;

				$candidate['bonus']=
					($candidate['percentage_votes']*1 + $candidate['percentage_score_company']*2 + $candidate['percentage_score_witower']*2)
						/
					(($sum['votes']>0?1:0) + ($sum['score_company']>0?2:0) + ($sum['score_witower']>0?2:0))
						*
					$project['bonus'];
			}
			
			$bonus[]=array('user'=>$candidate['id'],'amount'=>$candidate['bonus']);
		}
		
		return $bonus;
	}
	
	/**
	 * 获得一个项目的状态字符串
	 * @param int or array $project 项目id或项目数据，前者将先执行一次fetch
	 * @return string: preparing, witting, buffering, voting, end
	 */
	function getStatus($project=NULL){
		is_null($project) && $project=$this->id;
		if(!is_array($project)){
			$project=$this->fetch($project);
		}
		
		if($project['active']===false || $this->date->today > $project['vote_end']){
			return 'end';
		}
		elseif($this->date->today < $project['wit_start']){
			return 'preparing';
		}
		elseif($this->date->today >= $project['wit_start'] && $this->date->today <= $project['wit_end']){
			return 'witting';
		}
		elseif($this->date->today > $project['wit_end'] && $this->date->today < $project['vote_start']){
			return 'buffering';
		}
		elseif($this->date->today >= $project['vote_start'] && $this->date->today <= $project['vote_end']){
			return 'voting';
		}
	}
	
}
?>
