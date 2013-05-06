<?php
class Index extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 首页
	 */
	function index(){
		
		$project=array(
			array(
				'id'=>1,
				'pic'=>'/uploads/images/project/1.jpg',
				'expire_date'=>'2012-09-05',
				'bonus'=>'10000.00',
				'labels'=>array('可乐','广告'),
				'comments'=>array(
					array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_01')
				)
			),
			array(
				'id'=>2,
				'pic'=>'/uploads/images/project/2.jpg',
				'expire_date'=>'2012-09-05',
				'bonus'=>'10000.00',
				'labels'=>array('可乐','广告'),
				'comments'=>array(
					array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_01')
				)
			)
		);
		
		$this->load->view('index',compact('project'));
	}
	
}
?>
