<?php
class Company extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');
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
		
		$projects=$this->project->getList(array('company'=>$this->user->id));
		
		foreach($projects as &$project){
			$project['product_name']=$this->product->fetch($project['product'],'name');
		}
		
		$this->load->view('company/project', compact('projects'));
	}
	
	function editProject($id=NULL){
		
		$this->project->id=$id;
		
		if($this->input->post('submit')!==false){
			
			$data=array(
				'name'=>$this->input->post('name'),
				'summary'=>$this->input->post('summary'),
				'product'=>$this->input->post('product'),
				'company'=>$this->user->id,
				'wit_start'=>$this->input->post('start'),
				'wit_end'=>$this->input->post('end'),
				'bonus'=>$this->input->post('bonus')
			);

			//TODO 上传和更新产品图片文件
			if(is_null($this->project->id)){
				$this->project->add($data);
			}
			else{
				$this->project->update($data);
			}
			
			redirect('company/project');
		}
		
		if(is_null($this->project->id)){
			$project=$this->project->fields;
			$project['product']=$this->input->get('product');
		}
		else{
			$project=$this->project->fetch();
		}
		
		$products=$this->product->getArray(array('company'=>$this->user->id),'name','id');
		
		$this->load->view('company/project_edit', compact('project','products'));
	}
	
	function version(){
		
		if($this->input->post('submit')!==false){
			$this->version->score($this->input->post('score'));
		}
		
		$version_list_args=array('company'=>$this->user->id,'orderby'=>'id desc');
		
		if($this->input->get('wit')!==false){
			$version_list_args['wit']=$this->input->get('wit');
		}
		
		if($this->input->get('project')!==false){
			$version_list_args['in_project']=$this->input->get('project');
		}
		
		if($this->input->get('product')!==false){
			$version_list_args['in_product']=$this->input->get('product');
		}
		
		$versions=$this->version->getList($version_list_args);
		
		foreach($versions as &$version){
			$wit=$this->wit->fetch($version['wit']);
			$project=$this->project->fetch($wit['project']);
			
			$version['wit_name']=$wit['name'];
			$version['project_name']=$project['name'];
		}
		
		$this->load->view('company/version', compact('versions'));
	}
}
?>
