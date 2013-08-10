<?php
class Test extends WT_Controller{
	function __construct() {
		parent::__construct();
	}
	
	function index(){
		$this->load->model('finance_model','finance');
//		$this->account->getList(1, array(
//			'item'=>'悬赏奖金',
//			'date'=>['from'=>'2013-01-01']
//		));
		
		echo $this->finance->sum(array(
			'user'=>2,
			'item'=>'可用悬赏积分',
			'date'=>array('from'=>'2013-8-2')
		));
		
		
	}
}
?>
