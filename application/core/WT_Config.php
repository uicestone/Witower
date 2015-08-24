<?php
/**
 * 一个分层的配置存取方式
 * 公司(数据库)<用户(数据库)<session(控制器方法)
 * 出于安全性考虑Config::item和Config::user_item列为两个方法，互不相关
 */
class WT_Config extends CI_Config{
	
	var $witower=array();
	var $user=array();
	var $session=array();
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * @param string $item
	 * @return mixed
	 */
	function user_item($item){
		//TODO 给上级配置增加禁止覆盖选项
		$plain_config = array_merge($this->witower,$this->user,$this->session);
		
		$global = array_prefix($plain_config, $item);
		
		if($global!==array()){
			$decoded=json_decode($global);
			if(!is_null($decoded)){
				$global=$decoded;
			}
		
			return $global;
		}
		
		return false;
	}
	
	/**
	 * 释放session中的一项配置
	 * @param $item 配置名或路径
	 * @param $level 配置作用范围method, global
	 */
	function unset_user_item($item){
		unset($this->session[$item]);
		
		$CI=&get_instance();
		$CI->session->unset_userdata('config/'.$item);
	}
	
	/**
	 * @param $item
	 * @param $value
	 * @param $session 是否在session中改变设置
	 * @param $override 当配置已存在时是否覆盖
	 */
	function set_user_item($item,$value,$session=true,$override=true){
		if($session===true){
			if($override || !array_key_exists($item, $this->session)){
				$this->session[$item]=$value;

				$CI=&get_instance();
				//及时更新一次session的本地映射，否则更新的session要在下次请求才能被读取

				$CI->session->set_userdata('config/'.$item,$value);
			}
		}
		elseif($session==='db'){
				$CI=&get_instance();
				if(is_array($value) || is_object($value)){
					$value = json_encode($value);
				}
				$CI->db->update('config',array('value'=>$value),array('item'=>$item));
		}
		else{
			if($override || !array_key_exists($item, $this->user)){
				$this->user[$item]=$value;
			}
		}
	}
}

?>
