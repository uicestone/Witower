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
			'name'=>'项目名字',
			'summary'=>'简介有木有',
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
		);
		
		$active_project=10;
		
		$participants=171;
		
		$hot_tags=array('设计','包装','LOGO平面','网站','UI','广告','制作');
		
		$money = array('100-1000','1000-5000','5000,10000','10000-15000');
		
		$date = array('今日发布','昨日发布','三日内发布','48小时内发布','24小时内发布');
	
		$people = array('七嘴八舌(1-50)','高朋满座(51-500)' ,'人多势众(501-2000)','熙来攘往(2001-5000)','人山人海(5000以上)');
		
		$latest_projects=array(
			array(
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
			)
		);
		
		$hotprojects = array(
			array(
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
			)
		);
		
		$bonus_projects = array(
			array(
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
				'id'=>1,
				'name'=>'项目名字',
				'summary'=>'简介有木有',
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
			)
		);
		
//		$hot_projects=$latest_projects;
//		
//		$high_bonus_projects=$latest_projects;

		$this->load->view('project/list',compact('recommended_project','active_project','participants','hot_tags','money','date','people','latest_projects','hotprojects','bonus_projects'));
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
				array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_02')
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
				'title'=>'创意标题1',
				'content'=>'什么叫同义词11111？同义词，是表达的意义相同但是名称不同的词条，例如：“北京”和“北京市”是同义词。为了避免不同用户提交名称不同而内容相同的词条，造成资源浪费和重复劳动，互动百科会将概念相同的词条添加为同义',
				'comments'=>array(
					array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_02')
				),
				'comments_count'=>2
			),
			array(
				'id'=>2,
				'title'=>'创意标题2',
				'content'=>'什么叫同义词22222？同义词，是表达的意义相同但是名称不同的词条，例如：“北京”和“北京市”是同义词。为了避免不同用户提交名称不同而内容相同的词条，造成资源浪费和重复劳动，互动百科会将概念相同的词条添加为同义',
				'comments'=>array(
					array('id'=>1,'content'=>'Nike的Air系列不错。','user'=>5,'username'=>'user_01'),
					array('id'=>1,'content'=>'顶楼上。','user'=>6,'username'=>'user_02')
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
		$collection_tags = array('设计','包装');
		
		$this->load->view('project/view',  compact('project','wits','hot_tags','participants','participants_count','recommended_projects','recommended_votes','Collection_tags'));
	}
}
?>
