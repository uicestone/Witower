<?php
class Index extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 首页
	 */
	function index(){
		$this->load->view('index');
	}
	
}
?>
