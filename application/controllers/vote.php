<?php
class Vote extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 投票中的项目列表页
	 */
	function index(){
		$this->load->view('vote/list');
	}
	
	/**
	 * 项目投票详情查看页
	 */
	function view(){
		$this->load->view('vote/view');
	}
	
}
?>
