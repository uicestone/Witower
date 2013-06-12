<?php
class Company extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('project_model','project');
	}
	
	function product(){
		
		$products=$this->product->getList(array('company'=>$this->user->id));
		
		$this->load->view('company/product', compact('products'));
	}
	
	function editProduct(){
		$this->load->view('company/product_edit');
	}
	
	function project(){
		$this->load->view('company/project');
	}
	
	function editProject(){
		$this->load->view('company/project_edit');
	}
}
?>
