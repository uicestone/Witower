<?php
class Test extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		print_r($this->config->user_item('recommended_project'));
		print_r($this->session->all_userdata());
	}
}
?>
