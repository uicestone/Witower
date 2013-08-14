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
	
	function add(array $data) {
		if(empty($data['project'])){
			$data['project']=NULL;
		}
		return parent::add($data);
	}
	
	function update(array $data, $id = NULL) {
		if(empty($data['project'])){
			$data['project']=NULL;
		}
		return parent::update($data, $id);
	}
	
	function fetch($id = NULL, $field = NULL) {
		$this->db->select($this->table.'.*, DATE(datetime) date, TIME(datetime) time, UNIX_TIMESTAMP(datetime) timestamp', FALSE);
		return parent::fetch($id, $field);
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
		
		if(!array_key_exists('select', $args) || $args['select']){
			$this->db->select($this->table.'.*, DATE(datetime) date, TIME(datetime) time, UNIX_TIMESTAMP(datetime) timestamp');
		}
		
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
		
		if(array_key_exists('get_project_name', $args) && $args['get_project_name']){
			$this->db->join('project','finance.project = project.id','left')
				->select('project.name project_name');
		}
		
		if(array_key_exists('get_username', $args) && $args['get_username']){
			$this->db->join('user','finance.user = user.id','inner')
				->select('user.name username');
		}
		
		return parent::getList($args);
	}
	
	function sum(array $args=array()){
		return parent::sum('amount', $args);
	}
	
	function matchItems($term){
		$this->db->select('item, COUNT(*) sum', FALSE)
			->from('finance')
			->group_by('item')
			->order_by('sum desc');
		$result=$this->db->get()->result_array();
		return array_sub($result,'item');
	}
	
}
?>
