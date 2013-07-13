<?php
class Company_model extends User_model{
	
	var $total_bonus;
	
	function __construct() {
		parent::__construct();
		$this->table='company';
		
		$this->fields=array(
			'description'=>'',//描述,
			'total_bonus'=>0.00//悬赏余额
		);
		
		if($this->user->isCompany()){
			$company=$this->fetch();
			$this->total_bonus=$company['total_bonus'];
		}
	}
	
	function freezeBonus($amount,$company=NULL){
		is_null($company) && $company=$this->id;
		$this->db->set('frozen_bonus','`frozen_bonus` + '.$amount,false)
			->set('total_bonus','`total_bonus` - '.$amount,false)
			->where('id',$company)
			->update('company');
		
		return $this->db->affected_rows();
	}
}
?>
