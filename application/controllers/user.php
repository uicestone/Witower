<?php
class User extends WT_Controller{
	function __construct() {
		parent::__construct();
		$this->load->page_name='user';
		$this->load->page_path[]=array('text'=>lang('user'),'href'=>'/home');
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
		$this->load->helper('captcha');
		
		$captcha=create_captcha(array(
			'word'=>random_string('alnum',4),
			'img_path' => './uploads/images/captcha/',
			'img_url' => '/uploads/images/captcha/',
			'img_width' => 80
		));
		
		$data = array(
			'captcha_time' => $captcha['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $captcha['word']
		);

		$this->db->insert('captcha', $data);

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
			try{
				// 首先删除旧的验证码
				$expiration = time()-7200; // 2小时限制
				$this->db->where('captcha_time < ',$expiration)->delete('captcha');

				// 然后再看是否有验证码存在:
				$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
				$binds = array($this->input->post('captcha'), $this->input->ip_address(), $expiration);
				$query = $this->db->query($sql, $binds);
				$row = $query->row();
				if ($row->count == 0)
				{
					$this->form_validation->_field_data['captcha']['error']='验证码错误';
					throw new Exception;
				}

				if($this->form_validation->run()!==false){
					$user_id=$this->user->add(array(
						'name'=>$this->input->post('username'),
						'password'=>$this->input->post('password'),
						'email'=>$this->input->post('email')
					));
					
					$this->load->model('company_model','company');
					
					if($this->input->post('is_company')){
						$this->company->add(array(
							'id'=>$user_id,
							'description'=>$this->input->post('description')
						));
						$this->user->updateProfiles($this->input->post('profiles'), $user_id);
					}

					$this->user->sessionLogin($user_id);

					redirect(urldecode($this->input->post('forward')));
				}
			}catch(Exception $e){
				
			}
		}
		
		$this->load->page_name='register';
		
		$this->load->view('user/signup',compact('captcha'));
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
		
		$this->load->page_name='register';
		
		$this->load->view('user/login',compact('alert'));
	}
	
	function logout(){
		$this->user->sessionLogout();
		redirect('');
	}
	
	function resetPassword(){
		
		$this->load->library('form_validation');
		$this->load->helper('captcha');
		
		$captcha=create_captcha(array(
			'word'=>random_string('alnum',4),
			'img_path' => './uploads/images/captcha/',
			'img_url' => '/uploads/images/captcha/',
			'img_width' => 80
		));
		
		$data = array(
			'captcha_time' => $captcha['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $captcha['word']
		);

		$this->db->insert('captcha', $data);

		$this->form_validation->set_rules(array(
			array('field'=>'password','label'=>'新密码','rules'=>'required'),
			array('field'=>'repassword','label'=>'重复密码','rules'=>'required|matches[password]'),
		))
			->set_message('matches','两次%s输入不一致');
		
		if($this->input->post('resetpassword')!==false){
			try{
				// 首先删除旧的验证码
				$expiration = time()-7200; // 2小时限制
				$this->db->where('captcha_time < ',$expiration)->delete('captcha');

				// 然后再看是否有验证码存在:
				$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
				$binds = array($this->input->post('captcha'), $this->input->ip_address(), $expiration);
				$query = $this->db->query($sql, $binds);
				$row = $query->row();
				if ($row->count == 0)
				{
					$this->form_validation->_field_data['captcha']['error']='验证码错误';
					throw new Exception;
				}
				
				$user = $this->user->getList(array('name'=>$this->input->post('username'),'email'=>$this->input->post('email')));

				if(empty($user)){
					$this->form_validation->_field_data['email']['error']='邮箱和用户名不匹配';
					throw new Exception;
				}
				
				if($this->form_validation->run()!==false){
					
					$token = random_string('alnum', 32);
					
					$this->user->id=$user[0]['id'];
					$this->user->set_config('password_reset/to', $this->input->post('password'));
					$this->user->set_config('password_reset/token', $token);
					$this->user->id=NULL;
					
					//$this->user->updatePassword($user[0]['id'], $this->input->post('password'));
					
					$this->load->library('email');
					
					$this->email->initialize(array(
						'protocol'=>'smtp',
						'smtp_host'=>$this->config->user_item('email-smtp-server'),
						'smtp_user'=>$this->config->user_item('email-smtp-username'),
						'smtp_pass'=>$this->config->user_item('email-smtp-password'),
						'mailtype'=>'html',
						'crlf'=>"\r\n",
						'newline'=>"\r\n"
					));
					
					$this->email->from($this->config->user_item('email-smtp-username'), '智塔帮助');
					$this->email->to($this->input->post('email')); 

					$this->email->subject('您申请重置您在智塔(Witower.com)的账户密码');
					$this->email->message('点击此链接以确认设置新密码<a href="'.base_url().'user/resetpasswordconfirm/'.$token.'" target="_blank">'.base_url().'user/resetpasswordconfirm/'.$token.'</a>'); 

					if($this->email->send()){
						$alert[]=array('type'=>'success','message'=>'成功发送重置确认邮件，前往邮箱点击链接即可重置密码');
					}
					else{
						$alert[]=array('type'=>'warning','message'=>'由于系统原因，邮件发送失败。请联系客服重置密码');
					}
					
				}
			}catch(Exception $e){
				$e->getMessage() && $alert[]=array('type'=>'error','message'=>$e->getMessage());
			}
			
		}
		
		$this->load->page_name='register';
		
		$this->load->view('user/resetpassword', compact('captcha','alert'));
	}
	
	function resetPasswordConfirm($token){
		$uid = $this->user->retrieve_user_by_config('password_reset/token', $token);
		
		if($uid){
			$this->user->init($uid);
			$this->user->updatePassword($uid, $this->user->config('password_reset/to'));
			$this->user->remove_config_item('password_reset/to');
			$this->user->remove_config_item('password_reset/token');
			
			redirect('login');
		}
	}
	
	/**
	 * 用户资料编辑页面
	 */
	function profile(){
		
		if(is_null($this->user->id)){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
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
						throw new Exception();
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
					'allowed_types'=>'jpg',
					'overwrite'=>true
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
		
			$this->load->page_path[]=array('text'=>lang('profile'),'href'=>'/profile');
		
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
		
		$status=$this->user->getStatusList(NULL, $status_type);
		
		foreach($status as &$status_item){
			$status_item['comments']=$this->user->getStatusCommentList($status_item['id']);
		}
		
		$idols=$this->company->getList(array('is_idol_of'=>$this->user->id));
		
		$this->load->model('project_model','project');
		$recommended_projects=$this->project->getList(array('order_by'=>'witters','limit'=>10,'status'=>'witting'));
		$recommended_votes=$this->project->getList(array('order_by'=>'witters','limit'=>10,'status'=>'voting'));
		
		$this->load->page_name='space';
		
		$this->load->page_path[]=array('text'=>lang('home'),'href'=>'/home');
		
		$this->load->view('user/space', compact('user','status','idols','recommended_projects','recommended_votes'));
	}
	
	/**
	 * 用户首页
	 */
	function space($uid){
		
		$user=$this->user->fetch($uid);
		
		$status_type=$this->input->get('status_type')!==false?$this->input->get('status_type'):NULL;
		
		$status=$this->user->getStatusList($uid, $status_type);
		
		foreach($status as &$status_item){
			$status_item['comments']=$this->user->getStatusCommentList($status_item['id']);
		}
		
		$idols=$this->company->getList(array('is_idol_of'=>$uid));
		
		$this->load->model('project_model','project');
		$recommended_projects=$this->project->getList(array('order_by'=>'witters','limit'=>10,'status'=>'witting'));
		$recommended_votes=$this->project->getList(array('order_by'=>'witters','limit'=>10,'status'=>'voting'));
		
		$this->load->page_name='space';
		$this->load->page_path[]=array('text'=>$user['name'],'href'=>'/space/'.$user['id']);
		
		$this->load->view('user/space', compact('user','status','idols','recommended_projects','recommended_votes'));
	}
	
	function addStatus(){
		if(is_null($this->user->id)){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->user->addStatus($this->input->post('content'));
		redirect('home');
	}
	
	function addStatusComment($status_id){
		if(!$this->user->isLogged()){
			$this->output->set_output('Not logged in.');
			return;
		}
		$comment_id=$this->user->addStatusComment($status_id, $this->input->post('commentContent'));
		$comment=$this->user->getStatusComment($comment_id);
		$comment['time']=date('Y-m-d H:i:s',$comment['time']);
		$comment['username']=$this->user->fetch($comment['user'], 'name');
		$this->output->set_output(json_encode($comment));
	}
	
	function addFollow($idol){
		$this->output->set_output($this->user->addFollow($idol));
	}
	
	/**
	 * 积分和资金列表
	 */
	function finance(){
		if(is_null($this->user->id)){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
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
				
				$profiles=$this->user->getProfiles();
				if(empty($profiles['收货人姓名']) || empty($profiles['银行账号'])){
					throw new Exception('个人资料>收货地址中 收货人姓名 或 银行帐号 未填写');
				}

				$this->finance->add(array(
					'amount'=>-$this->input->post('withdraw'),
					'item'=>'积分'
				));
				
				$this->finance->add(array(
					'amount'=>$this->input->post('withdraw'),
					'item'=>'已申请提现积分'
				));
				
			}
		}catch(Exception $e){
			$alert[]=array('message'=>$e->getMessage());
		}
		
		$finance_records=$this->finance->getList(array('user'=>$this->user->id,'get_project_name'=>true,'order_by'=>'datetime desc'));
		
		$this->load->page_path[]=array('text'=>lang('user_finance'),'href'=>'/finance');
		
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
		if(is_null($this->user->id)){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->user->addGroup('blacklist', $user_id);
		redirect('space/'.$user_id);
	}
	
	function removeFromBlacklist($user_id){
		if(is_null($this->user->id)){
			redirect('login?'.http_build_query(array('forward'=>substr($this->input->server('REQUEST_URI'),1))));
		}
		
		$this->user->removeGroup('blacklist', $user_id);
		redirect('space/'.$user_id);
	}
	
}
?>
