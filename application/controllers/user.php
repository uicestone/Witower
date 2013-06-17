<?php
class User extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 注册页面
	 */
	function signup(){
		
		if($this->input->post('signup')){
			$user_id=$this->user->add(array(
				'name'=>$this->input->post('username'),
				'password'=>$this->input->post('password'),
				'email'=>$this->input->post('email')
			));
			
			$this->user->sessionLogin($user_id);
			
			redirect();
			
		}
		
		$this->load->view('user/signup');
	}
	
	/**
	 * 登陆页面
	 */
	function login(){
		
		if($this->input->post('login')){
			$user=$this->user->verify($this->input->post('username'), $this->input->post('password'));
			if($user){
				$this->user->sessionLogin($user['id']);
				redirect('');
			}
		}
		
		$this->load->view('user/login');
	}
	
	function logout(){
		$this->user->sessionLogout();
		redirect('');
	}
	
	/**
	 * 用户资料编辑页面
	 */
	function profile(){
		
		$user=$this->user->fetch();
		
		$profiles=$this->user->getProfiles();
		
		$this->load->view('user/profile', compact('user','profiles'));
	}
	
	/**
	 * 用户首页
	 */
	function home(){
		$user=$this->user->fetch();
		
		$status_type=$this->input->get('status_type')!==false?$this->input->get('status_type'):NULL;
		
		$status=$this->user->getStatusList();
		
		foreach($status as &$status_item){
			$status_item['comments']=$this->user->getStatusCommentList($status_item['id']);
		}
		
		$this->load->view('user/space', compact('user','status'));
	}
	
	/**
	 * 用户首页
	 */
	function space($uid){
		
		$user=$this->user->fetch($uid);
		
		$status_type=$this->input->get('status_type')!==false?$this->input->get('status_type'):NULL;
		
		$status=$this->user->getStatusList($uid);
		
		foreach($status as &$status_item){
			$status_item['comments']=$this->user->getStatusCommentList($status_item['id']);
		}
		
		$this->load->view('user/space', compact('user','status'));
	}
	
	function addStatus(){
		$this->user->addStatus($this->input->post('content'));
		redirect('home');
	}
	
	function addFollow($idol){
		$this->output->set_output($this->user->addFollow($idol));
	}
	
	/**
	 * 可兑换积分列表
	 */
	function score(){
		$this->load->view('user/score');
	}
	
	/**
	 * 达人列表
	 */
	function master(){
		
	}
	
	/**
	 * 合作伙伴列表
	 */
	function partner(){
		
	}
	
}
?>
