<?php
/**
 * 智塔管理
 */
class Admin extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');

		if(!$this->user->isLogged('witower')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
	}
	
	function index(){
		$this->load->view('admin/index');
	}
	
	function finance(){
		if(!$this->user->isLogged('finance')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
	}
	
	function editFinance($id=NULL){
		if(!$this->user->isLogged('finance')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
	}
	
	function company(){
		if(!$this->user->isLogged('company')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
	}
	
	function editCompany($id=NULL){
		if(!$this->user->isLogged('company')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
	}
	
	function user(){
		if(!$this->user->isLogged('user')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
	}
	
	function editUser($id=NULL){
		if(!$this->user->isLogged('user')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
	}
}
?>
