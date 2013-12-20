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
	function fetch($id=NULL,$field=NULL){
		
		is_null($id) && $id=$this->id;
		
		$id=intval($id);
		
		$row=$this->db->select($this->table.'.*')->from($this->table)->where($this->table.'.id',$id)->get()->row_array();
		
		if(!$row){
			show_error('"'.$this->table.' '.$id.'" item not found');
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
		$data=array_merge($this->fields,array_intersect_key($data, $this->fields));
		$this->db->insert($this->table,$data);
		return $this->db->insert_id();
	}
	
	function update(array $data, $id=NULL){
		$data=array_intersect_key($data, $this->fields);
		
		is_null($id) && $id=$this->id;
		
		if(is_array($id)){
			$this->db->where($id);
		}else{
			$this->db->where($this->table.'.id', $id);
		}
		
		$this->db->update($this->table,$data);
		
		return $this;
	}
	
	function remove($id=NULL){
		is_null($id) && $id=$this->id;
		
		if(is_array($id)){
			$this->db->where($id);
		}else{
			$this->db->where($this->table.'.id', $id);
		}
		
		$this->db->delete($this->table);
		
		return $this;
	}
	
	function addCount($field,$item_id=NULL){
		is_null($item_id) && $item_id=$this->id;
		$this->db
			->set($field,'`'.$field.'` + 1',false)
			->where('id',$item_id)
			->update($this->table);
	}
	
	/**
	 * 
	 * @param array $args
	 * name
	 * count_all_results
	 * order_by string or array
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
		
		if(array_key_exists('name',$args)){
			$this->db->like($this->table.'.name',$args['name']);
		}
		
		if(array_key_exists('id_in',$args)){
			if(!$args['id_in']){
				$this->db->where('FALSE',NULL,false);
			}else{
				$this->db->where_in($this->table.'.id',$args['id_in']);
			}
		}
		
		if(array_key_exists('count_all_results',$args) && $args['count_all_results']){
			return $this->db->count_all_results();
		}
		
		//复制一个DB对象用来计算行数，因为计算行数需要运行sql，将清空DB对象中属性
		$db_num_rows=clone $this->db;
		
		if(array_key_exists('order_by',$args)){
			if(is_array($args['order_by'])){
				foreach($args['order_by'] as $order_by){
					$this->db->order_by($order_by[0],$order_by[1]);
				}
			}elseif($args['order_by']){
				$this->db->order_by($args['order_by']);
			}
		}
		
		if(array_key_exists('group_by', $args)){
			$this->db->group_by($args['group_by']);
		}
		
		if(array_key_exists('having', $args)){
			$this->db->having($args['having']);
		}
		
		if(array_key_exists('limit',$args)){
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
	
	
	function getArray(array$args=array(),$keyname='name',$keyname_forkey='id'){
		return array_column($this->getList($args),$keyname,$keyname_forkey);
	}
	
	function getRow(array $args=array()){
		!array_key_exists('limit',$args) && $args['limit']=1;
		$result=$this->getList($args);
		if(isset($result[0])){
			return $result[0];
		}else{
			return array();
		}
	}
	
	function sum($field, array $args=array()){
		$this->db->select_sum($field);
		$result=$this->getRow($args+array('select'=>false));
		return $result[$field]?$result[$field]:0;
	}
	
	function count(array $args=array()){
		return $this->getList($args+array('count_all_results'=>true));
	}
	
	function getTags($id=NULL){
		is_null($id) && $id=$this->id;
		
		$this->db->select('tag.name')
			->from("{$this->table}_tag")
			->join('tag',"tag.id = {$this->table}_tag.tag",'inner')
			->where("{$this->table}_tag.{$this->table}",$id);
		
		return array_column($this->db->get()->result_array(),'name');
	}
	
	function addTags(array $tags, $id=NULL){
		is_null($id) && $id=$this->id;
		
		$insert=array_diff($tags,array_column($this->db->from('tag')->where_in('name',$tags)->get()->result_array(),'name'));
		$set=array();
		foreach($insert as $tag_name){
			if(!$tag_name){
				continue;
			}
			$set[]=array('name'=>$tag_name);
		}
		$set && $this->db->insert_batch('tag', $set);
		
		$tag_ids=array_column($this->db->from('tag')->where_in('name',$tags)->get()->result_array(),'id');
		
		$this->db->where_in('id',$tag_ids)->set('hits', '`hits` + 1', false)->update('tag');
		
		$set=array();
		foreach($tag_ids as $tag_id){
			$set[]=array($this->table=>$id,'tag'=>$tag_id);
		}
		$set && $this->db->insert_batch("{$this->table}_tag",$set);
		
		return $this->db->affected_rows();
	}
	
	function removeTags(array $tags, $id){
		is_null($id) && $id=$this->id;
		
		$tag_ids=array_column($this->db->select('id')->from('tag')->where_in('name',$tags)->get()->result_array(),'id');
		
		$this->db->where_in('id',$tag_ids)->set('hits', '`hits` - 1', false)->update('tag');
		
		$tags && $this->db->where_in('tag',$tag_ids)->delete("{$this->table}_tag");
		
		return $this->db->affected_rows();
	}
	
	function updateTags(array $tags,$id=NULL){
		is_null($id) && $id=$this->id;
		
		$current=$this->getTags($id);
		
		$insert=array_diff($tags,$current);
		$delete=array_diff($current,$tags);
		
		$this->addTags($insert, $id);
		$this->removeTags($delete, $id);
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
