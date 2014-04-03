<?php
class Test extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		
	}
	
	function hashifyuserpassword(){
		foreach($this->db->from('user')->get()->result() as $user){
			$this->db->update('user',array('password'=>sha1($user->password.$this->config->item('encryption_key'))),array('id'=>$user->id));
		}
	}
}
?>
