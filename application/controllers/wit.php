<?php
class Wit extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 单条创意的查看页面，包含多个版本
	 */
	function view(){
		$this->load->view('wit/view');
	}
	
	/**
	 * 单个版本的编辑页面
	 */
	function edit(){
		$this->load->view('wit/edit');
	}
	
}
?>
