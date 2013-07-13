<?php
class Company extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');

		if(!$this->user->isCompany()){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
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
			
			try{
			
				$data=array(
					'name'=>$this->input->post('name'),
					'description'=>$this->input->post('description'),
					'company'=>$this->user->id
				);

				if(is_null($this->product->id)){
					$this->product->id=$this->product->add($data);
				}
				else{
					$this->product->update($data);
				}

				$this->load->library('upload',array(
					'upload_path'=>'./uploads/',
					'allowed_types'=>'jpg'
				));
				
				if(!$_FILES['image']['error'] && !$this->upload->do_upload('image')){
					throw new Exception($this->upload->display_errors());
				}

				$upload_data=$this->upload->data();
				
				$this->load->library('image_lib',array(
					'source_image'=>$upload_data['full_path'],
					'maintain_ratio'=>true,
					'width'=>200,
					'height'=>200,
					'new_image'=>'./uploads/images/product/'.$this->product->id.'_200.jpg'
				));
				
				$this->image_lib->resize();
				
				$this->image_lib->clear();
				
				$this->image_lib->initialize(array(
					'source_image'=>$upload_data['full_path'],
					'maintain_ratio'=>true,
					'width'=>100,
					'height'=>100,
					'new_image'=>'./uploads/images/product/'.$this->product->id.'_100.jpg'
				));
				
				$this->image_lib->resize();
				
				$this->image_lib->clear();
				
				rename($upload_data['full_path'], './uploads/images/product/'.$this->product->id.'.jpg');
				
				redirect('company/product');
				
			}
			catch(Exception $e){
			}
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
			
			try{
				$data=array(
					'name'=>$this->input->post('name'),
					'summary'=>$this->input->post('summary'),
					'product'=>$this->input->post('product'),
					'company'=>$this->user->id,
					'wit_start'=>$this->input->post('start'),
					'wit_end'=>$this->input->post('end'),
					'bonus'=>$this->input->post('bonus')
				);

				if(is_null($this->project->id)){
					$this->project->id=$this->project->add($data);
				}
				else{
					$this->project->update($data);
				}
				
				$this->load->library('upload',array(
					'upload_path'=>'./uploads/',
					'allowed_types'=>'jpg'
				));
				
				if(!$_FILES['image']['error'] && !$this->upload->do_upload('image')){
					throw new Exception($this->upload->display_errors());
				}

				$upload_data=$this->upload->data();
				
				$this->load->library('image_lib',array(
					'source_image'=>$upload_data['full_path'],
					'maintain_ratio'=>true,
					'width'=>200,
					'height'=>200,
					'new_image'=>'./uploads/images/project/'.$this->project->id.'_200.jpg'
				));
				
				$this->image_lib->resize();
				
				$this->image_lib->clear();
				
				$this->image_lib->initialize(array(
					'source_image'=>$upload_data['full_path'],
					'maintain_ratio'=>true,
					'width'=>100,
					'height'=>100,
					'new_image'=>'./uploads/images/project/'.$this->project->id.'_100.jpg'
				));
				
				$this->image_lib->resize();
				
				$this->image_lib->clear();
				
				rename($upload_data['full_path'], './uploads/images/project/'.$this->project->id.'.jpg');

				redirect('company/project');
				
			}catch(Exception $e){
			}
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
			$wit=$this->wit->fetch($this->input->get('wit'));
			$project=$this->project->fetch($wit['project']);
		}
		
		if($this->input->get('project')!==false){
			$version_list_args['in_project']=$this->input->get('project');
			$project=$this->project->fetch($this->input->get('project'));
		}
		
		if($this->input->get('product')!==false){
			$version_list_args['in_product']=$this->input->get('product');
			$product=$this->product->fetch($this->input->get('product'));
		}
		
		$versions=$this->version->getList($version_list_args);
		
		array_walk($versions, function(&$version){
			$wit=$this->wit->fetch($version['wit']);
			
			$project=$this->project->fetch($wit['project']);
			
			$version['wit_name']=$wit['name'];
			$version['project_name']=$project['name'];
		});
		
		$this->load->view('company/version', compact('versions','wit','project','product'));
	}
}
?>
