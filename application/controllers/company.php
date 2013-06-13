<?php
class Company extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
	}
	
	function product(){
		
		$products=$this->product->getList(array('company'=>$this->user->id));
		
		foreach($products as &$product){
			$result_projects_witting=$this->project->getList(array('count'=>true,'in_product'=>$product['id'],'is_active'=>true));
			$product['projects_witting']=$result_projects_witting[0]['count'];
			
			$result_projects_voting=$this->project->getList(array('count'=>true,'in_product'=>$product['id'],'is_voting'=>true));
			$product['projects_voting']=$result_projects_voting[0]['count'];
			
			$product['wits']=count($this->wit->getList(array('in_product'=>$product['id'])));
		}
		
		$this->load->view('company/product', compact('products'));
	}
	
	function editProduct($id=NULL){
		
		$this->product->id=$id;
		
		if($this->input->post('submit')!==false){
			
			$data=array(
				'name'=>$this->input->post('name'),
				'description'=>$this->input->post('description'),
				'company'=>$this->user->id
			);

			//TODO 上传和更新产品图片文件
			if(is_null($this->product->id)){
				$this->product->add($data);
			}
			else{
				$this->product->update($data);
			}
			
			redirect('company/product');
		}
		
		if(is_null($this->product->id)){
			$product=$this->product->fields;
		}
		else{
			$product=$this->product->fetch();
		}
		
		$this->load->view('company/product_edit', compact('product'));
	}
	
	function project(){
		$this->load->view('company/project');
	}
	
	function editProject(){
		$this->load->view('company/project_edit');
	}
}
?>
