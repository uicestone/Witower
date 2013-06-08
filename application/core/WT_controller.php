<?php
class WT_Controller extends CI_Controller{
	function __construct() {
		parent::__construct();
		
		$this->load->model('user_model','user');
		
		$this->config->session=$this->session->all_userdata('config');
	}
}
?>
