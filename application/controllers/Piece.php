<?php

class Piece extends WT_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('piece_model', 'piece');
	}
	
	function index() {
		$pieces = array();
		$this->load->view('piece/list', compact('pieces'));
	}
	
	function detail($id) {
		$this->load->view('piece/detail');
	}
	
	function edit($id = null) {
		
		$this->load->model('project_model', 'project');
		
		if($this->input->post('submit') !== false){
			if(is_null($id)){
				$id = $this->piece->create($this->input->post());
				redirect('piece/edit/' . $id);
			}
			else{
				$this->piece->update($id, $this->input->post());
			}
		}
		
		if(!is_null($id)){
			$piece = $this->piece->get($id);
			$piece['project_name'] = $this->project->fetch($piece['project'])['name'];
		}
		
		$this->load->view('piece/edit', compact('piece'));
	}
	
}
