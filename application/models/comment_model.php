<?php
class comment_model extends WT_Model{
	function __construct() {
		parent::__construct();
		$this->table='version_comment';
		$this->fields=array(
			'id'=>0,//所属产品
			'status'=>'',//
			'content'=>'',//内容
			'user'=>0,//创意开始日期
			'time'=>date('Y-m-d'),//发表日期
			'version'=>0,//版本
		);
	}
	function getList(array $args=array()){
		if(array_key_exists('change_table', $args) && $args['change_table']){
			$this->table='user_status_comment';
		}
		if(!(isset($args['project'])&&$args['project'] !== false)){
			//echo $this->table."<br>";
			if(!array_key_exists('select', $args) || $args['select']){
				$this->db->join('user','user.id = '.$this->table.'.user','left')
				->select($this->table.'.*, user.name as username ');
				//$user_status_comment = $this->db->from('user_status_comment')->join('user','user.id = user_status_comment.user','left')->select('user_status_comment.*, user.name as username ');
				//print_r($reslutfirst);echo '<br>';
	//			$sql = "SELECT version_comment.*, `user`.name as username FROM (`version_comment`) LEFT JOIN `user` ON `user`.`id` = `version_comment`.`user`";
	//			$reslutsecond = $this->db->query($sql);
	//			$reslutsecond = $reslutsecond->result();
				//print_r($reslutsecond);echo '<br>';
	//			SELECT `user`.* FROM (`user`)  
	//			FROM (`user_status_comment`) 
	//			LEFT JOIN `user` ON `user`.`id` = `user_status_comment`.`user` 
	//			union all 
	//			SELECT `user`.* FROM (`user`)
	//			FROM (`version_comment`) 
	//			LEFT JOIN `user` ON `user`.`id` = `version_comment`.`user`';
				 //echo mysql_error();
				// echo $query->result();
				//echo $this->db->result();
				//$this->db->join('user','user.id = user_status_comment.user','left')->select('user_status_comment.*, user.name as username ');
				//echo $this->db->last_query();
				//$this->db->select($this->table.'.*, DATE(datetime) date, TIME(datetime) time, UNIX_TIMESTAMP(datetime) timestamp');
			}
			//return $reslutfirst;
		}else{
			$this->db->select('version_comment.*')
			->join('version','version.id = version_comment.version','inner')
			->join('wit','wit.id = version.wit','inner')
			->select('wit.id AS wit')
			->join('project','project.id = wit.project','inner')
			->select('project.id AS project, project.name AS project_name')
			->join('user','user.id = version_comment.user','inner')
			->select('user.name AS username')
			->where('project.id',$args['project']);
		}
			return parent::getList($args);
	}
	function delcomment($id = 0){
		$this->db->delete($this->table,array('id' => $id)); 
	}
	function setcomment($id = 0,$value = 0){
		if($value == 0){
			$value = 1;
		}else{
			$value = 0;
		}
		$data = array(
		   'is_show' => $value,
		);
		$this->db->where('id', $id);
		$this->db->update($this->table,$data); 
	}
	function sum(array $args=array()){
		 //print_r($this->db->select(' COUNT(*) '));echo "<br>";
		echo $this->db->last_query();
	}
}
?>
