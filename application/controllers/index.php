<?php
class Index extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 首页
	 */
	function index(){
		
		$projects=array(
			array(
				'id'=>1,
				'name'=>'',
				'summary'=>'',
				'date_start'=>'2012-08-05',
				'date_end'=>'2012-09-05',
				'bonus'=>'10000.00',
				'labels'=>array('可乐','广告'),
				'comments'=>array(
					array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_02')
				),
				//'reposts'=>10 项目的转发删了，不要了
				'comments_count'=>2,
				'favorites'=>3,
				'company'=>2,
				'company_name'=>'可口可乐'
			),
			array(
				'id'=>2,
				'date_start'=>'2012-08-05',
				'date_end'=>'2012-09-05',
				'bonus'=>'10000.00',
				'labels'=>array('可乐','广告'),
				'comments'=>array(
					array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_02')
				),
				'comments_count'=>2,
				'favorites'=>3,
				'company'=>2,
				'company_name'=>'可口可乐'
			)
		);
		
		$this->load->view('index',compact('projects'));
	}
	
}
?>
