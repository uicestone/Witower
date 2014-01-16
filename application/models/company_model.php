<?php
class Company_model extends User_model{
	
	function __construct() {
		parent::__construct();
		$this->table='company';
		
		$this->fields=array(
			'id'=>NULL,
			'certificated'=>false,
			'description'=>'',//描述,
		);
	}
	
	function fetch($id = NULL, $field = NULL) {
		$this->db->join('user','user.id = company.id','inner');
		return parent::fetch($id, $field);
	}
	
	function getList($args = array()) {
		$this->db->join('user','company.id = user.id','inner')
			->select('company.description, company.certificated');
		return parent::getList($args);
	}
	
}
?>
