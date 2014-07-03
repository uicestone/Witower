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
		$this->load->library('pagination');

		if(!$this->user->isLogged('witower')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->load->page_name='admin';
		$this->load->page_path[]=array('text'=>lang('admin'),'href'=>'/admin');
	}
	
	function index(){
		$this->load->view('admin/index');
	}
	
	function config(){
		if(!$this->user->isLogged('config')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->load->page_path[]=array('text'=>lang('admin_config'),'href'=>'/admin/config');
		
		$this->load->view('admin/config',array('config_items'=>$this->config->witower));
	}
	
	function editConfig($item){
		if(!$this->user->isLogged('config')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		if($this->input->post('submit')!==false){
			$this->config->set_user_item($item, $this->input->post('value'), 'db');
			redirect($this->uri->segment(1).'/config');
		}
		
		$this->load->page_path[]=array('text'=>lang('admin_config'),'href'=>'/admin/config');
		$this->load->page_path[]=array('text'=>$item,'href'=>'/admin/config/'.$item);
		
		$value=$this->config->user_item($item);
		$this->load->view('admin/config_edit',compact('item','value'));
	}
	
	function finance($action=NULL){
		if(!$this->user->isLogged('finance')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->load->model('finance_model','finance');
		
		if($action==='cashout'){
			
			$this->finance->add(array(
				'amount'=>-$this->input->get('amount'),
				'item'=>'已申请提现积分',
				'user'=>$this->input->get('user')
			));
			
			$this->finance->add(array(
				'amount'=>$this->input->get('amount'),
				'item'=>'已提现',
				'user'=>$this->input->get('user')
			));
			
			redirect('admin/finance/grouped');
			
		}
		
		$args=array('order_by'=>'id desc','get_username'=>true,'get_project_name'=>true);
		
		if($action==='grouped'){
			$args['group_by']='user, item';
			$args['having']='amount > 0';
		}
		
		if($this->input->get('user')!==false){
			$args['user']=$this->input->get('user');
		}
		
		if($this->input->get('item')!==false){
			$args['item']=$this->input->get('item');
		}
		
		if($this->input->get('project')!==false){
			$args['project']=$this->input->get('project');
		}
		
		$query='';
		if($this->input->get()!==false){
			$query='?'.http_build_query($this->input->get());
		}
		
		$this->pagination->initialize(array(
			'total_rows'=>$this->finance->count($args),
			'per_page'=>$this->config->user_item('list_per_page')
		));
		
		$pagination=$this->pagination->create_links();
		
		$items=$this->finance->sum(array('group_by'=>'item')+$args);
		
		$args['limit']=array($this->pagination->per_page,$this->pagination->cur_page?(($this->pagination->cur_page-1)*$this->pagination->per_page):0);
		$finance_records=$this->finance->getList($args);
		
		$this->load->page_path[]=array('text'=>lang('admin_finance'),'href'=>'/admin/finance');
		
		$this->load->view('admin/finance',compact('finance_records','items','query','pagination'));
		
	}
	
	/**
	 * 财务纪录查看/添加页，没有修改功能
	 * @param type $id
	 * @throws Exception
	 */
	function editFinance($id=NULL){
		if(!$this->user->isLogged('finance')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->load->model('finance_model','finance');
		
		$this->finance->id=$id;
		
		//只有新纪录可以被写入
		if(is_null($this->finance->id) && $this->input->post('submit')!==false){
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules(array(
				array('field'=>'date','label'=>'日期','rules'=>'required'),
				array('field'=>'time','label'=>'时间','rules'=>'required'),
				array('field'=>'user','label'=>'用户','rules'=>'required'),
				array('field'=>'amount','label'=>'金额','rules'=>'required'),
				array('field'=>'item','label'=>'科目','rules'=>'required'),
				
			));
			
			$alert=array();
			
			try{
			
				if($this->form_validation->run()===false){
					throw new Exception;
				}
				
				$data=array(
					'datetime'=>$this->input->post('date').' '.$this->input->post('time'),
					'user'=>$this->input->post('user'),
					'project'=>$this->input->post('project'),
					'amount'=>$this->input->post('amount'),
					'item'=>$this->input->post('item'),
					'summary'=>$this->input->post('summary')
				);

				//写入操作要放在全部表单验证以后
				$this->finance->id=$this->finance->add($data);

				redirect($this->uri->segment(1).'/finance');
				
			}
			catch(Exception $e){
				if($e->getMessage()){
					$alert[]=array('type'=>'error','message'=>$e->getMessage());
				}
			}
		}
		
		if(is_null($this->finance->id)){
			$finance=$this->finance->fields;
			$finance['user']=$this->input->get('user');
			$finance['project']=$this->input->get('project');
			$finance['date']=date('Y-m-d');
			$finance['time']=date('H:i:s');
		}
		else{
			$finance=$this->finance->fetch();
		}
		
		$finance['username']=$finance['user']?$this->user->fetch($finance['user'])['name']:NULL;
		$finance['project_name']=$finance['project']?$this->project->fetch($finance['project'])['name']:NULL;
		
		$this->load->page_path[]=array('text'=>lang('admin_finance'),'href'=>'/admin/finance');
		$this->load->page_path[]=array('text'=>is_null($this->finance->id)?lang('admin_finance_add'):lang('admin_finance_view'),'href'=>is_null($this->finance->id)?'/admin/addfinance':'/admin/finance/'.$this->finance->id);
		
		$this->load->view('admin/finance_edit',compact('finance','alert'));
		
	}
	
	function company(){
		if(!$this->user->isLogged('company')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$args=array(
			'order_by'=>'id desc'
		);
		
		$this->pagination->initialize(array(
			'total_rows'=>$this->company->count($args),
			'per_page'=>$this->config->user_item('list_per_page')
		));
		
		$pagination=$this->pagination->create_links();
		
		$args['limit']=array($this->pagination->per_page,$this->pagination->cur_page?(($this->pagination->cur_page-1)*$this->pagination->per_page):0);

		$companies=$this->company->getList($args);
		
		$this->load->page_path[]=array('text'=>lang('admin_company'),'href'=>'/admin/company');
		
		$this->load->view('admin/company',compact('companies','pagination'));
		
	}
	
	function editCompany($id=NULL){
		if(!$this->user->isLogged('company')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->company->id=$id;
		
		if($this->input->post('submit')!==false){
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules(array(
				array('field'=>'id','label'=>'用户','rules'=>'required'),
			));
			
			$alert=array();
			
			try{
			
				if($this->form_validation->run()===false){
					throw new Exception;
				}
				
				$data=array(
					'id'=>$this->input->post('id'),
					'certificated'=>(bool)$this->input->post('certificated'),
					'description'=>$this->input->post('description'),
				);

				//写入操作要放在全部表单验证以后
				if(is_null($this->company->id)){
					$this->company->id=$this->company->add($data);
				}
				else{
					$this->company->update($data);
				}

				redirect($this->uri->segment(1).'/company');
				
			}
			catch(Exception $e){
				if($e->getMessage()){
					$alert[]=array('type'=>'error','message'=>$e->getMessage());
				}
			}
		}
		
		if(is_null($this->company->id)){
			$company=$this->company->fields;
		}
		else{
			$company=$this->company->fetch();
			$profiles=$this->user->getProfiles($this->company->id);
		}
		
		$this->load->page_path[]=array('text'=>lang('admin_company'),'href'=>'/admin/company');
		$this->load->page_path[]=array('text'=>is_null($this->company->id)?lang('admin_company_add'):lang('admin_company_edit'),'href'=>is_null($this->company->id)?'/admin/addfinance':'/admin/finance/'.$this->company->id);
		
		$this->load->view('admin/company_edit',compact('company','profiles','alert'));
		
	}
	
	function user(){
		if(!$this->user->isLogged('user')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		if($this->input->get('encrypt_password')){
			$this->user->encrypt_password();
		}
		
		$args=array(
			'order_by'=>'id desc'
		);
		
		$this->pagination->initialize(array(
			'total_rows'=>$this->user->count($args),
			'per_page'=>$this->config->user_item('list_per_page')
		));
		
		$pagination=$this->pagination->create_links();
		
		$args['limit']=array($this->pagination->per_page,$this->pagination->cur_page?(($this->pagination->cur_page-1)*$this->pagination->per_page):0);
		$users=$this->user->getList($args);
		
		$this->load->page_path[]=array('text'=>lang('admin_user'),'href'=>'/admin/user');
		
		$this->load->view('admin/user',compact('users','pagination'));
		
	}
	
	function editUser($user_id=NULL){
		if(!$this->user->isLogged('user')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		if($this->input->post('submit')!==false){
			
			$this->load->library('form_validation');
			
			$this->form_validation->set_rules(array(
				array('field'=>'name','label'=>'用户名','rules'=>'required'),
				array('field'=>'email','label'=>'电子邮件','rules'=>'required')
			));
			
			$alert=array();
			
			try{
			
				if($this->form_validation->run()===false){
					throw new Exception;
				}
				
				$data=array(
					'name'=>$this->input->post('name'),
					'password'=>$this->input->post('password'),
					'email'=>$this->input->post('email'),
					'group'=>$this->input->post('group')
				);

				//写入操作要放在全部表单验证以后
				if(is_null($user_id)){
					$user_id=$this->user->add($data);
				}
				else{
					$this->user->update($data, $user_id);
				}

				redirect($this->uri->segment(1).'/user');
				
			}
			catch(Exception $e){
				if($e->getMessage()){
					$alert[]=array('type'=>'error','message'=>$e->getMessage());
				}
			}
		}
		
		if(is_null($user_id)){
			$user=$this->user->fields;
		}
		else{
			$user=$this->user->fetch($user_id);
			$profiles=$this->user->getProfiles($user_id);
		}
		
		$this->load->page_path[]=array('text'=>lang('admin_user'),'href'=>'/admin/user');
		$this->load->page_path[]=array('text'=>is_null($user_id)?lang('admin_user_add'):lang('admin_user_edit'),'href'=>is_null($user_id)?'/admin/adduser':'/admin/user/'.$user_id);
		
		$this->load->view('admin/user_edit',compact('user','profiles','alert'));
		
	}
}
?>
