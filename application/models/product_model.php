<?php
class Product_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='product';
		$this->fields=array(
			'name'=>'',//产品名称
			'description'=>'',//描述
			'company'=>$this->user->id//公司
		);
	}
	
	function getList(array $args=array()){
		
		if(array_key_exists('company',$args)){
			$this->db->where('product.company',$args['company']);
		}
		
		return parent::getList($args);
	}
}
?>
