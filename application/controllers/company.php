<?php
/**
 * 企业管理
 * 页面与智塔管理共用
 */
class Company extends WT_Controller{
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('product_model','product');
		$this->load->model('project_model','project');
		$this->load->model('wit_model','wit');
		$this->load->model('version_model','version');
		
		if(
			($this->uri->segment(1)==='admin' && !$this->user->isLogged('witower'))
			|| ($this->uri->segment(1)==='company' && !$this->user->isCompany())
		){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
	}
	
	/**
	 * @todo 企业管理首页仪表盘
	 */
	function index(){
		$this->load->view('company/index');
	}
	
	/**
	 * 产品列表
	 */
	function product(){
		
		$products=$this->product->getList($this->user->isLogged('witower')?array():array('company'=>$this->user->id));
		
		array_walk($products, function(&$product){
			$product['projects_witting']=$this->project->count(array('in_product'=>$product['id'],'status'=>'witting'));
			$product['projects_voting']=$this->project->count(array('in_product'=>$product['id'],'status'=>'voting'));
		});
		
		$this->load->view('company/product', compact('products'));
	}
	
	/**
	 * 产品编辑/添加
	 * @param int $id
	 */
	function editProduct($id=NULL){
		
		$this->product->id=$id;
		
		if($this->input->post('submit')!==false){
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules(array(
				array('field'=>'name','label'=>'产品名称','rules'=>'required')
			));
			
			$alert=array();
			
			try{
			
				if($this->form_validation->run()===false){
					throw new Exception;
				}
				
				$data=array(
					'name'=>$this->input->post('name'),
					'description'=>$this->input->post('description'),
					'company'=>$this->user->id
				);

				$this->load->library('upload',array(
					'upload_path'=>'./uploads/',
					'allowed_types'=>'jpg'
				));
				
				if(!$_FILES['image']['error'] && !$this->upload->do_upload('image')){
					throw new Exception($this->upload->display_errors());
				}

				$upload_data=$this->upload->data();
				
				//写入操作要放在全部表单验证以后
				if(is_null($this->product->id)){
					$this->product->id=$this->product->add($data);
				}
				else{
					$this->product->update($data);
				}

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
				
				redirect($this->uri->segment(1).'/product');
				
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
			if($this->uri->segment(1)==='company' && $product['company']!=$this->user->id){
				show_error('no permission to product'.$this->product->id);
			}
		}
		
		$this->load->view('company/product_edit', compact('product','alert'));
	}
	
	/**
	 * 项目列表
	 */
	function project($status=NULL){
		
		$args=array();
		
		if(!$this->user->isLogged('witower')){
			$args['company']=$this->user->id;
		}
		
		if(isset($status)){
			$args['status']=$status;
		}
		
		$projects=$this->project->getList($args);
		
		array_walk($projects, function(&$project){
			$project['product_name']=$this->product->fetch($project['product'],'name');
		});
		
		$this->load->view('company/project', compact('projects'));
	}
	
	/**
	 * 项目编辑/添加
	 * @param int $id
	 */
	function editProject($id=NULL){
		
		$this->project->id=$id;
		
		$this->load->model('finance_model','finance');
		
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
				
				$project=array(
					'name'=>$this->input->post('name'),
					'summary'=>$this->input->post('summary'),
					'product'=>$this->input->post('product'),
					'company'=>$this->user->id,
					'wit_start'=>$this->input->post('start'),
					'wit_end'=>$this->input->post('end'),
					'bonus'=>$this->input->post('bonus')
				);

				$this->load->library('upload',array(
					'upload_path'=>'./uploads/',
					'allowed_types'=>'jpg'
				));
				
				if(!$_FILES['image']['error'] && !$this->upload->do_upload('image')){
					throw new Exception($this->upload->display_errors());
				}

				$upload_data=$this->upload->data();
				
				//写入操作要放在全部表单验证以后
				if(is_null($this->project->id)){

					if($this->finance->sum(array('item'=>'可用悬赏积分','user'=>$project['company'])) < $this->input->post('bonus')){
						throw new Exception('可用悬赏积分不足');
					}
					
					$this->project->id=$this->project->add($project);
					
					$this->finance->add(array(
						'item'=>'可用悬赏积分',
						'user'=>$project['company'],
						'amount'=>-$this->input->post('bonus')
					));
					
					$this->finance->add(array(
						'item'=>'悬赏积分',
						'project'=>$this->project->id,
						'user'=>$project['company'],
						'amount'=>$this->input->post('bonus')
					));
					
				}
				else{
					unset($project['bonus']);
					$this->project->update($project);
				}
				
				$tags=preg_split('/[\s|，|,]+/',$this->input->post('tags'));				
				$this->project->updateTags($tags);
				
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

				redirect($this->uri->segment(1).'/project');
				
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

			if($this->uri->segment(1)==='company' && $project['company']!=$this->user->id){
				show_error('no permission to project'.$this->project->id);
			}
			
			$tags=$this->project->getTags();
		}
		
		$products=$this->product->getArray(array('company'=>$project['company']),'name','id');
		
		$this->load->view('company/project_edit', compact('project','products','tags','alert'));
	}
	
	/**
	 * 创意列表
	 */
	function wit(){

		if($this->input->post('select')!==false){
			$this->wit->select($this->input->post('select'));
		}
		
		$args=array();

		if(!$this->user->isLogged('witower')){
			$args['company']=$this->user->id;
		}
		
		if($this->input->get('product')!==false){
			$args['in_product']=$this->input->get('product');
		}
		
		if($this->input->get('project')!==false){
			$args['in_project']=$this->input->get('project');
			$project=$this->project->fetch($this->input->get('project'));
		}
		
		$wits=$this->wit->getList($args);
		
		array_walk($wits, function(&$wit){
			$wit['username']=$this->user->fetch($wit['user'],'name');
			$latest_version=$this->version->fetch($wit['latest_version']);
			$wit['latest_version_username']=$this->user->fetch($latest_version['user'],'name');
			$wit['latest_version_time']=$latest_version['time'];
			$wit['versions']=$this->wit->countVersions($wit['id']);
		});
		
		$this->load->view('company/wit', compact('wits','project'));
	}
	
	/**
	 * 版本列表
	 */
	function version(){
		
		$version_list_args=array('company'=>$this->user->id,'orderby'=>'id desc');
		
		if($this->uri->segment(1)==='admin'){
			unset($version_list_args['company']);
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
		
		$this->load->view('company/version', compact('versions','wit','project','product'));
	}
	
	/**
	 * 版本比较
	 */
	function versionCompare(){
		if($this->uri->segment(1)==='admin'){
			$score_field='score_witower';
		}else{
			$score_field='score_company';
		}
		
		if($this->input->post('score')!==false){
			$this->version->score($this->input->post('score'));
		}
		
		if($this->input->get('versions')!==false){
			$versions=$this->version->getlist(array('id_in'=>$this->input->get('versions')));
			$wit=$this->wit->fetch($versions[0]['wit']);
			$project=$this->project->fetch($wit['project']);
		}
		
		$this->load->view('company/version_compare',compact('versions','wit','project','score_field'));
	}
}
?>
