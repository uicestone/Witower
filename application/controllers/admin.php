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
		
		$this->load->model('finance_model','finance');
		
		$finance_records=$this->finance->getList(array('order_by'=>'id desc'));
		
		array_walk($finance_records,function(&$finance_record){
			$finance_record['username']=$this->user->fetch($finance_record['user'],'name');
			$finance_record['project_name']=isset($finance_record['project'])?$this->project->fetch($finance_record['project'])['name']:NULL;
		});
		
		$this->load->view('admin/finance',compact('finance_records'));
		
	}
	
	function editFinance($id=NULL){
		if(!$this->user->isLogged('finance')){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->load->model('finance_model','finance');
		
		$this->finance->id=$id;
		
		if($this->input->post('submit')!==false){
			
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
				if(is_null($this->finance->id)){
					$this->finance->id=$this->finance->add($data);
				}
				else{
					$this->finance->update($data);
				}

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
			$finance['username']=$finance['project_name']=$finance['date']=$finance['time']=NULL;
			$finance['date']=date('Y-m-d');
			$finance['time']=date('H:i:s');
		}
		else{
			$finance=$this->finance->fetch();
			
			if($this->uri->segment(1)==='company' && $finance['company']!=$this->user->id){
				show_error('no permission to finance'.$this->finance->id);
			}
			
			$finance['username']=$this->user->fetch($finance['user'])['name'];
			$finance['project_name']=$this->project->fetch($finance['project'])['name'];
			
		}
		
		$this->load->view('admin/finance_edit',compact('finance','alert'));
		
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
