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
			'company_name'=>'可口可乐',
			'voters'=>array(
				array('id'=>1,'name'=>'user_1'),
				array('id'=>1,'name'=>'user_1')
			),
			'voters_count'=>2,
			'votes'=>4,
			'tags'=>array('网站','UI','广告'),
			'candidates'=>array(
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
		
		$voting_projects=array(
			$recommended_voting_project,
			$recommended_voting_project
		);

		
		$this->load->view('vote/list');
	}
	
	/**
	 * 项目投票详情查看页
	 */
	function view(){
		$this->load->view('vote/view');
	}
	
}
?>
