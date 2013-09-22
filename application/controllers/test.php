<?php
class Test extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$this->load->model('wit_model','wit');
		$this->wit->autoSelect(1);
		print_r($this->user);
		print_r($this->session->all_userdata());
	}
}
?>
