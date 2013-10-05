<?php
class Witower_model extends WT_Model{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 获得存于数据库中的config项
	 * @return type
	 */
	function getConfig(){
		$this->db->from('config');
		return array_sub($this->db->get()->result_array(),'value','item',true);
	}
	
}
?>
