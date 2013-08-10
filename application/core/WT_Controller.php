<?php
class WT_Controller extends CI_Controller{
	function __construct() {
		parent::__construct();
		
		//$this->output->enable_profiler(TRUE);
		
		$this->load->model('witower_model','witower');
		$this->load->model('user_model','user');
		$this->load->model('company_model','company');
		
		$this->user->init();
		
		$this->config->witower=$this->witower->getConfig();
		$this->config->user=$this->user->getConfig();
		$this->config->session=$this->session->all_userdata('config');
	}
}
?>
