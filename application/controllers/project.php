<?php
class Project extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 项目列表页
	 */
	function index(){
		
		$recommended_project=array(
			'id'=>1,
			'name'=>'',
			'summary'=>'',
			'date_start'=>'2012-08-05',
			'date_end'=>'2012-09-05',
			'bonus'=>'10000.00',
			'labels'=>array('可乐','广告'),
			'comments'=>array(
				array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
				array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_01')
			),
			//'reposts'=>10 项目的转发删了，不要了
			'comments_count'=>2,
			'favorites'=>3,
			'company'=>2,
			'company_name'=>'可口可乐'
		);
		
		$active_project=10;
		
		$participants=171;
		
		$hot_tags=array('设计','包装','LOGO平面','网站','UI','广告','制作');
		
		$latest_projects=array(
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
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_01')
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
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_01')
				),
				'comments_count'=>2,
				'favorites'=>3,
				'company'=>2,
				'company_name'=>'可口可乐'
			)
		);
		
		$hot_projects=$latest_projects;
		
		$high_bonus_projects=$latest_projects;
		
		$this->load->view('project/list');
	}
	
	/**
	 * 项目详情页
	 */
	function view(){
		
		$project=array(
			'id'=>1,
			'name'=>'',
			'summary'=>'',
			'date_start'=>'2012-08-05',
			'date_end'=>'2012-09-05',
			'bonus'=>'10000.00',
			'labels'=>array('可乐','广告'),
			'comments'=>array(
				array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
				array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_01')
			),
			//'reposts'=>10 项目的转发删了，不要了
			'comments_count'=>2,
			'favorites'=>3,
			'company'=>2,
			'company_name'=>'可口可乐'
		);
		
		$wits=array(
			array(
				'id'=>1,
				'title'=>'创意标题',
				'content'=>'什么叫同义词？同义词，是表达的意义相同但是名称不同的词条，例如：“北京”和“北京市”是同义词。为了避免不同用户提交名称不同而内容相同的词条，造成资源浪费和重复劳动，互动百科会将概念相同的词条添加为同义',
				'comments'=>array(
					array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_01')
				),
				'comments_count'=>2
			),
			array(
				'id'=>2,
				'title'=>'创意标题',
				'content'=>'什么叫同义词？同义词，是表达的意义相同但是名称不同的词条，例如：“北京”和“北京市”是同义词。为了避免不同用户提交名称不同而内容相同的词条，造成资源浪费和重复劳动，互动百科会将概念相同的词条添加为同义',
				'comments'=>array(
					array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_01')
				),
				'comments_count'=>2
			),
		);
		
		$participants=array(
			array('id'=>1,'name'=>'user1'),
			array('id'=>2,'name'=>'user2'),
		);
		
		$participants_count=count($participants);
		
		$hot_tags=array('设计','包装','Logo平面','网站');
		
		$recommended_projects=array(
			array('id'=>1,'name'=>'Sony PSV'),
			array('id'=>2,'name'=>'可口可乐广告'),
		);
		
		$recommended_votes=array(
			array('id'=>1,'name'=>'Sony PSV'),
			array('id'=>2,'name'=>'可口可乐广告'),
		);
		
		$this->load->view('project/view');
	}
}
?>
