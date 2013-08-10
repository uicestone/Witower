<?php
class Finance_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='finance';
		$this->fields=array(
			'amount'=>0,
			'item'=>'',
			'summary'=>'',
			'datetime'=>date('Y-m-d H:i:s'),
			'project'=>NULL,
			'user'=>$this->user->id,
			'time'=>time()
		);
	}
	
	/**
	 * @param array $args
	 *	item
	 *	project
	 *	user
	 *	date
	 *		from
	 *		to
	 *	timestamp
	 *		from
	 *		to
	 * @return array $result
	 */
	function getList(array $args=array()){
		
		foreach(array('item','project','user') as $arg_name){
			if(array_key_exists($arg_name, $args)){
				$this->db->where($this->table.'.'.$arg_name,$args[$arg_name]);
			}
		}
		
		if(array_key_exists('date', $args)){
			if(array_key_exists('from', $args['date'])){
				$this->db->where("TO_DAYS(`datetime`) >= TO_DAYS({$this->db->escape($args['date']['from'])})");
			}
			if(array_key_exists('to', $args['date'])){
				$this->db->where("TO_DAYS(`datetime`) <= TO_DAYS({$this->db->escape($args['date']['to'])})");
			}
		}
		
		if(array_key_exists('timestamp', $args)){
			if(array_key_exists('from', $args['timestamp'])){
				$this->db->where("UNIX_TIMESTAMP(`datetime`) >= ".intval($args['timestamp']['from']));
			}
			if(array_key_exists('to', $args['timestamp'])){
				$this->db->where("UNIX_TIMESTAMP(`datetime`) < ".intval($args['timestamp']['to']));
			}
		}
		
		return parent::getList($args);
	}
	
	function sum(array $args=array()){
		return parent::sum('amount', $args);
	}
	
}
?>
