<?php
class Company_model extends User_model{
	
	function __construct() {
		parent::__construct();
		$this->table='company';
		
		$this->fields=array(
			'description'=>'',//描述,
		);
	}
}
?>
