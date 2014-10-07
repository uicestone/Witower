<?php

class Piece_Model extends WT_Model {
	
	var $fields = array(
		'name'=>'',
		'files'=>'',
		'description'=>'',
		'project'=>null,
		'wit'=>null,
	);
	
	function __construct() {
		parent::__construct();
	}
	
	function create(array $data){
		
		if(empty($data['project'])){
			$data['project'] = null;
		}
		
		$data = array_intersect_key($data, $this->fields);
		
		if(array_key_exists('files', $data) && is_array($data['files'])){
			array_walk($data['files'], function(&$item){
				$item = json_decode($item);
			});
			$data['files'] = json_encode($data['files'], JSON_UNESCAPED_UNICODE);
		}
		
		$data['user'] = $this->user->id;
		$data['time'] = time();
		
		$this->db->insert('piece', $data);
		
		return $this->db->insert_id();
	}
	
	function update($id, array $data){
		
		if(empty($data['project'])){
			$data['project'] = null;
		}
		
		unset($data['user']);
		
		$data = array_intersect_key($data, $this->fields);
		
		if(array_key_exists('files', $data) && is_array($data['files'])){
			array_walk($data['files'], function(&$item){
				$item = json_decode($item);
			});
			$data['files'] = json_encode($data['files'], JSON_UNESCAPED_UNICODE);
		}
		
		$data['time'] = time();
		
		$this->db->where('id', $id)->update('piece', $data);
	}
	
	function get($id){
		$data = $this->db->from('piece')->where('id', $id)->get()->row_array();
		$data['files'] = json_decode($data['files']);
		return $data;
	}
	
	function query(){
		$pieces = $this->db->from('piece')->get()->result_array();
		return $pieces;
	}
	
	function remove($id){
		return $this->db->where('id', $id)->delete('piece');
	}
	
}
