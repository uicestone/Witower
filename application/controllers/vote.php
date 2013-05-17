<?php
class Vote extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	/**
	 * 投票中的项目列表页
	 */
	function index(){
		
		$recommended_voting_project=array(
			'id'=>1,
			'name'=>'项目名字',
			'summary'=>'项目介绍',
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
			'company_name'=>'可口可乐',
			'voters'=>array(
				array('id'=>1,'name'=>'user_1'),
				array('id'=>2,'name'=>'user_2')
			),
			'voters_count'=>2,
			'votes'=>4,
			'tags'=>array('网站','UI','广告'),
			'candidates'=>array(//todo:如果这里是投票的话那么好像还少一个用户名字段，视图的是0.5%的人投票给@XX
				array(
					'percentage'=>0.5,
					'votes'=>2
				),
				array(
					'percentage'=>0.5,
					'votes'=>2
				)
			)
		);
		$hot_tags=array('设计','包装','LOGO平面','网站','UI','广告','制作');
		
		$money = array('100-1000','1000-5000','5000,10000','10000-15000');
		
		$date = array('今日发布','昨日发布','三日内发布','48小时内发布','24小时内发布');
	
		$people = array('七嘴八舌(1-50)','高朋满座(51-500)' ,'人多势众(501-2000)','熙来攘往(2001-5000)','人山人海(5000以上)');
		//@tudo:少了一个"我参与的"数组
		$voting_projects=array(
			$recommended_voting_project,
			$recommended_voting_project
		);

		
		$this->load->view('vote/list',  compact('recommended_voting_project','hot_tags','money','date','people','voting_projects'));
	}
	
	/**
	 * 项目投票详情查看页
	 */
	function view(){
		$this->load->view('vote/view');
	}
	
}
?>
