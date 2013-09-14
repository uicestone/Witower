<?php
class User extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	function match($term){
		$term=urldecode($term);
		$project=$this->user->getList(array('name'=>$term));
		$this->output->set_output(json_encode($project));
	}
	
	/**
	 * 注册页面
	 */
	function signup(){
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules(array(
			array('field'=>'email','label'=>'E-mail','rules'=>'required|valid_email|is_unique[user.email]'),
			array('field'=>'username','label'=>'用户名','rules'=>'required|is_unique[user.name]'),
			array('field'=>'password','label'=>'密码','rules'=>'required'),
			array('field'=>'repassword','label'=>'重复密码','rules'=>'required|matches[password]'),
		))
			->set_message('matches','两次%s输入不一致')
			->set_message('test','同意用户协议')
			->set_rules('agree','同意用户协议','callback__agree');
		
		if($this->input->post('signup')!==false){
			
			if($this->form_validation->run()!==false){
				$user_id=$this->user->add(array(
					'name'=>$this->input->post('username'),
					'password'=>$this->input->post('password'),
					'email'=>$this->input->post('email')
				));
				
				$this->user->sessionLogin($user_id);

				redirect(urldecode($this->input->post('forward')));
			}
		}
		
		$this->load->view('user/signup');
	}
	
	function _agree($value){
		if(is_null($value)){
			$this->form_validation->set_message('_agree', '请同意“用户协议”');
			return false;
		}
		return true;
	}
		
	/**
	 * 登陆页面
	 */
	function login(){
		
		if($this->user->isLogged()){
			redirect();
		}
		
		$alert=array();
		
		if($this->input->post('login')!==false){
			$user=$this->user->verify($this->input->post('username'), $this->input->post('password'));
			if($user){
				$this->user->sessionLogin($user['id']);
				redirect(urldecode($this->input->post('forward')));
			}else{
				$alert[]=array('title'=>'错误：','message'=>'用户名或密码错误');
			}
		}
		
		$this->load->view('user/login',compact('alert'));
	}
	
	function logout(){
		$this->user->sessionLogout();
		redirect('');
	}
	
	/**
	 * 用户资料编辑页面
	 */
	function profile(){
		
		if($this->input->post('submit')!==false){
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules(array());
			
			try{
				
				if($this->input->post('password_new')!==false){
					
					$this->form_validation->set_rules(array(
						array('field'=>'password','label'=>'密码','rules'=>'required'),
						array('field'=>'password_new','label'=>'新密码','rules'=>'required'),
						array('field'=>'password_new_confirm','label'=>'重复密码','rules'=>'required|matches[password_new]')
					))
						->set_message('matches','两次%s输入不一致');

					if(!$this->user->verify($this->user->name, $this->input->post('password'))){
						$this->form_validation->_field_data['password']['error']='原密码错误';
					}
					
					if(!$this->form_validation->run()){
						throw new Exception();
					}
					
					$this->user->update(array('password'=>$this->input->post('password_new')),$this->user->id);
					$alert[]=array('title'=>'提示','message'=>'密码已修改','type'=>'info');

				}
				
				is_array($this->input->post('user')) && $this->user->update($this->input->post('user'));
				
				is_array($this->input->post('profiles')) && $this->user->updateProfiles($this->input->post('profiles'));
				
				$this->load->library('upload',array(
					'upload_path'=>'./uploads/',
					'allowed_types'=>'jpg'
				));
				
				if(isset($_FILES['avatar']) && !$_FILES['avatar']['error']){
					if(!$this->upload->do_upload('avatar')){
						throw new Exception($this->upload->display_errors());
					}

					$upload_data=$this->upload->data();

					$this->load->library('image_lib');

					$this->image_lib->initialize(array(
						'source_image'=>$upload_data['full_path'],
						'maintain_ratio'=>true,
						'width'=>200,
						'height'=>200,
						'new_image'=>'./uploads/images/avatar/'.$this->user->id.'_200.jpg'
					));

					$this->image_lib->resize();

					$this->image_lib->clear();

					$this->image_lib->initialize(array(
						'source_image'=>$upload_data['full_path'],
						'maintain_ratio'=>true,
						'width'=>100,
						'height'=>100,
						'new_image'=>'./uploads/images/avatar/'.$this->user->id.'_100.jpg'
					));

					$this->image_lib->resize();

					$this->image_lib->clear();

					$this->image_lib->initialize(array(
						'source_image'=>$upload_data['full_path'],
						'maintain_ratio'=>true,
						'width'=>30,
						'height'=>30,
						'new_image'=>'./uploads/images/avatar/'.$this->user->id.'_30.jpg'
					));

					$this->image_lib->resize();

					$this->image_lib->clear();

					rename($upload_data['full_path'],'./uploads/images/avatar/'.$this->user->id.'.jpg');
				}
				
			}catch(Exception $e){
				$e->getMessage() && $alert[]=array('message'=>$e->getMessage());
			}
		}
		
		$user=$this->user->fetch();
		
		$profiles=$this->user->getProfiles();
		
		$this->load->view('user/profile', compact('user','profiles','alert'));
	}
	
	/**
	 * 用户首页
	 */
	function home(){
		
		if(is_null($this->user->id)){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$user=$this->user->fetch();
		
		$status_type=$this->input->get('status_type')!==false?$this->input->get('status_type'):NULL;
		
		$status=$this->user->getStatusList();
		
		foreach($status as &$status_item){
			$status_item['comments']=$this->user->getStatusCommentList($status_item['id']);
		}
		
		$this->load->view('user/space', compact('user','status'));
	}
	
	/**
	 * 用户首页
	 */
	function space($uid){
		
		$user=$this->user->fetch($uid);
		
		$status_type=$this->input->get('status_type')!==false?$this->input->get('status_type'):NULL;
		
		$status=$this->user->getStatusList($uid);
		
		foreach($status as &$status_item){
			$status_item['comments']=$this->user->getStatusCommentList($status_item['id']);
		}
		
		$this->load->view('user/space', compact('user','status'));
	}
	
	function addStatus(){
		$this->user->addStatus($this->input->post('content'));
		redirect('home');
	}
	
	function addFollow($idol){
		$this->output->set_output($this->user->addFollow($idol));
	}
	
	/**
	 * 积分和资金列表
	 */
	function finance(){
		$this->load->model('finance_model','finance');
		
		$alert=array();
		
		try{
			if($this->input->post('recharge')){
				if($this->input->post('recharge')<=0){
					throw new Exception('充值金额错误');
				}

				$this->finance->add(array(
					'amount'=>$this->input->post('recharge'),
					'item'=>'申请充值'
				));
			}

			if($this->input->post('withdraw')){
				if($this->input->post('withdraw')<=0){
					throw new Exception('提现金额错误');
				}

				if($this->input->post('withdraw') > $this->finance->sum(array('user'=>$this->user->id,'item'=>'积分'))){
					throw new Exception('积分余额不足');
				}

				$this->finance->add(array(
					'amount'=>$this->input->post('withdraw'),
					'item'=>'申请提现'
				));
			}
		}catch(Exception $e){
			$alert[]=array('message'=>$e->getMessage());
		}
		
		$finance_records=$this->finance->getList(array('user'=>$this->user->id,'get_project_name'=>true,'order_by'=>'datetime desc'));
		
		$this->load->view('user/finance',compact('finance_records','alert'));
	}
	
	/**
	 * 达人列表
	 */
	function master(){
		
	}
	
	/**
	 * 合作伙伴列表
	 */
	function partner(){
		
	}
	
	function addToBlacklist($user_id){
		$this->user->addGroup('blacklist', $user_id);
		redirect('space/'.$user_id);
	}
	
	function removeFromBlacklist($user_id){
		$this->user->removeGroup('blacklist', $user_id);
		redirect('space/'.$user_id);
	}
	
}
?>
