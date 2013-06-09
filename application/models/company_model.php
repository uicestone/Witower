<?php
class Company_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='company';
	}
	
	function fetch($id=NULL){
		$this->db->join('user','company.id = user.id','inner');
		return parent::fetch($id);
	}
}
?>
