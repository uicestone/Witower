<?php
class User_model extends WT_Model{
	
	var $name;
	var $group;
	
	function __construct(){
		parent::__construct();
		
		$this->table='user';
		
		$this->fields=array(
			'name'=>'',//用户名
			'password'=>'',//密码
			'email'=>'',//电子邮件
			'group'=>''//用户组
		);
	}
	
	function init($uid=NULL){
		is_null($uid) && $uid=$this->session->userdata('user/id');
		
		if($uid){
			$user=$this->fetch($uid);
			$this->id=$user['id'];
			$this->name=$user['name'];
			$this->group=preg_split('/[,|\s]+?/',$user['group']);
		}
	}
	
	function add(array $data) {

		if(!$data['password']){
			unset($data['password']);
		}
		
		return parent::add($data);
	}
	
	function update(array $data, $id = NULL) {

		if(!$data['password']){
			unset($data['password']);
		}
		
		return parent::update($data, $id);
	}
	
	/**
	 * 获得存于数据库中的user_config项
	 * @return type
	 */
	function getConfig(){
		$this->db->from('user_config')->where('user',$this->id);
		return array_sub($this->db->get()->result_array(),'value','item');
	}
	
	/**
	 * @param array $args
	 *	in_project int | array
	 *		参与过指定项目的创意编写的用户
	 *	in_wit int | array
	 *		为指定创意贡献过版本的用户
	 *	voted_project int | array
	 *		参与过指定项目的投票的用户
	 *	has_commented_project int | array
	 *		评论过特定项目中的版本的用户
	 *	is_fan_of
	 *		获得一个人的关注者列表
	 *	is_idol_of
	 *		获得一个人关注的所有人
	 * @return array
	 */
	function getList($args=array()){
		
		$this->db->select('user.id, user.name, user.email, user.group');
		
		if(array_key_exists('name', $args)){
			$this->db->where('user.name',$args['name']);
		}
		
		if(array_key_exists('email', $args)){
			$this->db->where('user.email',$args['email']);
		}
		
		if(array_key_exists('in_project',$args)){
			$this->db->where("id IN (SELECT user FROM version WHERE wit IN (SELECT id FROM wit WHERE project{$this->db->escape_int_array($args['in_project'])}))");
		}
		
		if(array_key_exists('in_wit',$args)){
			$this->db->where("id IN (SELECT user FROM version WHERE wit{$this->db->escape_int_array($args['in_wit'])})");
		}
		
		if(array_key_exists('voted_project',$args)){
			$this->db->where("user.id IN (SELECT voter FROM project_vote WHERE project{$this->db->escape_int_array($args['voted_project'])})");
		}
		
		if(array_key_exists('has_commented_project', $args)){
			$this->db->where("user.id IN (SELECT user FROM version_comment WHERE version IN (SELECT id FROM version WHERE project{$this->db->escape_int_array($args['has_commented_project'])}))");
		}
		
		if(array_key_exists('is_fan_of', $args)){
			$this->db->where("user.id IN (SELECT fan FROM user_follow WHERE idol{$this->db->escape_int_array($args['is_fan_of'])})");
		}
		
		if(array_key_exists('is_idol_of', $args)){
			$this->db->where("user.id IN (SELECT idol FROM user_follow WHERE fan{$this->db->escape_int_array($args['is_idol_of'])})");
		}
		
		return parent::getList($args);
	}
	
	/**
	 * 校验用户登陆密码
	 * @param string $username
	 * @param string $password
	 * @return array user info
	 */
	function verify($username,$password){
		
		$username=$this->db->escape($username);
		
		$this->db->from('user')
			->where("(name = $username OR email = $username)",NULL,false)
			->where('password',$password);
				
		$user=$this->db->get()->row_array();
		
		if(empty($user)){
			return false;
	
		}else{
			return $user;
		}
	}
	
	function updateLoginTime(){
		$this->db->update('user',
			array('lastip'=>$this->session->userdata('ip_address'),
				'lastlogin'=>time()
			),
			array('id'=>$this->id,'company'=>$this->company->id)
		);
	}
	
	function updatePassword($user_id,$new_password){
		
		return $this->db->update('user',array('password'=>$new_password),array('id'=>$user_id));
		
	}
	
	function updateUsername($user_id,$new_username){
		return $this->db->update('user',array('name'=>$new_username),array('id'=>$user_id));
	}
	
	/**
	 * 根据用户名或uid直接为其设置登录状态
	 */
	function sessionLogin($uid=NULL,$username=NULL){
		$this->db->from('user');

		if(isset($uid)){
			$this->db->where('user.id',$uid);
		}
		elseif(!is_null($username)){
			$this->db->where('user.name',$username);
		}
		
		$user=$this->db->get()->row_array();
		
		if($user){
			$this->session->set_userdata('user/id', $user['id']);
			return true;
		}
		
		return false;
	}

	/**
	 * 登出当前用户
	 */
	function sessionLogout(){
		$this->session->sess_destroy();
	}

	function isLogged($group=NULL){
		if(is_null($group) && $this->id){
			return true;
		}
		
		if(!is_null($group) && $this->id && $this->inGroup($group)){
			return true;
		}
		
		return false;
	}
	
	function inGroup($group, $user_id=NULL){
		is_null($user_id) && $user_id=$this->id;
		
		$groups=preg_split('/[,|\s]+?/',$this->fetch($user_id,'group'));
		
		if(!is_array($group)){
			$group=array($group);
		}
		
		if($this->id && !array_diff($group, $groups)){
			return true;
		}
		
		return false;
	}
	
	/**
	 * 测试是否已关注某用户
	 * @param int $idol
	 * @return bool
	 */
	function hasFollowed($idol){
		$this->db->from('user_follow')
			->where(array('idol'=>$idol,'fan'=>$this->id));
		
		if($this->db->count_all_results()){
			return true;
		}else{
			return false;
		}
	}
	
	function isCompany($user_id=NULL){
		
		if(is_null($user_id)){
			$user_id=$this->id;
		}
		
		$this->db->from('company')
			->where('id',$user_id);
		
		if($this->db->count_all_results()){
			return true;
		}
		
		return false;
	}
	
	/**
	 * 更新当前用户资料项
	 * @param array $profiles
	 */
	function updateProfiles(array $profiles, $user_id=NULL){
		
		is_null($user_id) && $user_id=$this->id;
		$origin=$this->getProfiles($user_id);
		
		$insert=array_diff_key($profiles, $origin);
		$update=array_intersect_key($profiles, $origin);
		
		$set=array();
		foreach($insert as $key => $value){
			$set[]=array('user'=>$user_id,'name'=>$key,'content'=>$value);
		}
		$set && $this->db->insert_batch('user_profile',$set);
		
		foreach($update as $key => $value){
			$this->db->update('user_profile',array('content'=>$value),array('user'=>$user_id,'name'=>$key));
		}
	}
	
	/**
	 * 获得某用户的资料
	 * @return array 资料项
	 */
	function getProfiles($user_id=NULL){
		is_null($user_id) && $user_id=$this->id;
		
		$this->db->from('user_profile')
			->where('user',$user_id);
		
		$result=$this->db->get()->result_array();
		
		$profiles=array_sub($result,'content','name');
		
		return $profiles;
	}
	
	/**
	 * 获得一个用户或一个用户关注的用户的状态列表
	 * @param int $uid 为NULL时返回当前用户关注的用户的状态
	 * @param string $type
	 * @return array
	 */
	function getStatusList($uid=NULL, $type=NULL){
		
		$this->db
			->select('user_status.*, user.name username')
			->from('user_status')
			->join('user','user_status.user = user.id','inner')
			->order_by('id desc');
		
		if(is_null($uid)){
			$this->db->where("( user_status.user = {$this->user->id} OR user_status.user IN (SELECT idol FROM user_follow WHERE fan = {$this->user->id}) )",NULL,false);
		}
		else{
			$this->db->where('user_status.user',$uid);
		}
		
		if(isset($type)){
			$this->db->where('user_status.type',$type);
		}
		
		return $this->db->get()->result_array();
	}
	
	/**
	 * 获得一个状态的评论列表
	 * @param int $status_id
	 * @return array
	 */
	function getStatusCommentList($status_id){
		$this->db
			->select('user_status_comment.*, user.name username')
			->from('user_status_comment')
			->join('user','user_status_comment.user = user.id','inner')
			->where('user_status_comment.status',$status_id)
			->order_by('id desc');
		
		return $this->db->get()->result_array();
	}
	
	function getStatusComment($comment_id){
		$this->db->from('user_status_comment')
			->where('id',$comment_id);
		
		return $this->db->get()->row_array();
	}
	
	/**
	 * 添加一条状态
	 * @param string $content
	 * @param int $uid
	 * @param string $type
	 * @param string $url
	 * @return int
	 */
	function addStatus($content, $uid=NULL, $type=NULL, $url=NULL){
		
		is_null($uid) && $uid=$this->user->id;
		
		$this->db->insert('user_status',array(
			'user'=>$uid,
			'type'=>$type,
			'content'=>$content,
			'url'=>$url,
			'time'=>time()
		));
		
		$this->addCount('statuses',$this->id);
		
		return $this->db->insert_id();
	}
	
	/**
	 * 添加一条状态评论
	 * @param int $status_id
	 * @param string $content
	 * @param int $uid
	 * @return int
	 */
	function addStatusComment($status_id, $content, $uid=NULL){
		is_null($uid) && $uid=$this->user->id;
		
		$this->db->insert('user_status_comment',array(
			'status'=>$status_id,
			'content'=>$content,
			'user'=>$uid,
			'time'=>time()
		));
		
		return $this->db->insert_id();
	}
	
	/**
	 * 将一个用户添加到当前用户的关注列表
	 * @param int $idol 被关注人user.id
	 * @return int
	 */
	function addFollow($idol){
		$this->db->insert('user_follow',array(
			'idol'=>$idol,
			'fan'=>$this->id
		));
		
		$this->addCount('fans',$idol);
		$this->addCount('follows',$this->id);
		
		return $this->db->insert_id();
	}
	
	function addBonus($user, $project, $bonus){
		$this->db->insert('user_bonus',array(
			'user'=>$user,
			'bonus'=>$bonus,
			'project'=>$project,
			'time'=>time()
		));
		
		return $this->db->insert_id();
	}
	
	function addGroup($group,$user_id=NULL){
		is_null($user_id) && $user_id=$this->id;
		$groups=explode(',',$this->fetch($user_id,'group'));
		if($groups[0]===''){
			array_shift($groups);
		}
		!in_array($group,$groups) && $groups[]=$group;
		$this->db->update($this->table,array('group'=>implode(',',$groups)), array('id'=>$user_id));
		return $this->db->affected_rows();
	}
	
	function removeGroup($group,$user_id=NULL){
		is_null($user_id) && $user_id=$this->id;
		$groups=explode(',',$this->fetch($user_id,'group'));
		array_remove_value($groups, $group);
		$this->db->update($this->table,array('group'=>implode(',',$groups)), array('id'=>$user_id));
		return $this->db->affected_rows();
	}
	
	function config($item){
		$this->db->from('user_config')
			->where('item',$item);
		
		$row = $this->db->get()->row();
		
		return $row?$row->value:NULL;
	}
	
	function set_config($item, $value){
		$this->db->query("INSERT INTO `user_config` (user, item, value) VALUE ({$this->id}, {$this->db->escape($item)}, {$this->db->escape($value)}) ON DUPLICATE KEY UPDATE value = {$this->db->escape($value)}");
		return $this->db->affected_rows();
	}
	
	function remove_config_item($item){
		$this->db->delete('user_config', array('user'=>$this->id,'item'=>$item));
	}
	
	function retrieve_user_by_config($item, $value){
		return $this->db->select('user')
			->from('user_config')
			->where('item',$item)
			->where('value',$value)
			->get()->row()->user;
	}
	
}
?>
