<?php
class Product_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='product';
		$this->fields=array(
			'name'=>'产品名称',
			'company'=>'公司'
		);
	}
	
	function getTags($product_id){
		$this->db->select('tag.*')
			->from('tag')
			->join('product_tag','product_tag.tag = tag.id','inner')
			->where('product_tag.product',$product_id);
		
		$result=$this->db->get()->result_array();
		
		return array_sub($result,'name');
	}
}
?>
