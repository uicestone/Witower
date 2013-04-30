<?php
class Project extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 项目列表页
	 */
	function index(){
		$this->load->view('project/list');
	}
	
	/**
	 * 项目详情页
	 */
	function view(){
		$this->load->view('project/view');
	}
}
?>
