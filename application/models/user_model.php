<?php
class User_model extends WT_Model{
	
	var $name;
	
	function __construct($uid=NULL){
		parent::__construct();
		
		$this->table='user';
		
		$this->fields=array(
			'name'=>'',//用户名
			'password'=>'',//密码
			'email'=>''//电子邮件
		);

		if(is_null($uid)){
			$uid=$this->session->userdata('user/id');
		}
		
		if($uid){
			$user=$this->fetch($uid);
			$this->id=$user['id'];
			$this->name=$user['name'];
		}
		
	}
	
	/**
	 * 获得存于数据库中的user_config项
	 * @return type
	 */
	function getConfig(){
		$this->db->from('user_config')->where('user',$this->id);
		return array_sub($this->db->get()->result_array(),'value','item');
	}
	
	function getList($args=array()){
		
		$this->db->select('user.id, user.name, user.email');
		
		if(isset($args['in_project'])){
			$this->db->where("id IN (SELECT user FROM version WHERE wit IN (SELECT id FROM wit WHERE project{$this->db->escape_int_array($args['in_project'])}))");
		}
		
		if(isset($args['voted_project'])){
			$this->db->where("user.id IN (SELECT voter FROM project_vote WHERE project{$this->db->escape_int_array($args['voted_project'])})");
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
				'lastlogin'=>$this->date->now
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

	function isLogged(){
		if($this->id){
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
	function updateProfiles(array $profiles){
		
	}
	
	/**
	 * 获得某用户的资料
	 * @return array 资料项
	 */
	function getProfiles($user_id=NULL){
		if(is_null($user_id)){
			$user_id=$this->id;
		}
		
		return $profiles;
	}
	
}
?>
