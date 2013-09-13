<?php
class Tag_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='tag';
		$this->fields=array(
			'name'=>'',
			'hits'=>0
		);
	}
}
?>
