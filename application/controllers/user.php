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
		$this->load->view('user/profile');
	}
	
	/**
	 * 用户首页
	 */
	function home(){
		$this->space();
	}
	
	/**
	 * 用户首页
	 */
	function space(){
		$this->load->view('user/space');
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
