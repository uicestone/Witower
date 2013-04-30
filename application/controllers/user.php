<?php
class User extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 注册页面
	 */
	function signup(){
		$this->load->view('user/signup');
	}
	
	/**
	 * 登陆页面
	 */
	function login(){
		$this->load->view('user/login');
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
	 * 企业的项目管理
	 */
	function management(){
		$this->load->view('user/project');
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
