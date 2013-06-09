<?php
class WT_Model extends CI_Model{
	
	var $table;
	
	var $fields;
	
	var $id;
	
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 抓取一条项目
	 * @param int $id
	 * @return array
	 */
	function fetch($id=NULL,$field=NULL,$query=NULL){
		
		is_null($id) && $id=$this->id;
		
		$id=intval($id);
		
		$row=array();
		
		if(is_null($query)){
			$row=$this->db->from($this->table)->where($this->table.'.id',$id)->get()->row_array();
		}
		else{
			$row=$this->db->query($query)->row_array();
		}
		
		if(!$row){
			show_error('item not found');
		}
		
		if(is_null($field)){
			return $row;
	
		}elseif(isset($row[$field])){
			return $row[$field];

		}else{
			return false;
		}
	}
	
	/**
	 * 增加一条项目
	 * @param array $data
	 */
	function add(array $data){
		$data=array_intersect_key($data, $this->fields);
		$this->db->insert('user',$data);
		return $this->db->insert_id();
	}
	
	/**
	 * 
	 * @param array $args
	 * name
	 * orderby string or array
	 * limit string, array OR 'pagination'
	 * @return array
	 */
	function getList($args=array()){
		
		/**
		 * 这是一个model方法，它具有配置独立性，即所有条件接口均通过参数$args来传递，不接受其他系统变量
		 */
		if(!$this->db->ar_select){
			$this->db->select($this->table.'.*');
		}
		
		$this->db->from($this->table);
		
		if(isset($args['name'])){
			$this->db->like($this->table.'.name',$args['name']);
		}
		
		//复制一个DB对象用来计算行数，因为计算行数需要运行sql，将清空DB对象中属性
		$db_num_rows=clone $this->db;
		
		if(isset($args['orderby'])){
			if(is_array($args['orderby'])){
				foreach($args['orderby'] as $orderby){
					$this->db->order_by($orderby[0],$orderby[1]);
				}
			}elseif($args['orderby']){
				$this->db->order_by($args['orderby']);
			}
		}
		
		if(isset($args['limit'])){
			if($args['limit']==='pagination'){
				$args['limit']=$this->pagination($db_num_rows);
				call_user_func_array(array($this->db,'limit'), $args['limit']);
			}
			elseif(is_array($args['limit'])){
				call_user_func_array(array($this->db,'limit'), $args['limit']);
			}
			else{
				call_user_func(array($this->db,'limit'), $args['limit']);
			}
		}
		
		return $this->db->get()->result_array();
	}
	
	
	function getArray($args=array(),$keyname='name',$keyname_forkey='id'){
		return array_sub($this->getList($args),$keyname,$keyname_forkey);
	}
	
	function pagination($db_active_record, $is_group_query=false, $field_for_distinct_count=NULL){
		
		if($is_group_query){
			$db_active_record->_ar_select=array();
			$db_active_record->select("COUNT(DISTINCT $field_for_distinct_count) AS num_rows",FALSE);
			$rows=$db_active_record->get()->row()->num_rows;
		}else{
			$rows=$db_active_record->count_all_results();
		}
		
		if($this->config->user_item('pagination/start')>$rows || $rows==0){
			//已越界或空列表时，列表起点归零
			$this->config->set_user_item('pagination/start',0);

		}elseif($this->config->user_item('pagination/start')+$this->config->user_item('pagination/items')>=$rows && $rows>$this->config->user_item('pagination/items')){
			//末页且非唯一页时，列表起点定位末页起点
			$this->config->set_user_item('pagination/start',$rows - ($rows % $this->config->user_item('pagination/items')));
		}

		if($this->config->user_item('pagination/start')!==false && $this->config->user_item('pagination/items')!==false){
			if($this->input->post('start')!==false){
				$this->config->set_user_item('pagination/start',$this->input->post('start'));
			}
			if($this->input->post('items')!==false){
				$this->config->set_user_item('paginantion/items',$this->input->post('items'));
			}
		}else{
			$this->config->set_user_item('pagination/start',0);
			$this->config->set_user_item('pagination/items',25);
		}
		
		$this->config->set_user_item('pagination/rows',$rows);
		
		$this->config->set_user_item('pagination/pages', ceil($this->config->user_item('pagination/rows') / $this->config->user_item('pagination/items')) );
		
		$this->config->set_user_item('pagination/pagenum',$this->config->user_item('pagination/start') / $this->config->user_item('pagination/items') + 1);

		return array($this->config->user_item('pagination/items'),$this->config->user_item('pagination/start'));
	}
	
}
?>
