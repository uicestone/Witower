<?php
class Test extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		print_r($this->session->all_userdata());
	}
}
?>
