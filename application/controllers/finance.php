<?php
class Finance extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('finance_model','finance');
	}
	
	function matchItems($term){
		$term=urldecode($term);
		$this->output->set_output(json_encode($this->finance->matchItems($term)));
	}
}
?>
