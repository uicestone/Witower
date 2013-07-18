<?php
class Company extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('product_model','product');
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');

		if(!$this->user->isCompany() && !$this->user->isLogged('witeditor')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
	}
	
	function product(){
		
		$products=$this->product->getList($this->user->isLogged('witeditor')?array():array('company'=>$this->user->id));
		
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
			
			$alert=array();
			
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
				if($e->getMessage()){
					$alert[]=array('type'=>'error','message'=>$e->getMessage());
				}
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
		
		$projects=$this->project->getList($this->user->isLogged('witeditor')?array():array('company'=>$this->user->id));
		
		foreach($projects as &$project){
			$project['product_name']=$this->product->fetch($project['product'],'name');
		}
		
		$this->load->view('company/project', compact('projects'));
	}
	
	function editProject($id=NULL){
		
		$this->project->id=$id;
		
		if($this->input->post('submit')!==false){
			
			$alert=array();
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules(array(
				array('field'=>'name','label'=>'项目名称','rules'=>'required'),
				array('field'=>'product','label'=>'所属产品','rules'=>'required'),
				array('field'=>'bonus','label'=>'悬赏金额','rules'=>'required|numeric|greater_than[0]'),
			));
			
			try{
				
				if($this->form_validation->run()===false){
					throw new Exception();
				}
				
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
					$this->company->freezeBonus($this->input->post('bonus'));//TODO 奖金余额不足错误提示要放到行内
					$this->project->id=$this->project->add($data);
				}
				else{
					unset($data['bonus']);
					$this->project->update($data);
				}
				
				$tags=preg_split('/[\s|，|,]+/',$this->input->post('tags'));				
				$this->project->updateTags($tags);
				
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
				if($e->getMessage()){
					$alert[]=array('type'=>'error','message'=>$e->getMessage());
				}
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
		$tags=$this->project->getTags();
		
		$this->load->view('company/project_edit', compact('project','products','tags','alert'));
	}
	
	function version(){
		
		if($this->input->post('submit')!==false){
			$this->version->score($this->input->post('score'));
		}
		
		if($this->input->post('select')!==false){
			$this->wit->select($this->input->post('select'));
		}
		
		$version_list_args=array('company'=>$this->user->id,'orderby'=>'id desc');
		
		if($this->user->isLogged('witeditor')){
			unset($version_list_args['company']);
			$score_field='score_witower';
		}else{
			$score_field='score_company';
		}
		
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
		
		$this->load->view('company/version', compact('versions','wit','project','product','score_field'));
	}
}
?>
